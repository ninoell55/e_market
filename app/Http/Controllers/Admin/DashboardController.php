<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $yesterday = now()->subDay()->startOfDay();

        // Financial Metrics
        $revenueToday = Order::where('status', 'completed')->whereDate('created_at', $today)->sum('total_price');
        $revenueYesterday = Order::where('status', 'completed')->whereDate('created_at', $yesterday)->sum('total_price');
        $growth = $revenueYesterday > 0 ? (($revenueToday - $revenueYesterday) / $revenueYesterday) * 100 : 0;

        // Operational Metrics
        $pendingOrders = Order::where('status', 'pending')->count();
        $needsConfirmation = DB::table('payments')->where('status', 'Pending')->count();
        $totalUsers = User::where('role', 'member')->count();
        $outOfStock = DB::table('product_variants')->where('stock', '<=', 0)->count();

        // Chart Data (7 Days)
        $salesData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total'))
            ->where('status', 'completed')->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')->orderBy('date', 'asc')->get();

        $chartLabels = $salesData->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('D'))->toArray();
        $chartValues = $salesData->pluck('total')->toArray();

        // Inventori Kritis
        $criticalVariants = DB::table('product_variants')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select('products.name', 'product_variants.attribute_value', 'product_variants.stock', 'products.id as p_id')
            ->where('product_variants.stock', '<', 15)
            ->orderBy('stock', 'asc')->take(6)->get();

        $recentOrders = Order::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', [
            'title' => 'System Control',
            'revenueToday' => $revenueToday,
            'growth' => $growth,
            'pendingOrders' => $pendingOrders,
            'needsConfirmation' => $needsConfirmation,
            'totalUsers' => $totalUsers,
            'outOfStock' => $outOfStock,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'criticalVariants' => $criticalVariants,
            'recentOrders' => $recentOrders
        ]);
    }   
}
