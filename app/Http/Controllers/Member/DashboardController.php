<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['category', 'variants'])
            ->when($request->search, fn($query) => $query->where('name', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('member.dashboard', ['title' => 'Dashboard - Member Panel'], compact('products', 'categories'));
    }

    public function archive()
    {
        return view('member.archive.index', ['title' => 'Archive']);
    }
}
