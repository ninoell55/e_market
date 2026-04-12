<x-member-layout>
    <x-slot:title>Checkout — {{ $title }}</x-slot:title>

    {{-- Container Utama: Pastikan h-screen di desktop agar sticky bekerja maksimal --}}
    <div class="bg-white dark:bg-[#0a0a0a] border-t border-black/5 dark:border-white/5" x-data="{
        method: 'COD',
        selectedAddress: {{ $addresses->where('is_default', true)->first()->id ?? ($addresses->first()->id ?? 'null') }},
        addresses: {{ $addresses->toJson() }},
        get current() {
            return this.addresses.find(a => a.id == this.selectedAddress) || {}
        }
    }">

        <form action="{{ route('member.checkout.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Flex Container: lg:h-screen untuk mengunci tinggi layar di desktop --}}
            <div class="flex flex-col lg:flex-row-reverse lg:h-screen lg:overflow-hidden">

                {{-- RIGHT SIDE: FORM DETAILS (Area yang bisa di-scroll) --}}
                <div class="flex-1 lg:overflow-y-auto custom-scrollbar scrollbar-left pb-24">
                    <div class="direction-ltr">
                        {{-- Header Section --}}
                        <div
                            class="px-6 md:px-12 py-16 border-b border-black/5 dark:border-white/5 bg-gray-50/30 dark:bg-white/1">
                            <p class="text-2xs font-bold text-rose-600 uppercase tracking-widest mb-3">Checkout Process
                            </p>
                            <h1
                                class="text-5xl md:text-7xl font-anton uppercase italic tracking-tighter dark:text-white leading-[0.8]">
                                Shipping <span class="text-rose-600">&</span> Payment
                            </h1>
                        </div>

                        <div class="px-6 md:px-12 py-12 space-y-24">
                            {{-- 01. Shipping Address --}}
                            <section class="space-y-10">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <span class="text-2xl font-anton italic text-rose-600">01</span>
                                        <h2 class="text-xs font-black uppercase tracking-[0.3em] dark:text-white">
                                            Shipping
                                            Address</h2>
                                    </div>
                                    <a href="{{ route('member.archive.create_address') }}"
                                        class="text-[9px] font-black uppercase tracking-widest border-b-2 border-rose-600 pb-1 hover:text-rose-600 transition-colors dark:text-white">
                                        + Add New Address
                                    </a>
                                </div>

                                {{-- Address Detail UI --}}
                                <div class="grid grid-cols-1 gap-6">
                                    <div
                                        class="border-b border-black/10 dark:border-white/10 focus-within:border-rose-600 transition-all pb-4">
                                        <label
                                            class="text-[9px] font-black uppercase tracking-widest text-gray-400 block mb-2">Select
                                            Destination</label>
                                        <select name="address_id" x-model="selectedAddress" required
                                            class="w-full bg-transparent border-none p-0 text-xl font-anton italic uppercase tracking-wider dark:text-white focus:ring-0 cursor-pointer">
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}" class="dark:bg-[#0a0a0a]">
                                                    {{ $address->label }} {{ $address->is_default ? '(Default)' : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div
                                        class="bg-gray-50/50 dark:bg-white/2 border border-black/5 dark:border-white/5 p-8 space-y-4">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-lg font-anton italic uppercase tracking-tight text-rose-600"
                                                x-text="current.label"></h3>
                                            <span
                                                class="px-3 py-1 bg-black dark:bg-white text-white dark:text-black text-[8px] font-black uppercase tracking-widest"
                                                x-show="current.is_default">Default</span>
                                        </div>
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 border-t border-black/5 dark:border-white/5">
                                            <div>
                                                <p
                                                    class="text-[9px] font-black uppercase text-gray-400 tracking-widest mb-1">
                                                    Recipient</p>
                                                <p class="text-sm font-bold dark:text-white uppercase"
                                                    x-text="current.recipient_name"></p>
                                                <p class="text-xs text-gray-500 font-medium"
                                                    x-text="current.recipient_phone"></p>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-[9px] font-black uppercase text-gray-400 tracking-widest mb-1">
                                                    Location</p>
                                                <p class="text-xs font-bold dark:text-white uppercase"
                                                    x-text="current.city + ', ' + current.province"></p>
                                                <p class="text-xs text-gray-500 leading-relaxed mt-1"
                                                    x-text="current.address"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- 02. Payment Method --}}
                            <section class="space-y-10">
                                <div class="flex items-center gap-4">
                                    <span class="text-2xl font-anton italic text-rose-600">02</span>
                                    <h2 class="text-xs font-black uppercase tracking-[0.3em] dark:text-white">Payment
                                        Method
                                    </h2>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="method" value="COD" x-model="method"
                                            class="hidden">
                                        <div :class="method === 'COD' ?
                                            'border-black dark:border-white bg-black dark:bg-white text-white dark:text-black' :
                                            'border-black/10 dark:border-white/10 dark:text-white'"
                                            class="py-8 px-6 border transition-all duration-500">
                                            <p class="text-2xs font-black uppercase tracking-widest mb-1">Option A</p>
                                            <p class="text-2xl font-anton uppercase italic">Cash on Delivery
                                            </p>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="method" value="Transfer" x-model="method"
                                            class="hidden">
                                        <div :class="method === 'Transfer' ?
                                            'border-black dark:border-white bg-black dark:bg-white text-white dark:text-black' :
                                            'border-black/10 dark:border-white/10 dark:text-white'"
                                            class="py-8 px-6 border transition-all duration-500">
                                            <p class="text-2xs font-black uppercase tracking-widest mb-1">Option B</p>
                                            <p class="text-2xl font-anton uppercase italic">Digital Transfer
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </section>

                            {{-- 03. Transfer Proof (Conditional) --}}
                            <section x-show="method === 'Transfer'" x-transition
                                class="pt-12 border-t border-black/5 dark:border-white/5">
                                <div class="flex flex-col md:flex-row gap-12 items-center">
                                    <div class="bg-white p-6 border border-black/5 shadow-2xl shrink-0">
                                        @php
                                            $qrUrl = $directCheckout
                                                ? route('member.checkout.receipt', ['type' => 'direct'])
                                                : route('member.checkout.receipt', ['id' => $cart->id]);
                                        @endphp
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($qrUrl ?? '#') }}"
                                            class="w-40 h-40 grayscale">
                                        <p
                                            class="text-[9px] font-bold uppercase mt-4 text-center tracking-widest text-black">
                                            Scan to Pay
                                        </p>
                                    </div>

                                    <div class="flex-1 space-y-8">
                                        {{-- Pesan Peringatan --}}
                                        <div class="bg-rose-600/5 border-l-4 border-rose-600 p-6 space-y-2">
                                            <div class="flex items-center gap-2 text-rose-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                <span
                                                    class="text-2xs font-black uppercase tracking-[0.2em]">Attention
                                                    Required</span>
                                            </div>
                                            <p
                                                class="text-[11px] font-bold dark:text-white uppercase leading-relaxed italic opacity-80">
                                                Orders using the <span class="text-rose-600 underline">Digital
                                                    Transfer</span> method cannot be cancelled once the payment proof is
                                                submitted. Please double-check your items.
                                            </p>
                                        </div>

                                        <div class="space-y-4">
                                            <h3 class="text-xs font-black uppercase tracking-widest dark:text-white">
                                                Upload Payment Proof
                                            </h3>
                                            <input type="file" name="proof_image" :required="method === 'Transfer'"
                                                class="block w-full text-2xs text-gray-500 file:mr-6 file:py-4 file:px-8 file:border-0 file:text-2xs file:font-black file:bg-black file:text-white dark:file:bg-white dark:file:text-black file:uppercase file:tracking-widest cursor-pointer hover:file:bg-rose-600 transition-all">
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                {{-- LEFT SIDE: SUMMARY (STIKY / FIXED AT DESKTOP) --}}
                <div
                    class="w-full lg:w-112.5 bg-white dark:bg-[#0a0a0a] flex flex-col shrink-0 border-r border-black/5 dark:border-white/5 lg:h-full">
                    <div class="p-8 md:p-12 h-full flex flex-col">
                        <div class="flex-1 space-y-10">
                            <h2
                                class="text-2xl font-anton uppercase italic tracking-tighter dark:text-white border-b border-black dark:border-white pb-6">
                                Order Summary
                            </h2>

                            <div class="space-y-8 overflow-y-auto max-h-[50vh] custom-scrollbar pr-4">
                                @if ($directCheckout)
                                    <div class="flex justify-between items-start gap-4">
                                        <div class="space-y-1">
                                            <p class="text-[11px] font-black dark:text-white uppercase leading-tight">
                                                {{ $directProduct->name }}</p>
                                            {{-- Menampilkan Variant --}}
                                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                                @if (
                                                    $directVariant->attribute_name == 'Size'
                                                        ? $directVariant->attribute_name == 'Size'
                                                        : $directVariant->attribute_name == 'Color')
                                                @endif

                                                {{ $directVariant->attribute_name }} :
                                                {{ $directVariant->attribute_value }}
                                            </p>
                                            <p class="text-[9px] font-bold text-rose-600 uppercase">Qty:
                                                {{ $directQuantity }}</p>
                                        </div>
                                        <span class="text-sm font-anton italic dark:text-white">IDR
                                            {{ number_format($directVariant->price * $directQuantity, 0, ',', '.') }}</span>
                                    </div>
                                @else
                                    @foreach ($cart->items as $item)
                                        <div class="flex justify-between items-start gap-4">
                                            <div class="space-y-1">
                                                <p
                                                    class="text-[11px] font-black dark:text-white uppercase leading-tight">
                                                    {{ $item->product->name }}</p>
                                                {{-- Menampilkan Variant --}}
                                                <p
                                                    class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                                    @if (
                                                        $item->variant->attribute_name == 'Size'
                                                            ? $item->variant->attribute_name == 'Size'
                                                            : $item->variant->attribute_name == 'Color')
                                                    @endif

                                                    {{ $item->variant->attribute_name }} :
                                                    {{ $item->variant->attribute_value }}
                                                </p>
                                                <p class="text-[9px] font-bold text-rose-600 uppercase">Qty:
                                                    {{ $item->quantity }}</p>
                                            </div>
                                            <span class="text-sm font-anton italic dark:text-white">IDR
                                                {{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="pt-10 border-t border-black/10 dark:border-white/10 space-y-2">
                                <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest">Total Amount
                                    Due</p>
                                <p class="text-5xl md:text-6xl font-anton italic tracking-tighter dark:text-white">
                                    IDR {{ number_format($total, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-15">
                            <button type="submit" onclick="this.disabled=true;this.form.submit();"
                                class="w-full bg-black dark:bg-white text-white dark:text-black py-7 text-center text-xs font-black uppercase tracking-[0.3em] hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all shadow-xl">
                                <span x-text="method === 'COD' ? 'Place Order' : 'Complete Payment'"></span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <style>
        .scrollbar-left {
            direction: rtl;
            /* Membalik arah container */
        }

        /* 2. Mengembalikan arah teks konten ke normal (kiri ke kanan) */
        .direction-ltr {
            direction: ltr;
        }

        /* Sembunyikan scrollbar di kanan agar tampilan clean, tapi tetap bisa di-scroll */
        .custom-scrollbar::-webkit-scrollbar {
            width: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
        }

        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</x-member-layout>
