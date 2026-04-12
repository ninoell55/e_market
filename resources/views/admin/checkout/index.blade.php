<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Header Section --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 px-4 sm:px-0">
            <div>
                <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">
                    Order Management
                </h3>
                <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-2">
                    Total Processing: {{ $orders->total() }} Active Shipments
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                {{-- Pencarian --}}
                <form action="{{ route('admin.checkout.index') }}" method="GET" class="relative w-full sm:w-72 group">
                    @foreach (request()->except(['search', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="INV / NAME / REF..."
                        class="w-full bg-white dark:bg-gray-950 border-gray-100 dark:border-gray-900 focus:ring-rose-500 focus:border-rose-500 rounded-2xl text-2xs font-bold uppercase tracking-widest pl-12 pr-4 py-4 transition-all shadow-sm">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
            </div>
        </div>

        {{-- Advanced Filter Bar --}}
        <div
            class="bg-white dark:bg-gray-950 p-6 rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-sm">
            <form action="{{ route('admin.checkout.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Filter Tanggal --}}
                <div class="flex flex-col gap-2">
                    <label
                        class="text-[9px] font-black uppercase text-gray-400 ml-2 tracking-widest">Date Period</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                        class="bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs font-bold dark:text-white focus:ring-rose-500">
                </div>

                {{-- Filter Payment --}}
                <div class="flex flex-col gap-2">
                    <label
                        class="text-[9px] font-black uppercase text-gray-400 ml-2 tracking-widest">Payment Method</label>
                    <select name="payment"
                        class="bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs font-bold dark:text-white focus:ring-rose-500">
                        <option value="">ALL METHODS</option>
                        <option value="Transfer" {{ request('payment') == 'Transfer' ? 'selected' : '' }}>BANK
                            TRANSFER</option>
                        <option value="COD" {{ request('payment') == 'COD' ? 'selected' : '' }}>CASH ON DELIVERY
                        </option>
                    </select>
                </div>

                {{-- Urutan --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[9px] font-black uppercase text-gray-400 ml-2 tracking-widest">Sort By</label>
                    <select name="sort"
                        class="bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs font-bold dark:text-white focus:ring-rose-500">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>NEWEST FIRST
                        </option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>OLDEST FIRST
                        </option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 py-3 bg-gray-900 dark:bg-rose-600 text-white text-2xs font-black uppercase rounded-xl hover:opacity-80 transition-all">
                        APPLY FILTERS
                    </button>
                    <a href="{{ route('admin.checkout.index') }}"
                        class="px-4 py-3 bg-gray-100 dark:bg-gray-800 text-gray-400 rounded-xl hover:text-rose-600 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </form>
        </div>

        {{-- Status Tabs (Hanya menampilkan status aktif, Cancelled dihilangkan) --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-2 px-4 sm:px-0 no-scrollbar">
            @php $currentStatus = request('status'); @endphp
            <a href="{{ route('admin.checkout.index', request()->except(['status', 'page'])) }}"
                class="px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest border {{ !$currentStatus ? 'bg-gray-900 dark:bg-rose-600 text-white shadow-lg' : 'border-gray-100 dark:border-gray-900 bg-white dark:bg-gray-950 text-gray-400 hover:text-rose-600' }} whitespace-nowrap transition-all">
                ALL ACTIVE
            </a>
            @foreach (['pending', 'paid', 'shipped', 'completed'] as $status)
                <a href="{{ route('admin.checkout.index', array_merge(request()->all(), ['status' => $status])) }}"
                    class="px-6 py-3 rounded-2xl text-2xs font-black uppercase tracking-widest border {{ $currentStatus == $status ? 'bg-gray-900 dark:bg-rose-600 text-white shadow-lg' : 'border-gray-100 dark:border-gray-900 bg-white dark:bg-gray-950 text-gray-400 hover:text-rose-600' }} whitespace-nowrap transition-all">
                    {{ $status }}
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        <div
            class="bg-white dark:bg-gray-950 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-900 overflow-hidden">
            <div class="w-full overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-gray-50 dark:border-gray-900 bg-gray-50/30 dark:bg-gray-900/30">
                            <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Reference</th>
                            <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Customer</th>
                            <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Amount</th>
                            <th class="px-8 py-6 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Status</th>
                            <th
                                class="px-8 py-6 text-right text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-900">
                        @forelse ($orders as $order)
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-rose-950/5 transition-all duration-300">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-black text-gray-900 dark:text-white tracking-tighter italic group-hover:text-rose-600 transition-colors uppercase">
                                            #{{ $order->order_number }}
                                        </span>
                                        <span
                                            class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter mt-0.5">
                                            {{ $order->created_at->format('d M Y') }} •
                                            {{ $order->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $order->user->name }}</span>
                                        <span
                                            class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $order->payment->method }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xs font-black text-rose-600 italic">
                                        IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusClasses = [
                                            'pending' =>
                                                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20',
                                            'paid' =>
                                                'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20',
                                            'shipped' =>
                                                'bg-purple-50 text-purple-600 border-purple-100 dark:bg-purple-500/10 dark:text-purple-400 dark:border-purple-500/20',
                                            'completed' =>
                                                'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20',
                                        ];
                                        $currentClass =
                                            $statusClasses[$order->status] ??
                                            'bg-gray-50 text-gray-600 border-gray-100';
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full border {{ $currentClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('admin.checkout.show', $order->id) }}"
                                        class="inline-flex items-center px-5 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-black text-[9px] font-black uppercase tracking-[0.2em] rounded-xl hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all shadow-lg active:scale-95">
                                        VIEW DETAILS
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <div class="col-span-full">
                                    <x-empty-state title="No Orders Found"
                                        message="Try adjusting your filters or check back later for new orders."
                                        buttonText="Refresh" />
                                </div>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="px-6">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</x-admin-layout>
