<x-admin-layout>
    <x-slot:title>Business_Intelligence</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Header & Advanced Filters --}}
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 px-4 sm:px-0">
            <div class="space-y-1">
                <h3 class="text-5xl font-black text-gray-900 dark:text-white tracking-tighter uppercase italic">
                    Analytics_<span class="text-rose-600">Center</span>
                </h3>
                <p class="text-2xs font-black text-gray-400 uppercase tracking-[0.4em] flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    Data-driven business overview
                </p>
            </div>

            <div
                class="bg-white dark:bg-gray-950 p-3 rounded-4xl border border-gray-100 dark:border-gray-900 shadow-xl shadow-gray-200/50 dark:shadow-none flex flex-wrap items-center gap-3">
                <form action="{{ route('admin.report.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <div
                        class="flex items-center gap-2 px-4 py-2 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-transparent focus-within:border-rose-500 transition-all">
                        <span class="text-[9px] font-black text-gray-400 uppercase">Date:</span>
                        <input type="date" name="date" value="{{ $filters['date'] }}"
                            class="bg-transparent border-none p-0 text-xs font-black dark:text-white focus:ring-0 uppercase">
                    </div>

                    <div
                        class="flex items-center gap-2 px-4 py-2 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-transparent focus-within:border-rose-500 transition-all">
                        <span class="text-[9px] font-black text-gray-400 uppercase">Month:</span>
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
                        class="bg-gray-900 dark:bg-rose-600 text-white px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest hover:bg-rose-600 dark:hover:bg-rose-700 transition-all shadow-lg shadow-rose-500/20 active:scale-95">
                        Filter
                    </button>
                </form>

                <div class="h-8 w-px bg-gray-100 dark:bg-gray-800 hidden md:block"></div>

                <a href="{{ route('admin.report.pdf', request()->all()) }}"
                    class="group flex items-center gap-2 bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all">
                    <svg class="w-3 h-3 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
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
                    class="absolute inset-0 bg-rose-600 rounded-[3rem] blur-2xl opacity-10 group-hover:opacity-20 transition-opacity">
                </div>
                <div
                    class="relative bg-gray-900 dark:bg-white p-10 rounded-[3rem] text-white dark:text-black overflow-hidden flex flex-col h-full shadow-2xl">
                    <div class="relative z-10 space-y-6">
                        <div class="flex justify-between items-start">
                            <span
                                class="text-2xs font-black text-rose-500 uppercase tracking-[0.3em]">Total_Net_Revenue</span>
                            <div class="p-3 bg-white/5 dark:bg-black/5 rounded-2xl">
                                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-4xl font-black italic tracking-tighter leading-none">
                            <span class="text-xs font-bold text-gray-500 mr-1 italic">IDR</span>
                            {{ number_format($totalRevenue, 0, ',', '.') }}
                        </h2>
                        <div
                            class="pt-8 border-t border-white/10 dark:border-black/5 flex justify-between items-center">
                            <div>
                                <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">
                                    Transactions</p>
                                <p class="text-2xl font-black italic tracking-tighter">{{ $totalOrders }}</p>
                            </div>
                            <div
                                class="text-right text-2xs font-bold text-emerald-400 uppercase bg-emerald-500/10 px-3 py-1 rounded-full">
                                ↑ Stable
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Best Seller --}}
            <div
                class="bg-white dark:bg-gray-950 p-10 rounded-[3rem] border border-gray-100 dark:border-gray-900 shadow-sm flex flex-col h-full">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.3em]">Top_Performing</span>
                </div>
                <div class="space-y-6 grow">
                    @foreach ($bestSellers as $product)
                        <div class="flex justify-between items-center group/item cursor-default">
                            <div class="flex flex-col">
                                <span
                                    class="text-xs font-black dark:text-white uppercase group-hover/item:text-rose-600 transition-colors tracking-tight">
                                    {{ $product->product_name }}
                                </span>
                                <span class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">
                                    {{ $product->total_qty }} Sold
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-black text-emerald-500 italic tabular-nums">
                                    +{{ number_format($product->total_sales, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Slow Moving --}}
            <div
                class="bg-white dark:bg-gray-950 p-10 rounded-[3rem] border border-gray-100 dark:border-gray-900 shadow-sm flex flex-col h-full">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-2 bg-rose-400 rounded-full"></div>
                    <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.3em]">Under_Performing</span>
                </div>
                <div class="space-y-6 grow">
                    @forelse($slowMoving as $slow)
                        <div class="flex justify-between items-center opacity-60 hover:opacity-100 transition-opacity">
                            <span
                                class="text-xs font-black dark:text-white uppercase tracking-tight">{{ $slow->name }}</span>
                            <div class="px-2 py-1 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <span
                                    class="text-[9px] font-black text-gray-400 uppercase tracking-tighter italic">Low_Interest</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-center py-10 opacity-20">
                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                            <p class="text-2xs font-black uppercase tracking-widest">Inventory_Optimized</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Audit Section --}}
        <div
            class="bg-white dark:bg-gray-950 rounded-[3rem] border border-gray-100 dark:border-gray-900 shadow-sm overflow-hidden">
            <div class="p-10 border-b border-gray-50 dark:border-gray-900 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gray-900 dark:bg-rose-600 rounded-2xl">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                stroke-width="2.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-[0.2em] italic">System_Audit_Log</span>
                </div>
                <span class="text-2xs font-bold text-gray-400 uppercase tracking-widest">Live Updates
                    Enabled</span>
            </div>
            <div class="overflow-x-auto p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] italic border-b border-gray-50 dark:border-gray-900">
                            <th class="px-8 py-6">Timestamp</th>
                            <th class="px-8 py-6">Reference_ID</th>
                            <th class="px-8 py-6 text-right">Settlement_Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-900">
                        @foreach ($orders as $order)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                <td class="px-8 py-6">
                                    <span
                                        class="text-xs font-bold text-gray-500 uppercase tracking-tighter">{{ $order->created_at->format('M d, Y') }}</span>
                                    <span class="text-2xs text-gray-300 mx-2">|</span>
                                    <span
                                        class="text-2xs font-black text-gray-400">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td
                                    class="px-8 py-6 font-black dark:text-white text-xs group-hover:text-rose-600 transition-colors italic uppercase">
                                    {{ $order->order_number }}
                                </td>
                                <td
                                    class="px-8 py-6 text-right font-black text-gray-900 dark:text-white text-xs italic">
                                    IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
