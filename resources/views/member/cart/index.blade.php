<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="bg-white dark:bg-[#0a0a0a] border-t border-black/5 dark:border-white/5">

        @if ($cart && $cart->items->count() > 0)
            {{-- Main Container: Lock height to screen on Desktop --}}
            <div class="flex flex-col lg:flex-row lg:h-screen lg:overflow-hidden">

                {{-- LEFT COLUMN: PRODUCT LIST (SCROLLABLE) --}}
                <div class="flex-1 border-r border-black/5 dark:border-white/5 lg:overflow-y-auto custom-scrollbar">

                    {{-- Header Section --}}
                    <div
                        class="px-6 md:px-12 py-16 border-b border-black/5 dark:border-white/5 bg-gray-50/30 dark:bg-white/1">
                        <p class="text-2xs font-bold text-rose-600 uppercase tracking-widest mb-2">Shopping Cart</p>
                        <h1 class="text-5xl md:text-6xl font-anton uppercase italic tracking-tighter dark:text-white">
                            Overview <span class="text-rose-600">—</span> {{ $cart->items->count() }} Items
                        </h1>
                    </div>

                    {{-- List Item --}}
                    <div class="divide-y divide-black/5 dark:divide-white/5">
                        @foreach ($cart->items as $item)
                            <div
                                class="flex flex-col md:flex-row gap-8 items-center md:items-stretch py-12 px-6 md:px-12 group hover:bg-gray-50 dark:hover:bg-white/2 transition-colors">

                                {{-- Thumbnail --}}
                                <div
                                    class="w-40 md:w-52 aspect-square overflow-hidden bg-[#fbfbfb] dark:bg-white/5 shrink-0 flex items-center justify-center border border-black/5 dark:border-white/5">
                                    <img src="{{ asset('storage/uploads/' . $item->product->image) }}"
                                        class="w-full h-full object-contain p-4 transform group-hover:scale-105 transition-transform duration-700">
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 flex flex-col justify-between w-full py-1">
                                    <div class="flex justify-between items-start gap-10">
                                        <div class="space-y-2">
                                            <h3
                                                class="text-2xl md:text-3xl font-anton uppercase italic tracking-tighter dark:text-white">
                                                {{ $item->product->name }}
                                            </h3>
                                            <div
                                                class="flex flex-wrap gap-x-4 gap-y-1 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                                <span>Variant: <span
                                                        class="text-black dark:text-white">{{ $item->variant->attribute_value }}</span></span>
                                                <span class="opacity-30">|</span>
                                                <span>CAT: #{{ $item->product->category->category_name }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-anton italic dark:text-white tracking-tighter">
                                                IDR
                                                {{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between mt-10 md:mt-0">
                                        {{-- Qty Control --}}
                                        <form action="{{ route('member.cart.update', $item->id) }}" method="POST"
                                            id="form-qty-{{ $item->id }}" class="flex items-center gap-3">
                                            @csrf @method('PATCH')
                                            <label
                                                class="text-2xs font-bold uppercase tracking-widest text-gray-400">Qty</label>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1"
                                                onchange="document.getElementById('form-qty-{{ $item->id }}').submit()"
                                                class="bg-transparent border-b border-black/20 dark:border-white/20 focus:border-rose-600 p-0 w-10 text-sm font-black dark:text-white focus:ring-0 text-center transition-colors">
                                        </form>

                                        {{-- Remove --}}
                                        <form action="{{ route('member.cart.destroy', $item->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="confirm-delete-btn text-2xs font-bold uppercase tracking-widest text-gray-400 hover:text-rose-600 transition-colors flex items-center gap-2"
                                                title="Remove Item" data-confirm-title="Remove Item?"
                                                data-confirm-text="Are you sure you want to remove this item from your cart?"
                                                data-confirm-button="Yes, Remove">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-1.123c0-1.08-.783-1.993-1.876-1.993H10.124c-1.093 0-1.876.913-1.876 1.993v1.123m9.966 0c-1.09-.051-2.185-.083-3.282-.103m-5.045 0c-1.097.02-2.192.052-3.282.103m0 0a48.11 48.11 0 0 0-3.478.397" />
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT COLUMN: SUMMARY (FIXED ON SCREEN) --}}
                <div class="w-full lg:w-105 bg-white dark:bg-[#0a0a0a] flex flex-col shrink-0">
                    <div
                        class="p-8 md:p-12 h-full flex flex-col justify-between border-t lg:border-t-0 border-black/5 dark:border-white/5">

                        <div class="space-y-10">
                            <h2
                                class="text-2xl font-anton uppercase italic tracking-tighter dark:text-white border-b border-black dark:border-white pb-6">
                                Order Summary
                            </h2>

                            <div class="space-y-5 text-[11px] font-bold uppercase tracking-widest">
                                <div class="flex justify-between items-center dark:text-white/60">
                                    <span>Subtotal</span>
                                    <span class="text-black dark:text-white">IDR
                                        {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center dark:text-white/60">
                                    <span class="text-base text-rose-600">there is no shipping cost because this is just
                                        a simulation
                                    </span>
                                </div>

                                <div class="pt-10 space-y-2">
                                    <p class="text-2xs font-bold text-gray-400">Total Payable</p>
                                    <p class="text-5xl font-anton italic tracking-tighter dark:text-white">
                                        IDR {{ number_format($total, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 mb-15 lg:mt-0">
                            <a href="{{ route('member.checkout.index', ['source' => 'cart']) }}"
                                class="block w-full bg-black dark:bg-white text-white dark:text-black py-7 text-center text-xs font-black uppercase tracking-[0.3em] hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all shadow-xl">
                                Continue to Checkout
                            </a>
                            <a href="{{ route('member.dashboard') }}"
                                class="block w-full text-center py-4 text-2xs font-bold uppercase tracking-widest dark:text-white opacity-40 hover:opacity-100 transition-opacity">
                                ← Continue Shopping
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="h-[80vh] flex flex-col items-center justify-center text-center p-6 relative overflow-hidden">
                <h2 class="text-[15vw] font-anton opacity-[0.03] dark:opacity-[0.05] absolute select-none">EMPTY</h2>
                <div class="relative z-10 space-y-8">
                    <p class="text-xs font-bold uppercase tracking-[0.5em] dark:text-white">Your cart is empty</p>
                    <a href="{{ route('member.dashboard') }}"
                        class="inline-block border border-black dark:border-white px-10 py-4 text-2xs font-bold uppercase tracking-[0.2em] dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                        Back to Products
                    </a>
                </div>
            </div>
        @endif

    </div>

    {{-- Custom Scrollbar Style (Optional) --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.2);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #e11d48;
        }
    </style>
</x-member-layout>
