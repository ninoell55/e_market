<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div
        class="relative w-full h-[90vh] bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-white/5 overflow-hidden flex flex-col group/banner">

        <div class="relative grow flex items-center justify-center group/img">

            <div class="absolute inset-0 z-0 overflow-hidden">
                <img src="{{ asset('assets/img/shoes-big.jpg') }}"
                    class="w-full h-full object-cover grayscale brightness-[0.8] group-hover/banner:scale-110 group-hover/banner:grayscale-0 transition-all duration-[3s] cubic-bezier(0.4, 0, 0.2, 1)">

                <div class="absolute inset-0 opacity-[0.15] pointer-events-none mix-blend-overlay"
                    style="background-image: url('https://grainy-gradients.vercel.app/noise.svg');"></div>

                <div
                    class="absolute inset-0 bg-radial-gradient from-transparent via-transparent to-black/60 transition-opacity duration-1000">
                </div>
            </div>

            <div class="relative z-10 w-full text-center pointer-events-none select-none">
                <h1
                    class="text-[22vw] font-black text-white uppercase italic tracking-tighter leading-none transition-all duration-700 group-hover/banner:tracking-normal group-hover/banner:opacity-100 opacity-90 drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
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

    @include('layouts.collection')
</x-member-layout>
