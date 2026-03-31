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
            'is_best' => 'boolean',

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

            // Validasi array variants
            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|exists:product_variants,id', // ID bisa null kalau varian baru
            'variants.*.attribute_name' => 'required|string',
            'variants.*.attribute_value' => 'required|string',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        // Handle Image Upload
        $fileName = $product->image;
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($product->image && Storage::disk('public')->exists('uploads/' . $product->image)) {
                Storage::disk('public')->delete('uploads/' . $product->image);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('uploads', $fileName, 'public');
        }

        // 1. Update data produk utama
        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $fileName,
            'is_best' => $request->has('is_best')
        ]);

        // --- LOGIC VARIANT SYNC ---

        // Ambil semua ID varian yang datang dari form
        $formVariantIds = collect($request->variants)->pluck('id')->filter()->toArray();

        // 2. Hapus varian di database yang tidak ada lagi di dalam form
        $product->variants()->whereNotIn('id', $formVariantIds)->delete();

        // 3. Loop untuk Update atau Create varian
        foreach ($request->variants as $variantData) {
            if (isset($variantData['id'])) {
                // Jika ada ID, berarti update varian lama
                $product->variants()->where('id', $variantData['id'])->update([
                    'attribute_name' => $variantData['attribute_name'],
                    'attribute_value' => $variantData['attribute_value'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                ]);
            } else {
                // Jika ID kosong, berarti ini varian baru yang ditambah di form edit
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

    /**
     * Remove the specified resource from storage.
     */
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
