<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb Modern --}}
            <div class="mb-8">
                <a href="{{ route('admin.product.index') }}"
                    class="inline-flex items-center gap-2 text-rose-500 hover:text-rose-700 font-bold text-xs uppercase tracking-widest transition-all group">
                    <div
                        class="p-2 bg-white dark:bg-gray-900 rounded-full shadow-sm group-hover:shadow-rose-200 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    Back to Inventory
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- Left Side: Premium Image --}}
                <div class="lg:col-span-5">
                    <div class="sticky top-10 space-y-6">
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-linear-to-tr from-rose-500 to-fuchsia-500 rounded-[3rem] blur opacity-25 group-hover:opacity-40 transition duration-1000">
                            </div>

                            <div
                                class="relative bg-white dark:bg-gray-900 p-4 rounded-[3rem] shadow-xl border border-rose-100 dark:border-gray-800">
                                @if (isset($product->image))
                                    <div class="overflow-hidden rounded-[2.5rem] aspect-square">
                                        <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                    </div>
                                @else
                                    <div
                                        class="aspect-square flex flex-col items-center justify-center bg-rose-50 dark:bg-gray-800 rounded-[2.5rem]">
                                        <svg class="w-16 h-16 text-rose-200" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Price Card --}}
                        <div
                            class="bg-linear-to-br from-rose-600 to-rose-700 p-8 rounded-[2.5rem] shadow-lg shadow-rose-200 dark:shadow-none text-white">
                            <p class="text-rose-100 text-xs font-bold uppercase tracking-tighter mb-1">MSRP / Listing
                                Price</p>
                            <h2 class="text-4xl font-black italic">Rp {{ number_format($product->price, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Details --}}
                <div class="lg:col-span-7 space-y-8">

                    <div
                        class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl p-8 lg:p-12 rounded-[3rem] shadow-sm border border-white dark:border-gray-800">
                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="px-4 py-1.5 bg-rose-100 dark:bg-rose-900/50 text-rose-600 dark:text-rose-400 text-2xs font-black uppercase tracking-widest rounded-full">
                                {{ $product->category->category_name }}
                            </span>
                            <span class="h-1 w-1 bg-gray-300 rounded-full"></span>
                            <span class="text-2xs font-bold text-gray-400 uppercase tracking-widest">
                                ID: #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        <h1 class="text-4xl lg:text-5xl font-black text-gray-900 dark:text-white leading-tight mb-6">
                            {{ $product->name }}
                        </h1>

                        <div class="prose prose-rose dark:prose-invert">
                            <h3 class="text-xs font-black text-rose-500 uppercase tracking-[0.2em] mb-3">The Story</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed italic">
                                "{{ $product->description ?? 'A curated masterpiece with no words needed.' }}"
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-10">
                            <div class="p-5 bg-rose-50/50 dark:bg-rose-950/20 rounded-2xl border border-rose-100/50">
                                <p class="text-2xs font-bold text-rose-400 uppercase mb-1">Stock on Hand</p>
                                <p class="text-2xl font-black text-rose-600 dark:text-rose-400">
                                    {{ $product->variants->sum('stock') }} <span
                                        class="text-xs font-medium opacity-60 italic text-gray-500">units</span></p>
                            </div>
                            <div class="p-5 bg-rose-50/50 dark:bg-rose-950/20 rounded-2xl border border-rose-100/50">
                                <p class="text-2xs font-bold text-rose-400 uppercase mb-1">Variations</p>
                                <p class="text-2xl font-black text-rose-600 dark:text-rose-400">
                                    {{ $product->variants->count() }} <span
                                        class="text-xs font-medium opacity-60 italic text-gray-500">types</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Variants Table --}}
                    <div
                        class="bg-white dark:bg-gray-900 rounded-[3rem] shadow-sm border border-rose-50 dark:border-gray-800 overflow-hidden">
                        <div
                            class="px-8 py-6 bg-rose-50/30 dark:bg-gray-800/50 border-b border-rose-50 dark:border-gray-800">
                            <h3 class="text-xs font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest">
                                Variation Matrix</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left">
                                        <th class="px-8 py-4 text-2xs font-black text-gray-400 uppercase">Description
                                        </th>
                                        <th class="px-8 py-4 text-2xs font-black text-gray-400 uppercase text-right">
                                            Unit Price</th>
                                        <th class="px-8 py-4 text-2xs font-black text-gray-400 uppercase text-right">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-rose-50 dark:divide-gray-800">
                                    @foreach ($product->variants as $variant)
                                        <tr
                                            class="group hover:bg-rose-50/50 dark:hover:bg-rose-900/10 transition-colors">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-2 h-2 rounded-full bg-rose-400"></div>
                                                    <span
                                                        class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ $variant->attribute_name }}:
                                                        {{ $variant->attribute_value }}</span>
                                                </div>
                                            </td>
                                            <td
                                                class="px-8 py-5 text-right font-mono text-sm font-bold text-gray-900 dark:text-white">
                                                {{ number_format($variant->price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <span
                                                    class="inline-block px-3 py-1 rounded-lg {{ $variant->stock < 10 ? 'bg-orange-100 text-orange-600' : 'bg-rose-100 text-rose-600' }} text-2xs font-black uppercase tracking-tighter">
                                                    {{ $variant->stock }} in stock
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('admin.product.edit', $product) }}"
                            class="flex-2 py-5 bg-gray-900 dark:bg-rose-600 text-white text-center text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-700 transition-all shadow-lg active:scale-95">
                            Modify Product
                        </a>
                        <form action="{{ route('admin.product.destroy', $product) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Remove from collection?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full py-5 bg-white dark:bg-transparent border-2 border-rose-100 dark:border-rose-900 text-rose-400 hover:text-rose-600 hover:border-rose-600 transition-all text-xs font-black uppercase tracking-[0.2em] rounded-2xl active:scale-95">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
