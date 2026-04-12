<x-admin-layout>
    <x-slot:title>Business Intelligence</x-slot:title>

    {{-- Container dibuat Full Width tanpa batasan mx-auto yang sempit --}}
    <div class="w-full p-4 lg:p-10 space-y-10">

        {{-- Header & Advanced Filters --}}
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
            <div class="space-y-2">
                <h3
                    class="text-6xl font-black text-gray-900 dark:text-white tracking-tighter uppercase italic">
                    Analytics
                </h3>
            </div>

            <div
                class="bg-white dark:bg-[#0A0A0B] p-4 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-2xl shadow-gray-200/50 dark:shadow-none flex flex-wrap items-center gap-4">
                <form action="{{ route('admin.report.index') }}" method="GET"
                    class="flex flex-wrap items-center gap-4">
                    <div
                        class="flex items-center gap-3 px-5 py-2.5 bg-gray-50 dark:bg-white/3 rounded-2xl border border-transparent focus-within:border-rose-500/50 transition-all">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Date</span>
                        <input type="date" name="date" value="{{ $filters['date'] }}"
                            class="bg-transparent border-none p-0 text-xs font-black dark:text-white focus:ring-0 uppercase cursor-pointer">
                    </div>

                    <div
                        class="flex items-center gap-3 px-5 py-2.5 bg-gray-50 dark:bg-white/3 rounded-2xl border border-transparent focus-within:border-rose-500/50 transition-all">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Month</span>
                        <select name="month"
                            class="bg-transparent border-none p-0 pr-8 text-xs font-black dark:text-white focus:ring-0 uppercase cursor-pointer">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $filters['month'] == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-gray-900 dark:bg-rose-600 text-white px-8 py-3 rounded-2xl text-2xs font-black uppercase tracking-[0.2em] hover:bg-rose-600 dark:hover:bg-rose-700 transition-all shadow-lg shadow-rose-500/20 active:scale-95">
                        Update Report
                    </button>
                </form>

                <div class="h-10 w-px bg-gray-100 dark:bg-white/10 hidden md:block"></div>

                <a href="{{ route('admin.report.pdf', request()->all()) }}"
                    class="group flex items-center gap-3 bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 px-8 py-3 rounded-2xl text-2xs font-black uppercase tracking-[0.2em] hover:bg-rose-600 hover:text-white transition-all">
                    <svg class="w-4 h-4 transition-transform group-hover:translate-y-0.5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>

        {{-- Metric Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Financial Summary Card --}}
            <div class="relative group">
                <div
                    class="absolute inset-0 bg-rose-600 rounded-[3rem] blur-3xl opacity-5 group-hover:opacity-10 transition-opacity">
                </div>
                <div
                    class="relative bg-gray-900 dark:bg-white p-10 rounded-[3.5rem] text-white dark:text-black overflow-hidden flex flex-col h-full shadow-2xl transition-transform duration-500 hover:scale-[1.01]">
                    <div class="relative z-10 space-y-8">
                        <div class="flex justify-between items-start">
                            <span class="text-2xs font-black text-rose-500 uppercase tracking-[0.4em]">Total Net
                                Revenue</span>
                            <div
                                class="p-4 bg-white/5 dark:bg-black/5 rounded-2xl border border-white/10 dark:border-black/5">
                                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-5xl font-black italic tracking-tighter">
                            <span class="text-xs font-bold text-gray-500 mr-2 italic non-italic uppercase">IDR</span>
                            {{ number_format($totalRevenue, 0, ',', '.') }}
                        </h2>
                        <div class="pt-8 border-t border-white/10 dark:border-black/5 flex justify-between items-end">
                            <div>
                                <p class="text-2xs font-black text-gray-500 uppercase tracking-widest mb-1">Processed
                                    Transactions</p>
                                <p class="text-3xl font-black italic tracking-tighter">{{ $totalOrders }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Best Seller --}}
            <div
                class="bg-white dark:bg-[#0A0A0B] p-10 rounded-[3.5rem] border border-gray-100 dark:border-white/5 shadow-sm flex flex-col h-full transition-all hover:shadow-xl hover:shadow-gray-200/50 dark:hover:shadow-none">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full shadow-lg shadow-emerald-500/50"></div>
                    <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.4em]">Top Performing
                        Products</span>
                </div>
                <div class="space-y-8 grow">
                    @foreach ($bestSellers as $product)
                        <div class="flex justify-between items-center group/item cursor-pointer">
                            <div class="flex flex-col">
                                <span
                                    class="text-sm font-black dark:text-white uppercase group-hover/item:text-rose-600 transition-colors tracking-tight">
                                    {{ $product->product_name }}
                                </span>
                                <span class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-1">
                                    {{ $product->total_qty }} Units Sold
                                </span>
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-sm font-black text-emerald-500 italic tabular-nums group-hover/item:scale-110 transition-transform block">
                                    +{{ number_format($product->total_sales, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Slow Moving --}}
            <div
                class="bg-white dark:bg-[#0A0A0B] p-10 rounded-[3.5rem] border border-gray-100 dark:border-white/5 shadow-sm flex flex-col h-full">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-3 h-3 bg-rose-400 rounded-full"></div>
                    <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.4em]">Inventory
                        Insights</span>
                </div>
                <div class="space-y-8 grow">
                    @forelse($slowMoving as $slow)
                        <div
                            class="flex justify-between items-center opacity-60 hover:opacity-100 transition-all group/slow">
                            <span
                                class="text-sm font-black dark:text-white uppercase tracking-tight group-hover/slow:text-gray-900">{{ $slow->name }}</span>
                            <div
                                class="px-3 py-1 bg-gray-50 dark:bg-white/5 rounded-xl border border-transparent group-hover/slow:border-rose-500/20">
                                <span
                                    class="text-[9px] font-black text-gray-400 group-hover/slow:text-rose-500 uppercase tracking-widest italic">Low
                                    Interest</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-center py-10 opacity-20">
                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <p class="text-2xs font-black uppercase tracking-[0.3em]">Inventory Optimized</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Audit Section --}}
        <div
            class="bg-white dark:bg-[#0A0A0B] rounded-[3.5rem] border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="p-10 border-b border-gray-50 dark:border-white/3 flex justify-between items-center">
                <div class="flex items-center gap-5">
                    <div class="p-4 bg-gray-900 dark:bg-rose-600 rounded-3xl shadow-xl shadow-rose-500/10">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <span
                            class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-[0.3em] italic">System
                            Audit Log</span>
                        <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-1">Detailed
                            Transaction History</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-2xs font-black text-gray-400 uppercase tracking-widest">Live Updates</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="text-2xs font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 dark:bg-white/1">
                            <th class="px-10 py-8">Timestamp</th>
                            <th class="px-10 py-8">Reference ID</th>
                            <th class="px-10 py-8 text-right">Settlement Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/3">
                        @foreach ($orders as $order)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-white/2 transition-all cursor-pointer"
                                onclick="window.location='{{ route('admin.checkout.show', $order->id) }}'">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="text-xs font-black text-gray-900 dark:text-white tracking-tighter">{{ $order->created_at->format('M d, Y') }}</span>
                                        <span class="w-1 h-1 bg-gray-300 dark:bg-gray-700 rounded-full"></span>
                                        <span
                                            class="text-xs font-bold text-gray-400 tabular-nums">{{ $order->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <span
                                        class="text-xs font-black dark:text-white group-hover:text-rose-600 transition-colors italic uppercase tracking-widest">
                                        #{{ $order->order_number }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <span
                                        class="text-sm font-black text-gray-900 dark:text-white italic tabular-nums group-hover:scale-105 transition-transform block">
                                        IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer Table Info --}}
            <div
                class="p-8 bg-gray-50 dark:bg-white/1 border-t border-gray-50 dark:border-white/3 text-center">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.5em]">End of Audit Log</p>
            </div>
        </div>
    </div>

    <style>
        /* Custom font outline effect for "Center" */
        .font-outline-2 {
            -webkit-text-stroke: 1px currentColor;
            color: transparent;
        }

        @media (min-width: 1024px) {
            .font-outline-2 {
                -webkit-text-stroke: 2px currentColor;
            }
        }
    </style>
</x-admin-layout>
