<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-6 lg:px-12 min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white antialiased">

        {{-- Navigation Back --}}
        <div class="py-12 flex justify-between items-center max-w-4xl mx-auto">
            <a href="{{ route('member.archive.orders') }}" class="group inline-flex items-center gap-2">
                <span
                    class="text-2xs font-black uppercase tracking-[0.3em] opacity-30 group-hover:opacity-100 group-hover:text-rose-600 transition-all">
                    ← Return_To_Archive
                </span>
            </a>

            {{-- LOGIKA PEMBATALAN 10 MENIT --}}
            @php
                $minutesPassed = $order->created_at->diffInMinutes(now());
                $canCancel = $order->status === 'pending' && $minutesPassed < 10;
            @endphp

            @if ($canCancel)
                <form action="{{ route('member.checkout.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="confirm-delete-btn bg-rose-600 text-white px-6 py-2 text-2xs font-black uppercase italic tracking-widest hover:bg-black transition-all animate-pulse">
                        Abort_Order ({{ 10 - $minutesPassed }}m left)
                    </button>
                </form>
            @endif
        </div>

        <main class="max-w-4xl mx-auto pb-24">

            {{-- ORDER STATUS STEPPER --}}
            <div class="mb-20">
                <div class="flex justify-between items-center relative">
                    {{-- Progress Line --}}
                    <div class="absolute h-0.5 w-full bg-gray-100 dark:bg-white/5 top-1/2 -translate-y-1/2 z-0"></div>

                    {{-- Status Steps --}}
                    @php
                        // Tentukan urutan status berdasarkan payment method
                        if ($order->payment->method === 'COD') {
                            // COD: pending → shipped → paid → completed
                            $statuses = ['pending', 'shipped', 'paid', 'completed'];
                        } else {
                            // Transfer: pending → paid → shipped → completed
                            $statuses = ['pending', 'paid', 'shipped', 'completed'];
                        }

                        $currentIdx = array_search($order->status, $statuses);
                        if ($order->status === 'cancelled') {
                            $statuses = ['pending', 'cancelled'];
                        }
                    @endphp

                    @foreach ($statuses as $index => $step)
                        <div class="relative z-10 flex flex-col items-center gap-3">
                            <div
                                class="w-4 h-4 {{ $index <= $currentIdx || $order->status === 'completed' ? 'bg-rose-600' : 'bg-gray-200 dark:bg-white/10' }} rotate-45 transition-colors duration-700">
                            </div>
                            <span
                                class="text-[8px] font-black uppercase tracking-widest {{ $index <= $currentIdx ? 'opacity-100' : 'opacity-20' }}">
                                {{ $step }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Header Details --}}
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-gray-100 dark:border-white/5 pb-12 mb-12 gap-8">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-[0.5em] text-rose-600 mb-2 block italic">//
                        Transaction_Manifest</span>
                    <h1 class="text-6xl font-black uppercase tracking-tighter italic">#{{ $order->order_number }}</h1>
                    <p class="text-xs font-mono mt-2 opacity-50 uppercase tracking-widest">Logged:
                        {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div class="text-left md:text-right">
                    <span
                        class="text-[9px] font-black uppercase tracking-[0.3em] opacity-30 mb-2 block">Payment_Method</span>
                    <span class="text-xl font-black uppercase italic px-4 py-2 border border-black dark:border-white">
                        {{ $order->payment->method ?? 'N/A' }}
                    </span>
                </div>
            </div>

            {{-- Order Items Table --}}
            <div class="space-y-px bg-gray-100 dark:bg-white/10 border border-gray-100 dark:border-white/5 mb-12">
                @foreach ($order->items as $item)
                    <div
                        class="bg-white dark:bg-[#0a0a0a] p-6 flex items-center justify-between group transition-colors hover:bg-gray-50/50 dark:hover:bg-white/2">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-16 h-16 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 overflow-hidden">
                                @if ($item->product->image)
                                    <img src="{{ asset('storage/uploads/' . $item->product->image) }}"
                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-2xs opacity-20 italic">
                                        No_Img</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-black uppercase italic group-hover:text-rose-600 transition-colors">
                                    {{ $item->product_name }}</h3>
                                <p class="text-2xs font-bold text-rose-600 uppercase tracking-tighter mb-1">
                                    {{ $item->variant_name }}</p>
                                <p class="text-2xs font-mono opacity-50 uppercase tracking-tighter">Qty:
                                    {{ $item->quantity }} × IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black italic">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Summary & Shipping --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Shipping Info --}}
                <div class="border border-gray-100 dark:border-white/5 p-8 relative overflow-hidden">
                    {{-- Dekorasi background --}}
                    <div
                        class="absolute top-0 right-0 p-2 opacity-5 text-4xl font-black uppercase italic pointer-events-none">
                        SHIP</div>

                    <span
                        class="text-[9px] font-black uppercase tracking-[0.3em] opacity-30 mb-6 block italic">Destination_Protocol</span>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[8px] font-black uppercase text-gray-400">Shipping_Address</p>
                            <p class="text-xs leading-relaxed opacity-70 font-mono italic">
                                {{ $order->shipping_address }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Financial Calculation --}}
                <div class="flex flex-col justify-end">
                    <div class="space-y-2">
                        <div class="flex justify-between text-2xs uppercase font-bold opacity-40">
                            <span>Subtotal</span>
                            <span>IDR {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-2xs uppercase font-bold opacity-40">
                            <span>Shipping_Fee</span>
                            <span class="text-rose-600 italic">FREE_FOR_SIMULATION</span>
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-white/5 flex justify-between items-end">
                            <span class="text-2xs font-black uppercase tracking-[0.3em]">Total_Grand</span>
                            <span class="text-4xl font-black italic tracking-tighter">IDR
                                {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Admin Notes / Message --}}
            @if ($order->status === 'cancelled')
                <div class="mt-12 p-6 border border-rose-600/20 bg-rose-600/5 text-center">
                    <p class="text-rose-600 text-xs font-black uppercase tracking-[0.3em]">
                        This_Order_Has_Been_Terminated</p>
                </div>
            @endif

        </main>
    </div>
</x-member-layout>
