<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Receipt Archive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Efek kertas thermal yang lebih nyata */
        .receipt-paper {
            background: #fff;
            position: relative;
            /* Shadow yang lebih soft agar tidak terlihat kotor */
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        }

        /* Guntingan zigzag di bawah struk */
        .zigzag {
            height: 10px;
            background: linear-gradient(-45deg, transparent 5px, #fff 0),
                linear-gradient(45deg, transparent 5px, #fff 0);
            background-size: 10px 10px;
            width: 100%;
            position: absolute;
            bottom: -10px;
            left: 0;
        }
    </style>
</head>

<body class="bg-[#f8f8f8] p-6 md:p-12 flex justify-center items-start min-h-screen">

    <div class="receipt-paper w-full max-w-sm p-8 border-t-12 border-black">

        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black italic tracking-tighter uppercase mb-1">
                The Archive<span class="text-rose-600">.</span>
            </h1>
            <p class="text-[9px] font-black uppercase tracking-[0.4em] opacity-40">Official Payment Gateway</p>

            <div class="mt-6 border-y border-black py-2">
                <p class="text-[11px] font-black uppercase tracking-[0.2em]">Digital Receipt</p>
            </div>
        </div>

        {{-- Meta Data --}}
        <div class="text-[11px] space-y-2 mb-10 uppercase font-bold tracking-tight border-b border-gray-100 pb-8">
            <div class="flex justify-between">
                <span class="opacity-40">Registry User</span>
                <span>{{ Auth::user()->username }}</span>
            </div>
            <div class="flex justify-between">
                <span class="opacity-40">Timestamp</span>
                <span>{{ $date }}</span>
            </div>
        </div>

        {{-- Item List --}}
        <div class="space-y-6 mb-12">
            <p class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em]">Purchase Manifest</p>

            @foreach ($cart->items as $item)
                <div class="flex justify-between items-start text-[12px] font-bold uppercase leading-tight">
                    <div class="max-w-[65%] space-y-1">
                        <p class="tracking-tighter">{{ $item->product->name }}</p>
                        @if ($item->variant)
                            <p class="text-2xs text-rose-600 font-black">
                                {{ $item->variant->attribute_value }}
                            </p>
                        @endif
                        <p class="text-2xs opacity-40 italic font-medium">
                            {{ $item->quantity }} x {{ number_format($item->variant->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <span class="tabular-nums text-right">
                        {{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}
                    </span>
                </div>
            @endforeach
        </div>

        {{-- Summary Total --}}
        <div class="border-t-2 border-black border-dashed pt-8 mb-10">
            <div class="flex justify-between items-end">
                <span class="text-[11px] font-black uppercase tracking-[0.3em] mb-2">Total Due</span>
                <span class="text-4xl font-black italic tracking-tighter tabular-nums">
                    Rp{{ number_format($total, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- Status Box --}}
        <div class="bg-black text-white p-5 text-center mb-10">
            <p class="text-2xs font-black uppercase tracking-[0.5em] mb-1">Status: Validated</p>
            <p class="text-[8px] font-medium opacity-60 uppercase tracking-widest">Transaction Verified By System</p>
        </div>

        {{-- Footer --}}
        <div class="text-center space-y-6">
            <p class="text-2xs font-bold text-gray-400 uppercase leading-relaxed italic px-4">
                Thank you for your purchase. Please keep this digital receipt for your archives.
            </p>

            <div class="pt-6 border-t border-gray-100">
                <div class="opacity-20 text-[8px] font-black uppercase tracking-[0.6em]">
                    The Archive Digital Protocol // 2026
                </div>
            </div>
        </div>

        {{-- Zigzag Dekoratif --}}
        <div class="zigzag"></div>
    </div>

</body>

</html>
