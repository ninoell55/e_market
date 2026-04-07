<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Breadcrumb & Header --}}
        <div class="px-4 sm:px-0 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">
                    Order Detail
                </h3>
                <p class="text-2xs font-bold text-gray-400 uppercase tracking-[0.3em] mt-1">
                    Registry_ID: <span class="text-gray-900 dark:text-gray-200">#{{ $order->order_number }}</span>
                </p>
            </div>

            <a href="{{ route('admin.checkout.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-gray-500 hover:text-rose-600 transition-all uppercase tracking-widest ml-6 md:ml-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                Back to collection
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- Left Side: Customer & Items (Main Info) --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- Item Manifest Card --}}
                <div
                    class="bg-white dark:bg-gray-950 rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-sm overflow-hidden">
                    <div
                        class="px-8 py-6 border-b border-gray-50 dark:border-gray-900 bg-gray-50/50 dark:bg-gray-900/50 flex justify-between items-center">
                        <span
                            class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-widest italic">Item_Manifest</span>
                        <span class="text-2xs font-bold text-gray-400 uppercase">{{ count($order->items) }}
                            Positions Recorded</span>
                    </div>

                    <div class="p-8">
                        <div class="space-y-6">
                            @foreach ($order->items as $item)
                                <div class="flex justify-between items-center group">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-gray-50 dark:bg-gray-900 rounded-xl flex items-center justify-center text-xs font-black text-gray-300">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-tight group-hover:text-rose-600 transition-colors">
                                                {{ $item->product_name }}
                                            </span>
                                            <span class="text-2xs font-bold text-gray-400 uppercase tracking-widest">
                                                {{ $item->variant_name }} <span class="mx-2 text-gray-200">/</span>
                                                QTY: {{ $item->quantity }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-black text-gray-900 dark:text-white italic">
                                            IDR {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Financial Summary --}}
                        <div
                            class="mt-10 pt-8 border-t-2 border-dashed border-gray-100 dark:border-gray-900 grid grid-cols-2 gap-8">
                            <div>
                                <span
                                    class="text-2xs font-black text-gray-400 uppercase tracking-widest block mb-1">Customer_Details</span>
                                <p class="text-sm font-black dark:text-white uppercase">{{ $order->user->name }}
                                </p>
                                <p class="text-2xs font-bold text-gray-400 uppercase mt-1">
                                    {{ $order->user->email }}</p>
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-2xs font-black text-rose-600 uppercase tracking-widest block mb-1">Grand_Total</span>
                                <h4 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter italic">
                                    IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address / Logistics Info (Optional but recommended) --}}
                <div
                    class="bg-white dark:bg-gray-950 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-sm flex items-start gap-6">
                    <div class="p-4 bg-rose-50 dark:bg-rose-500/10 rounded-2xl text-rose-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xs font-black text-gray-400 uppercase tracking-widest block mb-2 italic">//
                            Delivery_Destination</span>
                        <p class="text-xs font-bold text-gray-600 dark:text-gray-400 leading-relaxed uppercase">
                            {{ $order->shipping_address ?? 'No address provided in manifest' }}
                        </p>
                    </div>
                </div>

                <div
                    class="inline-block bg-gray-50 dark:bg-gray-900 px-6 py-3 rounded-2xl border border-gray-100 dark:border-gray-800">
                    <span class="text-2xs font-black text-gray-400 uppercase tracking-widest">Current_Status:</span>
                    <span
                        class="text-xs font-black uppercase italic {{ $order->status === 'completed' ? 'text-emerald-500' : 'text-rose-600' }}">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            {{-- Right Side: Execution & Evidence --}}
            <div class="lg:col-span-4 space-y-8">

                {{-- Execution Card (Pindahkan ke atas agar mudah dijangkau) --}}
                <div class="bg-gray-900 dark:bg-white p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                    {{-- Background Decoration --}}
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-rose-600 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity">
                    </div>

                    <span class="text-2xs font-black text-rose-500 uppercase tracking-[0.2em] block mb-6">//
                        Operational_Bridge</span>

                    <div class="space-y-4 relative z-10">
                        @if ($order->status === 'pending' && $order->payment->method === 'Transfer')
                            <form action="{{ route('admin.checkout.approve', $order->id) }}" method="POST">
                                @csrf
                                <button
                                    class="w-full px-6 py-5 bg-rose-600 text-white text-xs font-black uppercase italic rounded-2xl hover:bg-rose-700 transition-all active:scale-95 shadow-lg shadow-rose-600/20">
                                    CONFIRM_PAYMENT_DATA
                                </button>
                            </form>
                        @endif

                        @if ($order->status === 'paid' || ($order->status === 'pending' && $order->payment->method === 'COD'))
                            <form action="{{ route('admin.checkout.ship', $order->id) }}" method="POST">
                                @csrf
                                <button
                                    class="w-full px-6 py-5 bg-rose-600 text-white text-xs font-black uppercase italic rounded-2xl hover:bg-rose-700 transition-all active:scale-95 shadow-lg shadow-rose-600/20">
                                    AUTHORIZE_SHIPMENT
                                </button>
                            </form>
                        @endif

                        @if ($order->status === 'shipped')
                            <form action="{{ route('admin.checkout.complete', $order->id) }}" method="POST">
                                @csrf
                                <button
                                    class="w-full px-6 py-5 bg-emerald-600 text-white text-xs font-black uppercase italic rounded-2xl hover:bg-emerald-700 transition-all active:scale-95 shadow-lg shadow-emerald-600/20">
                                    CLOSE_MANIFEST
                                </button>
                            </form>
                        @endif

                        @if ($order->status === 'completed')
                            <div
                                class="p-6 border border-dashed border-gray-700 dark:border-gray-200 rounded-2xl text-center">
                                <span
                                    class="text-2xs font-black text-gray-500 dark:text-gray-400 uppercase italic">Transaction_Finished</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Evidence Card --}}
                <div
                    class="bg-white dark:bg-gray-950 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-2xs font-black text-gray-400 uppercase tracking-widest">//
                            Evidence_Vault</span>
                        <span
                            class="text-[9px] font-bold px-2 py-1 bg-gray-100 dark:bg-gray-900 dark:text-gray-300 rounded text-gray-500 uppercase">{{ $order->payment->method }}</span>
                    </div>

                    <div
                        class="aspect-3/4 bg-gray-50 dark:bg-gray-900 rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800 mb-6 group cursor-zoom-in">
                        @if ($order->payment->proof_image)
                            <img src="{{ asset('storage/' . $order->payment->proof_image) }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center opacity-20 italic">
                                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">No_Physical_Proof</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span
                                class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Pay_Status</span>
                            <span
                                class="text-xs font-black uppercase italic dark:text-white">{{ $order->payment->status }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span
                                class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Recorded_At</span>
                            <span
                                class="text-xs font-black uppercase italic dark:text-white">{{ $order->created_at->format('H:i / d.m.y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
