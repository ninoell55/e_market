<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-6 lg:px-12 min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white antialiased">

        {{-- Navigation Back --}}
        <div class="py-12">
            <a href="{{ route('archive.orders') }}" class="group inline-flex items-center gap-2">
                <span
                    class="text-2xs font-black uppercase tracking-[0.3em] opacity-30 group-hover:opacity-100 group-hover:text-rose-600 transition-all">
                    ← Return_To_Archive
                </span>
            </a>
        </div>

        <main class="max-w-4xl mx-auto pb-24">
            {{-- Header Details --}}
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-gray-100 dark:border-white/5 pb-12 mb-12 gap-8">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-[0.5em] text-rose-600 mb-2 block italic">//
                        Transaction_Manifest</span>
                    <h1 class="text-6xl font-black uppercase tracking-tighter italic">#{{ $order->id }}</h1>
                    <p class="text-xs font-mono mt-2 opacity-50 uppercase tracking-widest">Logged:
                        {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div class="text-left md:text-right">
                    <span
                        class="text-[9px] font-black uppercase tracking-[0.3em] opacity-30 mb-2 block">Current_Status</span>
                    <span class="text-xl font-black uppercase italic px-4 py-2 border border-black dark:border-white">
                        {{ $order->status ?? 'Processing' }}
                    </span>
                </div>
            </div>

            {{-- Order Items Table --}}
            <div class="space-y-px bg-gray-100 dark:bg-white/10 border border-gray-100 dark:border-white/5 mb-12">
                @foreach ($order->items as $item)
                    <div class="bg-white dark:bg-[#0a0a0a] p-6 flex items-center justify-between group">
                        <div class="flex items-center gap-6">
                            {{-- Product Image Placeholder --}}
                            <div
                                class="w-16 h-16 bg-gray-50 dark:bg-white/2 border border-gray-100 dark:border-white/5 overflow-hidden">
                                @if ($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-2xs opacity-20 italic">
                                        No_Img</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-black uppercase italic group-hover:text-rose-600 transition-colors">
                                    {{ $item->product->name }}</h3>
                                <p class="text-2xs font-mono opacity-50 uppercase tracking-tighter">Qty:
                                    {{ $item->quantity }} × IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black italic">IDR
                                {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Summary & Shipping --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Shipping Info --}}
                <div class="border border-gray-100 dark:border-white/5 p-8">
                    <span
                        class="text-[9px] font-black uppercase tracking-[0.3em] opacity-30 mb-6 block italic">Destination_Protocol</span>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[8px] font-black uppercase text-gray-400">Recipient</p>
                            <p class="font-bold uppercase tracking-tight italic">{{ $order->recipient_name ?? 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[8px] font-black uppercase text-gray-400">Address_String</p>
                            <p class="text-xs leading-relaxed opacity-70">
                                {{ $order->shipping_address ?? 'No address recorded' }}</p>
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
                            <span>IDR 0</span>
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-white/5 flex justify-between items-end">
                            <span class="text-2xs font-black uppercase tracking-[0.3em]">Total_Grand</span>
                            <span class="text-4xl font-black italic tracking-tighter">IDR
                                {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-member-layout>
