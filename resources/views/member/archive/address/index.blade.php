<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="bg-white dark:bg-black text-black dark:text-white antialiased selection:bg-rose-600 pb-35">

        {{-- Section 01: Floating Header & Navigation --}}
        <div class="px-6 lg:px-12 pt-16 pb-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="relative">
                    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                        List <span class="text-gray-300 text-2xl md:text-4xl">of Shipping Destinations</span>
                    </h1>
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('member.archive.addresses') }}"
                        class="px-8 py-4 text-[11px] font-black uppercase tracking-widest border-2 {{ request()->routeIs('member.archive.addresses') ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white' : 'border-black/10 dark:border-white/10 hover:border-black dark:hover:border-white opacity-40' }} transition-all">
                        Addresses
                    </a>
                    <a href="{{ route('member.archive.orders') }}"
                        class="px-8 py-4 text-[11px] font-black uppercase tracking-widest border-2 {{ request()->routeIs('member.archive.orders') ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white' : 'border-black/10 dark:border-white/10 hover:border-black dark:hover:border-white opacity-40' }} transition-all">
                        Orders
                    </a>
                </div>
            </div>
        </div>

        <main class="px-6 lg:px-12">
            {{-- Action Bar --}}
            <div
                class="flex justify-between items-center border-b border-black/5 dark:border-white/5 bg-white dark:bg-[#0a0a0a]">
                <div class="flex items-center gap-4">
                    <div class="w-1 h-8 bg-rose-600"></div> {{-- Accent Line --}}
                    <p class="text-2xs font-black uppercase tracking-[0.3em] opacity-40 italic">Shipping Addresses
                    </p>
                </div>

                <a href="{{ route('member.archive.create_address') }}"
                    class="group flex items-center gap-3 bg-rose-600 text-white px-10 lg:px-21 py-3 text-2xs font-black uppercase tracking-widest hover:bg-black dark:hover:bg-white dark:hover:text-black transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Add Address</span>
                </a>
            </div>
            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                @forelse($addresses as $address)
                    {{-- Pastikan container grid menggunakan items-stretch --}}
                    <div
                        class="group relative bg-white dark:bg-[#0a0a0a] p-10 border border-black/5 dark:border-white/5 overflow-hidden transition-all duration-500 hover:z-10 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] dark:hover:shadow-[0_30px_60px_-15px_rgba(255,255,255,0.05)] flex flex-col h-full">

                        {{-- Background Decor Number --}}
                        <span
                            class="absolute top-15 right-10 text-8xl font-black italic opacity-[0.03] group-hover:opacity-[0.07] transition-opacity select-none">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div class="relative z-10 flex flex-col grow justify-between space-y-10">
                            {{-- Section Top: Header & Content --}}
                            <div class="space-y-10">
                                {{-- Header Card --}}
                                <div class="flex justify-between items-start">
                                    <span
                                        class="px-3 py-1 border border-black/10 dark:border-white/10 text-[9px] font-black uppercase tracking-widest opacity-60">
                                        {{ $address->label }}
                                    </span>
                                    @if ($address->is_default)
                                        <div class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-pulse"></span>
                                            <span
                                                class="text-[9px] font-black uppercase text-rose-600 tracking-widest">Default</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-2xs font-black uppercase tracking-[0.3em] opacity-30 mb-1">
                                            Recipient</p>
                                        <h2
                                            class="text-3xl font-black tracking-tighter italic uppercase line-clamp-1 group-hover:text-rose-600 transition-colors">
                                            {{ $address->recipient_name }}
                                        </h2>
                                    </div>
                                    <div class="max-w-70">
                                        <p class="text-2xs font-black uppercase tracking-[0.3em] opacity-30 mb-1">
                                            Location</p>
                                        {{-- line-clamp-2 menjaga alamat maksimal 2 baris agar tinggi kartu tetap konsisten --}}
                                        <p
                                            class="text-xs font-bold leading-relaxed opacity-60 line-clamp-2 uppercase min-h-8">
                                            {{ $address->address }}, {{ $address->city }}, {{ $address->province }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Section Bottom: Contacts & Actions (Akan selalu di bawah kartu) --}}
                            <div class="pt-8 border-t border-black/5 dark:border-white/5">
                                <div class="flex justify-between items-end">
                                    <p class="text-[9px] font-black uppercase opacity-30 mb-1">Contact Number</p>
                                    <p class="text-lg font-black tracking-tighter italic font-mono">
                                        {{ $address->recipient_phone }}
                                    </p>
                                </div>

                                {{-- Brutalist Button Group --}}
                                <div
                                    class="grid grid-cols-3 gap-px bg-black/5 dark:bg-white/5 mt-8 border border-black/5 dark:border-white/5">
                                    <a href="{{ route('member.archive.edit_address', $address) }}"
                                        class="bg-white dark:bg-[#0a0a0a] py-4 text-[9px] font-black uppercase text-center hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                                        Edit
                                    </a>

                                    @if (!$address->is_default)
                                        <form action="{{ route('member.archive.set_default', $address) }}"
                                            method="POST" class="bg-white dark:bg-[#0a0a0a]">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="w-full h-full py-4 text-[9px] font-black uppercase text-center hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all cursor-pointer">
                                                Set Default
                                            </button>
                                        </form>
                                        <form action="{{ route('member.archive.delete_address', $address) }}"
                                            method="POST" class="bg-white dark:bg-[#0a0a0a]">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="confirm-delete-btn w-full h-full py-4 text-[9px] font-black uppercase text-center text-rose-600 hover:bg-rose-600 hover:text-white transition-all cursor-pointer"
                                                data-confirm-title="Confirm Deletion?" data-confirm-text="Are you sure you want to delete this address? This action cannot be undone."
                                                data-confirm-button="Delete">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <div
                                            class="col-span-2 bg-black/2 dark:bg-white/2 py-4 text-[9px] font-black uppercase text-center opacity-20 italic select-none flex items-center justify-center">
                                            Default Address
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <x-empty-state title="No Shipping Addresses Found"
                            message="You haven't added any shipping addresses yet." buttonText="Refresh" />
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($addresses->hasPages())
                <div class="flex justify-center">
                    <div class="w-full p-2 bg-white dark:bg-[#0a0a0a] border border-black/5 dark:border-white/5">
                        {{ $addresses->links() }}
                    </div>
                </div>
            @endif
        </main>
    </div>
</x-member-layout>
