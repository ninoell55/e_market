<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-6 lg:px-12 min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white antialiased">

        {{-- Section 01: Header --}}
        <header class="px-6 py-20 border-b border-gray-100 dark:border-white/5">
            <div class="flex flex-col items-center">
                <h1 class="text-5xl font-black uppercase tracking-tighter italic text-center">
                    Member_Archive<span class="text-rose-600">.</span>
                </h1>
                <p class="mt-2 text-2xs uppercase tracking-[0.5em] opacity-40">Personal Dashboard / 2026</p>
            </div>
        </header>

        {{-- Section 02: Navigation (Real Links) --}}
        <nav
            class="sticky top-0 z-10 bg-white/80 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-gray-100 dark:border-white/5">
            <div class="flex justify-center">
                <a href="{{ route('member.archive.addresses') }}"
                    class="px-10 py-6 text-2xs font-black uppercase tracking-[0.4em] border-b-2 transition-all duration-300 {{ request()->routeIs('member.archive.addresses') ? 'border-black dark:border-white opacity-100' : 'border-transparent opacity-30 hover:opacity-100' }}">
                    Addresses
                </a>
                <a href="{{ route('member.archive.orders') }}"
                    class="px-10 py-6 text-2xs font-black uppercase tracking-[0.4em] border-b-2 transition-all duration-300 {{ request()->routeIs('member.archive.orders') ? 'border-black dark:border-white opacity-100' : 'border-transparent opacity-30 hover:opacity-100' }}">
                    Orders
                </a>
            </div>
        </nav>

        <main class="mx-auto px-2 py-12">
            {{-- Bagian Alamat --}}
            <div class="flex justify-between items-end mb-12 border-l-4 border-rose-600 pl-4">
                <div>
                    <h2 class="text-2xl font-black uppercase italic">Saved_Locations</h2>
                    <p class="text-2xs opacity-50 uppercase tracking-widest">Manage your shipping destinations</p>
                </div>
                <a href="{{ route('member.archive.create_address') }}"
                    class="text-2xs font-black uppercase tracking-widest border border-black dark:border-white px-8 py-4 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                    + New Address
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @forelse($addresses as $address)
                    <div
                        class="group relative border border-gray-100 dark:border-white/5 p-8 flex flex-col min-h-87.5 justify-between hover:bg-gray-50 dark:hover:bg-white/2 transition-all duration-500">
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <span
                                    class="text-[9px] font-black uppercase tracking-[0.2em] px-2 py-1 bg-gray-100 dark:bg-white/5 italic">
                                    {{ $address->label }}
                                </span>
                                @if ($address->is_default)
                                    <span class="flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-pulse"></span>
                                        <span
                                            class="text-[9px] font-black uppercase text-rose-600 tracking-tighter">Primary_Unit</span>
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-2">
                                <h3
                                    class="text-2xl font-black uppercase tracking-tight italic group-hover:text-rose-600 transition-colors truncate">
                                    {{ $address->recipient_name }}
                                </h3>
                                {{-- Address dengan Line Clamp untuk Alamat Panjang --}}
                                <p
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 leading-relaxed line-clamp-3 wrap-break-word">
                                    {{ $address->address }}, {{ $address->city }}, {{ $address->province }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-white/5">
                            <div class="mb-6">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.3em] mb-1">
                                    Contact_Line</p>
                                <p class="text-sm font-mono font-bold">{{ $address->recipient_phone }}</p>
                            </div>

                            <div
                                class="grid grid-cols-3 gap-px bg-gray-100 dark:bg-white/10 pt-px border border-gray-100 dark:border-white/5">
                                <a href="{{ route('member.archive.edit_address', $address) }}"
                                    class="bg-white dark:bg-[#0a0a0a] py-3 text-[9px] font-black uppercase text-center hover:text-rose-600">
                                    Edit
                                </a>
                                @if (!$address->is_default)
                                    <form action="{{ route('member.archive.set_default', $address) }}" method="POST"
                                        class="bg-white dark:bg-[#0a0a0a]">
                                        @csrf @method('PATCH')
                                        <button type="button"
                                            class="confirm-delete-btn w-full py-3 text-[9px] font-black uppercase text-center hover:text-rose-600 cursor-pointer"
                                            data-confirm-title="Set as Default?"
                                            data-confirm-text="This address will be set as your primary shipping address."
                                            data-confirm-button="YES, SET IT">
                                            Set
                                        </button>
                                    </form>
                                    <form action="{{ route('member.archive.delete_address', $address) }}"
                                        method="POST" class="bg-white dark:bg-[#0a0a0a]">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            class="confirm-delete-btn w-full py-3 text-[9px] font-black uppercase text-center text-rose-600/50 hover:text-rose-600 cursor-pointer"
                                            data-confirm-title="Delete Address?"
                                            data-confirm-text="This action cannot be undone."
                                            data-confirm-button="YES, DELETE IT">
                                            Del
                                        </button>
                                    </form>
                                @else
                                    <div
                                        class="col-span-2 bg-white dark:bg-[#0a0a0a] py-3 text-[8px] font-black uppercase text-right pr-4 text-gray-300 italic select-none">
                                        // Active_Unit
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <x-empty-state title="Empty_Archive" message="No address data sequences found." />
                @endforelse
            </div>
        </main>
    </div>
</x-member-layout>
