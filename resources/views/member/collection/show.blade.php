<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- State Management --}}
    <div x-data="{
        selectedVariant: '',
        basePrice: {{ $product->price }},
        variantPrices: {{ $variantsJson }},
        get currentPrice() {
            return this.selectedVariant ? this.variantPrices[this.selectedVariant] : this.basePrice;
        }
    }" class="bg-white dark:bg-[#0a0a0a] min-h-screen">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 border-b border-gray-100 dark:border-white/5">

            {{-- LEFT: VISUAL --}}
            <div
                class="lg:col-span-7 bg-[#f6f6f6] dark:bg-[#0d0d0d] flex items-center justify-center relative overflow-hidden group border-r border-gray-100 dark:border-white/5">
                <div
                    class="absolute inset-0 flex items-center justify-center opacity-[0.03] dark:opacity-[0.05] dark:text-white pointer-events-none">
                    <h2 class="text-[20vw] text-center font-anton uppercase italic tracking-tighter">{{ $product->name }}
                    </h2>
                </div>

                <div class="relative z-10 p-8 md:p-20">
                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                        class="w-full h-auto max-h-[70vh] object-contain drop-shadow-[0_35px_35px_rgba(0,0,0,0.25)] transform group-hover:scale-105 transition-transform duration-1000">
                </div>

                <div class="absolute top-10 left-10 flex flex-col gap-2">
                    <span class="bg-rose-600 text-white px-3 py-1 text-[9px] font-black uppercase tracking-[0.3em]">
                        {{ $product->category->category_name }}
                    </span>
                </div>
            </div>

            {{-- RIGHT: COMMAND PANEL --}}
            <div class="lg:col-span-5 p-8 md:p-16 lg:p-20 flex flex-col justify-center bg-white dark:bg-[#0a0a0a]">
                <div class="space-y-12">
                    {{-- Title & Price --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-px bg-rose-600"></span>
                            <p class="text-2xs font-black text-rose-600 uppercase tracking-[0.5em]">Product Registry
                            </p>
                        </div>

                        <h1 class="text-5xl md:text-6xl font-anton uppercase italic tracking-tighter dark:text-white">
                            {{ $product->name }}
                        </h1>

                        {{-- DYNAMIC PRICE BOX --}}
                        <div class="inline-block pt-4">
                            <p
                                class="text-4xl font-anton dark:text-white italic tracking-tighter transition-all duration-300">
                                <span class="text-sm not-italic opacity-40 font-bold mr-2 uppercase">IDR</span>
                                <span x-text="new Intl.NumberFormat('id-ID').format(currentPrice)"></span>
                            </p>
                            {{-- Price Indicator --}}
                            <template x-if="selectedVariant">
                                <p
                                    class="text-[9px] font-black text-rose-600 uppercase tracking-widest mt-1 animate-pulse">
                                    [ Variant Price Applied ]
                                </p>
                            </template>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div
                        class="p-6 bg-gray-50 dark:bg-white/5 border-l-2 border-gray-200 dark:border-white/10 space-y-3">
                        <p class="text-[9px] font-black uppercase tracking-widest opacity-40 dark:text-white">
                            Unit Specification</p>
                        <p class="text-sm leading-relaxed dark:text-white/70 font-medium">
                            {{ $product->description ?? 'No specific technical log found for this unit. Standard industrial grade verified.' }}
                        </p>
                    </div>

                    {{-- VARIANT SELECTION --}}
                    @if ($product->variants->count() > 0)
                        <div class="space-y-8">
                            @foreach ($product->variants->groupBy('attribute_name') as $name => $values)
                                <div class="space-y-4">
                                    <div class="flex justify-between items-end">
                                        <p
                                            class="text-2xs font-black uppercase tracking-[0.4em] dark:text-white opacity-50">
                                            Select {{ $name }}
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($values as $variant)
                                            <button type="button" @click="selectedVariant = '{{ $variant->id }}'"
                                                :class="selectedVariant == '{{ $variant->id }}' ?
                                                    'bg-rose-600 text-white border-rose-600' :
                                                    'border-gray-200 dark:border-white/10 dark:text-white hover:border-gray-900 dark:hover:border-white'"
                                                class="min-w-15 border px-6 py-3 text-[11px] font-anton uppercase transition-all duration-300">
                                                {{ $variant->attribute_value }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- ACTION BUTTONS --}}
                    <div class="space-y-4 pt-6">
                        <form action="{{ route('member.cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_variant_id" :value="selectedVariant">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                :disabled="{{ $product->variants->count() > 0 }} && !selectedVariant"
                                class="w-full bg-black dark:bg-white text-white dark:text-black py-6 font-anton uppercase tracking-[0.3em] text-xs hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all shadow-xl flex items-center justify-center gap-4 group disabled:opacity-20 disabled:grayscale disabled:cursor-not-allowed">
                                <span x-text="selectedVariant ? 'Add to Cart' : 'Select Variant First'"></span>
                                <span class="group-hover:translate-x-2 transition-transform duration-500">→</span>
                            </button>
                        </form>

                        <form action="{{ route('member.checkout.direct') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_variant_id" :value="selectedVariant">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                :disabled="{{ $product->variants->count() > 0 }} && !selectedVariant"
                                class="w-full border border-gray-200 dark:border-white/10 py-5 font-anton uppercase tracking-[0.3em] text-2xs flex items-center justify-center dark:text-white hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition-all disabled:opacity-20 disabled:cursor-not-allowed">
                                Direct Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- RELATED PRODUCTS --}}
        @if ($related->count() > 0)
            <section class="py-32 bg-white dark:bg-[#0a0a0a]">
                {{-- Header Section --}}
                <div
                    class="px-8 md:px-16 flex items-baseline gap-4 mb-16 pb-8">
                    <h3 class="text-5xl font-anton uppercase italic tracking-tighter dark:text-white">Complete the Look
                    </h3>
                    <div class="h-px flex-1 bg-gray-100 dark:bg-white/5"></div>
                    {{-- Hint dihilangkan karena scrollbar sudah terlihat --}}
                </div>

                {{-- Scrollable Container dengan Custom Scrollbar --}}
                <div
                    class="flex overflow-x-auto overflow-y-hidden snap-x snap-mandatory rose-scrollbar pb-12 cursor-grab active:cursor-grabbing">
                    {{-- Spacer awal --}}
                    <div class="flex-none w-8 md:w-16"></div>

                    @foreach ($related as $rel)
                        <a href="{{ route('member.product.show', $rel->slug) }}"
                            class="group flex-none w-[75vw] md:w-[30vw] lg:w-[22vw] bg-white dark:bg-[#0a0a0a] p-6 transition-all border-r border-gray-100 dark:border-white/5 snap-start rounded-none">

                            <div class="aspect-square bg-gray-50 dark:bg-white/5 overflow-hidden relative mb-6">
                                <img src="{{ asset('storage/uploads/' . $rel->image) }}"
                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                    alt="{{ $rel->name }}">
                            </div>

                            <div class="space-y-1">
                                <h4
                                    class="text-lg font-anton uppercase italic dark:text-white group-hover:text-rose-600 transition-colors truncate">
                                    {{ $rel->name }}
                                </h4>
                                <p class="text-sm font-anton dark:text-white opacity-40">
                                    IDR {{ number_format($rel->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    @endforeach

                    {{-- Spacer akhir --}}
                    <div class="flex-none w-8 md:w-16"></div>
                </div>
            </section>
        @endif

        <style>
            /* 1. Base Container: Beri padding bawah agar scrollbar tidak mepet gambar */
            .rose-scrollbar {
                -webkit-overflow-scrolling: touch;
                /* Halus di iOS */
            }

            /* 2. Ukuran Scrollbar (Tinggi untuk Horizontal) */
            .rose-scrollbar::-webkit-scrollbar {
                height: 3px;
                /* Tipis & Elegan */
                width: 3px;
            }

            /* 3. Track (Latar Belakang Scrollbar) */
            .rose-scrollbar::-webkit-scrollbar-track {
                background: #f1f1f1;
                /* Abu-abu sangat muda di light mode */
                border-radius: 10px;
            }

            /* Dark Mode Track */
            .dark .rose-scrollbar::-webkit-scrollbar-track {
                background: #1a1a1a;
                /* Hitam abu-abu di dark mode */
            }

            /* 4. Thumb (Bagian yang Bergerak) */
            .rose-scrollbar::-webkit-scrollbar-thumb {
                background: #e11d48;
                /* Warna Rose-600 Tailwind */
                border-radius: 10px;
                transition: background 0.3s ease;
            }

            /* 5. Hover Effect pada Thumb */
            .rose-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #be123c;
                /* Warna Rose-700 saat di-hover */
            }
        </style>
    </div>
</x-member-layout>
