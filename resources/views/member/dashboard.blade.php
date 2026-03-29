<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- SECTION 01: VIBRANT HERO BANNER --}}
    <section class="relative w-full bg-white dark:bg-[#0a0a0a]">
        <div class="px-4 py-4 md:px-12">
            {{-- Tambahkan rounded-3xl agar lebih modern seperti app Nike --}}
            <div
                class="relative h-[65vh] md:h-[85vh] w-full overflow-hidden bg-gray-100 dark:bg-white/5 rounded-3xl shadow-2xl">
                @if ($featured)
                    {{-- Foto asli tanpa grayscale --}}
                    <img src="{{ asset('storage/uploads/' . $featured->image) }}"
                        class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-3000 ease-out">

                    {{-- Linear yang lebih soft --}}
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-8 md:p-20">
                        <div class="max-w-4xl space-y-6 text-white">
                            <div class="flex items-center gap-3">
                                <span
                                    class="px-3 py-1 bg-rose-600 text-2xs font-black uppercase tracking-widest animate-pulse">Just
                                    In</span>
                                <span
                                    class="text-2xs font-bold uppercase tracking-[0.3em] opacity-70 italic">{{ $featured->category->name }}</span>
                            </div>

                            <h2
                                class="text-6xl md:text-[9vw] font-black uppercase italic tracking-tighter leading-[0.85]">
                                {{ $featured->name }}<span class="text-rose-600">.</span>
                            </h2>

                            <div class="flex flex-col md:flex-row md:items-center gap-8 pt-4">
                                <p
                                    class="text-sm md:text-lg font-medium max-w-md opacity-90 leading-tight tracking-wide">
                                    The next generation of industrial aesthetics. Engineered for movement, styled for
                                    the archive.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- SECTION 02: THE BEST SELECTIONS (3 Kotak Berwarna) --}}
    <section class="px-4 md:px-12 py-20 bg-white dark:bg-[#0a0a0a]">
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-2">
                <p class="text-rose-600 text-xs font-black uppercase tracking-[0.4em]">Curated_Selection</p>
                <h3 class="text-4xl font-black uppercase italic tracking-tighter dark:text-white">Best Products<span
                        class="text-rose-600">.</span></h3>
            </div>
            <a href="#catalog"
                class="text-xs font-black uppercase tracking-widest border-b-2 border-black dark:border-white pb-1 hover:text-rose-600 hover:border-rose-600 transition-all">View
                All Products</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($best_products as $best)
                <div
                    class="group relative aspect-4/5 overflow-hidden rounded-2xl bg-gray-50 dark:bg-white/5 shadow-lg">
                    {{-- Product Image: Tanpa Grayscale --}}
                    <img src="{{ asset('storage/uploads/' . $best->image) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-all duration-1500">

                    {{-- Colored Overlay on Hover --}}
                    <div
                        class="absolute inset-0 bg-rose-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    {{-- Info Overlay --}}
                    <div class="absolute inset-0 p-10 flex flex-col justify-between z-10">
                        <div
                            class="transform -translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                            <span
                                class="bg-white/90 backdrop-blur text-black px-4 py-2 text-2xs font-black uppercase tracking-widest rounded-full shadow-lg">
                                Best Selection
                            </span>
                        </div>

                        <div
                            class="text-white transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                            <p class="text-2xs font-bold uppercase tracking-widest mb-1 opacity-80">
                                {{ $best->category->name }}</p>
                            <h4 class="text-3xl font-black uppercase italic tracking-tighter mb-4">
                                {{ $best->name }}
                            </h4>
                            <div class="h-1 w-0 group-hover:w-full bg-rose-600 transition-all duration-500"></div>
                        </div>
                    </div>

                    {{-- Bottom Vignette --}}
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-transparent opacity-60">
                    </div>
                </div>
            @empty
                {{-- Empty State tetap bersih --}}
                <div
                    class="col-span-3 py-32 text-center rounded-3xl border-2 border-dashed border-gray-200 dark:border-white/10">
                    <p class="text-xs font-black uppercase opacity-20 tracking-[0.5em]">System_Empty</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- SECTION 03: FULL CATALOG --}}
    <section id="catalog" class="bg-white dark:bg-black py-15 rounded-t-[3rem]">
        <div>
            <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="px-4 md:px-12">
                    <h3 class="text-5xl md:text-5xl font-black uppercase italic tracking-tighter dark:text-white">
                        The_Archive</h3>
                    <p class="text-rose-600 text-xs font-bold uppercase tracking-[0.3em]">Detected_Units:
                        [{{ $products->total() }}]</p>
                </div>

                {{-- Simple Search Info --}}
                @if (request('search'))
                    <div class="bg-rose-600 text-white px-4 py-2 rounded-full text-xs font-bold uppercase">
                        Results for: "{{ request('search') }}"
                    </div>
                @endif
            </div>

            <div class="min-h-screen">
                <x-header />

                @include('layouts.collection')
            </div>
        </div>
    </section>

    <style>
        /* Tipografi ala Nike: Kuat dan Rapat */
        h2,
        h3,
        h4 {
            letter-spacing: -0.05em !important;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</x-member-layout>
