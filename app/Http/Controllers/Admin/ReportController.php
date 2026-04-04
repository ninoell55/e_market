<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getReportData($request);
        return view('admin.report.index', $data);
    }

    public function exportPDF(Request $request)
    {
        $data = $this->getReportData($request);
        $pdf = Pdf::loadView('admin.report.pdf', $data)->setPaper('a4', 'portrait');

        $filename = 'Report-' . ($request->date ?? $request->month . '-' . $request->year) . '.pdf';
        return $pdf->download($filename);
    }

    private function getReportData(Request $request)
    {
        $query = Order::where('status', 'completed');
        $itemQuery = OrderItem::whereHas('order', function ($q) {
            $q->where('status', 'completed');
        });

        // Filter Waktu (Hari, Bulan, Tahun)
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
            $itemQuery->whereDate('created_at', $request->date);
        } else {
            $month = $request->get('month', date('m'));
            $year = $request->get('year', date('Y'));
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
            $itemQuery->whereMonth('created_at', $month)->whereYear('created_at', $year);
        }

        // 1. Laporan Keuangan
        $totalRevenue = $query->sum('total_price');
        $totalOrders = $query->count();

        // 2. Produk Terlaris (Top 5)
        $bestSellers = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
            ->whereHas('order', function ($q) use ($request) {
                $q->where('status', 'completed');
                if ($request->filled('date')) $q->whereDate('created_at', $request->date);
                else $q->whereMonth('created_at', $request->get('month', date('m')))->whereYear('created_at', $request->get('year', date('Y')));
            })
            ->groupBy('product_name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        // 3. Produk Kurang Laku (Low Performing)
        // Kita ambil produk yang ada di sistem tapi tidak ada di OrderItem pada periode tersebut
        $soldProductNames = $bestSellers->pluck('product_name')->toArray();
        $slowMoving = Product::whereNotIn('name', $soldProductNames)
            ->take(5)
            ->get();

        return [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'bestSellers' => $bestSellers,
            'slowMoving' => $slowMoving,
            'orders' => $query->latest()->get(),
            'filters' => [
                'date' => $request->date,
                'month' => $request->get('month', date('m')),
                'year' => $request->get('year', date('Y')),
            ]
        ];
    }
}
