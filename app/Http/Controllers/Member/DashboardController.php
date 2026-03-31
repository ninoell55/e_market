<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $categories = Category::all();

        // 1. Banner Utama: Produk yang paling baru ditambahkan
        $featuredProduct = Product::with(['category'])->latest()->first();

        // 2. Tiga Kotak: Produk terbaik (is_best) dari kategori yang berbeda
        // Kita ambil 3 produk yang is_best, di-group berdasarkan kategori agar variatif
        $bestProducts = Product::with(['category'])
            ->where('is_best', true)
            ->latest()
            ->get()
            ->groupBy('category_id')
            ->take(3)
            ->flatten();

        // 3. Semua produk untuk bagian catalog (Pagination)
        $products = Product::with(['category', 'variants'])
            ->when($request->search, fn($query) => $query
                ->where('name', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $ordersCount = $user->orders()->count();

        return view('member.dashboard', [
            'title' => 'Dashboard - Member Panel',
            'user' => $user,
            'orders_count' => $ordersCount,
            'featured' => $featuredProduct,
            'best_products' => $bestProducts,
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
