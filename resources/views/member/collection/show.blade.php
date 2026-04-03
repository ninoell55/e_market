<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Gunakan x-data Alpine.js untuk mengelola state variant yang dipilih --}}
    <div x-data="{ selectedVariant: '' }" class="bg-white dark:bg-[#0a0a0a] min-h-screen">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 border-b border-gray-100 dark:border-white/5">

            {{-- LEFT: VISUAL --}}
            <div
                class="lg:col-span-7 bg-[#f6f6f6] dark:bg-[#0d0d0d] flex items-center justify-center relative overflow-hidden group">
                <div
                    class="absolute inset-0 flex items-center justify-center opacity-[0.03] dark:opacity-[0.05] pointer-events-none">
                    <h2 class="text-[20vw] font-black uppercase italic tracking-tighter">Archive</h2>
                </div>

                <div class="relative z-10 p-8 md:p-20">
                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                        class="w-full h-auto max-h-[75vh] object-contain drop-shadow-2xl transform group-hover:scale-105 transition-transform duration-1000">
                </div>

                <div class="absolute top-10 left-10 flex flex-col gap-2">
                    <span class="bg-rose-600 text-white px-3 py-1 text-[9px] font-black uppercase tracking-widest">
                        Sector: {{ $product->category->category_name }}
                    </span>
                </div>
            </div>

            {{-- RIGHT: COMMAND PANEL --}}
            <div class="lg:col-span-5 p-8 md:p-16 lg:p-20 flex flex-col justify-center bg-white dark:bg-[#0a0a0a]">
                <div class="space-y-10">
                    <div class="space-y-2">
                        <p class="text-2xs font-black text-rose-600 uppercase tracking-[0.5em]">Product_Registry</p>
                        <h1 class="text-5xl md:text-6xl font-black uppercase italic tracking-tighter dark:text-white">
                            {{ $product->name }}
                        </h1>
                        <div class="p-6 bg-gray-50 dark:bg-white/5 border-l-4 border-rose-600 space-y-3">
                            <p class="text-[9px] font-black uppercase tracking-widest opacity-40 dark:text-white">
                                Unit_Specification</p>
                            <p class="text-sm leading-relaxed dark:text-white/70 font-medium">
                                {{ $product->description ?? 'No specific technical log found for this unit. Standard industrial grade verified.' }}
                            </p>
                        </div>
                        <p class="text-3xl font-black italic tracking-tighter text-gray-900 dark:text-white/90">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- VARIANT SELECTION --}}
                    @if ($product->variants->count() > 0)
                        <div class="space-y-6">
                            @foreach ($product->variants->groupBy('attribute_name') as $name => $values)
                                <div class="space-y-3">
                                    <p
                                        class="text-2xs font-black uppercase tracking-[0.4em] dark:text-white opacity-50">
                                        Select_{{ $name }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($values as $variant)
                                            <button type="button" @click="selectedVariant = '{{ $variant->id }}'"
                                                :class="selectedVariant == '{{ $variant->id }}' ?
                                                    'bg-black text-white border-black dark:bg-white dark:text-black' :
                                                    'border-gray-100 dark:border-white/10 dark:text-white'"
                                                class="min-w-15 border-2 px-4 py-3 text-[11px] font-black uppercase transition-all shadow-sm">
                                                {{ $variant->attribute_value }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- FORM KERANJANG --}}
                    <div class="space-y-3 pt-6 flex flex-col">
                        <form action="{{ route('member.cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            {{-- Input ini akan terisi otomatis oleh Alpine.js --}}
                            <input type="hidden" name="product_variant_id" :value="selectedVariant">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                :disabled="{{ $product->variants->count() > 0 }} && !selectedVariant"
                                class="w-full bg-black dark:bg-white text-white dark:text-black py-6 rounded-xl font-black uppercase tracking-[0.3em] text-xs hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all shadow-2xl flex items-center justify-center gap-4 group disabled:opacity-30 disabled:cursor-not-allowed">
                                Add_to_Cart
                                <span class="group-hover:translate-x-2 transition-transform duration-500">→</span>
                            </button>
                        </form>

                        {{-- Direct Checkout Form --}}
                        <form action="{{ route('member.checkout.direct') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_variant_id" :value="selectedVariant">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                :disabled="{{ $product->variants->count() > 0 }} && !selectedVariant"
                                class="w-full border-2 border-gray-900 dark:border-white py-5 rounded-xl font-black uppercase tracking-[0.3em] text-2xs flex items-center justify-center dark:text-white hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                                Direct_Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- RELATED PRODUCTS --}}
        @if ($related->count() > 0)
            <section class="py-24 px-8 md:px-16 bg-gray-50 dark:bg-[#0d0d0d]">
                <h3 class="text-4xl font-black uppercase italic tracking-tighter dark:text-white mb-12">Complete the
                    Look<span class="text-rose-600">.</span></h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($related as $rel)
                        <a href="{{ route('member.product.show', $rel->slug) }}" class="group space-y-4">
                            <div
                                class="aspect-square bg-white dark:bg-white/5 overflow-hidden rounded-2xl relative shadow-sm">
                                <img src="{{ asset('storage/uploads/' . $rel->image) }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            <div class="space-y-1">
                                <h4
                                    class="text-sm font-black uppercase italic tracking-tighter dark:text-white group-hover:text-rose-600 transition-colors">
                                    {{ $rel->name }}</h4>
                                <p class="text-xs font-bold opacity-50 dark:text-white">Rp
                                    {{ number_format($rel->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-member-layout>
