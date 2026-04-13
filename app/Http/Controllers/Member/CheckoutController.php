<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->query('source') === 'cart') {
            session()->forget('direct_checkout_product');
        }

        $directCheckoutData = session('direct_checkout_product');

        if ($directCheckoutData) {
            $product = Product::with('variants')->findOrFail($directCheckoutData['product_id']);
            $variant = $product->variants()->findOrFail($directCheckoutData['product_variant_id']);

            $total = $variant->price * $directCheckoutData['quantity'];

            return view('member.checkout.index', [
                'title' => 'Finalize_Order',
                'cart' => null,
                'directCheckout' => true,
                'directProduct' => $product,
                'directVariant' => $variant,
                'directQuantity' => $directCheckoutData['quantity'],
                'total' => $total,
                'addresses' => $user->addresses,
            ]);
        }

        $cart = Cart::where('user_id', $user->id)
            ->with(['items.product', 'items.variant'])
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('member.cart.index')->with('error', 'Your archive is empty.');
        }

        $total = $cart->items->sum(function ($item) {
            return $item->variant->price * $item->quantity;
        });

        return view('member.checkout.index', [
            'title' => 'Finalize_Order',
            'cart' => $cart,
            'directCheckout' => false,
            'total' => $total,
            'addresses' => $user->addresses,
        ]);
    }

    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'address_id' => [
                'required',
                Rule::exists('addresses', 'id')->where(fn($query) => $query->where('user_id', $user->id)),
            ],
            'method' => 'required|in:COD,Transfer',
            'proof_image' => [
                Rule::requiredIf(fn() => $request->method === 'Transfer'),
                'nullable',
                'image',
                'mimes:jpg,png,jpeg',
                'max:2048',
            ],
        ]);

        $address = $user->addresses()
            ->where('id', $request->address_id)
            ->firstOrFail();

        $directCheckoutData = session('direct_checkout_product');
        $isDirectCheckout = !is_null($directCheckoutData);

        if ($isDirectCheckout) {
            $variant = ProductVariant::with('product')->findOrFail($directCheckoutData['product_variant_id']);
            $itemsToProcess = [
                (object)[
                    'product' => $variant->product,
                    'variant' => $variant,
                    'quantity' => $directCheckoutData['quantity']
                ]
            ];
        } else {
            $cart = Cart::where('user_id', $user->id)->with(['items.product', 'items.variant'])->first();
            if (!$cart || $cart->items->isEmpty()) return back()->with('error', 'No items to process.');
            $itemsToProcess = $cart->items;
        }

        DB::beginTransaction();
        try {
            foreach ($itemsToProcess as $item) {
                if ($item->variant->stock < $item->quantity) {
                    throw new \Exception("Stock {$item->product->name} ({$item->variant->attribute_value}) not available.");
                }
            }

            $totalPrice = collect($itemsToProcess)->sum(fn($i) => $i->variant->price * $i->quantity);

            $orderStatus = ($request->method === 'COD') ? 'pending' : 'pending';

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'TRX-' . strtoupper(Str::random(10)),
                'total_price' => $totalPrice,
                'status' => $orderStatus,
                'shipping_address' =>
                $address->recipient_name . ' - ' . $address->recipient_phone . ', ' . $address->province . ', ' . $address->city . ', ' . $address->address,
                'ordered_at' => now(),
            ]);

            foreach ($itemsToProcess as $item) {
                $item->variant->decrement('stock', $item->quantity);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'product_variant_id' => $item->variant->id,
                    'product_name' => $item->product->name,
                    'variant_name' => $item->variant->attribute_value,
                    'price' => $item->variant->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->variant->price * $item->quantity,
                ]);
            }

            $proofPath = $request->hasFile('proof_image')
                ? $request->file('proof_image')->store('payments/proofs', 'public')
                : null;

            Payment::create([
                'order_id' => $order->id,
                'method' => $request->method,
                'amount' => $totalPrice,
                'status' => 'pending', 
                'transaction_id' => 'PAY-' . strtoupper(Str::random(12)),
                'proof_image' => $proofPath,
            ]);

            if (!$isDirectCheckout) $cart->items()->delete();
            session()->forget('direct_checkout_product');

            DB::commit();
            return redirect()->route('member.archive.show_order', $order->id)->with('success', 'Order placed successfully! Please wait for confirmation.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function digitalReceipt(Request $request, $id = null)
    {
        $user = Auth::user();
        $date = now()->format('d/m/Y H:i');

        if ($request->query('type') === 'direct') {
            $directData = session('direct_checkout_product');
            if (!$directData) return abort(404, 'Session Expired');

            $product = Product::findOrFail($directData['product_id']);
            $variant = ProductVariant::findOrFail($directData['product_variant_id']);

            $cart = (object)[
                'id' => 'DIRECT',
                'items' => collect([(object)[
                    'product' => $product,
                    'variant' => $variant,
                    'quantity' => $directData['quantity']
                ]])
            ];
            $total = $variant->price * $directData['quantity'];

            return view('member.checkout.receipt', compact('cart', 'total', 'date'));
        }

        $cart = Cart::where('id', $id)->where('user_id', $user->id)->with(['items.product', 'items.variant'])->firstOrFail();
        $total = $cart->items->sum(fn($item) => $item->variant->price * $item->quantity);

        return view('member.checkout.receipt', compact('cart', 'total', 'date'));
    }

    public function directCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        session([
            'direct_checkout_product' => [
                'product_id' => $request->product_id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
            ],
        ]);

        return redirect()->route('member.checkout.index');
    }

    public function cancelOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->created_at->diffInMinutes(now()) > 10) {
            return back()->with('error', 'Time limit for cancellation has passed. You can contact support for assistance.');
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Time limit for cancellation has passed. You can contact support for assistance.');
        }

        DB::beginTransaction();
        try {
            foreach ($order->items as $item) {
                $item->variant->increment('stock', $item->quantity);
            }

            $order->update(['status' => 'cancelled']);
            $order->payment->update(['status' => 'failed']);

            DB::commit();
            return back()->with('success', 'Order successfully cancelled. Stock has been returned.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to cancel order.');
        }
    }
}
