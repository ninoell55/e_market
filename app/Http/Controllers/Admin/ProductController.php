<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['category', 'variants'])
            ->when($request->search, fn($query) => $query->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->category, fn($query) => $query->whereHas('category', fn($q) => $q->where('slug', $request->category)))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.product.index', ['title' => 'Products List'], compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['title' => 'Create New Product'], compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->where(fn($query) => $query->where('category_id', $request->category_id))],
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_best' => 'boolean',

            'variants' => 'required|array|min:1',
            'variants.*.attribute_name' => 'required|string',  
            'variants.*.attribute_value' => 'required|string', 
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $fileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->hashName();
            $file->storeAs('uploads', $fileName, 'public');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $fileName,
            'is_best' => $request->has('is_best')
        ]);

        foreach ($request->variants as $variant) {
            $product->variants()->create([
                'attribute_name' => $variant['attribute_name'],
                'attribute_value' => $variant['attribute_value'],
                'price' => $variant['price'],
                'stock' => $variant['stock'],
            ]);
        }

        Alert::success('Success', 'Product and variants created successfully!');
        return redirect()->route('admin.product.index');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', ['title' => 'Product Details'], compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', ['title' => 'Edit Product'], compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($product->id)->where(fn($query) => $query->where('category_id', $request->category_id))
            ],
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_best' => 'nullable|boolean',

            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.attribute_name' => 'required|string',
            'variants.*.attribute_value' => 'required|string',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $fileName = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists('uploads/' . $product->image)) {
                Storage::disk('public')->delete('uploads/' . $product->image);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('uploads', $fileName, 'public');
        }

        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $fileName,
            'is_best' => $request->has('is_best')
        ]);

        $formVariantIds = collect($request->variants)->pluck('id')->filter()->toArray();

        $product->variants()->whereNotIn('id', $formVariantIds)->delete();

        foreach ($request->variants as $variantData) {
            if (isset($variantData['id'])) {
                $product->variants()->where('id', $variantData['id'])->update([
                    'attribute_name' => $variantData['attribute_name'],
                    'attribute_value' => $variantData['attribute_value'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                ]);
            } else {
                $product->variants()->create([
                    'attribute_name' => $variantData['attribute_name'],
                    'attribute_value' => $variantData['attribute_value'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                ]);
            }
        }

        Alert::success('Success', 'Product and variants updated successfully!');
        return redirect()->route('admin.product.index');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists('uploads/' . $product->image)) {
            Storage::disk('public')->delete('uploads/' . $product->image);
        }

        $product->delete();

        Alert::success('Success', 'Product deleted successfully!');
        return redirect()->route('admin.product.index');
    }
}
