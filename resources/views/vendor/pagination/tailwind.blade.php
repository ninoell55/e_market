@if ($paginator->hasPages())
    {{-- Pastikan ada w-full di sini --}}
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex flex-col md:flex-row items-center justify-between w-full py-4 gap-6">

        {{-- SISI KIRI: Info Showing --}}
        {{-- flex-1 akan memastikan bagian ini mengambil ruang yang tersedia --}}
        <div class="flex-1">
            <p class="text-2xs font-black text-gray-400 uppercase tracking-widest text-center md:text-left">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        {{-- SISI KANAN: Tombol Navigasi --}}
        <div class="flex items-center gap-2">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="p-4 rounded-2xl bg-white dark:bg-gray-950/50 border border-gray-100 dark:border-gray-900 text-gray-200 dark:text-gray-800 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="p-4 rounded-2xl bg-white dark:bg-gray-950 border border-gray-100 dark:border-gray-900 text-gray-400 hover:text-rose-600 transition-all active:scale-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            {{-- Page Numbers --}}
            <div class="flex items-center gap-1.5">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-2 text-gray-400 font-black">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-900 dark:bg-rose-600 text-white text-xs font-black shadow-xl shadow-gray-200 dark:shadow-rose-900/20">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white dark:bg-gray-950 border border-gray-100 dark:border-gray-900 text-gray-400 text-xs font-black hover:text-rose-600 transition-all">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="p-4 rounded-2xl bg-white dark:bg-gray-950 border border-gray-100 dark:border-gray-900 text-gray-400 hover:text-rose-600 transition-all active:scale-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span
                    class="p-4 rounded-2xl bg-white dark:bg-gray-950/50 border border-gray-100 dark:border-gray-900 text-gray-200 dark:text-gray-800 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
