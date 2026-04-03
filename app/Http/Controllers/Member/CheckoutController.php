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
    /**
     * TAMPILAN CHECKOUT
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Check if this is direct checkout from session
        if ($request->query('source') === 'cart') {
            session()->forget('direct_checkout_product');
        }

        $directCheckoutData = session('direct_checkout_product');

        if ($directCheckoutData) {
            // Direct checkout: build cart-like structure from session
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

        // Regular checkout from cart
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

    /**
     * PROSES SIMPAN ORDER (POST)
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // 1. VALIDASI INPUT (Sesuai ERD dan rule bisnis)
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

        $directCheckoutData = session('direct_checkout_product');
        $isDirectCheckout = !is_null($directCheckoutData);

        // Get cart data (only if not direct checkout)
        $cart = null;
        if ($isDirectCheckout) {
            // Validate direct checkout data
            if (!isset($directCheckoutData['product_id']) || !isset($directCheckoutData['product_variant_id'])) {
                return back()->with('error', 'Direct checkout data invalid.');
            }
        } else {
            $cart = Cart::where('user_id', $user->id)
                ->with(['items.product', 'items.variant'])
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return back()->with('error', 'No items to process.');
            }
        }

        $address = $user->addresses()->find($request->address_id);
        if (!$address) {
            return back()->with('error', 'Address not found or not authorized.');
        }

        // Calculate total price
        $totalPrice = 0;
        if ($isDirectCheckout) {
            $variant = ProductVariant::findOrFail($directCheckoutData['product_variant_id']);
            $totalPrice = $variant->price * $directCheckoutData['quantity'];
        } else {
            $totalPrice = $cart->items->sum(function ($item) {
                $price = optional($item->variant)->price ?? optional($item->product)->price ?? 0;
                return $price * $item->quantity;
            });
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'TRX-' . strtoupper(Str::random(10)),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => "{$address->recipient_name} | {$address->address}, {$address->city}, {$address->province} ({$address->recipient_phone})",
            ]);

            if ($isDirectCheckout) {
                // Process direct checkout product
                $product = Product::findOrFail($directCheckoutData['product_id']);
                $variant = ProductVariant::findOrFail($directCheckoutData['product_variant_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_variant_id' => $variant->id,
                    'product_name' => $product->name,
                    'variant_name' => $variant->attribute_name ? $variant->attribute_name . ': ' . $variant->attribute_value : '-',
                    'price' => $variant->price,
                    'quantity' => $directCheckoutData['quantity'],
                    'subtotal' => $variant->price * $directCheckoutData['quantity'],
                ]);
            } else {
                // Process regular cart items
                foreach ($cart->items as $item) {
                    $variantPrice = optional($item->variant)->price ?? optional($item->product)->price ?? 0;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id,
                        'product_name' => optional($item->product)->name,
                        'variant_name' => optional($item->variant)->attribute_name ? optional($item->variant)->attribute_name . ': ' . optional($item->variant)->attribute_value : '-',
                        'price' => $variantPrice,
                        'quantity' => $item->quantity,
                        'subtotal' => $variantPrice * $item->quantity,
                    ]);
                }

                // Delete cart items only for regular checkout
                $cart->items()->delete();
            }

            $proofPath = null;
            if ($request->hasFile('proof_image')) {
                $proofPath = $request->file('proof_image')->store('payments/proofs', 'public');
            }

            Payment::create([
                'order_id' => $order->id,
                'method' => $request->method,
                'amount' => $totalPrice,
                'status' => 'pending',
                'transaction_id' => 'PAY-' . strtoupper(Str::random(12)),
                'proof_image' => $proofPath,
            ]);

            // Clear direct checkout session if exists
            if ($isDirectCheckout) {
                session()->forget('direct_checkout_product');
            }

            DB::commit();

            $successMessage = $request->method === 'COD'
                ? 'Order_Registry_Completed via COD.'
                : 'Payment_Proof_Submitted. Waiting for verification.';

            return redirect()->route('member.archive.show_order', $order->id)->with('success', $successMessage);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'System Failure: ' . $e->getMessage());
        }
    }

    /**
     * STRUK DIGITAL UNTUK SCAN QR (Simulasi)
     */
    public function digitalReceipt(Request $request, $id = null)
    {
        $user = Auth::user();
        $date = now()->format('d/m/Y H:i');

        // Jika scan QR dari Direct Checkout
        if ($request->query('type') === 'direct') {
            $directData = session('direct_checkout_product');
            if (!$directData) return abort(404, 'Session Expired');

            $product = Product::findOrFail($directData['product_id']);
            $variant = ProductVariant::findOrFail($directData['product_variant_id']);

            // Buat mock object supaya view receipt tidak error
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

        // Jika scan QR dari Cart Normal
        $cart = Cart::where('id', $id)->where('user_id', $user->id)->with(['items.product', 'items.variant'])->firstOrFail();
        $total = $cart->items->sum(fn($item) => $item->variant->price * $item->quantity);

        return view('member.checkout.receipt', compact('cart', 'total', 'date'));
    }

    /**
     * DIRECT CHECKOUT - Save product to session and proceed to checkout
     */
    public function directCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Store direct checkout data in session (isolated from cart)
        session([
            'direct_checkout_product' => [
                'product_id' => $request->product_id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
            ],
        ]);

        return redirect()->route('member.checkout.index');
    }
}
