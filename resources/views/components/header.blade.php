@props(['category' => null])

@php
    $cartCount = Auth::check() ? Auth::user()->cart?->items?->count() ?? 0 : 0;
    $displayCount = str_pad($cartCount, 2, '0', STR_PAD_LEFT);
    $cartRoute = route('member.cart.index');
@endphp

<header class="bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto">
        {{-- Baris Utama --}}
        <div class="flex flex-col lg:flex-row">

            <div
                class="flex items-center justify-between h-20 px-6 lg:px-12 lg:border-r border-gray-100 dark:border-white/5 lg:min-w-75">
                {{-- SECTION: LOGO & USER --}}
                <div class="shrink-0 group cursor-default leading-none">
                    <h2
                        class="font-black text-xl text-gray-950 dark:text-white uppercase tracking-tighter italic transition-all group-hover:tracking-normal">
                        The <span class="text-rose-600">Archive</span>
                    </h2>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-rose-600 rounded-full animate-pulse"></span>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.2em]">
                            USR // {{ Auth::user()->name }}
                        </p>
                    </div>
                </div>

                {{-- Mobile Cart/Action (Dinamis) --}}
                <div class="flex lg:hidden items-center">
                    <a href="{{ $cartRoute }}" class="relative p-3 text-gray-400 hover:text-rose-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        @if ($cartCount > 0)
                            <span
                                class="absolute top-1 right-1 flex items-center justify-center min-w-4 h-4 bg-rose-600 text-[8px] font-black text-white">
                                {{ $displayCount }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>

            {{-- SECTION: SEARCH --}}
            <div
                class="flex grow relative group border-t lg:border-t-0 border-gray-100 dark:border-white/5 lg:mx-12 h-16 lg:h-20 items-center px-6 lg:px-0">
                @php
                    $hasCategory = $category && isset($category->slug);
                    $searchAction = $hasCategory
                        ? route('member.collection', $category->slug)
                        : route('member.dashboard');
                    $placeholder = $hasCategory
                        ? 'SEARCH in COLLECTION: ' . $category->category_name
                        : 'SEARCH COLLECTION';
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
                            class="w-full bg-transparent border-none text-2xs font-black uppercase tracking-[0.2em] pl-8 pr-20 py-2 focus:ring-0 placeholder:text-gray-300 dark:placeholder:text-gray-700 dark:text-white transition-all">

                        @if (request('search'))
                            <div class="absolute right-0 flex items-center gap-3">
                                <a href="{{ $searchAction }}"
                                    class="flex items-center justify-center bg-gray-100 dark:bg-white/5 hover:bg-rose-600 dark:hover:bg-rose-600 text-gray-400 hover:text-white px-2 py-1 transition-all duration-300 group/clear">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </div>
                        @endif

                        <div
                            class="absolute bottom-0 left-0 w-0 h-px bg-rose-600 group-focus-within:w-full transition-all duration-500">
                        </div>
                    </div>
                </form>
            </div>

            {{-- SECTION: ACTIONS (Desktop Only - Dinamis) --}}
            <div class="hidden lg:flex items-center">
                <a href="{{ $cartRoute }}"
                    class="relative p-3 text-gray-400 hover:text-gray-950 dark:hover:text-white transition-all group border-l border-gray-100 dark:border-white/5 h-20 flex items-center justify-center px-8">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>

                    @if ($cartCount > 0)
                        <span
                            class="absolute top-6 right-6 flex items-center justify-center min-w-4.5 h-4.5 bg-gray-950 dark:bg-white text-[9px] font-black text-white dark:text-gray-950 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                            {{ $displayCount }}
                        </span>
                    @endif
                </a>
                <div class="border-r border-gray-100 dark:border-white/5 h-20"></div>
            </div>

        </div>
    </div>
</header>
