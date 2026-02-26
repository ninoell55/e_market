@props(['category' => null]) {{-- Default null agar tidak error jika tidak dikirim --}}

<header
    class="bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between h-20 px-6 lg:px-12">

            {{-- SECTION: LOGO & USER --}}
            <div class="shrink-0 group cursor-default">
                <h2
                    class="font-black text-xl text-gray-950 dark:text-white uppercase tracking-tighter italic leading-none transition-all group-hover:tracking-normal">
                    The <span class="text-rose-600">Archive</span>
                </h2>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="w-1.5 h-1.5 bg-rose-600 rounded-full animate-pulse"></span>
                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.2em]">
                        USR // {{ Auth::user()->name }}
                    </p>
                </div>
            </div>

            {{-- SECTION: SEARCH (MINIMALIST) --}}
            <div class="hidden lg:flex grow max-w-lg mx-12 relative group">
                @php
                    $hasCategory = $category && isset($category->slug);
                    $searchAction = $hasCategory
                        ? route('member.collection.show', $category->slug)
                        : route('member.dashboard');
                    $placeholder = $hasCategory ? 'FILTER: ' . $category->category_name : 'SEARCH ARCHIVE';
                @endphp

                <form action="{{ $searchAction }}" method="GET" class="w-full">
                    <div class="relative flex items-center">
                        <svg class="absolute left-0 w-3.5 h-3.5 text-gray-300 group-focus-within:text-rose-600 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="{{ strtoupper($placeholder) }}..."
                            class="w-full bg-transparent border-none text-2xs font-black uppercase tracking-[0.2em] pl-8 pr-4 py-2 focus:ring-0 placeholder:text-gray-300 dark:placeholder:text-gray-700 dark:text-white transition-all">

                        {{-- Underline animation --}}
                        <div
                            class="absolute bottom-0 left-0 w-0 h-px bg-rose-600 group-focus-within:w-full transition-all duration-500">
                        </div>
                    </div>
                </form>

                @if (request('search'))
                    <div class="absolute -bottom-5 left-8 flex items-center gap-2">
                        <p class="text-[7px] font-black text-rose-600 uppercase tracking-widest">
                            MATCH_FOUND: "{{ request('search') }}"
                        </p>
                        <a href="{{ $searchAction }}"
                            class="text-[7px] font-black text-gray-400 hover:text-gray-950 dark:hover:text-white transition-colors underline decoration-rose-600">CLEAR_X</a>
                    </div>
                @endif
            </div>

            {{-- SECTION: ACTIONS --}}
            <div class="flex items-center">
                <a href="#"
                    class="relative p-3 text-gray-400 hover:text-gray-950 dark:hover:text-white transition-all group border-l border-gray-100 dark:border-white/5 h-20 flex items-center justify-center px-8">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span
                        class="absolute top-6 right-6 flex items-center justify-center min-w-4.5 h-4.5 bg-gray-950 dark:bg-white text-[9px] font-black text-white dark:text-gray-950 rounded-none group-hover:bg-rose-600 group-hover:text-white transition-colors">
                        03
                    </span>
                </a>

                {{-- Border-r penutup untuk konsistensi grid --}}
                <div class="border-r border-gray-100 dark:border-white/5 h-20"></div>
            </div>

        </div>
    </div>
</header>
