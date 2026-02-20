<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-950 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">
                <div class="p-10 sm:p-14">

                    <div class="mb-10 text-center relative">
                        <div
                            class="absolute -top-4 left-1/2 -translate-x-1/2 opacity-[0.03] text-7xl font-black uppercase tracking-tighter select-none">
                            Edit
                        </div>
                        <h3 class="relative text-3xl font-black text-gray-900 dark:text-white tracking-tighter">Modify
                            Category</h3>
                        <p class="text-2xs font-bold text-gray-400 uppercase tracking-[0.2em] mt-2">Adjusting
                            classification for ID: #CAT-{{ $category->id }}</p>
                    </div>

                    <form action="{{ route('admin.category.update', $category) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <label for="category_name"
                                class="block text-2xs font-black text-gray-400 uppercase tracking-[0.2em] ml-1">
                                Category Name
                            </label>
                            <input type="text" id="category_name" name="category_name"
                                value="{{ old('category_name', $category->category_name ?? '') }}"
                                placeholder="Update Category Name"
                                class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-rose-600 dark:text-white placeholder-gray-300 dark:placeholder-gray-700 transition-all duration-300 font-bold tracking-tight shadow-inner"
                                required>
                            @error('category_name')
                                <p class="text-2xs font-bold text-rose-600 uppercase tracking-widest ml-1">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit" onclick="this.disabled=true; this.form.submit();"
                                class="flex-1 px-8 py-4 bg-gray-900 dark:bg-rose-600 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-500 transition-all duration-300 shadow-xl shadow-gray-200 dark:shadow-none active:scale-95">
                                Update Category
                            </button>

                            <a href="{{ route('admin.category.index') }}"
                                class="flex-1 px-8 py-4 bg-gray-100 dark:bg-gray-900 text-gray-500 text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-gray-200 dark:hover:bg-gray-800 transition-all duration-300 text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div
                class="mt-8 px-10 py-6 bg-amber-50/50 dark:bg-amber-950/5 rounded-4xl border border-amber-100/50 dark:border-amber-900/20 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="mt-1 text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-2xs font-black text-gray-900 dark:text-white uppercase tracking-widest">
                            Impact Notice</h4>
                        <p class="text-[11px] font-medium text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">
                            Changing this category name will immediately update all associated products in your
                            inventory. Ensure this change reflects your current collection strategy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
