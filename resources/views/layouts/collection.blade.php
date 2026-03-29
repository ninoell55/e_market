<div class="min-h-screen bg-white dark:bg-gray-950">
    <div class="px-6 lg:px-12">
        <div class="flex flex-col items-center justify-center gap-6 text-center">
            <div class="relative group px-12 py-4">
                <div
                    class="absolute top-0 left-0 w-4 h-4 border-l-2 border-t-2 border-rose-600 transition-all duration-500 group-hover:w-full group-hover:h-full group-hover:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-4 h-4 border-r-2 border-b-2 border-gray-950 dark:border-white transition-all duration-500 group-hover:w-full group-hover:h-full group-hover:opacity-20">
                </div>

                <div class="flex flex-col items-center">
                    {{-- Badge Status --}}
                    <div
                        class="flex items-center gap-4 mb-4 opacity-0 group-hover:opacity-100 transition-all duration-700 -translate-y-2 group-hover:translate-y-0">
                        <span class="h-px w-6 bg-rose-600"></span>
                        <span class="text-[8px] font-black tracking-[0.6em] text-rose-600 uppercase">Fashion_Aura</span>
                        <span class="h-px w-6 bg-rose-600"></span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-5xl md:text-7xl font-black uppercase italic tracking-tighter dark:text-white">
                        <span
                            class="text-gray-200 dark:text-gray-800 transition-colors group-hover:text-rose-600">All</span>
                        <span class="text-gray-900 dark:text-white transition-all duration-500">
                            Catalog<span class="text-rose-600">.</span>
                        </span>
                    </h3>

                    {{-- Info Bar --}}
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
                        class="absolute top-0 right-0 w-0 h-0 border-t-30 border-r-30 {{ $isOutOfStock ? 'border-t-gray-500/0 border-r-gray-500/0' : 'border-t-rose-600/0 border-r-rose-600/0 group-hover:border-t-rose-600 group-hover:border-r-rose-600' }} transition-all duration-500 z-30">
                    </div>

                    {{-- Photo Section --}}
                    <div class="relative aspect-square mb-5 overflow-hidden bg-gray-50 dark:bg-white/2">
                        <img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-all duration-1000 ease-in-out {{ $isOutOfStock ? 'opacity-50 grayscale' : '' }}">

                        {{-- Action Button --}}
                        <div
                            class="absolute inset-x-4 bottom-4 translate-y-12 group-hover:translate-y-0 transition-all duration-500 z-20">
                            @if ($isOutOfStock)
                                <button disabled
                                    class="w-full bg-gray-200 dark:bg-gray-800 text-gray-500 py-3 text-[8px] font-black uppercase tracking-[0.3em] cursor-not-allowed border border-transparent">
                                    Sold Out
                                </button>
                            @else
                                <a href="{{ route('member.product.show', $product) }}"
                                    class="w-full inline-block text-center bg-gray-950 dark:bg-white text-white dark:text-gray-950 border border-gray-900 dark:border-white/20 py-3 text-[8px] font-black uppercase tracking-[0.3em] hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-xl cursor-pointer">
                                    View Details
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="relative space-y-3">
                        {{-- Header Info: Category (Dynamic Color) & Status --}}
                        <div class="flex items-center justify-between border-b border-gray-50 dark:border-white/5 pb-2">
                            <div class="flex items-center gap-1.5">
                                <span
                                    class="px-1.5 py-0.5 rounded-sm border text-[7px] font-black uppercase tracking-widest {{ $appliedColor }}">
                                    {{ $categoryName ? ucfirst($categoryName) : 'Uncategorized' }}
                                </span>
                            </div>

                            {{-- Status Logic --}}
                            <div class="flex items-center gap-1">
                                <div
                                    class="w-1 h-1 rounded-full {{ $isOutOfStock ? 'bg-gray-400' : 'bg-green-500 animate-pulse' }}">
                                </div>
                                <span class="text-[6px] font-bold uppercase tracking-[0.2em] text-gray-400">
                                    {{ $isOutOfStock ? 'Empty' : 'Active' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <h4
                                class="flex-1 text-[11px] md:text-[12px] font-black dark:text-white uppercase tracking-tight group-hover:text-rose-600 transition-colors line-clamp-2">
                                {{ $product->name }}
                            </h4>
                            <div class="text-right flex flex-col justify-start pt-0.5">
                                <p
                                    class="text-[12px] md:text-[14px] font-black text-gray-950 dark:text-white italic tracking-tighter {{ $isOutOfStock ? 'line-through text-gray-500' : '' }}">
                                    <span
                                        class="text-[8px] not-italic opacity-40 font-bold mr-0.5">IDR</span>{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <x-empty-state title="No Product Found"
                        message="No products are available in the current category or search results."
                        buttonText="Refresh" />
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="mt-12 py-12 border-t border-gray-100 dark:border-white/5">
            {{ $products->links() }}
        </div>
    </div>
</div>
