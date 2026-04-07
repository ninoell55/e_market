<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">
        {{-- Header Section: Stack on mobile, Row on desktop --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-6 mb-8">
            <div>
                <h3 class="text-3xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tighter">
                    Category List</h3>
                <p class="text-2xs md:text-2xs font-bold text-gray-400 uppercase tracking-widest mt-2">
                    Organize your products by style and type
                </p>
            </div>
            <a href="{{ route('admin.category.create') }}"
                class="w-full md:w-auto justify-center px-6 py-4 md:py-3 bg-gray-900 dark:bg-rose-600 text-white text-2xs font-black uppercase tracking-[0.2em] rounded-xl md:rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-500 transition-all duration-300 shadow-lg active:scale-95 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Add New Category
            </a>
        </div>

        {{-- Table Container with Horizontal Scroll for safety --}}
        <div
            class="bg-white dark:bg-gray-950 rounded-3xl md:rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-125 md:min-w-full">
                    <thead>
                        <tr class="border-b border-gray-50 dark:border-gray-900 bg-gray-50/20">
                            <th
                                class="px-6 md:px-8 py-5 md:py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em] w-16">
                                #</th>
                            <th
                                class="px-6 md:px-8 py-5 md:py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Category Name</th>
                            <th
                                class="px-6 md:px-8 py-5 md:py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em] text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-900">
                        @forelse ($categories as $category)
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                                <td class="px-6 md:px-8 py-5 md:py-6">
                                    <span
                                        class="text-xs font-bold text-gray-400 group-hover:text-rose-600 transition-colors">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-6 md:px-8 py-5 md:py-6">
                                    <span
                                        class="text-sm font-black text-gray-900 dark:text-white tracking-tight uppercase group-hover:pl-2 transition-all duration-300">
                                        {{ $category->category_name }}
                                    </span>
                                </td>
                                <td class="px-6 md:px-8 py-5 md:py-6 text-right">
                                    <div class="flex justify-end gap-2 md:gap-1">
                                        <a href="{{ route('admin.category.edit', $category) }}"
                                            class="p-2 text-gray-400 hover:text-blue-600 transition-all" title="Edit">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.category.destroy', $category) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button type="button" data-confirm-title="Are you sure?"
                                                data-confirm-text="Deleting this category might affect products under it."
                                                data-confirm-button="YES, DELETE"
                                                class="confirm-delete-btn p-2 text-gray-400 hover:text-rose-600 transition-all"
                                                title="Delete">
                                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
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
                                        <p class="text-2xs font-black text-gray-400 uppercase tracking-widest italic">
                                            Empty Category</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer Summary --}}
        <div class="mt-6 px-4 flex justify-between items-center">
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                Total: {{ $categories->count() }} Units
            </p>
        </div>
    </div>
</x-admin-layout>
