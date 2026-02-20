<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-950 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">

                <div class="p-8 sm:p-12">
                    <div class="mb-10">
                        <h3 class="text-xl font-black text-gray-900 dark:text-white tracking-tighter flex items-center">
                            <span class="w-8 h-1 bg-rose-600 mr-4 rounded-full"></span>
                            Update Product
                        </h3>
                        <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-2 ml-12">Modifying:
                            {{ $product->name }}</p>
                    </div>

                    <form action="{{ route('admin.product.update', $product) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label for="name"
                                    class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Product
                                    Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $product->name ?? '') }}" placeholder="Insert Product Name"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold placeholder:text-gray-300 dark:placeholder:text-gray-700">
                            </div>

                            <div class="group">
                                <label for="category_id"
                                    class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Category</label>
                                <select name="category_id" id="category_id"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold appearance-none cursor-pointer">
                                    <option disabled>-- Select Category Name --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label for="price"
                                    class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Price</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-2xs font-black text-gray-400">RP</span>
                                    <input type="number" id="price" name="price"
                                        value="{{ old('price', $product->price ?? '') }}" placeholder="0"
                                        class="w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">
                                </div>
                            </div>

                            <div class="group">
                                <label for="stock"
                                    class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Stock
                                    Quantity</label>
                                <input type="number" id="stock" name="stock"
                                    value="{{ old('stock', $product->stock ?? '') }}" placeholder="0"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold">
                            </div>
                        </div>

                        <div class="group">
                            <label for="description"
                                class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Description</label>
                            <textarea name="description" id="description" rows="4" placeholder="Describe the product details..."
                                class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-3xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-bold placeholder:text-gray-300 dark:placeholder:text-gray-700">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-1">
                                <label
                                    class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Current
                                    Image</label>
                                <div
                                    class="relative group/img overflow-hidden rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-2">
                                    @if (isset($product->image))
                                        <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                            alt="{{ $product->image }}"
                                            class="w-full h-32 object-cover rounded-xl shadow-sm">
                                    @else
                                        <div
                                            class="w-full h-32 flex items-center justify-center text-2xs font-bold text-gray-300 uppercase italic">
                                            No Image</div>
                                    @endif
                                </div>
                            </div>

                            <div class="md:col-span-2 group">
                                <label
                                    class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-rose-600 transition-colors">Replace
                                    Image</label>
                                <div
                                    class="relative w-full h-32 bg-gray-50 dark:bg-gray-900 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-800 hover:border-rose-500/50 transition-colors flex items-center justify-center">
                                    <input type="file" id="image" name="image"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <div class="flex flex-col items-center text-gray-400">
                                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-[9px] font-black uppercase tracking-widest">Upload New
                                            File</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit" onclick="this.disabled=true; this.form.submit();"
                                class="flex-2 px-8 py-4 bg-gray-900 dark:bg-rose-600 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-500 transition-all duration-300 shadow-xl shadow-rose-200/20 dark:shadow-none active:scale-95">
                                Update Product
                            </button>
                            <a href="{{ route('admin.product.index') }}"
                                class="flex-1 px-8 py-4 bg-gray-100 dark:bg-gray-900 text-gray-500 text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-gray-200 dark:hover:bg-gray-800 transition-all text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
