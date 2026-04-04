<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment'])
            ->where('status', '!=', 'cancelled'); // Sembunyikan cancelled

        // Filter Search
        if ($request->search) {
            $query->where('order_number', 'LIKE', "%{$request->search}%")
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', "%{$request->search}%");
                });
        }

        // Filter Status (dari Tabs)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter Payment Method
        if ($request->payment) {
            $query->whereHas('payment', function ($q) use ($request) {
                $q->where('method', $request->payment);
            });
        }

        // Filter Tanggal
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // Sortir
        $sort = $request->sort == 'oldest' ? 'asc' : 'desc';
        $orders = $query->orderBy('created_at', $sort)->paginate(10);

        return view('admin.checkout.index', ['title' => 'Checkout Management'], compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'items.variant', 'payment'])->findOrFail($id);
        return view('admin.checkout.show', ['title' => 'Order Details'], compact('order'));
    }

    // Mengonfirmasi Pembayaran (Untuk Transfer)
    public function approvePayment($id)
    {
        $order = Order::findOrFail($id);

        $order->payment->update(['status' => 'completed']);
        $order->update(['status' => 'paid']);

        return back()->with('success', 'Payment confirmed. Order status: PAID');
    }

    // Mengirim Barang (Simulasi 24 Jam)
    public function shipOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'shipped']);

        return back()->with('success', 'Order is on the way (SHIPPED)');
    }

    // Menyelesaikan Order (Kurir konfirmasi sampai/dibayar COD)
    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);

        // Jika COD, sekalian selesaikan status payment-nya
        if ($order->payment->method === 'COD') {
            $order->payment->update(['status' => 'completed']);
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Transaction finished (COMPLETED)');
    }
}
