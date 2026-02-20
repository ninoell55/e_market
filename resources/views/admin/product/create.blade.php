<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <h3 class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter flex items-center">
                    <span class="w-2 h-8 bg-rose-600 mr-4 rounded-full"></span>
                    Create New Product
                </h3>
                <p class="text-2xs font-bold text-gray-400 uppercase tracking-[0.2em] mt-2 ml-6">
                    Add new inventory to your store catalog
                </p>
            </div>

            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Form Utama --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Name --}}
                                <div class="group md:col-span-2">
                                    <label
                                        class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Product
                                        Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        placeholder="E.G. LUXURY ROSE WATCH"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold placeholder:text-gray-300">
                                </div>

                                {{-- Category --}}
                                <div class="group">
                                    <label
                                        class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Category</label>
                                    <select name="category_id"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold appearance-none cursor-pointer">
                                        <option disabled selected>SELECT CATEGORY</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Base Price --}}
                                <div class="group">
                                    <label
                                        class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Base
                                        Price</label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-6 top-1/2 -translate-y-1/2 text-2xs font-black text-gray-400">RP</span>
                                        <input type="number" name="price" value="{{ old('price') }}" placeholder="0"
                                            class="w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Variant Section --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                            <div class="flex items-center justify-between mb-6">
                                <h4 class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-[0.2em]">
                                    Product Variants</h4>
                                <button type="button" onclick="addVariant()"
                                    class="text-2xs font-black text-rose-600 hover:text-rose-500 transition-colors uppercase tracking-widest">+
                                    Add New</button>
                            </div>

                            <div id="variant-container" class="space-y-4">
                                <div
                                    class="variant-row grid grid-cols-2 md:grid-cols-4 gap-4 p-5 bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-800 relative">
                                    @foreach (['attribute_name' => 'Attribute', 'attribute_value' => 'Value', 'price' => 'Price', 'stock' => 'Stock'] as $key => $label)
                                        <div>
                                            <label
                                                class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-1">{{ $label }}</label>
                                            <input type="text" name="variants[0][{{ $key }}]"
                                                class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800 group">
                            <label
                                class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4 group-focus-within:text-rose-600">Product
                                Description</label>
                            <textarea name="description" rows="4" placeholder="Describe your product here..."
                                class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold"></textarea>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Media & Actions --}}
                    <div class="space-y-6">
                        {{-- Image Upload --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800 group text-center">
                            <label
                                class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 group-focus-within:text-rose-600">Product
                                Image</label>
                            <div class="relative group">
                                <input type="file" name="image"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="aspect-square bg-gray-50 dark:bg-gray-950 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center p-6 group-hover:border-rose-400 transition-colors">
                                    <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-2xs font-black text-gray-400 uppercase tracking-widest">Select
                                        Image</span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800 space-y-3">
                            <button type="submit"
                                class="w-full py-4 bg-gray-900 dark:bg-rose-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 transition-all duration-300 shadow-lg active:scale-95">
                                Save Product
                            </button>
                            <a href="{{ route('admin.product.index') }}"
                                class="block w-full py-4 bg-gray-50 dark:bg-gray-800 text-gray-400 text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-gray-100 dark:hover:bg-gray-700 text-center transition-all">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        let variantCount = 1;

        function addVariant() {
            const container = document.getElementById('variant-container');
            const newRow = `
                <div class="variant-row grid grid-cols-2 md:grid-cols-4 gap-4 p-5 bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-800 animate-in fade-in slide-in-from-top-2 relative">
                    <div><input type="text" name="variants[${variantCount}][attribute_name]" placeholder="ATTR" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white"></div>
                    <div><input type="text" name="variants[${variantCount}][attribute_value]" placeholder="VAL" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white"></div>
                    <div><input type="number" name="variants[${variantCount}][price]" placeholder="PRICE" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white"></div>
                    <div class="flex items-center gap-2">
                        <input type="number" name="variants[${variantCount}][stock]" placeholder="STOCK" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white">
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-rose-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', newRow);
            variantCount++;
        }
    </script>
</x-admin-layout>
