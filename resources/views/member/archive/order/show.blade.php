<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div
        class="min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white antialiased selection:bg-rose-600 selection:text-white font-sans">

        <main class="w-full border-t border-black/10 dark:border-white/10">

            {{-- Navigation Bar --}}
            <div
                class="flex flex-col md:flex-row justify-between items-stretch md:items-center border-b border-black/10 dark:border-white/10 bg-white/80 dark:bg-black/80">

                {{-- Back Action --}}
                <a href="{{ route('member.archive.orders') }}"
                    class="group flex items-center gap-6 px-10 py-6 border-r border-black/10 dark:border-white/10 bg-black text-white dark:bg-white dark:text-black transition-all duration-500 relative overflow-hidden">
                    {{-- Animated Background Bar --}}
                    <div
                        class="absolute left-0 top-0 w-1 h-full bg-rose-600 translate-y-0 transition-transform duration-500">
                    </div>

                    <div class="relative flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 group-hover:-translate-x-2 transition-transform duration-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                        </svg>
                        <div class="flex flex-col">
                            <span class="text-2xs font-black uppercase tracking-[0.3em]">Back to Archive</span>
                        </div>
                    </div>
                </a>

                {{-- Dangerous Action Zone --}}
                <div class="flex items-center border-t md:border-t-0 md:border-l border-black/10 dark:border-white/10">
                    @php
                        $minutesPassed = $order->created_at->diffInMinutes(now());
                        $isNotTransfer = ($order->payment->method ?? '') !== 'Transfer';
                        $canCancel = $order->status === 'pending' && $minutesPassed < 10 && $isNotTransfer;
                    @endphp

                    @if ($canCancel)
                        <form action="{{ route('member.checkout.cancel', $order->id) }}" method="POST" class="h-full">
                            @csrf
                            <button type="submit"
                                class="confirm-delete-btn group relative h-full px-12 py-6 bg-transparent text-rose-600 overflow-hidden"
                                title="Delete" data-confirm-title="Cancel Order Process?"
                                data-confirm-text="This will permanently abort the transaction. Proceed with caution."
                                data-confirm-button="Yes, Abort Order">

                                {{-- Hover Background --}}
                                <div
                                    class="absolute inset-0 bg-rose-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                                </div>

                                <div class="relative z-10 flex flex-col items-center gap-1">
                                    <span
                                        class="text-2xs font-black uppercase tracking-[0.3em] group-hover:text-white transition-colors duration-500">Cancel
                                        Order</span>
                                    <span
                                        class="text-[7px] font-mono opacity-50 group-hover:text-white/70 transition-colors uppercase tracking-[0.2em]">
                                        Timer: {{ 10 - $minutesPassed }}m left
                                    </span>
                                </div>
                            </button>
                        </form>
                    @else
                        <div class="bg-rose-600 text-white px-12 py-6 flex flex-col items-end select-none w-full">
                            <span class="text-2xs uppercase tracking-[0.3em]">Cancel Locked</span>
                            <span class="text-[7px] font-mono uppercase tracking-widest italic">Timeout Reached</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Progress Stepper --}}
            <div
                class="py-24 border-b border-black/10 dark:border-white/10 px-6 relative overflow-hidden bg-white dark:bg-[#0a0a0a]">
                {{-- Background Decor - Status Ghost Text --}}
                <div
                    class="absolute inset-0 opacity-2 pointer-events-none select-none flex items-center justify-center font-black text-[18vw] italic uppercase tracking-tighter transition-all duration-700">
                    {{ $order->status }}
                </div>

                {{-- Technical Grid Overlay (Optional Decor) --}}
                <div
                    class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-size-[40px_40px] mask-[radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)]">
                </div>

                <div class="relative max-w-5xl mx-auto">

                    <div class="relative flex justify-between items-center px-4">
                        {{-- Background Track --}}
                        <div
                            class="absolute h-0.5 w-[calc(100%-2rem)] bg-black/5 dark:bg-white/5 top-1/2 -translate-y-1/2 left-4 z-0">
                        </div>

                        @php
                            $statuses =
                                $order->payment->method === 'COD'
                                    ? ['pending', 'shipped', 'paid', 'completed']
                                    : ['pending', 'paid', 'shipped', 'completed'];

                            if ($order->status === 'cancelled') {
                                $statuses = ['pending', 'cancelled'];
                            }

                            $currentIdx = array_search($order->status, $statuses);
                            // Calculate width for the active progress line
                            $progressWidth = count($statuses) > 1 ? ($currentIdx / (count($statuses) - 1)) * 100 : 0;
                        @endphp

                        {{-- Active Progress Line --}}
                        <div class="absolute h-0.5 bg-rose-600 top-1/2 -translate-y-1/2 left-4 z-0 transition-all duration-[1.5s] ease-in-out shadow-[0_0_10px_rgba(225,29,72,0.4)]"
                            style="width: calc({{ $progressWidth }}% - 2rem)">
                        </div>

                        @foreach ($statuses as $index => $step)
                            <div class="relative z-10 flex flex-col items-center group">
                                {{-- Marker Node --}}
                                <div class="relative flex items-center justify-center transition-all duration-500">
                                    {{-- Outer Ring --}}
                                    <div
                                        class="absolute w-8 h-8 rounded-full border border-black/5 dark:border-white/5 scale-0 group-hover:scale-100 {{ $index <= $currentIdx ? 'group-hover:border-rose-600/30' : '' }} transition-all duration-500">
                                    </div>

                                    {{-- Diamond Core --}}
                                    <div
                                        class="w-3.5 h-3.5 rotate-45 transition-all duration-700 
                            {{ $index <= $currentIdx
                                ? 'bg-rose-600 shadow-[0_0_20px_rgba(225,29,72,0.8)] scale-110'
                                : 'bg-gray-200 dark:bg-white/10 group-hover:bg-white/30' }}">
                                    </div>
                                </div>

                                {{-- Label Container --}}
                                <div class="absolute -bottom-14 flex flex-col items-center whitespace-nowrap">
                                    <div class="flex items-center gap-1 mb-1">
                                        <span
                                            class="w-2 h-px bg-rose-600 transition-all duration-500 {{ $index <= $currentIdx ? 'opacity-100' : 'opacity-0' }}"></span>
                                        <span
                                            class="text-[7px] font-mono opacity-30 uppercase tracking-[0.2em]">{{ $index + 1 }}</span>
                                    </div>
                                    <span
                                        class="text-2xs font-black uppercase tracking-[0.25em] transition-all duration-500 italic
                            {{ $index <= $currentIdx ? 'text-black dark:text-white translate-y-0' : 'opacity-20 translate-y-1' }}">
                                        {{ $step }}
                                    </span>

                                    {{-- Timestamp Placeholder (Optional) --}}
                                    @if ($index === $currentIdx)
                                        <span
                                            class="text-[6px] font-mono text-rose-600 mt-1 animate-pulse uppercase">Current
                                            Phase</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Manifest Header --}}
            <div
                class="grid grid-cols-1 md:grid-cols-12 border-b border-black/10 dark:border-white/10 bg-white dark:bg-[#0a0a0a] overflow-hidden relative">

                {{-- Left Section: Primary Metadata --}}
                <div
                    class="md:col-span-7 p-10 md:p-16 border-b md:border-b-0 md:border-r border-black/10 dark:border-white/10 relative z-10">
                    <div class="flex flex-col gap-6 mb-12">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-0.5 bg-rose-600"></span>
                            <span
                                class="text-2xs font-mono font-bold text-rose-600 uppercase tracking-[0.4em]">Order Number</span>
                        </div>

                        <div class="space-y-1">
                            <span
                                class="text-[9px] font-mono opacity-30 uppercase tracking-[0.3em] block">Registry_ID</span>
                            <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tighter italic">
                                #{{ $order->order_number }}<span class="text-rose-600 animate-pulse">_</span>
                            </h2>
                        </div>
                    </div>

                    {{-- Technical Specs Grid --}}
                    <div class="grid grid-cols-2 gap-12 pt-8 border-t border-black/5 dark:border-white/5">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <div class="w-1 h-1 bg-black dark:bg-white rotate-45"></div>
                                <span
                                    class="text-[8px] font-mono opacity-30 uppercase tracking-widest">Date</span>
                            </div>
                            <p class="text-[13px] font-black uppercase tracking-widest italic">
                                {{ $order->created_at->format('d.M.Y') }}
                            </p>
                        </div>
                        <div class="space-y-2 border-l border-black/10 dark:border-white/10 pl-8">
                            <div class="flex items-center gap-2">
                                <div class="w-1 h-1 bg-black dark:bg-white rotate-45"></div>
                                <span class="text-[8px] font-mono opacity-30 uppercase tracking-widest">Time</span>
                            </div>
                            <p class="text-[13px] font-black uppercase tracking-widest italic">
                                {{ $order->created_at->format('H:i:s T') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Right Section: System Status --}}
                <div
                    class="md:col-span-5 flex flex-col justify-between bg-black/2 dark:bg-white/2 p-10 md:p-16 relative z-10">

                    {{-- Payment Status Card --}}
                    <div class="space-y-8">
                        <div class="group">
                            <p
                                class="text-[9px] font-mono opacity-30 uppercase tracking-[0.3em] mb-4 flex items-center gap-2">
                                <span class="w-1 h-1 bg-rose-600"></span>
                                Payment Method
                            </p>
                            <div class="flex items-end gap-3">
                                <h3
                                    class="text-3xl font-black uppercase italic tracking-tighter group-hover:text-rose-600 transition-colors duration-500">
                                    {{ $order->payment->method ?? 'NULL' }}
                                </h3>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <p class="text-[9px] font-mono opacity-30 uppercase tracking-[0.3em]">Status</p>
                            <div class="inline-flex items-center gap-4">
                                <span
                                    class="text-xs font-black uppercase tracking-[0.3em] px-6 py-3 border-2 border-black dark:border-white bg-black text-white dark:bg-white dark:text-black italic hover:bg-transparent hover:text-black dark:hover:text-white transition-all duration-300 cursor-default">
                                    {{ $order->status === 'completed' ? 'Verified Success' : 'On Progress' }}
                                </span>
                                @if ($order->status === 'completed')
                                    <div class="flex gap-1">
                                        <span class="w-1 h-4 bg-rose-600"></span>
                                        <span class="w-1 h-4 bg-rose-600"></span>
                                        <span class="w-1 h-4 bg-rose-600"></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Data Grid --}}
            <div
                class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-black/10 dark:divide-white/10 bg-white dark:bg-[#0a0a0a]">

                {{-- Product Feed (Kiri) --}}
                <div class="lg:col-span-7 flex flex-col">
                    <div
                        class="p-8 md:p-10 border-b border-black/5 dark:border-white/5 flex justify-between items-center bg-black/2 dark:bg-white/2">
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-2 bg-rose-600 rotate-45 animate-pulse"></div>
                            <span class="text-2xs font-black uppercase tracking-[0.4em]">Product List</span>
                        </div>
                        <span class="text-[9px] font-mono opacity-40 uppercase tracking-widest italic">
                            {{ $order->items->count() }} Line Items Detected
                        </span>
                    </div>

                    <div class="divide-y divide-black/5 dark:divide-white/5 grow">
                        @foreach ($order->items as $item)
                            <div
                                class="p-10 md:p-14 flex items-center justify-between group hover:bg-black/1 dark:hover:bg-white/1 transition-all duration-700">
                                <div class="flex items-center gap-12">
                                    {{-- Product Image with Technical Frame --}}
                                    <div class="relative group">
                                        <div
                                            class="absolute -inset-2 border border-black/5 dark:border-white/5 scale-95 group-hover:scale-100 transition-transform duration-700">
                                        </div>
                                        <div
                                            class="w-24 bg-gray-100 dark:bg-white/5 overflow-hidden relative z-10">
                                            @if ($item->product->image)
                                                <img src="{{ asset('storage/uploads/' . $item->product->image) }}"
                                                    class="w-full object-cover aspect-square contrast-125 brightness-90 group-hover:scale-110 transition-all duration-1000">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <h3
                                                class="text-2xl font-black uppercase italic tracking-tighter group-hover:text-rose-600 transition-colors">
                                                {{ $item->product_name }}
                                            </h3>
                                        </div>
                                        <div class="flex gap-10">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-[8px] font-mono opacity-30 uppercase mb-1">Variant</span>
                                                <span
                                                    class="text-2xs font-bold text-rose-600 uppercase tracking-widest">{{ $item->variant_name }}</span>
                                            </div>
                                            <div
                                                class="flex flex-col border-l border-black/10 dark:border-white/10 pl-6">
                                                <span class="text-[8px] font-mono opacity-30 uppercase mb-1">Qty</span>
                                                <span
                                                    class="text-2xs font-black uppercase italic">{{ $item->quantity }}
                                                    UNITS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right flex flex-col justify-center">
                                    <span
                                        class="text-[8px] font-mono opacity-20 block mb-2 uppercase tracking-widest">Subtotal</span>
                                    <p class="text-2xl font-black italic tracking-tighter">
                                        {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Summary Panel (Kanan) --}}
                <div class="lg:col-span-5 flex flex-col bg-black/2 dark:bg-white/2">
                    <div class="p-10 md:p-16 space-y-16 grow">
                        {{-- Logistics / Shipping --}}
                        <div class="relative">
                            <div
                                class="absolute -left-16 top-0 hidden lg:block h-px w-12 bg-black/10 dark:bg-white/10">
                            </div>
                            <span
                                class="text-2xs font-black uppercase tracking-[0.5em] opacity-30 block mb-10 italic">Destination</span>

                            <div
                                class="space-y-6 border-l-2 border-black dark:border-white pl-8 py-2 group hover:border-rose-600 transition-colors duration-700">
                                <div class="space-y-1">
                                    <span class="text-[8px] font-mono opacity-30 uppercase block">User</span>
                                    <p class="text-xl font-black uppercase italic tracking-tight">
                                        {{ Auth::user()->name }}</p>
                                </div>
                                <div class="space-y-1">
                                    <span class="text-[8px] font-mono opacity-30 uppercase block">Shipping
                                        Address</span>
                                    <p
                                        class="text-xs leading-relaxed opacity-60 font-medium italic uppercase tracking-widest">
                                        {{ $order->shipping_address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Final Total Card --}}
                    <div
                        class="p-12 md:p-16 bg-black text-white dark:bg-white dark:text-black transition-all duration-700 relative overflow-hidden group">
                        {{-- Background Ghost Number --}}
                        <div
                            class="absolute -bottom-4 right-0 opacity-[0.05] group-hover:opacity-[0.1] transition-opacity duration-700 text-[12vw] font-black italic select-none pointer-events-none uppercase">
                            IDR
                        </div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-16">
                                <div class="flex flex-col gap-2">
                                    <div class="flex gap-1">
                                        <div class="w-8 h-1 bg-rose-600"></div>
                                        <div class="w-2 h-1 bg-rose-600/30"></div>
                                    </div>
                                    <span class="text-[11px] font-black uppercase tracking-[0.6em] italic">Total
                                        Payable</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[8px] font-mono opacity-40 uppercase block">Unit Sum</span>
                                    <span class="text-2xs font-black">{{ $order->items->sum('quantity') }}
                                        PCS</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-end">
                                <span class="text-xs font-mono opacity-50 tracking-[0.4em] mb-4">IDR</span>
                                <p class="text-7xl md:text-9xl font-black italic tracking-tighter">
                                    {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Terminal --}}
            @if ($order->status === 'cancelled')
                <div
                    class="w-full py-16 bg-rose-600 text-white flex flex-col items-center justify-center gap-4 overflow-hidden relative">
                    <div
                        class="absolute inset-0 opacity-10 flex items-center justify-center text-[10vw] font-black italic select-none">
                        CANCELLED</div>
                    <p
                        class="text-[12px] font-black uppercase tracking-[0.8em] italic animate-pulse relative z-10 text-center">
                        X Process Cancelled X</p>
                    <p class="text-[9px] font-mono opacity-70 relative z-10">ERROR CODE: ORDER REJECTED BY USER</p>
                </div>
            @endif

        </main>
    </div>
</x-member-layout>
