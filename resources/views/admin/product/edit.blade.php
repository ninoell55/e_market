<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">
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
            <a href="{{ route('admin.product.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-gray-500 hover:text-rose-600 transition-all uppercase tracking-widest ml-6 md:ml-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                Back to collection
            </a>
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
                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-2xs font-black text-gray-400">IDR</span>
                                    <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                        class="w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">
                                </div>
                            </div>

                            {{-- Is Best Seller --}}
                            <div class="md:col-span-2 mt-2">
                                <label class="flex items-center cursor-pointer group w-fit">
                                    <div class="relative">
                                        <input type="checkbox" name="is_best" value="1"
                                            {{ old('is_best', $product->is_best ?? false) ? 'checked' : '' }}
                                            class="sr-only peer">
                                        <div
                                            class="w-11 h-6 bg-gray-200 dark:bg-gray-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-600">
                                        </div>
                                    </div>
                                    <span
                                        class="ms-3 text-2xs font-black text-gray-400 uppercase tracking-widest group-hover:text-rose-600 transition-colors">Mark
                                        as Best Seller</span>
                                </label>
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M6 18L18 6M6 6l12 12" />
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
                        class="bg-white dark:bg-gray-900 rounded-none p-8 shadow-sm border border-gray-100 dark:border-gray-800 group text-center">
                        <label
                            class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 group-focus-within:text-rose-600 transition-colors">
                            Product Image
                        </label>

                        <div class="relative group">
                            {{-- File Input --}}
                            <input type="file" name="image" id="editImageInput" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">

                            {{-- Preview Container: Dibuat Aspect Square agar sama dengan Create --}}
                            <div id="imagePreviewContainer"
                                class="aspect-square rounded-4xl bg-gray-50 dark:bg-gray-950 border-2 border-dashed border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center overflow-hidden group-hover:border-rose-400 transition-all duration-300">

                                @if ($product->image)
                                    {{-- Existing Image --}}
                                    <img id="mainImagePreview"
                                        src="{{ asset('storage/uploads/' . $product->image) }}"
                                        class="w-full h-full object-cover">

                                    {{-- Overlay saat Hover untuk memberi tahu bisa di-update --}}
                                    <div id="editOverlay"
                                        class=" absolute rounded-4xl inset-0 bg-gray-900/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                        <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-2xs font-black text-white uppercase tracking-widest">Change
                                            Photo</span>
                                    </div>
                                @else
                                    {{-- Placeholder jika tidak ada gambar sama sekali --}}
                                    <div id="placeholderContent"
                                        class="flex flex-col items-center justify-center p-6">
                                        <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-2xs font-black text-gray-400 uppercase tracking-widest">Add
                                            Image</span>
                                    </div>
                                    {{-- Tag img kosong untuk preview upload baru --}}
                                    <img id="mainImagePreview" src="#"
                                        class="hidden w-full h-full object-cover">
                                @endif
                            </div>
                        </div>

                        {{-- Note kecil di bawah --}}
                        <p class="mt-4 text-[9px] font-bold text-gray-400 uppercase tracking-tight">
                            Click to update current product image
                        </p>
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

            // Logic Preview Gambar Edit
            const imageInput = document.getElementById('editImageInput');
            const imagePreview = document.getElementById('mainImagePreview');
            const placeholder = document.getElementById('imagePlaceholder');

            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Masukkan hasil preview ke src gambar
                            imagePreview.src = e.target.result;

                            // Munculkan elemen gambar jika sebelumnya tersembunyi (kasus: No Image)
                            imagePreview.classList.remove('hidden');

                            // Sembunyikan placeholder tulisan "No Image" jika ada
                            if (placeholder) {
                                placeholder.classList.add('hidden');
                            }

                            // Efek transisi halus
                            imagePreview.style.opacity = '0';
                            setTimeout(() => {
                                imagePreview.style.opacity = '1';
                            }, 50);
                        }

                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
</x-admin-layout>
