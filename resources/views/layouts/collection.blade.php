<div class="min-h-screen bg-white dark:bg-gray-950">
    <div class="px-6 lg:px-12">

        {{-- HEADER SECTION (DYNAMIC TITLE) --}}
        <div class="flex flex-col items-center justify-center gap-6 text-center py-12">
            <div class="relative group px-12 py-4">
                <div
                    class="absolute top-0 left-0 w-4 h-4 border-l-2 border-t-2 border-rose-600 transition-all duration-500 group-hover:w-full group-hover:h-full group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-4 h-4 border-r-2 border-b-2 border-gray-950 dark:border-white transition-all duration-500 group-hover:w-full group-hover:h-full group-hover:opacity-20">
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="flex items-center gap-4 mb-4 opacity-0 group-hover:opacity-100 transition-all duration-700 -translate-y-2 group-hover:translate-y-0">
                        <span class="h-px w-6 bg-rose-600"></span>
                        <span class="text-[8px] font-black tracking-[0.6em] text-rose-600 uppercase">Fashion_Aura</span>
                        <span class="h-px w-6 bg-rose-600"></span>
                    </div>

                    <h3 class="text-5xl md:text-7xl font-black uppercase italic tracking-tighter dark:text-white">
                        <span class="text-gray-200 dark:text-gray-800 transition-colors group-hover:text-rose-600">
                            {{ isset($category) ? 'The' : 'All' }}
                        </span>
                        <span class="text-gray-900 dark:text-white transition-all duration-500">
                            {{ isset($category) ? $category->category_name : 'Catalog' }}<span
                                class="text-rose-600">.</span>
                        </span>
                    </h3>

                    <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 mt-2">
                        <p
                            class="text-2xs font-black text-gray-950 dark:text-white uppercase tracking-[0.4em] flex items-center gap-2">
                            <span class="w-1 h-1 bg-rose-600 rounded-full animate-ping"></span>
                            {{ $category->category_name ?? 'Global' }}_Collection
                        </p>
                        <span class="hidden md:block text-gray-200 dark:text-gray-800">/</span>
                        <span
                            class="text-[9px] font-bold text-gray-400 dark:text-gray-600 italic tracking-widest uppercase">
                            Total in : [{{ $products->total() }}]
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- NEW: INTEGRATED FILTER & SORT BAR --}}
        <div class="mb-12 py-8 border-y border-gray-100 dark:border-white/5 bg-gray-50/30 dark:bg-white/1">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-10">

                {{-- LEFT SIDE: DYNAMIC FILTERS --}}
                <div class="flex flex-col gap-3 w-full lg:w-auto">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-rose-600"></span>
                        <span class="text-[9px] font-black text-gray-950 dark:text-white uppercase tracking-[0.3em]">
                            @if (isset($category))
                                {{ strtolower($category->category_name) == 'accessories' ? 'Color_Selection' : 'Size_Library' }}
                            @else
                                Category_Explore
                            @endif
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @if (isset($category))
                            {{-- Filter Logic --}}
                            @php
                                $isAcc = strtolower($category->category_name) == 'accessories';
                                $param = $isAcc ? 'color' : 'size';
                                $items = $isAcc ? $availableColors ?? [] : $availableSizes ?? [];
                            @endphp

                            {{-- Reset Button --}}
                            <a href="{{ request()->fullUrlWithQuery([$param => null]) }}"
                                class="px-5 py-2 text-2xs font-bold uppercase tracking-widest transition-all border
                        {{ !request($param)
                            ? 'bg-rose-600 border-rose-600 text-white shadow-lg shadow-rose-600/20'
                            : 'bg-white dark:bg-gray-950 border-gray-200 dark:border-white/10 text-gray-400 hover:border-rose-600 hover:text-rose-600' }}">
                                All_Items
                            </a>

                            @foreach ($items as $item)
                                <a href="{{ request()->fullUrlWithQuery([$param => $item]) }}"
                                    class="px-5 py-2 text-2xs font-bold uppercase tracking-widest transition-all border
                            {{ request($param) == $item
                                ? 'bg-rose-600 border-rose-600 text-white shadow-lg shadow-rose-600/20'
                                : 'bg-white dark:bg-gray-950 border-gray-200 dark:border-white/10 text-gray-400 hover:border-rose-600 hover:text-rose-600' }}">
                                    {{ $item }}
                                </a>
                            @endforeach
                        @else
                            {{-- Dashboard Mode --}}
                            @foreach ($categories ?? [] as $cat)
                                <a href="{{ route('member.collection', $cat->slug) }}"
                                    class="px-5 py-2 text-2xs font-bold uppercase tracking-widest transition-all border border-gray-200 dark:border-white/10 text-gray-400 hover:border-rose-600 hover:text-rose-600">
                                    {{ $cat->category_name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- RIGHT SIDE: SEARCH & SORT --}}
                <div class="flex flex-col md:flex-row items-end md:items-center gap-8 w-full lg:w-auto">

                    {{-- New Refined Sort --}}
                    <div class="flex flex-col items-end gap-2">
                        <span
                            class="text-[7px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.4em]">Sort_Order:</span>
                        <div class="flex items-center gap-6">
                            @php
                                $sorts = [
                                    'latest' => 'Newest',
                                    'price_high' => 'High-Low',
                                    'price_low' => 'Low-High',
                                ];
                            @endphp
                            @foreach ($sorts as $val => $label)
                                <a href="{{ request()->fullUrlWithQuery(['sort' => $val]) }}"
                                    class="relative text-2xs font-black uppercase tracking-widest transition-all
                            {{ request('sort', 'latest') == $val ? 'text-rose-600' : 'text-gray-300 dark:text-gray-700 hover:text-gray-950 dark:hover:text-white' }}">
                                    {{ $label }}
                                    @if (request('sort', 'latest') == $val)
                                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-rose-600"></span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div
            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-px bg-gray-100 dark:bg-white/5 border border-gray-100 dark:border-white/5">
            @forelse ($products as $product)
                @php
                    $isOutOfStock = $product->total_stock <= 0;
                    $categoryName = strtolower($product->category->category_name);
                    $colorMap = [
                        'shoes' =>
                            'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20',
                        'clothes' =>
                            'bg-yellow-50 text-yellow-600 border-yellow-100 dark:bg-yellow-500/10 dark:text-yellow-400 dark:border-yellow-500/20',
                        'accessories' =>
                            'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20',
                        'default' =>
                            'bg-gray-50 text-gray-600 border-gray-100 dark:bg-gray-500/10 dark:text-gray-400 dark:border-gray-500/20',
                    ];
                    $appliedColor = $colorMap[$categoryName] ?? $colorMap['default'];
                @endphp

                <div class="group relative bg-white dark:bg-gray-950 p-4 transition-all duration-500 hover:z-20">
                    {{-- Corner Accent --}}
                    <div
                        class="absolute top-0 right-0 w-0 h-0 border-t-30 border-r-30 {{ $isOutOfStock ? 'border-t-transparent border-r-transparent' : 'border-t-transparent border-r-transparent group-hover:border-t-rose-600 group-hover:border-r-rose-600' }} transition-all duration-500 z-30">
                    </div>

                    {{-- Photo Section --}}
                    <div class="relative aspect-square mb-5 overflow-hidden bg-gray-50 dark:bg-white/2">
                        <img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-all duration-1000 ease-in-out {{ $isOutOfStock ? 'opacity-50 grayscale' : '' }}">

                        <div
                            class="absolute inset-x-4 bottom-4 translate-y-12 group-hover:translate-y-0 transition-all duration-500 z-20">
                            @if ($isOutOfStock)
                                <button disabled
                                    class="w-full bg-gray-200 dark:bg-gray-800 text-gray-500 py-3 text-[8px] font-black uppercase tracking-[0.3em] cursor-not-allowed">Sold
                                    Out</button>
                            @else
                                <a href="{{ route('member.product.show', $product) }}"
                                    class="w-full inline-block text-center bg-gray-950 dark:bg-white text-white dark:text-gray-950 border border-gray-900 dark:border-white/20 py-3 text-[8px] font-black uppercase tracking-[0.3em] hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-xl">
                                    View Details
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="relative space-y-3">
                        <div class="flex items-center justify-between border-b border-gray-50 dark:border-white/5 pb-2">
                            <span
                                class="px-1.5 py-0.5 rounded-sm border text-[7px] font-black uppercase tracking-widest {{ $appliedColor }}">
                                {{ $product->category->category_name ?? 'Uncategorized' }}
                            </span>
                            <div class="flex items-center gap-1">
                                <div
                                    class="w-1 h-1 rounded-full {{ $isOutOfStock ? 'bg-gray-400' : 'bg-green-500 animate-pulse' }}">
                                </div>
                                <span
                                    class="text-[6px] font-bold uppercase tracking-[0.2em] text-gray-400">{{ $isOutOfStock ? 'Empty' : 'Active' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <h4
                                class="flex-1 text-[11px] md:text-[12px] font-black dark:text-white uppercase tracking-tight group-hover:text-rose-600 transition-colors line-clamp-2">
                                {{ $product->name }}</h4>
                            <p
                                class="text-[12px] md:text-[14px] font-black text-gray-950 dark:text-white italic tracking-tighter">
                                <span
                                    class="text-[8px] not-italic opacity-40 font-bold mr-0.5">IDR</span>{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <x-empty-state title="No products found"
                        message="No products match the search criteria or category filter." buttonText="Refresh" />
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="mt-12 py-12 border-t border-gray-100 dark:border-white/5">
            {{ $products->links() }}
        </div>
    </div>
</div>
