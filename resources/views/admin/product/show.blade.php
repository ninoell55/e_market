<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('admin.product.index') }}"
                    class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-rose-600 transition-colors group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Collection
                </a>
            </div>

            <div
                class="bg-white dark:bg-gray-900 rounded-4xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="flex flex-col lg:flex-row">

                    <div
                        class="w-full lg:w-1/2 bg-gray-50 dark:bg-gray-800/30 p-8 lg:p-12 flex items-center justify-center border-b lg:border-b-0 lg:border-r border-gray-100 dark:border-gray-800">
                        @if (isset($product->image))
                            <div class="relative group w-full">
                                <div
                                    class="absolute -inset-4 bg-rose-500/10 rounded-[3rem] blur-2xl opacity-0 group-hover:opacity-100 transition duration-700">
                                </div>
                                <img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="relative rounded-3xl shadow-2xl w-full aspect-square object-cover transform group-hover:scale-[1.01] transition duration-500">
                            </div>
                        @else
                            <div class="flex flex-col items-center text-gray-300 dark:text-gray-700">
                                <svg class="w-24 h-24 mb-4 opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-black uppercase tracking-[0.2em]">No Preview Available</span>
                            </div>
                        @endif
                    </div>

                    <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-8">
                                <span
                                    class="px-4 py-1.5 bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 text-2xs font-black uppercase tracking-[0.15em] rounded-full border border-rose-100 dark:border-rose-500/20">
                                    {{ $product->category->category_name }}
                                </span>
                                <span class="text-2xs font-bold text-gray-400 tracking-widest uppercase">
                                    ID: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <h1
                                class="text-4xl lg:text-5xl font-black text-gray-900 dark:text-white tracking-tight leading-[1.1] mb-6">
                                {{ $product->name }}
                            </h1>

                            <div class="grid grid-cols-2 gap-8 py-8 border-y border-gray-100 dark:border-gray-800">
                                <div>
                                    <p
                                        class="text-2xs font-black text-gray-400 uppercase tracking-widest mb-2 flex items-center">
                                        <span class="w-3 h-3 bg-rose-500 rounded-full mr-2"></span> Price
                                    </p>
                                    <p class="text-2xl font-black text-rose-600 tracking-tight">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-2xs font-black text-gray-400 uppercase tracking-widest mb-2">
                                        Available Stock</p>
                                    <p class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">
                                        {{ $product->stock }} <span
                                            class="text-sm font-medium text-gray-400">Units</span>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8">
                                <p class="text-2xs font-black text-gray-400 uppercase tracking-widest mb-4">Product
                                    Overview</p>
                                <p
                                    class="text-base font-medium text-gray-600 dark:text-gray-400 leading-relaxed italic">
                                    "{{ $product->description ?? 'This product has no description yet.' }}"
                                </p>
                            </div>
                        </div>

                        <div class="mt-12">
                            <div
                                class="text-2xs font-bold text-gray-400 uppercase tracking-widest mb-8 flex items-center">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Cataloged on {{ $product->created_at->format('M d, Y') }}
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('admin.product.edit', $product) }}"
                                    class="flex-2 px-8 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 dark:hover:bg-rose-500 dark:hover:text-white transition-all duration-300 text-center shadow-lg active:scale-95">
                                    Edit Details
                                </a>

                                <form action="{{ route('admin.product.destroy', $product) }}" method="POST"
                                    class="flex-1" onsubmit="return confirm('Archive this product?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-8 py-4 bg-white dark:bg-transparent border border-gray-200 dark:border-gray-800 text-gray-400 hover:text-rose-600 hover:border-rose-600 transition-all duration-300 text-xs font-black uppercase tracking-widest rounded-xl active:scale-95">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
