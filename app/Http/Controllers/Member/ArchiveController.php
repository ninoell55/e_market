<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ArchiveController extends Controller
{
    public function addresses()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $addresses = $user->addresses()
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('member.archive.address.index', [
            'title' => 'Address Archive',
            'addresses' => $addresses,
        ]);
    }

    public function orders()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $orders = $user->orders()
            ->with('items')
            ->latest()
            ->paginate(6);

        return view('member.archive.order.index', [
            'title' => 'Order Archive',
            'orders' => $orders
        ]);
    }

    public function showOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        return view('member.archive.order.show', [
            'title' => 'Order Details #' . $order->id,
            'order' => $order->load('items.product')
        ]);
    }

    public function createAddress()
    {
        $previousUrl = url()->previous();
        if (str_starts_with($previousUrl, url('/')) && str_contains($previousUrl, '/checkout')) {
            session(['return_to_checkout' => $previousUrl]);
        }
        return view('member.archive.address.create', ['title' => 'Add New Address']);
    }

    public function storeAddress(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $label = Str::slug($request->input('label'));

        $validated = $request->validate([
            'label' => [
                'required',
                'string',
                'max:50',
                Rule::unique('addresses')->where(fn($q) => $q->where('user_id', $user->id)->where('label', $label))
            ],
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $validated['label'] = $label;
        $isFirst = $user->addresses()->count() === 0;

        $user->addresses()->create(array_merge($validated, [
            'is_default' => $isFirst
        ]));

        if (session()->has('return_to_checkout')) {
            $url = session('return_to_checkout');
            session()->forget('return_to_checkout');
            return redirect($url);
        }

        Alert::success('Success', 'New shipping record has been archived.');
        return redirect()->route('member.archive.addresses'); 
    }

    public function editAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

        return view('member.archive.address.edit', [
            'title' => 'Edit Address',
            'address' => $address
        ]);
    }

    public function updateAddress(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

        $label = Str::slug($request->input('label'));

        $validated = $request->validate([
            'label' => [
                'required',
                'string',
                'max:50',
                Rule::unique('addresses')->where(fn($q) => $q->where('user_id', Auth::id())->where('label', $label))->ignore($address->id)
            ],
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $validated['label'] = $label;
        $address->update($validated);

        Alert::success('Success', 'Address record updated.');
        return redirect()->route('member.archive.addresses');
    }

    public function setDefaultAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

        Address::where('user_id', Auth::id())->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        Alert::success('Success', 'Primary address updated.');
        return back();
    }

    public function deleteAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $wasDefault = $address->is_default;

        $address->delete();

        if ($wasDefault) {
            $nextAddress = $user->addresses()->latest()->first();
            if ($nextAddress) {
                $nextAddress->update(['is_default' => true]);
            }
        }

        Alert::success('Deleted', 'Address record removed.');
        return back();
    }
}
