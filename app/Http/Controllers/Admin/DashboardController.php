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
        // 1. Timeframes - Menggunakan Carbon secara konsisten
        $today = now()->startOfDay();
        $yesterday = now()->subDay()->startOfDay();

        // 2. Financial Metrics
        // Tips: Menggunakan whereDate lebih aman untuk kolom datetime
        $revenueToday = Order::where('status', 'completed')->whereDate('created_at', $today)->sum('total_price');
        $revenueYesterday = Order::where('status', 'completed')->whereDate('created_at', $yesterday)->sum('total_price');

        // Menghitung growth (persentase kenaikan/penurunan dibanding kemarin)
        $growth = $revenueYesterday > 0 ? (($revenueToday - $revenueYesterday) / $revenueYesterday) * 100 : ($revenueToday > 0 ? 100 : 0);

        // 3. Operational Metrics
        $needsConfirmation = DB::table('orders')->where('status', 'pending')->count();
        $totalUsers = User::where('role', 'member')->count();

        // Sesuai tabel product_variants di gambar Anda
        $outOfStock = ProductVariant::where('stock', '<=', 0)->count();

        // 4. Chart Data (7 Days Terakhir) - Optimasi agar tidak ada hari yang kosong
        $last7Days = collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('Y-m-d'));

        $salesData = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            ])
            ->pluck('total', 'date');

        // Mapping agar urutan hari sesuai dan nilai kosong menjadi 0
        $formattedChart = $last7Days->mapWithKeys(function ($date) use ($salesData) {
            $dayName = Carbon::parse($date)->format('D');
            return [$dayName => (float)($salesData->get($date) ?? 0)];
        });

        // 5. Inventory Alerts (Menampilkan stok menipis)
        // Eager loading 'product' dari relasi product_variants -> products
        $criticalVariants = ProductVariant::with('product:id,name')
            ->where('stock', '<', 15)
            ->orderBy('stock', 'asc')
            ->take(6)
            ->get();

        // 6. Recent Transactions (Eager Loading User untuk efisiensi query)
        $recentOrders = Order::with('payment', 'user:id,name,email')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'title' => 'Admin Overview',
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
