<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen bg-white dark:bg-black text-black dark:text-white antialiased selection:bg-rose-600">

        {{-- Floating Header & Navigation --}}
        <div class="px-6 lg:px-12 pt-16 pb-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="relative">
                    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                        List <span class="text-gray-300 text-2xl md:text-4xl">of Orders</span>
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

        <main class="px-6 lg:px-12 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                @forelse($orders as $order)
                    @php
                        $statusTheme =
                            [
                                'pending' => 'border-amber-500/20 text-amber-600',
                                'paid' => 'border-blue-500/20 text-blue-600',
                                'shipped' => 'border-purple-500/20 text-purple-600',
                                'completed' => 'border-emerald-500/20 text-emerald-600',
                                'cancelled' => 'border-rose-600/20 text-rose-600 opacity-50',
                            ][$order->status] ?? 'border-black/10';

                        // Ambil nama produk pertama dan hitung sisa produk lainnya
                        $firstItem = $order->items->first();
                        $otherItemsCount = $order->items->count() - 1;
                        $totalQuantity = $order->items->sum('quantity');
                    @endphp

                    <a href="{{ route('member.archive.show_order', $order->id) }}"
                        class="group relative bg-white dark:bg-[#0a0a0a] p-10 border border-black/5 dark:border-white/5 overflow-hidden transition-all duration-500 hover:z-10 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] dark:hover:shadow-[0_30px_60px_-15px_rgba(255,255,255,0.05)]">

                        {{-- Background Decor --}}
                        <span
                            class="absolute top-10 right-10 text-8xl font-black italic opacity-[0.03] group-hover:opacity-[0.07] transition-opacity select-none">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div class="relative z-10 space-y-10">
                            {{-- Top: Status & Date --}}
                            <div class="flex justify-between items-start">
                                <div
                                    class="px-3 py-1 border {{ $statusTheme }} text-[9px] font-black uppercase tracking-widest">
                                    {{ $order->status }}
                                </div>
                                <span
                                    class="text-2xs font-mono opacity-30">{{ $order->created_at->format('M.d.Y') }}</span>
                            </div>

                            {{-- Mid: Order ID & Items Preview --}}
                            <div class="space-y-4">
                                <div>
                                    <p
                                        class="text-2xs font-black uppercase tracking-[0.3em] opacity-30 mb-2 group-hover:text-rose-600 group-hover:opacity-100 transition-all">
                                        ORDER NUMBER
                                    </p>
                                    <h2
                                        class="text-4xl font-black tracking-tighter italic uppercase group-hover:scale-[1.02] origin-left transition-transform duration-500">
                                        #{{ $order->order_number }}
                                    </h2>
                                </div>

                                {{-- Product Preview --}}
                                <div class="flex items-center gap-3">
                                    <p class="text-[11px] font-bold uppercase tracking-wider opacity-60">
                                        @if ($firstItem)
                                            {{ $firstItem->product_name ?? 'Unknown Product' }}
                                            @if ($otherItemsCount > 0)
                                                <span class="text-rose-600"> +{{ $otherItemsCount }} More Items</span>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Bottom: Info --}}
                            <div
                                class="pt-8 border-t border-black/5 dark:border-white/5 flex justify-between items-end">
                                <div class="flex gap-10">
                                    {{-- Total Quantity --}}
                                    <div class="pr-10 border-r border-black/5 dark:border-white/5">
                                        <p class="text-[9px] font-black uppercase opacity-30 mb-1">Quantity</p>
                                        <p class="text-xl font-black tracking-tighter">{{ $totalQuantity }} <span
                                                class="text-2xs opacity-40 italic">PCS</span></p>
                                    </div>

                                    {{-- Total Payable --}}
                                    <div>
                                        <p class="text-[9px] font-black uppercase opacity-30 mb-1">Total Payable</p>
                                        <p class="text-xl font-black tracking-tighter">IDR
                                            {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div
                                    class="w-12 h-12 bg-black dark:bg-white flex items-center justify-center group-hover:bg-rose-600 transition-colors duration-500">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-white dark:text-black group-hover:text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <x-empty-state title="No Orders Found" message="You haven't placed any orders yet."
                            buttonText="Refresh" />
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($orders->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="w-full p-2 bg-white dark:bg-[#0a0a0a] border border-black/5 dark:border-white/5">
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </main>
    </div>
</x-member-layout>
