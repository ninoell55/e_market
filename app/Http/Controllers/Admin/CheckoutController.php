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
            ->where('status', '!=', 'cancelled');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('order_number', 'LIKE', "%{$request->search}%")
                    ->orWhereHas('user', function ($q2) use ($request) {
                        $q2->where('name', 'LIKE', "%{$request->search}%");
                    });
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->payment) {
            $query->whereHas('payment', function ($q) use ($request) {
                $q->where('method', $request->payment);
            });
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $sort = $request->sort == 'oldest' ? 'asc' : 'desc';
        $orders = $query->orderBy('created_at', $sort)->paginate(10);

        return view('admin.checkout.index', ['title' => 'Transaction Management'], compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'items.variant', 'payment'])->findOrFail($id);
        return view('admin.checkout.show', ['title' => 'Transaction Details'], compact('order'));
    }

    public function approvePayment($id)
    {
        $order = Order::findOrFail($id);

        if (! $order->payment) {
            return back()->with('error', 'Payment record not found.');
        }

        $order->payment->update(['status' => 'completed']);
        $order->update(['status' => 'paid']);

        return back()->with('success', 'Payment confirmed. Order status: PAID');
    }

    public function shipOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'shipped']);

        return back()->with('success', 'Order is on the way (SHIPPED)');
    }

    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);

        if (! $order->payment) {
            return back()->with('error', 'Payment record not found.');
        }

        if ($order->payment->method === 'COD') {
            $order->payment->update(['status' => 'completed']);
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Transaction finished (COMPLETED)');
    }
}
