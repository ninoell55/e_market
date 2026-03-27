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
            {{-- Header Section --}}
            <div class="mb-12 border-l-4 border-rose-600 pl-4">
                <h2 class="text-2xl font-black uppercase italic">Transaction_History</h2>
                <p class="text-2xs opacity-50 uppercase tracking-widest">A complete record of your previous orders
                </p>
            </div>

            <div class="border border-gray-100 dark:border-white/5 bg-white dark:bg-[#0a0a0a]">
                @forelse($orders as $order)
                    <div
                        class="group flex flex-col md:flex-row items-start md:items-center justify-between p-8 border-b border-gray-100 dark:border-white/5 last:border-0 hover:bg-gray-50 dark:hover:bg-white/1 transition-all">

                        {{-- Left Side: ID & Date --}}
                        <div class="flex items-center gap-12 w-full md:w-auto">
                            <div class="flex flex-col min-w-30">
                                <span
                                    class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Ref_No</span>
                                <span
                                    class="text-xl font-black italic group-hover:text-rose-600 transition-all duration-300">
                                    #{{ $order->id }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Timestamp</span>
                                <span class="text-xs font-bold uppercase tracking-tight">
                                    {{ $order->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Middle: Status & Items (Optional) --}}
                        <div class="hidden lg:flex flex-col">
                            <span
                                class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Process_Status</span>
                            <span
                                class="text-2xs font-black uppercase px-2 py-0.5 border border-black dark:border-white w-fit">
                                {{ $order->status ?? 'Completed' }}
                            </span>
                        </div>

                        {{-- Right Side: Amount & Action --}}
                        <div
                            class="flex items-center justify-between md:justify-end gap-12 mt-6 md:mt-0 w-full md:w-auto pt-6 md:pt-0 border-t md:border-t-0 border-gray-100 dark:border-white/5">
                            <div class="text-left md:text-right">
                                <span
                                    class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Total_Amount</span>
                                <p class="text-2xl font-black italic tracking-tighter">
                                    IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>

                            <a href="{{ route('member.archive.show_order', $order->id) }}"
                                class="inline-block text-2xs font-black border border-black dark:border-white px-8 py-4 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                                VIEW_DETAILS
                            </a>
                        </div>
                    </div>
                @empty
                    <x-empty-state title="No_Transactions" message="Order history is currently empty." />
                @endforelse
            </div>
        </main>
    </div>
</x-member-layout>
