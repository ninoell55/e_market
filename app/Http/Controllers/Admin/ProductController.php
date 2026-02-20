<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['category', 'variants'])
            ->when($request->search, fn($query) => $query->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->category, fn($query) => $query->whereHas('category', fn($q) => $q->where('slug', $request->category)))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.product.index', ['title' => 'Read'], compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['title' => 'Create'], compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->where(fn($query) => $query->where('category_id', $request->category_id))],
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Validasi untuk varian
            'variants' => 'required|array|min:1',
            'variants.*.attribute_name' => 'required|string',  // e.g., Size
            'variants.*.attribute_value' => 'required|string', // e.g., XL
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
            'image' => $fileName
        ]);

        foreach ($request->variants as $variant) {
            $product->variants()->create([
                'attribute_name' => $variant['attribute_name'],
                'attribute_value' => $variant['attribute_value'],
                'price' => $variant['price'],
                'stock' => $variant['stock'],
            ]);
        }

        return redirect()->route('admin.product.index')->with('success', 'Product and variants created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
        return view('admin.product.show', ['title' => 'Show'], compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', ['title' => 'Edit'], compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)->where(fn($query) => $query->where('category_id', $request->category_id))],
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($product->image && Storage::disk('public')->exists('/uploads/' . $product->image)) {
                Storage::disk('public')->delete('/uploads/' . $product->image);
            }
            $fileName = $file->hashName();
            $file->storeAs('uploads', $fileName, 'public');
        } else {
            $fileName = $product->image;
        }


        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'image' => $fileName
        ]);
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists('uploads/' . $product->image)) {
            Storage::disk('public')->delete('uploads/' . $product->image);
        }

        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    }
}
