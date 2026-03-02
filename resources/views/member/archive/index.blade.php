<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div x-data="{ tab: 'addresses' }"
        class="px-6 lg:px-12 min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white antialiased">

        {{-- Section 01: Centered Header --}}
        <header class="px-6 py-16 border-b border-gray-100 dark:border-white/5">
            <div class="flex justify-center items-center">
                <h1 class="text-4xl font-black uppercase tracking-tighter italic text-center">
                    Member_Archive<span class="text-rose-600">.</span>
                </h1>
            </div>
        </header>

        {{-- Section 02: Navigation (Centered Tabs) --}}
        <nav class="border-b border-gray-100 dark:border-white/5">
            <div class="flex justify-center">
                <button @click="tab = 'addresses'"
                    :class="tab === 'addresses' ? 'border-black dark:border-white opacity-100' : 'border-transparent opacity-30'"
                    class="px-10 py-6 text-2xs font-black uppercase tracking-[0.4em] border-b-2 transition-all">
                    Addresses
                </button>
                <button @click="tab = 'orders'"
                    :class="tab === 'orders' ? 'border-black dark:border-white opacity-100' : 'border-transparent opacity-30'"
                    class="px-10 py-6 text-2xs font-black uppercase tracking-[0.4em] border-b-2 transition-all">
                    Orders
                </button>
            </div>
        </nav>

        <main class="mx-auto px-6 py-10">

            {{-- Tab: Address Book --}}
            <div x-show="tab === 'addresses'" x-transition>

                <div class="flex justify-end mb-8">
                    <a href="{{ route('member.archive.create_address') }}"
                        class="text-2xs font-black uppercase tracking-widest border border-black dark:border-white px-6 py-3 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                        + Add Address
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($addresses as $address)
                        <div
                            class="border border-gray-100 dark:border-white/5 p-6 flex flex-col justify-between hover:border-gray-300 dark:hover:border-white/20 transition-all">

                            <div class="space-y-4">
                                <div class="flex justify-between items-start">
                                    <span class="text-[8px] font-black uppercase tracking-[0.2em] text-gray-400 italic">
                                        [{{ $address->label }}]
                                    </span>
                                    @if ($address->is_default)
                                        <span class="text-[8px] font-black uppercase text-rose-600">Primary</span>
                                    @endif
                                </div>

                                <div class="space-y-1">
                                    <h3 class="text-xl font-black uppercase tracking-tight italic">
                                        {{ $address->recipient_name }}</h3>
                                    <p class="text-xs font-medium capitalize text-gray-500 leading-relaxed">
                                        {{ strtolower($address->province) }},
                                        {{ strtolower($address->city) }},
                                        {{ strtolower($address->address) }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <div class="mb-4">
                                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Phone
                                        Number</p>
                                    <p class="text-xs font-mono font-bold">{{ $address->recipient_phone }}</p>
                                </div>

                                <div
                                    class="grid grid-cols-3 gap-px bg-gray-100 dark:bg-white/10 pt-px border-t border-gray-100 dark:border-white/5">
                                    <a href="{{ route('member.archive.edit_address', $address) }}"
                                        class="bg-white dark:bg-[#0a0a0a] py-3 text-[9px] font-black uppercase text-center hover:text-rose-600">
                                        Edit
                                    </a>

                                    @if (!$address->is_default)
                                        <form action="{{ route('member.archive.set_default', $address) }}"
                                            method="POST">
                                            @csrf @method('PATCH')
                                            <button
                                                class="confirm-delete-btn cursor-pointer w-full bg-white dark:bg-[#0a0a0a] py-3 text-[9px] font-black uppercase text-center hover:text-rose-600"
                                                title="Set as Default" data-confirm-title="Are you sure?"
                                                data-confirm-text="This will set this address as your default shipping address."
                                                data-confirm-button="YES, SET AS DEFAULT">
                                                Default
                                            </button>
                                        </form>
                                        <form action="{{ route('member.archive.delete_address', $address) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button
                                                class="confirm-delete-btn cursor-pointer w-full bg-white dark:bg-[#0a0a0a] py-3 text-[9px] font-black uppercase text-center text-rose-600/50 hover:text-rose-600"
                                                title="Delete Address" data-confirm-title="Are you sure?"
                                                data-confirm-text="This action cannot be undone. Do you want to proceed?"
                                                data-confirm-button="YES, DELETE">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <div
                                            class="col-span-2 bg-white dark:bg-[#0a0a0a] py-3 text-[8px] font-black uppercase text-right pr-2 text-gray-300 italic">
                                            Active_Unit
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <x-empty-state title="No Addresses Found"
                                message="No addresses are available in your profile." buttonText="Refresh" />
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Tab: Order History --}}
            <div x-show="tab === 'orders'" style="display: none;" x-transition>
                <div class="border border-gray-100 dark:border-white/5 divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($orders as $order)
                        <div class="flex items-center justify-between p-8 hover:bg-gray-50 dark:hover:bg-white/1">
                            <div class="flex items-center gap-8">
                                <span class="text-lg font-black italic">#{{ $order->id }}</span>
                                <span
                                    class="text-2xs font-bold uppercase opacity-30">{{ $order->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-8">
                                <p class="text-xl font-black italic">IDR
                                    {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <a href="#"
                                    class="text-2xs font-black border border-black dark:border-white px-4 py-2 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">Details</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <x-empty-state title="No Orders Found" message="No orders are available in your profile."
                                buttonText="Refresh" />
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</x-member-layout>
