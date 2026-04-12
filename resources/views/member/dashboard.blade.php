<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        /* Membuat pergerakan carousel menjadi halus & tanpa henti (linear) */
        .swiper-wrapper {
            transition-timing-function: linear !important;
        }
    </style>

    {{-- SECTION 01: VIBRANT HERO BANNER --}}
    <section class="relative w-full bg-white dark:bg-[#0a0a0a] pt-6">
        <div class="px-4 md:px-10">
            {{-- Main Container --}}
            <div
                class="relative h-[85vh] md:h-[95vh] w-full overflow-hidden rounded-[3.5rem] bg-gray-900 shadow-2xl group">

                @if ($featured)
                    {{-- Background Image dengan Zoom & Pan Effect --}}
                    <img src="{{ asset('storage/uploads/' . $featured->image) }}"
                        class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-7000 ease-out">

                    {{-- Overlay Decorative Elements --}}
                    <div class="absolute top-12 left-12 hidden md:block">
                        <p class="font-anton text-rose-600 text-6xl leading-none opacity-20 italic select-none">AURA_S26
                        </p>
                    </div>

                    {{-- Content Grid --}}
                    <div
                        class="absolute inset-0 flex flex-col justify-end p-8 md:p-20 bg-linear-to-t from-black via-black/20 to-transparent">

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-end">

                            {{-- Left Column: Main Title --}}
                            <div class="lg:col-span-8 space-y-6">
                                <div class="flex items-center gap-4">
                                    <span
                                        class="px-4 py-1 bg-rose-600 text-white font-anton text-2xs tracking-[0.3em] uppercase italic">
                                        NEW_EVOLUTION
                                    </span>
                                    <div class="h-px w-24 bg-white/20 hidden md:block"></div>
                                    <span class="font-sans text-2xs font-bold text-white/60 uppercase tracking-[0.4em]">
                                        {{ $featured->category->category_name }}
                                    </span>
                                </div>

                                <h2
                                    class="font-anton text-7xl md:text-[12vw] text-white uppercase italic leading-[0.75] tracking-tighter drop-shadow-2xl">
                                    {{ $featured->name }}<span class="text-rose-600">.</span>
                                </h2>
                            </div>

                            {{-- Right Column: Desc & CTA --}}
                            <div class="lg:col-span-4 space-y-8 lg:pb-6">
                                <div class="relative pl-8 border-l border-rose-600/50">
                                    <p
                                        class="font-sans text-sm md:text-base text-white/70 leading-relaxed tracking-tight uppercase">
                                        Engineered for the modern rebel. <br>
                                        <span class="text-white font-bold">Limited units available</span> for the
                                        current archive cycle.
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-4">
                                    <a href="#catalog"
                                        class="group/btn relative overflow-hidden bg-white text-black px-10 py-5 rounded-full font-anton text-xs uppercase tracking-widest transition-all duration-500 hover:pr-16">
                                        <span
                                            class="relative z-10 group-hover/btn:text-white transition-colors duration-500">SHOP_COLLECTION</span>
                                        {{-- Background Fill Animation --}}
                                        <div
                                            class="absolute inset-0 bg-rose-600 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-500">
                                        </div>
                                        {{-- Arrow Icon --}}
                                        <svg class="absolute right-6 top-1/2 -translate-y-1/2 w-5 h-5 opacity-0 group-hover/btn:opacity-100 transition-all duration-500 text-white"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>

                        {{-- Bottom Aesthetic Bar --}}
                        <div
                            class="mt-16 pt-8 border-t border-white/10 flex justify-between items-center text-[8px] font-black text-white/30 tracking-[0.5em] uppercase">
                            <div class="flex gap-8 italic">
                                <span>01_CORE_AESTHETIC</span>
                                <span>02_INDUSTRIAL_DNA</span>
                            </div>
                            <div class="hidden md:block">
                                EST_2026 // FASHION_AURA
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- SECTION 02: THE BEST SELECTIONS (INFINITE CAROUSEL) --}}
    <section class="px-6 md:px-16 pt-32 pb-20 bg-white dark:bg-[#0a0a0a] overflow-hidden">
        {{-- Header --}}
        <div class="mb-16 flex items-baseline justify-between border-b border-gray-100 dark:border-white/5 pb-8">
            <h3 class="font-anton text-5xl md:text-7xl uppercase italic tracking-tighter dark:text-white leading-none">
                BEST SELECTIONS<span class="text-rose-600">.</span>
            </h3>
            <a href="#catalog"
                class="group flex items-center gap-3 text-2xs font-black dark:text-white uppercase tracking-[0.3em] hover:text-rose-600 transition-all">
                EXPLORE_ALL_UNITS
                <span
                    class="w-10 h-px bg-black dark:bg-white group-hover:bg-rose-600 group-hover:w-16 transition-all"></span>
            </a>
        </div>

        {{-- Swiper Container --}}
        <div class="swiper bestProductsSwiper overflow-visible!">
            <div class="swiper-wrapper">
                @forelse($best_products as $best)
                    <div class="swiper-slide w-70 md:w-87.5!">
                        <a href="{{ route('member.product.show', $best) }}"
                            class="group relative block aspect-3/4 overflow-hidden bg-gray-100 dark:bg-white/5">

                            {{-- Index Tag --}}
                            <div class="absolute top-6 left-6 z-20">
                                <span
                                    class="text-2xs font-black dark:text-white/20 text-black/20 group-hover:text-rose-600 transition-colors">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            {{-- Product Image --}}
                            <img src="{{ asset('storage/uploads/' . $best->image) }}"
                                class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">

                            {{-- Hover Overlay --}}
                            <div
                                class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-center items-center p-8 text-center">
                                <p class="text-rose-500 text-[8px] font-black uppercase tracking-[0.4em] mb-2">
                                    {{ $best->category->category_name }}
                                </p>
                                <h4
                                    class="font-anton text-2xl text-white uppercase italic leading-tight tracking-tighter">
                                    {{ $best->name }}
                                </h4>
                                <span
                                    class="mt-6 px-6 py-2 border border-white/20 text-[9px] text-white uppercase tracking-widest group-hover:bg-rose-600 group-hover:border-rose-600 transition-all">
                                    VIEW_UNIT
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full">
                        <x-empty-state title="No Best Products" message="No best products available at the moment."
                            buttonText="Refresh" />
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- SECTION 03: FULL CATALOG --}}
    <section id="catalog" class="relative bg-white dark:bg-[#0a0a0a]">
        <div>
            <div class="min-h-screen">
                <x-header />
                @include('layouts.collection')
            </div>
        </div>
    </section>

    <script>
        const swiper = new Swiper('.bestProductsSwiper', {
            slidesPerView: 'auto',
            spaceBetween: 20, // Jarak antar produk
            loop: true,
            speed: 5000, // Kecepatan jalan (makin besar makin lambat/halus)
            allowTouchMove: true, // Bisa digeser manual
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: true, // BERHENTI PAS DI-HOVER
            },
            grabCursor: true,
            breakpoints: {
                768: {
                    spaceBetween: 30,
                }
            }
        });
    </script>
</x-member-layout>
