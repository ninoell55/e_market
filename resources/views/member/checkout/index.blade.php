<x-member-layout>
    <x-slot:title>Finalize Transaction — {{ $title }}</x-slot:title>

    <div class="bg-white dark:bg-[#0a0a0a] min-h-screen pb-24" x-data="{ method: 'COD' }">
        <div class="max-w-7xl mx-auto px-6 md:px-12 pt-16">

            {{-- Header --}}
            <div class="mb-16 border-b border-gray-100 dark:border-white/5 pb-10">
                <h1
                    class="text-4xl font-black italic tracking-tighter dark:text-white uppercase text-center md:text-left">
                    Checkout_Registry<span class="text-rose-600">.</span>
                </h1>
            </div>

            <form action="{{ route('member.checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">

                    {{-- LEFT COLUMN --}}
                    <div class="lg:col-span-7 space-y-16">

                        {{-- 01. Shipping Address (Automatic Default Selection) --}}
                        <section class="space-y-6">
                            <h2 class="text-xs font-black uppercase tracking-[0.5em] text-rose-600 italic">01.
                                Shipping_Destination</h2>
                            <div
                                class="border-b border-black/10 dark:border-white/10 focus-within:border-rose-600 transition-all pb-2">
                                <label
                                    class="text-[9px] font-black uppercase tracking-widest opacity-30 dark:text-white block mb-2 text-rose-600">Selected_Address_Registry</label>
                                <select name="address_id" required
                                    class="w-full bg-transparent border-none p-0 text-sm font-bold dark:text-white focus:ring-0 uppercase tracking-widest cursor-pointer">
                                    <option value="" class="dark:bg-[#0a0a0a]">-- CHOOSE_ADDRESS --</option>
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}" class="dark:bg-[#0a0a0a]"
                                            {{ $address->is_default ? 'selected' : '' }}>
                                            {{ $address->label }} ({{ $address->city }})
                                            {{ $address->is_default ? '[DEFAULT]' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </section>

                        {{-- 02. Payment Protocol --}}
                        <section class="space-y-8">
                            <h2 class="text-xs font-black uppercase tracking-[0.5em] text-rose-600 italic">02.
                                Payment_Method</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="method" value="COD" x-model="method" class="hidden">
                                    <div :class="method === 'COD' ? 'border-rose-600 bg-rose-600/5' :
                                        'border-gray-100 dark:border-white/5'"
                                        class="py-6 text-center border transition-all">
                                        <span class="text-[10px] font-black uppercase tracking-widest dark:text-white"
                                            :class="method === 'COD' ? 'text-rose-600' : ''">Cash_On_Delivery</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="method" value="Transfer" x-model="method"
                                        class="hidden">
                                    <div :class="method === 'Transfer' ? 'border-rose-600 bg-rose-600/5' :
                                        'border-gray-100 dark:border-white/5'"
                                        class="py-6 text-center border transition-all">
                                        <span class="text-[10px] font-black uppercase tracking-widest dark:text-white"
                                            :class="method === 'Transfer' ? 'text-rose-600' : ''">Digital_Transfer</span>
                                    </div>
                                </label>
                            </div>
                        </section>

                        {{-- 03. Transfer Simulation (ONLY VISIBLE IF TRANSFER) --}}
                        <section x-show="method === 'Transfer'" x-transition
                            class="space-y-10 pt-10 border-t border-dashed border-black/10 dark:border-white/10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                                {{-- Ganti bagian QR Code kamu dengan logika ini agar aman --}}
                                <div
                                    class="bg-white p-4 inline-block mx-auto border-4 border-black shadow-[10px_10px_0px_0px_rgba(225,29,72,0.1)]">
                                    @php
                                        $qrUrl = $directCheckout
                                            ? route('member.checkout.receipt', ['type' => 'direct'])
                                            : route('member.checkout.receipt', ['id' => $cart->id]);
                                    @endphp
                                    
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($qrUrl) }}"
                                        alt="Payment QR" class="w-40 h-40">

                                    <p class="text-[8px] font-black uppercase mt-4 text-center tracking-tighter">
                                        SCAN_FOR_REAL_RECEIPT
                                    </p>
                                </div>

                                {{-- Proof Upload --}}
                                <div class="space-y-4">
                                    <h3 class="text-[10px] font-black uppercase tracking-widest dark:text-white">
                                        Submit_Screenshot_Proof:</h3>
                                    <input type="file" name="proof_image" :required="method === 'Transfer'"
                                        class="block w-full text-[10px] text-gray-500
                                        file:mr-4 file:py-3 file:px-6 file:border-0 file:text-[10px] file:font-black
                                        file:bg-black file:text-white dark:file:bg-white dark:file:text-black
                                        file:uppercase file:tracking-[0.2em] cursor-pointer hover:file:bg-rose-600 transition-all">
                                </div>
                            </div>
                        </section>
                    </div>

                    {{-- RIGHT COLUMN (SUMMARY) --}}
                    <div class="lg:col-span-5">
                        <div
                            class="sticky top-24 bg-gray-50 dark:bg-white/2 p-10 border border-black/5 dark:border-white/5 shadow-2xl">
                            <h2
                                class="text-xl font-black uppercase italic tracking-tighter dark:text-white mb-8 border-b-2 border-black dark:border-white pb-4">
                                Manifest</h2>
                            <div class="space-y-4 mb-10 overflow-y-auto max-h-60 pr-2 custom-scrollbar">
                                @if ($directCheckout)
                                    {{-- Direct Checkout: Single Product --}}
                                    <div class="flex justify-between items-end">
                                        <div class="max-w-[180px]">
                                            <span
                                                class="text-[10px] font-black dark:text-white uppercase truncate block">{{ $directProduct->name }}</span>
                                            <span
                                                class="text-[8px] font-bold text-rose-600 uppercase tracking-widest">QTY:
                                                {{ $directQuantity }}</span>
                                        </div>
                                        <span
                                            class="text-[11px] font-black italic dark:text-white tabular-nums">{{ number_format($directVariant->price * $directQuantity, 0, ',', '.') }}</span>
                                    </div>
                                @else
                                    {{-- Regular Cart Checkout: Multiple Items --}}
                                    @foreach ($cart->items as $item)
                                        <div class="flex justify-between items-end">
                                            <div class="max-w-[180px]">
                                                <span
                                                    class="text-[10px] font-black dark:text-white uppercase truncate block">{{ $item->product->name }}</span>
                                                <span
                                                    class="text-[8px] font-bold text-rose-600 uppercase tracking-widest">QTY:
                                                    {{ $item->quantity }}</span>
                                            </div>
                                            <span
                                                class="text-[11px] font-black italic dark:text-white tabular-nums">{{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="pt-8 border-t border-black/10 dark:border-white/10">
                                <div class="flex justify-between items-end">
                                    <span
                                        class="text-[9px] font-black uppercase opacity-20 dark:text-white tracking-[0.4em]">Total_Due</span>
                                    <span
                                        class="text-4xl font-black italic tracking-tighter dark:text-white tabular-nums">Rp{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit" onclick="this.disabled=true;this.form.submit();"
                                class="w-full mt-10 bg-black dark:bg-white text-white dark:text-black py-7 font-black uppercase tracking-[0.5em] text-[10px] hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all shadow-xl">
                                <span
                                    x-text="method === 'COD' ? 'Deploy_Order (COD)' : 'Confirm_Transaction_Proof'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-member-layout>
