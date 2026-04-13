<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 px-4 sm:px-0">
            <div>
                <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">
                    User Management
                </h3>
                <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-2">
                    System access control and user authority levels
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                {{-- Search Form --}}
                <form action="{{ route('admin.user.index') }}" method="GET" class="relative w-full sm:w-72 group">
                    @if (request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                    @endif

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        class="w-full bg-white dark:bg-gray-950 border-gray-100 dark:border-gray-900 focus:ring-rose-500 focus:border-rose-500 rounded-2xl text-2xs font-bold uppercase tracking-widest pl-12 pr-4 py-4 transition-all shadow-sm">

                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="hidden"></button>
                </form>

                <a href="{{ route('admin.user.create') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gray-900 dark:bg-rose-600 text-white text-2xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-500 transition-all duration-300 shadow-xl shadow-gray-200 dark:shadow-none active:scale-95">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New User
                </a>
            </div>
        </div>

        {{-- Role Filter Tabs --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-2 px-4 sm:px-0 no-scrollbar">
            <a href="{{ route('admin.user.index') }}"
                class="px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest border {{ !request('role') ? 'bg-gray-900 dark:bg-rose-600 text-white shadow-lg' : 'border-gray-100 dark:border-gray-900 bg-white dark:bg-gray-950 text-gray-400 hover:text-rose-600' }} whitespace-nowrap transition-all">
                All Roles
            </a>

            @foreach ($roles as $role)
                <a href="{{ route('admin.user.index', ['role' => $role]) }}"
                    class="px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest border {{ request('role') == $role ? 'bg-gray-900 dark:bg-rose-600 text-white shadow-lg' : 'border-gray-100 dark:border-gray-900 bg-white dark:bg-gray-950 text-gray-400 hover:text-rose-600' }} whitespace-nowrap transition-all">
                    {{ $role }}
                </a>
            @endforeach
        </div>

        {{-- Table Card --}}
        <div
            class="bg-white dark:bg-gray-950 rounded-3xs md:rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left min-w-150 md:min-w-full">
                    <thead>
                        <tr class="border-b border-gray-50 dark:border-gray-900 bg-gray-50/30 dark:bg-gray-900/30">
                            <th
                                class="px-6 md:px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em] w-16">
                                #</th>
                            <th class="px-6 md:px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                User Identity</th>
                            {{-- Email disembunyikan di mobile sangat kecil, muncul di tablet --}}
                            <th
                                class="hidden sm:table-cell px-6 md:px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Email Address</th>
                            <th class="px-6 md:px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Privilege</th>
                            <th
                                class="px-6 md:px-8 py-6 text-right text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-900">
                        @forelse ($users as $user)
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-rose-950/5 transition-all duration-300">
                                <td class="px-6 md:px-8 py-6">
                                    <span
                                        class="text-xs font-bold text-gray-400 group-hover:text-rose-600 transition-colors">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-6 md:px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-black text-gray-900 dark:text-white tracking-tight group-hover:text-rose-600 transition-colors uppercase leading-none">
                                            {{ $user->name }}
                                        </span>
                                        {{-- Tampilkan email di bawah nama khusus untuk tampilan mobile --}}
                                        <span
                                            class="sm:hidden text-2xs text-gray-400 mt-1 font-medium lowercase">{{ $user->email }}</span>
                                        <span
                                            class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter mt-1">
                                            UID: #{{ $user->id }} <span class="hidden md:inline">• Joined
                                                {{ $user->created_at->format('d/m/Y') }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell px-6 md:px-8 py-6">
                                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </span>
                                </td>
                                <td class="px-6 md:px-8 py-6">
                                    @php
                                        $roleColor =
                                            [
                                                'courier' =>
                                                    'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20',
                                                'admin' =>
                                                    'bg-yellow-50 text-yellow-600 border-yellow-100 dark:bg-yellow-500/10 dark:text-yellow-400 dark:border-yellow-500/20',
                                                'member' =>
                                                    'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20',
                                            ][$user->role] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                                    @endphp
                                    <span
                                        class="px-2.5 py-1 text-[8px] md:text-[9px] font-black uppercase tracking-widest rounded-lg border {{ $roleColor }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 md:px-8 py-6 text-right">
                                    <div class="flex justify-end items-center gap-1 md:gap-2">
                                        <a href="{{ route('admin.user.edit', $user) }}"
                                            class="p-2 text-gray-400 hover:text-blue-600 transition-all" title="Edit">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button type="button" data-confirm-title="Are you sure?"
                                                data-confirm-text="Deleting this user will revoke all their access."
                                                data-confirm-button="DELETE USER"
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
                                <div class="col-span-full">
                                    <x-empty-state title="No User Found"
                                        message="No users match the search criteria or role filter."
                                        buttonText="Refresh" />
                                </div>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
