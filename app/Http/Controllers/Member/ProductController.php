<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()
            ->with(['category', 'variants'])
            ->where('category_id', $category->id)
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $title = "Collection / " . $category->category_name;
        $viewPath = "member.collection.{$slug}";

        if (view()->exists($viewPath)) {
            return view($viewPath, compact('category', 'products', 'title'));
        }

        return redirect()->route('member.dashboard');
    }
    
    public function show(Product $product)
    {
        // Load relasi agar kategori dan varian muncul
        $product->load(['category', 'variants']);

        // Ambil produk terkait (opsional, untuk bagian bawah)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('member.collection.show', [
            'title' => $product->name . ' - Detail',
            'product' => $product,
            'related' => $relatedProducts
        ]);
    }
}
