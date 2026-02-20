<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter flex items-center">
                        <span class="w-2 h-8 bg-rose-600 mr-4 rounded-full"></span>
                        Update Collection
                    </h3>
                    <p class="text-2xs font-bold text-gray-400 uppercase tracking-[0.2em] mt-2 ml-6">
                        Editing: <span class="text-rose-600">{{ $product->name }}</span>
                    </p>
                </div>
                <span class="hidden md:block text-2xs font-black text-gray-300 uppercase tracking-[0.3em]">Editor
                    Mode</span>
            </div>

            <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Form Detail --}}
                    <div class="lg:col-span-2 space-y-6">
                        {{-- Basic Info Card --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group md:col-span-2">
                                    <label
                                        class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Product
                                        Name</label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Category</label>
                                    <select name="category_id"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold appearance-none cursor-pointer">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ strtoupper($category->category_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Price
                                        Reference</label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-6 top-1/2 -translate-y-1/2 text-2xs font-black text-gray-400">RP</span>
                                        <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                            class="w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Variant Management Card --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                            <div class="flex items-center justify-between mb-8">
                                <h4 class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-[0.2em]">
                                    Product Variants</h4>
                                <button type="button" id="add-variant"
                                    class="text-2xs font-black text-rose-600 hover:text-rose-500 transition-colors uppercase tracking-widest">+
                                    Add New</button>
                            </div>

                            <div id="variant-container" class="space-y-4">
                                @foreach ($product->variants as $index => $variant)
                                    <div
                                        class="variant-row grid grid-cols-2 md:grid-cols-4 gap-4 p-5 bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-800 relative group">
                                        <input type="hidden" name="variants[{{ $index }}][id]"
                                            value="{{ $variant->id }}">

                                        <div>
                                            <label
                                                class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-1">Attribute</label>
                                            <input type="text" name="variants[{{ $index }}][attribute_name]"
                                                value="{{ $variant->attribute_name }}"
                                                class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-1">Value</label>
                                            <input type="text" name="variants[{{ $index }}][attribute_value]"
                                                value="{{ $variant->attribute_value }}"
                                                class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-1">Price</label>
                                            <input type="number" name="variants[{{ $index }}][price]"
                                                value="{{ $variant->price }}"
                                                class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white">
                                        </div>
                                        <div class="relative">
                                            <label
                                                class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-1">Stock</label>
                                            <input type="number" name="variants[{{ $index }}][stock]"
                                                value="{{ $variant->stock }}"
                                                class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500 dark:text-white">
                                            <button type="button"
                                                class="remove-variant absolute -right-2 -top-2 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Description Card --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800 group">
                            <label
                                class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4 group-focus-within:text-rose-600">Full
                                Description</label>
                            <textarea name="description" rows="4"
                                class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Media & Actions --}}
                    <div class="space-y-6">
                        {{-- Image Display Card --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800 group">
                            <label
                                class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 text-center group-focus-within:text-rose-600">Product
                                Media</label>

                            <div
                                class="mb-6 rounded-3xl overflow-hidden bg-gray-50 dark:bg-gray-950 border border-gray-100 dark:border-gray-800">
                                @if ($product->image)
                                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div
                                        class="w-full h-48 flex items-center justify-center text-2xs font-black text-gray-300 uppercase italic">
                                        No Image</div>
                                @endif
                            </div>

                            <div class="relative">
                                <input type="file" name="image"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="w-full py-4 bg-rose-50 dark:bg-rose-500/10 border-2 border-dashed border-rose-100 dark:border-rose-900 rounded-2xl flex flex-col items-center justify-center p-4 hover:border-rose-400 transition-colors">
                                    <svg class="w-6 h-6 text-rose-300 mb-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span
                                        class="text-[9px] font-black text-rose-400 uppercase tracking-widest text-center">Update
                                        Artwork</span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Card --}}
                        <div
                            class="bg-white dark:bg-gray-900 rounded-4xl p-8 shadow-sm border border-gray-100 dark:border-gray-800 space-y-3">
                            <button type="submit"
                                class="w-full py-4 bg-gray-900 dark:bg-rose-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 transition-all duration-300 shadow-lg active:scale-95">
                                Update Product
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
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('variant-container');
            const addButton = document.getElementById('add-variant');
            let variantIndex = {{ $product->variants->count() }};

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className =
                    'variant-row grid grid-cols-2 md:grid-cols-4 gap-4 p-5 bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-800 animate-in fade-in slide-in-from-top-2 relative group';
                row.innerHTML = `
                    <div><label class="block text-[9px] font-black text-gray-400 uppercase mb-2">Attribute</label><input type="text" name="variants[${variantIndex}][attribute_name]" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500"></div>
                    <div><label class="block text-[9px] font-black text-gray-400 uppercase mb-2">Value</label><input type="text" name="variants[${variantIndex}][attribute_value]" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500"></div>
                    <div><label class="block text-[9px] font-black text-gray-400 uppercase mb-2">Price</label><input type="number" name="variants[${variantIndex}][price]" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500"></div>
                    <div class="relative"><label class="block text-[9px] font-black text-gray-400 uppercase mb-2">Stock</label><input type="number" name="variants[${variantIndex}][stock]" class="w-full bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-bold uppercase focus:ring-1 focus:ring-rose-500">
                        <button type="button" class="remove-variant absolute -right-2 -top-2 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center shadow-lg"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>`;
                container.appendChild(row);
                variantIndex++;
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-variant')) {
                    if (confirm('Remove this variant?')) e.target.closest('.variant-row').remove();
                }
            });
        });
    </script>
</x-admin-layout>
