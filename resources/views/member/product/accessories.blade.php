<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div
        class="relative w-full h-[90vh] bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-white/5 overflow-hidden flex flex-col group/banner">

        <div class="relative grow flex items-center justify-center group/img">

            <div class="absolute inset-0 z-0 overflow-hidden">
                <img src="{{ asset('assets/img/accessories.jpg') }}"
                    class="w-full h-full object-cover grayscale brightness-[0.8] group-hover/banner:scale-110 group-hover/banner:grayscale-0 transition-all duration-[3s] cubic-bezier(0.4, 0, 0.2, 1)">

                <div class="absolute inset-0 opacity-[0.15] pointer-events-none mix-blend-overlay"
                    style="background-image: url('https://grainy-gradients.vercel.app/noise.svg');"></div>

                <div
                    class="absolute inset-0 bg-radial-gradient from-transparent via-transparent to-black/60 transition-opacity duration-1000">
                </div>
            </div>

            <div class="relative z-10 w-full text-center pointer-events-none select-none">
                <h1
                    class="text-[12vw] font-black text-white uppercase italic tracking-tighter leading-none transition-all duration-700 group-hover/banner:tracking-normal group-hover/banner:opacity-100 opacity-90 drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    {{ $category->category_name }}<span class="text-rose-600 not-italic">.</span>
                </h1>
            </div>

            <div
                class="absolute bottom-12 left-12 z-10 flex flex-col gap-1 translate-y-0 group-hover/banner:-translate-y-2 transition-transform duration-700">
                <div class="w-12 h-0.75 bg-rose-600 mb-2"></div>
                <p
                    class="text-2xs font-black text-white uppercase tracking-[0.4em] leading-none flex items-center gap-2">
                    <span class="opacity-40">CAT:</span> {{ strtoupper($category->slug) }}
                </p>
                <p class="text-[8px] font-medium text-white/60 uppercase tracking-[0.2em]">
                    Archive Collection ©{{ date('Y') }} — {{ $products->total() }} UNITS
                </p>
            </div>

            <div class="absolute bottom-12 right-12 z-10 flex items-center gap-4 group/scroll cursor-pointer">
                <p
                    class="text-[8px] font-black text-white uppercase tracking-[0.5em] writing-mode-vertical rotate-180 transition-all group-hover/banner:text-rose-600">
                    EXPLORE_UNITS
                </p>
                <div class="w-px h-16 bg-white/20 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-rose-600 -translate-y-full group-hover/banner:translate-y-full transition-transform duration-[2s] infinite">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-header :category="$category" />

    <div class="min-h-screen bg-white dark:bg-gray-950">
        <div class="p-6 lg:p-12">
            <div class="flex items-end justify-between mb-10 border-b border-gray-100 dark:border-white/5 pb-6">
                <div>
                    <p class="text-2xs font-black text-rose-600 uppercase tracking-[0.4em] mb-2 italic">Product Feed
                    </p>
                    <h3 class="text-3xl font-black uppercase italic tracking-tighter dark:text-white">
                        All <span class="text-gray-300 dark:text-gray-700">/</span> {{ $category->category_name }}
                    </h3>
                </div>
                <div class="text-right">
                    <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest italic leading-tight">
                        <span class="font-extrabold text-rose-500 italic underline">{{ $products->total() }}</span>
                        Collection by
                        <br>
                        <span class="font-extrabold text-black dark:text-white">Fashion</span><span
                            class="font-extrabold text-rose-500">Aura</span>
                    </p>
                </div>
            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-px bg-gray-100 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                @forelse ($products as $product)
                    <div class="group bg-white dark:bg-gray-950 p-6 hover:z-10 transition-all duration-300">
                        <div class="relative aspect-square mb-6 overflow-hidden bg-gray-50 dark:bg-white/2">
                            <img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">

                            <div
                                class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <button
                                    class="cursor-pointer w-full bg-rose-600 text-white py-3 text-2xs font-black uppercase tracking-widest active:bg-gray-900 transition-colors">
                                    Quick Add +
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <h4
                                class="text-sm font-black dark:text-white uppercase leading-tight tracking-tight group-hover:text-rose-600 transition-colors">
                                {{ $product->name }}
                            </h4>
                            <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest italic">
                                {{ $category->category_name }}
                            </p>
                            <p class="text-lg font-black text-gray-950 dark:text-white italic tracking-tighter pt-2">
                                IDR {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-20 px-4 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-3xl">
                        {{-- Icon minimalis --}}
                        <div class="mb-6 opacity-20 dark:opacity-40">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>

                        {{-- Text --}}
                        <div class="text-center space-y-2">
                            <h3 class="text-xl font-black uppercase tracking-tighter text-gray-950 dark:text-white">
                                No Products Found
                            </h3>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest italic">
                                Our inventory is currently empty or matches no criteria.
                            </p>
                        </div>

                        {{-- Action Button (Optional) --}}
                        <a href="{{ url()->current() }}"
                            class="mt-8 px-8 py-3 bg-gray-950 dark:bg-white dark:text-gray-950 text-white text-2xs font-black uppercase tracking-widest hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-colors duration-300">
                            Refresh Gallery
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 py-12 border-t border-gray-100 dark:border-white/5">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-member-layout>
