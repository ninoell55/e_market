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

        <div class="w-full space-y-6">
            {{-- Top Quick Info Bar --}}
            <div
                class="bg-white dark:bg-[#0A0A0B] p-6 rounded-4xl border border-gray-100 dark:border-white/5 flex flex-wrap items-center justify-between gap-6 shadow-sm">
                <div class="flex items-center gap-6">
                    <div class="p-4 bg-rose-600 rounded-2xl shadow-lg shadow-rose-600/20 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black dark:text-white tracking-tighter uppercase italic">Order
                            #{{ $order->order_number }}</h1>
                        <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">
                            {{ $order->created_at->format('d F Y • H:i') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-8">
                    <div class="hidden md:block text-right">
                        <span class="text-2xs font-black text-gray-400 uppercase tracking-widest block mb-1">Grand
                            Total</span>
                        <span class="text-2xl font-black text-rose-600 italic">IDR
                            {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="h-10 w-px bg-gray-100 dark:bg-white/10 hidden md:block"></div>
                    <div class="flex flex-col items-end">
                        <span class="text-2xs font-black text-gray-400 uppercase tracking-widest mb-2">Process
                            Status</span>
                        <span
                            class="px-5 py-1.5 rounded-full text-2xs font-black uppercase tracking-widest border 
                    {{ $order->status === 'completed' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-rose-500/10 text-rose-600 border-rose-500/20' }}">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Left Column: Manifest & Address --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- Item Manifest --}}
                    <div
                        class="bg-white dark:bg-[#0A0A0B] rounded-[2.5rem] border border-gray-100 dark:border-white/5 overflow-hidden shadow-sm">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-[0.2em]">
                                    Package Content</h3>
                                <span
                                    class="text-2xs font-bold text-gray-400 uppercase italic">{{ count($order->items) }}
                                    positions</span>
                            </div>

                            <div class="space-y-4">
                                @foreach ($order->items as $item)
                                    <div
                                        class="group flex items-center justify-between p-4 rounded-3xl hover:bg-gray-50 dark:hover:bg-white/2 transition-all border border-transparent hover:border-gray-100 dark:hover:border-white/5">
                                        <div class="flex items-center gap-5">
                                            <div class="relative">
                                                <div
                                                    class="w-14 h-14 bg-gray-100 dark:bg-white/5 rounded-2xl flex items-center justify-center overflow-hidden">
                                                    @if ($item->product->image)
                                                        <img src="{{ asset('storage/uploads/' . $item->product->image) }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <span
                                                            class="text-2xs font-black text-gray-400 uppercase tracking-tighter">Item</span>
                                                    @endif
                                                </div>
                                                <div
                                                    class="absolute -top-2 -right-2 w-6 h-6 bg-white dark:bg-gray-900 border border-gray-100 dark:border-white/10 rounded-full flex items-center justify-center shadow-sm">
                                                    <span
                                                        class="text-[9px] font-black text-rose-600">{{ $item->quantity }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.product.index', ['search' => $item->product_name]) }}"
                                                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-tight hover:text-rose-600 transition-colors">
                                                    {{ $item->product_name }}
                                                </a>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span
                                                        class="text-2xs font-bold text-gray-400 uppercase tracking-widest">{{ $item->variant_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xs font-bold text-gray-400 uppercase mb-1">Subtotal</p>
                                            <p class="text-sm font-black text-gray-900 dark:text-white italic">IDR
                                                {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Address Box --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div
                            class="bg-white dark:bg-[#0A0A0B] p-8 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-sm relative overflow-hidden group">
                            <span
                                class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em] block mb-4">Customer
                                Details</span>
                            <a href="{{ route('admin.user.index', ['search' => $order->user->name]) }}"
                                class="text-sm font-black dark:text-white hover:text-rose-600 block transition-colors">
                                {{ $order->user->name }}
                            </a>
                            <p class="text-2xs font-bold text-gray-400 mt-1 tracking-widest">
                                {{ $order->user->email }}</p>
                            <div
                                class="absolute right-6 top-6 opacity-5 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                </svg>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-[#0A0A0B] p-8 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-sm relative overflow-hidden group">
                            <span
                                class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em] block mb-4">Shipping
                                Destination</span>
                            <p class="text-xs font-bold text-gray-600 dark:text-gray-400 leading-relaxed">
                                {{ $order->shipping_address ?? 'Pickup point only' }}
                            </p>
                            <div
                                class="absolute right-6 top-6 opacity-5 group-hover:scale-110 transition-transform duration-500 text-rose-600">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Evidence & Action --}}
                <div class="lg:col-span-4 space-y-6">

                    {{-- Action Control Center --}}
                    <div
                        class="bg-gray-900 dark:bg-rose-600 p-8 rounded-[2.5rem] shadow-xl relative overflow-hidden group shadow-rose-500/10">
                        <h3 class="text-2xs font-black text-white/50 uppercase tracking-[0.2em] mb-6">
                            Action Center
                        </h3>

                        <div class="space-y-3 relative z-10">
                            @if ($order->status === 'pending' && $order->payment->method === 'Transfer')
                                <form action="{{ route('admin.checkout.approve', $order->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="w-full py-4 bg-white text-gray-900 text-2xs font-black uppercase tracking-widest rounded-2xl hover:scale-[1.02] transition-all active:scale-95 shadow-xl">
                                        Verify Payment
                                    </button>
                                </form>
                            @endif

                            @if ($order->status === 'paid' || ($order->status === 'pending' && $order->payment->method === 'COD'))
                                <form action="{{ route('admin.checkout.ship', $order->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="w-full py-4 bg-white text-gray-900 text-2xs font-black uppercase tracking-widest rounded-2xl hover:scale-[1.02] transition-all active:scale-95 shadow-xl">
                                        Mark as Shipped
                                    </button>
                                </form>
                            @endif

                            @if ($order->status === 'shipped')
                                <form action="{{ route('admin.checkout.complete', $order->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="w-full py-4 bg-emerald-500 text-white text-2xs font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-600 transition-all active:scale-95 shadow-xl shadow-emerald-900/20">
                                        Complete Process
                                    </button>
                                </form>
                            @endif

                            @if ($order->status === 'pending')
                                <form action="{{ route('admin.checkout.cancel', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to cancel this order? This will restore the product stock.')">
                                    @csrf
                                    <button
                                        class="confirm-delete-btn w-full py-4 bg-red-500 text-white text-2xs font-black uppercase tracking-widest rounded-2xl hover:bg-red-600 transition-all active:scale-95 shadow-xl shadow-red-900/20"
                                        title="Cancel Order" data-confirm-title="Are you sure?"
                                        data-confirm-text="This action cannot be undone and will restore the product stock."
                                        data-confirm-button="YES, CANCEL IT">
                                        Cancel Order
                                    </button>
                                </form>
                            @endif

                            @if ($order->status === 'completed')
                                <div
                                    class="p-6 border border-white/20 rounded-2xl text-center bg-white/5 backdrop-blur-sm">
                                    <span
                                        class="text-2xs font-black text-white/70 uppercase tracking-widest">Transaction
                                        Closed</span>
                                </div>
                            @endif

                            @if ($order->status === 'cancelled')
                                <div
                                    class="p-6 border border-white/20 rounded-2xl text-center bg-red-500/10 backdrop-blur-sm">
                                    <span class="text-2xs font-black text-red-400 uppercase tracking-widest">Order
                                        Cancelled</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Proof Image --}}
                    <div
                        class="bg-white dark:bg-[#0A0A0B] p-8 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Payment
                                Vault</span>
                            <span
                                class="px-3 py-1 bg-gray-50 dark:bg-white/5 rounded-lg text-[9px] font-black dark:text-gray-300 uppercase tracking-widest">{{ $order->payment->method }}</span>
                        </div>

                        <div
                            class="relative group cursor-zoom-in rounded-4xl overflow-hidden bg-gray-50 dark:bg-white/2 border border-gray-100 dark:border-white/5">
                            @if ($order->payment->proof_image)
                                <img src="{{ asset('storage/' . $order->payment->proof_image) }}"
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                            @else
                                <div
                                    class="w-full h-full flex p-10 flex-col items-center justify-center text-gray-300 dark:text-gray-700">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="text-[9px] font-black uppercase tracking-widest">No Proof Data</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
