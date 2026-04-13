<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $yesterday = now()->subDay()->startOfDay();

        $revenueToday = Order::where('status', 'completed')->whereDate('created_at', $today)->sum('total_price');
        $revenueYesterday = Order::where('status', 'completed')->whereDate('created_at', $yesterday)->sum('total_price');

        $growth = $revenueYesterday > 0 ? (($revenueToday - $revenueYesterday) / $revenueYesterday) * 100 : ($revenueToday > 0 ? 100 : 0);

        $needsConfirmation = DB::table('orders')->where('status', 'pending')->count();
        $totalUsers = User::where('role', 'member')->count();

        $outOfStock = ProductVariant::where('stock', '<=', 0)->count();

        $last7Days = collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('Y-m-d'));

        $salesData = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            ])
            ->pluck('total', 'date');

        $formattedChart = $last7Days->mapWithKeys(function ($date) use ($salesData) {
            $dayName = Carbon::parse($date)->format('D');
            return [$dayName => (float)($salesData->get($date) ?? 0)];
        });
        $criticalVariants = ProductVariant::with('product:id,name')
            ->where('stock', '<', 15)
            ->orderBy('stock', 'asc')
            ->take(6)
            ->get();

        $recentOrders = Order::with('payment', 'user:id,name,email')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'title' => 'Dashboard - Admin Panel',
            'revenueToday' => $revenueToday,
            'growth' => $growth,
            'needsConfirmation' => $needsConfirmation,
            'totalUsers' => $totalUsers,
            'outOfStock' => $outOfStock,
            'chartLabels' => $formattedChart->keys()->toArray(),
            'chartValues' => $formattedChart->values()->toArray(),
            'criticalVariants' => $criticalVariants,
            'recentOrders' => $recentOrders,
            'totalWeeklyRevenue' => $formattedChart->sum()
        ]);
    }
}
