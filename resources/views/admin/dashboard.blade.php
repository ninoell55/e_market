<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div
        class="min-h-screen bg-white dark:bg-black text-gray-800 dark:text-gray-200 transition-colors duration-500 selection:bg-rose-500/30">
        {{-- Full Width Wrapper --}}
        <div class="w-full p-6 lg:p-10 space-y-10">

            {{-- HEADER: Cinematic & Functional --}}
            <div
                class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 border-b border-gray-100 dark:border-white/5 pb-12 transition-all duration-500">

                {{-- Brand & System Status --}}
                <div class="relative group">
                    <div
                        class="absolute -left-4 top-0 bottom-0 w-1 bg-rose-600 scale-y-0 group-hover:scale-y-100 transition-transform duration-500 origin-top">
                    </div>
                    <h1
                        class="text-5xl font-extralight tracking-tighter text-gray-900 dark:text-white uppercase leading-none">
                        Aura<span class="font-black text-rose-600 italic">Admin</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-3">
                        <p
                            class="text-[9px] font-black tracking-[0.4em] text-gray-400 dark:text-gray-500 uppercase flex items-center gap-2">
                            <span class="inline-block w-6 h-px bg-gray-300 dark:bg-white/10"></span>
                            Command Center
                        </p>
                    </div>
                </div>

                {{-- Actions & Admin Profile --}}
                <div class="flex flex-wrap items-center gap-4 sm:gap-8">

                    {{-- Clock / Date (Optional but useful for Admin) --}}
                    <div class="hidden xl:flex flex-col items-end border-r border-gray-100 dark:border-white/5 pr-8">
                        <span class="text-xs font-black dark:text-white tracking-tight">{{ now()->format('H:i') }} <span
                                class="text-rose-600">GMT+7</span></span>
                        <span
                            class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ now()->format('l, d F') }}</span>
                    </div>

                    {{-- Dynamic Action Buttons --}}
                    <div class="flex items-center gap-3">
                        {{-- Primary Action: Add Product --}}
                        <a href="{{ route('admin.product.create') }}"
                            class="group relative h-12 px-8 flex items-center bg-gray-900 dark:bg-rose-600 text-white text-2xs font-black uppercase tracking-[0.2em] overflow-hidden rounded-xl shadow-lg shadow-gray-900/10 dark:shadow-rose-600/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                            <span class="relative z-10 flex items-center gap-3">
                                <svg class="w-3 h-3 group-hover:rotate-90 transition-transform duration-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add New Product
                            </span>
                            {{-- Liquid effect on hover --}}
                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-500">
                            </div>
                            <div
                                class="absolute inset-0 bg-linear-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] transition-transform">
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <style>
                @keyframes shimmer {
                    100% {
                        transform: translateX(100%);
                    }
                }
            </style>

            {{-- STATS GRID: Modern & Interactive Bento Tiles --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Revenue Card --}}
                <a href="{{ route('admin.checkout.index') }}"
                    class="group relative bg-white dark:bg-[#0c0c0c] border border-gray-100 dark:border-white/5 p-8 overflow-hidden transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_20px_40px_-15px_rgba(225,29,72,0.1)]">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="flex justify-between items-start">
                            <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Revenue
                                Today</span>
                            <span
                                class="text-rose-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </span>
                        </div>
                        <div class="mt-8">
                            <h2 class="text-3xl font-black dark:text-white tracking-tighter">
                                Rp {{ number_format($revenueToday, 0, ',', '.') }}
                            </h2>
                            <div class="mt-3 flex items-center gap-2">
                                <span
                                    class="flex items-center px-2 py-0.5 rounded text-2xs font-black {{ $growth >= 0 ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500' }}">
                                    {{ $growth >= 0 ? '↑' : '↓' }} {{ number_format(abs($growth), 1) }}%
                                </span>
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">vs
                                    yesterday</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute -right-4 -bottom-4 text-8xl font-black text-gray-50 dark:text-white/2 italic pointer-events-none group-hover:text-rose-600/5 transition-colors duration-500">
                        01</div>
                </a>

                {{-- Action Required Card --}}
                <a href="{{ route('admin.checkout.index', ['status' => 'pending']) }}"
                    class="group relative bg-white dark:bg-[#0c0c0c] border border-gray-100 dark:border-white/5 p-8 overflow-hidden transition-all duration-500 hover:border-rose-600/50">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="flex justify-between items-start">
                            <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Pending
                                Orders</span>
                            <div class="flex h-2 w-2 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-600"></span>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="flex items-baseline gap-3">
                                <h2
                                    class="text-5xl font-black dark:text-white group-hover:text-rose-600 transition-colors tracking-tighter">
                                    {{ $needsConfirmation }}
                                </h2>
                                <span class="text-2xs font-black uppercase text-rose-500 tracking-widest">Orders</span>
                            </div>
                            <p
                                class="text-[9px] font-bold text-gray-400 uppercase mt-4 tracking-widest group-hover:text-gray-300">
                                Click to process →</p>
                        </div>
                    </div>
                    <div
                        class="absolute -right-4 -bottom-4 text-8xl font-black text-gray-50 dark:text-white/2 italic pointer-events-none group-hover:text-rose-600/5 transition-colors duration-500">
                        02</div>
                </a>

                {{-- User Growth --}}
                <a href="{{ route('admin.user.index') }}"
                    class="group relative bg-white dark:bg-[#0c0c0c] border border-gray-100 dark:border-white/5 p-8 overflow-hidden transition-all duration-500 hover:-translate-y-1">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Total
                            Members</span>
                        <div class="mt-8">
                            <h2 class="text-3xl font-black dark:text-white tracking-tighter">
                                {{ number_format($totalUsers) }}
                            </h2>
                            <div class="flex -space-x-2 mt-4 overflow-hidden">
                                {{-- Avatar placeholders for visual flair --}}
                                <div
                                    class="inline-block h-6 w-6 rounded-full ring-2 ring-white dark:ring-[#0c0c0c] bg-gray-200 dark:bg-white/10">
                                </div>
                                <div
                                    class="inline-block h-6 w-6 rounded-full ring-2 ring-white dark:ring-[#0c0c0c] bg-gray-300 dark:bg-white/20">
                                </div>
                                <div
                                    class="h-6 w-6 rounded-full ring-2 ring-white dark:ring-[#0c0c0c] bg-rose-500 flex items-center justify-center text-[8px] text-white font-bold">
                                    +</div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute -right-4 -bottom-4 text-8xl font-black text-gray-50 dark:text-white/2 italic pointer-events-none group-hover:text-rose-600/5 transition-colors duration-500">
                        03</div>
                </a>

                {{-- Inventory Status --}}
                <a href="{{ route('admin.product.index') }}"
                    class="group relative bg-white dark:bg-[#0c0c0c] border border-gray-100 dark:border-white/5 p-8 overflow-hidden transition-all duration-500 {{ $outOfStock > 0 ? 'hover:border-rose-600' : 'hover:border-emerald-500' }}">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Stock
                            Integrity</span>
                        <div class="mt-8">
                            <h2
                                class="text-3xl font-black tracking-tighter {{ $outOfStock > 0 ? 'text-rose-600' : 'text-emerald-500' }}">
                                {{ $outOfStock > 0 ? $outOfStock : 'Healthy' }}
                            </h2>
                            <p class="text-2xs font-bold text-gray-400 uppercase mt-3 tracking-widest">
                                {{ $outOfStock > 0 ? 'Requires Restock' : 'All items in stock' }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="absolute -right-4 -bottom-4 text-8xl font-black text-gray-50 dark:text-white/2 italic pointer-events-none group-hover:text-rose-600/5 transition-colors duration-500">
                        04</div>
                </a>
            </div>

            {{-- CHART & ANALYTICS --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Sales Graph: Elevating the Main Canvas --}}
                <div
                    class="lg:col-span-8 bg-white dark:bg-[#0c0c0c] border border-gray-100 dark:border-white/5 rounded-2xl p-8 relative shadow-sm transition-all duration-500 hover:shadow-xl hover:shadow-gray-200/20 dark:hover:shadow-none">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="w-1 h-4 bg-rose-600 rounded-full"></div>
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-900 dark:text-white">
                                    Performance Analytics</h3>
                            </div>
                            <p class="text-2xs text-gray-400 font-bold uppercase tracking-wider ml-3">Net sales
                                revenue trajectory</p>
                        </div>
                    </div>
                    <div class="h-125 w-full">
                        <canvas id="mainDashboardChart"></canvas>
                    </div>
                </div>

                {{-- Stock Alerts: Improved Glassmorphism --}}
                <div
                    class="lg:col-span-4 bg-gray-900 dark:bg-rose-950/10 border border-gray-800 dark:border-rose-500/10 rounded-2xl p-8 flex flex-col relative overflow-hidden group">
                    <div class="relative z-10 flex flex-col h-full">
                        <h3
                            class="text-2xs font-black uppercase tracking-[0.3em] mb-10 text-rose-500 flex items-center justify-between">
                            <span class="flex items-center gap-3">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-600"></span>
                                </span>
                                Inventory Alerts
                            </span>
                            <span
                                class="text-[9px] px-2 py-0.5 bg-rose-500/20 rounded border border-rose-500/20">{{ count($criticalVariants) }}
                                Issues</span>
                        </h3>

                        <div class="space-y-6 grow">
                            @foreach ($criticalVariants as $v)
                                <div
                                    class="group/item flex justify-between items-center p-3 rounded-xl hover:bg-white/5 transition-all duration-300 border border-transparent hover:border-white/5">
                                    <div class="max-w-[65%]">
                                        <p
                                            class="text-xs font-bold text-white group-hover/item:text-rose-400 transition-colors truncate">
                                            {{ $v->product->name ?? 'System Item' }}
                                        </p>
                                        <p class="text-[9px] text-gray-500 font-bold uppercase mt-1 tracking-tighter">
                                            Variant: <span class="text-gray-400">{{ $v->attribute_value }}</span>
                                        </p>
                                    </div>
                                    <a href="{{ route('admin.product.edit', $v->product_id) }}"
                                        class="text-[9px] font-black tracking-widest bg-rose-600/10 text-rose-500 border border-rose-500/20 px-3 py-2 rounded-lg hover:bg-rose-600 hover:text-white transition-all duration-300">
                                        {{ $v->stock }} LEFT
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('admin.product.index') }}"
                            class="mt-10 group/link inline-flex items-center gap-3 text-2xs font-black uppercase tracking-widest text-gray-400 hover:text-white transition-all">
                            Full Inventory Report
                            <span
                                class="group-hover/link:translate-x-2 transition-transform duration-300 text-rose-500">→</span>
                        </a>
                    </div>
                    {{-- More subtle decorative elements --}}
                    <div
                        class="absolute -top-10 -right-10 w-40 h-40 bg-rose-600/10 rounded-full blur-[80px] pointer-events-none">
                    </div>
                    <div
                        class="absolute -bottom-10 -left-10 w-40 h-40 bg-rose-900/10 rounded-full blur-[80px] pointer-events-none">
                    </div>
                </div>

                {{-- TABLE: Professional & Structured --}}
                <div
                    class="lg:col-span-12 bg-white dark:bg-[#0c0c0c] border border-gray-100 dark:border-white/5 rounded-2xl overflow-hidden mt-2 shadow-sm">
                    <div
                        class="p-8 border-b border-gray-50 dark:border-white/5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/20 dark:bg-white/1">
                        <div>
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-900 dark:text-white">
                                Recent Transactions</h3>
                            <p class="text-2xs text-gray-400 font-bold uppercase mt-1 tracking-wider">Real-time
                                order processing hub</p>
                        </div>
                        <a href="{{ route('admin.checkout.index') }}"
                            class="px-5 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-black text-[9px] font-black uppercase tracking-widest hover:scale-105 active:scale-95 transition-all duration-300 rounded-lg">
                            View Ledger
                        </a>
                    </div>
                    <div class="overflow-x-auto px-4">
                        <table class="w-full text-left border-separate border-spacing-y-3">
                            <thead>
                                <tr
                                    class="text-[9px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.25em]">
                                    <th class="px-6 py-2">Customer Details</th>
                                    <th class="px-6 py-2">Reference ID</th>
                                    <th class="px-6 py-2">Amount</th>
                                    <th class="px-6 py-2">Date & Time</th>
                                    <th class="px-6 py-2 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                                @foreach ($recentOrders as $order)
                                    <tr class="group transition-all duration-300">
                                        {{-- Customer Info --}}
                                        <td
                                            class="bg-white dark:bg-white/2 px-6 py-4 first:rounded-l-2xl border-y border-l border-gray-100/50 dark:border-white/5 group-hover:border-rose-500/30 group-hover:bg-gray-50/50 dark:group-hover:bg-white/4 transition-all">
                                            <div class="flex items-center gap-4">
                                                <div class="relative">
                                                    <div
                                                        class="w-9 h-9 rounded-xl bg-linear-to-br from-gray-50 to-gray-100 dark:from-white/5 dark:to-white/2 flex items-center justify-center font-black text-[11px] text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-white/10 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                                        {{ substr($order->user->name, 0, 1) }}
                                                    </div>
                                                    <div
                                                        class="absolute -bottom-1 -right-1 w-3 h-3 bg-emerald-500 border-2 border-white dark:border-[#0c0c0c] rounded-full">
                                                    </div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors tracking-tight">
                                                        {{ $order->user->name }}
                                                    </span>
                                                    <span
                                                        class="text-[9px] text-gray-400 font-black tracking-tighter opacity-70">
                                                        {{ $order->user->email ?? 'Client Account' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Order Number --}}
                                        <td
                                            class="bg-white dark:bg-white/2 px-6 py-4 border-y border-gray-100/50 dark:border-white/5 group-hover:bg-gray-50/50 dark:group-hover:bg-white/4 transition-all">
                                            <span
                                                class="font-mono text-2xs font-bold px-2 py-1 bg-gray-100 dark:bg-white/5 rounded text-gray-500 dark:text-gray-400 border border-gray-200/50 dark:border-white/5">
                                                #{{ $order->order_number }}
                                            </span>
                                        </td>

                                        {{-- Value --}}
                                        <td
                                            class="bg-white dark:bg-white/2 px-6 py-4 border-y border-gray-100/50 dark:border-white/5 group-hover:bg-gray-50/50 dark:group-hover:bg-white/4 transition-all">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-black text-gray-900 dark:text-white tracking-tighter text-[13px]">
                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                </span>
                                                @if ($order->payment->method == 'COD')
                                                    <span
                                                        class="text-[8px] text-emerald-500 font-bold uppercase tracking-widest">Cash
                                                        on Delivery</span>
                                                @else
                                                    <span
                                                        class="text-[8px] text-emerald-500 font-bold uppercase tracking-widest">Paid
                                                        via Gateway</span>
                                                @endif
                                            </div>
                                        </td>

                                        {{-- Date --}}
                                        <td
                                            class="bg-white dark:bg-white/2 px-6 py-4 border-y border-gray-100/50 dark:border-white/5 group-hover:bg-gray-50/50 dark:group-hover:bg-white/4 transition-all">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-gray-600 dark:text-gray-400 font-medium tracking-tight">
                                                    {{ $order->created_at->format('d M, Y') }}
                                                </span>
                                                <span
                                                    class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">
                                                    {{ $order->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Status --}}
                                        <td
                                            class="bg-white dark:bg-white/2 px-6 py-4 last:rounded-r-2xl border-y border-r border-gray-100/50 dark:border-white/5 text-right group-hover:border-rose-500/30 group-hover:bg-gray-50/50 dark:group-hover:bg-white/4 transition-all">
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest border shadow-sm {{ $order->status == 'completed' ? 'border-emerald-500/20 text-emerald-500 bg-emerald-500/5 shadow-emerald-500/5' : 'border-amber-500/20 text-amber-500 bg-amber-500/5 shadow-amber-500/5' }}">
                                                <span class="relative flex h-1.5 w-1.5 mr-2">
                                                    @if ($order->status != 'completed')
                                                        <span
                                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                                    @endif
                                                    <span
                                                        class="relative inline-flex rounded-full h-1.5 w-1.5 {{ $order->status == 'completed' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                                </span>
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const isDark = document.documentElement.classList.contains('dark');
        const ctx = document.getElementById('mainDashboardChart').getContext('2d');

        const linear = ctx.createLinearGradient(0, 0, 0, 400);
        linear.addColorStop(0, 'rgba(225, 29, 72, 0.15)');
        linear.addColorStop(0.5, 'rgba(225, 29, 72, 0.05)');
        linear.addColorStop(1, 'rgba(225, 29, 72, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartValues),
                    borderColor: '#e11d48',
                    borderWidth: 3,
                    fill: true,
                    backgroundColor: linear,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#e11d48',
                    pointHoverBorderColor: isDark ? '#000' : '#fff',
                    pointHoverBorderWidth: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#888',
                            font: {
                                size: 10,
                                weight: '700'
                            },
                            padding: 10
                        }
                    },
                    y: {
                        grid: {
                            color: isDark ? 'rgba(255,255,255,0.03)' : 'rgba(0,0,0,0.03)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#888',
                            font: {
                                size: 10,
                                weight: '500'
                            },
                            padding: 10,
                            callback: (v) => 'Rp ' + (v >= 1000000 ? (v / 1000000) + 'M' : (v / 1000) + 'k')
                        }
                    }
                }
            }
        });
    </script>
</x-admin-layout>
