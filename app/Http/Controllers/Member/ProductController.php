<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('is_best', true)->take(4);
        }])->whereIn('slug', ['shoes', 'clothes', 'accessories'])->get();

        $shoes = $categories->where('slug', 'shoes')->first();
        $clothes = $categories->where('slug', 'clothes')->first();
        $accessories = $categories->where('slug', 'accessories')->first();

        return view('welcome', compact('shoes', 'clothes', 'accessories'));
    }

    public function showCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()
            ->with(['category'])->where('category_id', $category->id)
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $title = "Collection / " . $category->category_name;
        $viewPath = "member.product.{$slug}";

        if (view()->exists($viewPath)) {
            return view($viewPath, compact('category', 'products', 'title'));
        }

        return redirect()->route('member.dashboard');
    }
}
