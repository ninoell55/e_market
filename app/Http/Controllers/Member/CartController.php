<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $cart = Cart::with(['items.product.category', 'items.variant'])
            ->where('user_id', $user->id)
            ->first();

        $cartItems = $cart ? $cart->items : collect();

        $total = $cartItems->sum(function ($item) {
            return $item->variant->price * $item->quantity;
        });

        return view('member.cart.index', [
            'title' => 'Your Archive - Cart',
            'cart' => $cart,
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Auth::user()->cart ?: Cart::create(['user_id' => Auth::id()]);

        $existingItem = $cart->items()
            ->where('product_id', $request->product_id)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $request->quantity);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('member.cart.index')->with('success', 'Added to cart.');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($item->cart->user_id === Auth::id()) {
            $item->update(['quantity' => $request->quantity]);
        }

        return back()->with('success', 'Quantity updated.');
    }

    public function destroy(CartItem $item)
    {
        if ($item->cart->user_id === Auth::id()) {
            $item->delete();
        }
        return back()->with('success', 'Item removed from cart.');
    }
}
