<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ArchiveController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $addresses = $user->addresses()
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $orders = $user->orders()->with('items')
            ->latest()
            ->get();

        return view('member.archive.index', [
            'title' => 'My Archive',
            'user' => $user,
            'addresses' => $addresses,
            'orders' => $orders
        ]);
    }

    public function createAddress()
    {
        return view('member.archive.create_address', ['title' => 'Add New Address']);
    }

    public function storeAddress(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'label' => [
                'required',
                'string',
                'max:50',
                Rule::unique('addresses')->where(fn($q) => $q->where('user_id', $user->id))
            ],
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $validated['label'] = Str::slug($validated['label']);

        $isFirst = $user->addresses()->count() === 0;

        $user->addresses()->create(array_merge($validated, [
            'is_default' => $isFirst
        ]));

        Alert::success('Success', 'New shipping record has been archived.');
        return redirect()->route('member.archive.index');
    }

    public function editAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

        return view('member.archive.edit_address', [
            'title' => 'Edit Address',
            'address' => $address
        ]);
    }

    public function updateAddress(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'label' => [
                'required',
                'string',
                'max:50',
                // Unik kecuali milik record ini sendiri
                Rule::unique('addresses')->where(fn($q) => $q->where('user_id', Auth::id()))->ignore($address->id)
            ],
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $validated['label'] = Str::slug($validated['label']);

        $address->update($validated);

        Alert::success('Success', 'Address record updated.');
        return redirect()->route('member.archive.index');
    }

    public function setDefaultAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);

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
