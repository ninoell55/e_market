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

        {{-- Section 02: Navigation --}}
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
                <p class="text-2xs opacity-50 uppercase tracking-widest">A complete record of your previous orders</p>
            </div>

            <div class="border border-gray-100 dark:border-white/5 bg-white dark:bg-[#0a0a0a]">
                @forelse($orders as $order)
                    <div
                        class="group flex flex-col md:flex-row items-start md:items-center justify-between p-8 border-b border-gray-100 dark:border-white/5 last:border-0 hover:bg-gray-50 dark:hover:bg-white/2 transition-all">

                        {{-- Left Side: ID & Date --}}
                        <div class="flex items-center gap-12 w-full md:w-auto">
                            <div class="flex flex-col min-w-30">
                                <span
                                    class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Ref_No</span>
                                <span
                                    class="text-xl font-black italic group-hover:text-rose-600 transition-all duration-300 tracking-tighter">
                                    #{{ $order->order_number }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Timestamp</span>
                                <span class="text-xs font-bold uppercase tracking-tight opacity-70">
                                    {{ $order->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Middle: Status Badge (Enhanced) --}}
                        <div class="mt-4 md:mt-0 flex flex-col">
                            <span
                                class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em] mb-1">Process_Status</span>

                            @php
                                $statusStyles = [
                                    'pending' => 'border-amber-500 text-amber-500',
                                    'paid' => 'border-blue-500 text-blue-500',
                                    'shipped' => 'border-purple-500 text-purple-500',
                                    'completed' => 'border-emerald-500 text-emerald-500',
                                    'cancelled' => 'border-rose-600 text-rose-600 opacity-50',
                                ];
                                $currentStyle = $statusStyles[$order->status] ?? 'border-black dark:border-white';
                            @endphp

                            <div class="flex items-center gap-2">
                                <span
                                    class="text-2xs font-black uppercase px-3 py-1 border {{ $currentStyle }} w-fit italic tracking-widest">
                                    {{ $order->status }}
                                </span>

                                {{-- Penanda jika masih bisa dicancel (Under 10 mins) --}}
                                @if ($order->status === 'pending' && $order->created_at->diffInMinutes(now()) < 10)
                                    <span class="w-2 h-2 bg-rose-600 animate-ping rounded-full"
                                        title="Cancelable"></span>
                                @endif
                            </div>
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
                                class="inline-block text-2xs font-black border border-black dark:border-white px-8 py-4 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all uppercase tracking-widest italic">
                                VIEW_DETAILS
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="py-24 text-center">
                        <span class="text-xs font-black opacity-20 uppercase tracking-[1em]">Empty_Archive</span>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</x-member-layout>
