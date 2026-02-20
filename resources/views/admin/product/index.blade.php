<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 px-4 sm:px-0">
                <div>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">Product Collection
                    </h3>
                    <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-2">Manage your luxury stock
                        and availability</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                    <form action="{{ route('admin.product.index') }}" method="GET" class="relative w-full sm:w-72 group">
                        {{-- Jika sedang di kategori tertentu, bawa juga input hidden agar filter kategori tidak lepas --}}
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search product..."
                            class="w-full bg-white dark:bg-gray-950 border-gray-100 dark:border-gray-900 focus:ring-rose-500 focus:border-rose-500 rounded-2xl text-2xs font-bold uppercase tracking-widest pl-12 pr-4 py-4 transition-all shadow-sm">

                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        {{-- Tombol submit tersembunyi agar bisa enter --}}
                        <button type="submit" class="hidden"></button>
                    </form>

                    <a href="{{ route('admin.product.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gray-900 dark:bg-rose-600 text-white text-2xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-500 transition-all duration-300 shadow-xl shadow-gray-200 dark:shadow-none active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                        Add New Product
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-2 overflow-x-auto pb-2 px-4 sm:px-0 no-scrollbar">
                {{-- Button All Items --}}
                <a href="{{ route('admin.product.index') }}"
                    class="px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest border {{ !request('category') ? 'bg-gray-900 dark:bg-rose-600 text-white shadow-lg' : 'border-gray-100 dark:border-gray-900 bg-white dark:bg-gray-950 text-gray-400 hover:text-rose-600' }} whitespace-nowrap transition-all">
                    All Items
                </a>

                {{-- Contoh Looping Kategori dari Database (Sangat disarankan) --}}
                @foreach ($categories as $category)
                    <a href="{{ route('admin.product.index', ['category' => $category->slug]) }}"
                        class="px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest border {{ request('category') == $category->slug ? 'bg-gray-900 dark:bg-rose-600 text-white shadow-lg' : 'border-gray-100 dark:border-gray-900 bg-white dark:bg-gray-950 text-gray-400 hover:text-rose-600' }} whitespace-nowrap transition-all">
                        {{ $category->category_name }}
                    </a>
                @endforeach
            </div>

            <div
                class="bg-white dark:bg-gray-950 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="border-b border-gray-50 dark:border-gray-900 bg-gray-50/30 dark:bg-gray-900/30">
                                <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">#
                                </th>
                                <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                    Product Details</th>
                                <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                    Category</th>
                                <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Price
                                    & Stock</th>
                                <th
                                    class="px-8 py-6 text-right text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-900">
                            @forelse ($products as $product)
                                <tr
                                    class="group hover:bg-gray-50/50 dark:hover:bg-rose-950/5 transition-all duration-300">
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-xs font-bold text-gray-400 group-hover:text-rose-600 transition-colors">
                                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-900 overflow-hidden border border-gray-100 dark:border-gray-800 shrink-0">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-[8px] font-black text-gray-300 uppercase">
                                                        No Pic</div>
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-black text-gray-900 dark:text-white tracking-tight group-hover:text-rose-600 transition-colors uppercase">{{ $product->name }}</span>
                                                <span
                                                    class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter mt-0.5">ID:
                                                    #PROD-{{ $product->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="px-3 py-1 bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-500 text-[9px] font-black uppercase tracking-widest rounded-full border border-rose-100 dark:border-rose-500/20">
                                            {{ $product->category->category_name }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-black text-gray-900 dark:text-white tracking-tighter">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            {{-- Karena stok ada di varian, tampilkan total stok dari semua varian --}}
                                            <span
                                                class="text-2xs font-bold {{ $product->variants->sum('stock') < 10 ? 'text-rose-500' : 'text-gray-400' }} uppercase">
                                                {{ $product->variants->sum('stock') }} in stock
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            {{-- Button Show (Detail) --}}
                                            <a href="{{ route('admin.product.show', $product) }}"
                                                class="p-2.5 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-xl transition-all shadow-sm"
                                                title="View Details">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            {{-- Button Edit --}}
                                            <a href="{{ route('admin.product.edit', $product) }}"
                                                class="p-2.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all shadow-sm"
                                                title="Edit Product">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Button Delete --}}
                                            <form action="{{ route('admin.product.destroy', $product) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                                    class="p-2.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-all shadow-sm"
                                                    title="Delete Product">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-12 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div
                                                class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.07 0l-.548.547A3.374 3.374 0 0014 18H7a3.373 3.373 0 00-2.122.879l-.548-.547z" />
                                                </svg>
                                            </div>
                                            <span class="text-sm font-bold text-gray-400 uppercase">No products
                                                found</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="w-full">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
