<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="bg-white dark:bg-[#0a0a0a] min-h-screen pb-24">
        <div class="max-w-7xl mx-auto px-6 md:px-12 pt-16">

            {{-- Title Section --}}
            <div class="mb-20">
                <h1 class="text-4xl font-black italic tracking-tighter dark:text-white uppercase">
                    Cart Overview<span class="text-rose-600"> / </span>{{ $cart->items->count() }} Items
                </h1>
            </div>

            @if ($cart && $cart->items->count() > 0)
                <div class="flex flex-col lg:flex-row gap-20">

                    {{-- LEFT: BORDERLESS LIST --}}
                    <div class="flex-1 space-y-12">
                        @foreach ($cart->items as $item)
                            <div class="flex gap-8 items-start border-b border-gray-100 dark:border-white/5 pb-12 group">

                                {{-- Thumbnail --}}
                                <div
                                    class="w-32 md:w-44 aspect-square overflow-hidden bg-gray-50 dark:bg-white/5 shrink-0">
                                    <img src="{{ asset('storage/uploads/' . $item->product->image) }}"
                                        class="w-full h-full object-cover">
                                </div>

                                {{-- Item Details --}}
                                <div class="flex-1 space-y-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3
                                                class="text-2xl font-black uppercase italic tracking-tighter dark:text-white">
                                                {{ $item->product->name }}
                                            </h3>
                                            <p
                                                class="text-2xs font-bold text-rose-600 uppercase tracking-widest mt-1">
                                                Variant: {{ $item->variant->attribute_value }}
                                            </p>
                                        </div>
                                        <p
                                            class="text-xl font-black italic dark:text-white tracking-tighter text-right">
                                            IDR
                                            {{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-between pt-4">
                                        {{-- Quantity Control (Standard POST Reload) --}}
                                        <div class="flex items-center gap-6">
                                            {{-- Minus Button --}}
                                            <form action="{{ route('member.cart.update', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                                <button type="submit" {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                                    class="text-xl font-light opacity-40 hover:opacity-100 dark:text-white transition-opacity disabled:hidden">
                                                    −
                                                </button>
                                            </form>

                                            <span
                                                class="text-sm font-black dark:text-white w-6 text-center tabular-nums">
                                                {{ str_pad($item->quantity, 2, '0', STR_PAD_LEFT) }}
                                            </span>

                                            {{-- Plus Button --}}
                                            <form action="{{ route('member.cart.update', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="quantity"
                                                    value="{{ $item->quantity + 1 }}">
                                                <button type="submit"
                                                    class="text-xl font-light opacity-40 hover:opacity-100 dark:text-white transition-opacity">
                                                    +
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Remove Action (Global Setup) --}}
                                        <form action="{{ route('member.cart.destroy', $item->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="button"
                                                class="confirm-delete-btn p-2 text-gray-300 hover:text-rose-600 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-5 h-5 pointer-events-none">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-1.123c0-1.08-.783-1.993-1.876-1.993H10.124c-1.093 0-1.876.913-1.876 1.993v1.123m9.966 0c-1.09-.051-2.185-.083-3.282-.103m-5.045 0c-1.097.02-2.192.052-3.282.103m0 0a48.11 48.11 0 0 0-3.478.397" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- RIGHT: STICKY CHECKOUT --}}
                    <div class="w-full lg:w-95">
                        <div class="sticky top-24 space-y-12">
                            <div class="space-y-6">
                                <div
                                    class="flex justify-between items-baseline border-b border-black dark:border-white pb-4">
                                    <span
                                        class="text-[11px] font-black uppercase tracking-widest dark:text-white opacity-40">Total
                                        Amount</span>
                                    <span class="text-2xl font-black italic tracking-tighter dark:text-white">
                                        IDR {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p
                                    class="text-2xs uppercase tracking-widest text-gray-400 font-bold leading-relaxed">
                                    * Prices shown are final. Shipping costs will be added during checkout based on your
                                    delivery address.
                                </p>
                            </div>

                            <div class="space-y-3">
                                <a href="#"
                                    class="block w-full bg-black dark:bg-white text-white dark:text-black py-6 text-center text-[11px] font-black uppercase tracking-[0.4em] hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all">
                                    Continue to Checkout
                                </a>
                                <a href="{{ route('member.dashboard') }}"
                                    class="block w-full border border-black/10 dark:border-white/10 text-center py-6 text-[11px] font-black uppercase tracking-[0.4em] dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-all">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="py-40 text-center">
                    <p class="text-2xs font-black uppercase tracking-[0.5em] opacity-20 dark:text-white mb-8">
                        Your cart is currently empty
                    </p>
                    <a href="{{ route('member.dashboard') }}"
                        class="text-sm font-black uppercase tracking-widest border-b-2 border-black dark:border-white pb-1 dark:text-white hover:text-rose-600 hover:border-rose-600 transition-all">
                        Back to Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-member-layout>
