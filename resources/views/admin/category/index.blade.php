<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-end mb-8">
                <div>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">Category List</h3>
                    <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-2">Organize your products
                        by style and type</p>
                </div>
                <a href="{{ route('admin.category.create') }}"
                    class="px-6 py-3 bg-gray-900 dark:bg-rose-600 text-white text-2xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-500 transition-all duration-300 shadow-lg shadow-gray-200 dark:shadow-none active:scale-95 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Category
                </a>
            </div>

            <div
                class="bg-white dark:bg-gray-950 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-50 dark:border-gray-900">
                            <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">#</th>
                            <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Category Name</th>
                            <th
                                class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em] text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-900">
                        @forelse ($categories as $category)
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                                <td class="px-8 py-6">
                                    <span
                                        class="text-xs font-bold text-gray-400 group-hover:text-rose-600 transition-colors">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="text-sm font-black text-gray-900 dark:text-white tracking-tight uppercase">
                                        {{ $category->category_name }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-1 transition-opacity duration-300">
                                        <a href="{{ route('admin.category.edit', $category) }}"
                                            class="p-2.5 text-gray-400 hover:text-blue-600 hover:bg-white dark:hover:bg-gray-900 rounded-xl transition-all shadow-sm hover:shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.category.destroy', $category) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Delete this category? Products within it might be affected.')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2.5 text-gray-400 hover:text-rose-600 hover:bg-white dark:hover:bg-gray-900 rounded-xl transition-all shadow-sm hover:shadow-md">
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
                                <td colspan="3" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 8-8-8" />
                                            </svg>
                                        </div>
                                        <p class="text-2xs font-black text-gray-400 uppercase tracking-widest">No
                                            Categories Found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 px-4">
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                    Total Categories: {{ $categories->count() }}
                </p>
            </div>

        </div>
    </div>
</x-admin-layout>
