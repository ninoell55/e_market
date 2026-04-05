<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div
        class="min-h-screen bg-gray-50 dark:bg-[#080808] text-gray-600 dark:text-gray-400 font-sans p-4 lg:p-8 transition-colors duration-500">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- TOP HEADER --}}
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10">
                <div class="space-y-1">
                    <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter uppercase italic">
                        Terminal_<span class="text-rose-600">Admin</span>
                    </h1>
                    <div class="flex items-center gap-3 text-2xs font-bold tracking-[0.3em] uppercase opacity-60">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        System_Active // {{ now()->format('H:i T') }}
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.product.create') }}"
                        class="px-5 py-2.5 bg-white dark:bg-white/5 hover:bg-rose-600 hover:text-white transition-all rounded-xl border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white text-2xs font-black uppercase tracking-widest shadow-sm">
                        + New_Product
                    </a>
                    <a href="{{ route('admin.checkout.index') }}"
                        class="px-5 py-2.5 bg-white dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all rounded-xl border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white text-2xs font-black uppercase tracking-widest shadow-sm">
                        Orders_List
                    </a>
                </div>
            </div>

            {{-- GRID SYSTEM --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- LEFT COLUMN --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- 3-Grid Quick Stats --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div
                            class="bg-white dark:bg-linear-to-br dark:from-gray-900 dark:to-black p-8 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-sm dark:shadow-2xl relative overflow-hidden group">
                            <span class="text-[9px] font-black uppercase tracking-widest text-rose-600">//
                                Daily_Revenue</span>
                            <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-4 italic">Rp
                                {{ number_format($revenueToday, 0, ',', '.') }}</h3>
                            <div
                                class="mt-4 text-2xs font-bold {{ $growth >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $growth >= 0 ? '▲' : '▼' }} {{ number_format(abs($growth), 1) }}% <span
                                    class="opacity-50 text-gray-500 dark:text-white uppercase">vs yesterday</span>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-900/40 p-8 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-sm">
                            <span class="text-[9px] font-black uppercase tracking-widest text-amber-600">//
                                Pending_Verify</span>
                            <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-4 italic">
                                {{ $needsConfirmation }} <span
                                    class="text-xs opacity-50 not-italic uppercase">Payments</span></h3>
                            <a href="{{ route('admin.checkout.index') }}"
                                class="mt-4 block text-[9px] font-black text-rose-600 dark:text-white underline tracking-widest">Go_To_Verification
                                →</a>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-900/40 p-8 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-sm">
                            <span class="text-[9px] font-black uppercase tracking-widest text-blue-600">//
                                Active_Users</span>
                            <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-4 italic">
                                {{ $totalUsers }} <span
                                    class="text-xs opacity-50 not-italic uppercase">Members</span></h3>
                            <p class="mt-4 text-[9px] font-bold opacity-40 uppercase tracking-widest">
                                Growth_Steady</p>
                        </div>
                    </div>

                    {{-- Main Analytics Chart --}}
                    <div
                        class="bg-white dark:bg-[#0c0c0c] p-10 rounded-[3rem] border border-gray-100 dark:border-white/5 shadow-sm dark:shadow-2xl">
                        <div class="flex justify-between items-center mb-10">
                            <h4
                                class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-widest italic">
                                // Sales_Trajectory</h4>
                        </div>
                        <div class="h-87.5">
                            <canvas id="mainDashboardChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="lg:col-span-4 space-y-6">

                    {{-- Critical Inventory (Selalu Rose untuk penekanan) --}}
                    <div class="bg-rose-600 rounded-[3rem] p-8 shadow-xl shadow-rose-900/20 text-white">
                        <div class="flex justify-between items-center mb-8">
                            <span class="text-2xs font-black uppercase tracking-widest italic">// Stock_Alert</span>
                            <span
                                class="bg-black/20 text-[8px] font-black px-2 py-1 rounded-lg uppercase italic">{{ $outOfStock }}
                                Empty</span>
                        </div>
                        <div class="space-y-4">
                            @foreach ($criticalVariants as $v)
                                <div class="flex items-center justify-between group">
                                    <div class="max-w-[70%]">
                                        <p class="text-[8px] font-black text-rose-200 uppercase truncate">
                                            {{ $v->name }}</p>
                                        <p class="text-xs font-black uppercase italic truncate">
                                            {{ $v->attribute_value }}</p>
                                    </div>
                                    <a href="{{ route('admin.product.edit', $v->p_id) }}"
                                        class="text-2xs font-black bg-white text-rose-600 px-3 py-1 rounded-lg hover:scale-110 transition-transform shadow-lg">
                                        {{ $v->stock }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Recent Transactions Feed --}}
                    <div
                        class="bg-white dark:bg-gray-900/40 p-8 rounded-[3rem] border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden text-gray-900 dark:text-white">
                        <span
                            class="text-2xs font-black text-gray-400 dark:text-white uppercase tracking-widest italic block mb-8">//
                            Live_Activity</span>
                        <div class="space-y-6">
                            @foreach ($recentOrders as $order)
                                <div
                                    class="flex justify-between items-start border-b border-gray-50 dark:border-white/5 pb-4 last:border-0 group">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-2xs font-black uppercase italic group-hover:text-rose-600 transition-colors">{{ $order->user->name }}</span>
                                        <span
                                            class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter">#{{ $order->order_number }}</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xs font-black italic">Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                        <span
                                            class="text-[7px] font-black px-2 py-0.5 rounded {{ $order->status == 'completed' ? 'bg-emerald-500/10 text-emerald-600' : 'bg-amber-500/10 text-amber-600' }} uppercase tracking-widest">{{ $order->status }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('admin.checkout.index') }}"
                            class="block text-center mt-8 text-[9px] font-black text-gray-400 uppercase hover:text-rose-600 transition-colors tracking-[0.3em]">View_All_Streams
                            →</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- CHART SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Deteksi mode saat ini untuk warna grid
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.03)' : 'rgba(0, 0, 0, 0.03)';
        const tickColor = isDark ? '#555' : '#999';

        const ctx = document.getElementById('mainDashboardChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, 'rgba(225, 29, 72, 0.25)');
        gradient.addColorStop(1, 'rgba(225, 29, 72, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartValues),
                    borderColor: '#e11d48',
                    borderWidth: 4,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#e11d48',
                    pointBorderColor: isDark ? '#000' : '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                            font: {
                                size: 9,
                                weight: 'bold'
                            },
                            color: tickColor
                        }
                    },
                    y: {
                        grid: {
                            color: gridColor,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 9,
                                weight: 'bold'
                            },
                            color: tickColor,
                            callback: v => 'Rp ' + v.toLocaleString()
                        }
                    }
                }
            }
        });
    </script>
</x-admin-layout>
