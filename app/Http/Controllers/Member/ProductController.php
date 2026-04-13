<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $isAccessory = strtolower($category->category_name) == 'accessories';

        $availableSizes = null;
        $availableColors = null;

        if ($isAccessory) {
            $availableColors = ProductVariant::whereHas('product', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })
                ->where('attribute_name', 'color')
                ->distinct()
                ->pluck('attribute_value');
        } else {
            $availableSizes = ProductVariant::whereHas('product', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })
                ->where('attribute_name', 'size')
                ->distinct()
                ->pluck('attribute_value');
        }

        $products = $category->products()
            ->with(['category', 'variants'])
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->size, function ($query, $size) {
                $query->whereHas('variants', fn($q) => $q->where('attribute_name', 'size')->where('attribute_value', $size));
            })
            ->when($request->color, function ($query, $color) {
                $query->whereHas('variants', fn($q) => $q->where('attribute_name', 'color')->where('attribute_value', $color));
            })
            ->when($request->sort, function ($query, $sort) {
                switch ($sort) {
                    case 'price_high':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'price_low':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'oldest':
                        $query->oldest();
                        break;
                    default:
                        $query->latest();
                        break;
                }
            }, fn($query) => $query->latest())
            ->paginate(10)
            ->withQueryString();

        $title = "Collection / " . $category->category_name;

        $viewData = compact('category', 'products', 'title', 'availableSizes', 'availableColors');
        $viewPath = "member.collection.{$slug}";

        return view()->exists($viewPath)
            ? view($viewPath, $viewData)
            : view('member.collection.index', $viewData);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'variants']);

        $variantsJson = $product->variants->pluck('price', 'id')->toJson();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('member.collection.show', [
            'title' => $product->name . ' - Detail',
            'product' => $product,
            'related' => $relatedProducts,
            'variantsJson' => $variantsJson 
        ]);
    }
}
