<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital_Receipt_Archive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Efek tekstur kertas thermal */
        .receipt-paper {
            background: #fff;
            position: relative;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
        }

        /* Guntingan zigzag di bawah struk */
        .zigzag {
            height: 10px;
            background: linear-gradient(-45deg, transparent 5px, #fff 0), linear-gradient(45deg, transparent 5px, #fff 0);
            background-size: 10px 10px;
            width: 100%;
            position: absolute;
            bottom: -10px;
            left: 0;
        }
    </style>
</head>

<body class="bg-[#f0f0f0] p-4 md:p-10 flex justify-center items-start min-h-screen">

    <div class="receipt-paper w-full max-w-[380px] p-8 border-t-[12px] border-black">

        {{-- Header Struk --}}
        <div class="text-center mb-10">
            <h1 class="text-2xl font-black italic tracking-tighter uppercase mb-1">
                The_Archive<span class="text-rose-600">.</span>
            </h1>
            <p class="text-[9px] font-bold uppercase tracking-[0.3em] opacity-40">Official_Payment_Gateway</p>
            <div class="mt-4 border-y border-black border-double py-1">
                <p class="text-[10px] font-black uppercase tracking-widest">Digital_Receipt</p>
            </div>
        </div>

        {{-- Meta Data (Sesuai Auth & Transaction) --}}
        <div class="text-[10px] space-y-2 mb-8 uppercase font-bold tracking-tight">
            <div class="flex justify-between">
                <span class="opacity-40">Registry_User:</span>
                <span>{{ Auth::user()->username }}</span>
            </div>
            <div class="flex justify-between">
                <span class="opacity-40">Timestamp:</span>
                <span>{{ $date }}</span>
            </div>
        </div>

        {{-- Item List (Looping dari Database cart_items) --}}
        <div class="space-y-5 mb-10">
            <div class="border-b border-black/10 pb-2 mb-2">
                <p class="text-[9px] font-black opacity-30 uppercase tracking-[0.2em]">Purchase_Manifest:</p>
            </div>

            @foreach ($cart->items as $item)
                <div class="flex justify-between items-start text-[11px] font-bold uppercase leading-tight">
                    <div class="max-w-[70%]">
                        <p class="tracking-tighter">{{ $item->product->name }}</p>
                        <p class="text-[9px] opacity-40 mt-1 italic">
                            {{ $item->quantity }}x IDR {{ number_format($item->variant->price, 0, ',', '.') }}
                        </p>
                        @if ($item->variant)
                            <p class="text-[8px] text-rose-600 font-black mt-0.5">
                                [{{ $item->variant->attribute_value }}]</p>
                        @endif
                    </div>
                    <span
                        class="tabular-nums">{{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        {{-- Summary Total --}}
        <div class="border-t-2 border-black border-dashed pt-6 mb-10">
            <div class="flex justify-between items-center mb-2">
                <span class="text-[10px] font-black uppercase tracking-widest opacity-40">Subtotal</span>
                <span class="text-xs font-bold tabular-nums">{{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-end">
                <span class="text-[11px] font-black uppercase tracking-[0.3em]">Total_Due</span>
                <span class="text-3xl font-black italic tracking-tighter tabular-nums">
                    Rp{{ number_format($total, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- QR Status (Visual) --}}
        <div class="bg-black text-white p-5 text-center mb-6">
            <p class="text-[10px] font-black uppercase tracking-[0.4em] mb-1">Status: VALIDATED</p>
            <p class="text-[7px] font-medium opacity-60 uppercase">Transaction_Verified_By_System</p>
        </div>

        {{-- Instruction for User --}}
        <div class="text-center space-y-4">
            <p class="text-[9px] font-bold text-rose-600 uppercase leading-relaxed italic">
                Please_Scan_The_QR_Code_Below_To_Access_Your_Digital_Receipt
            </p>
            <div class="opacity-10 text-[7px] font-black uppercase tracking-[0.5em] pt-4">
                The_Archive_Digital_Protocol // 2026
            </div>
        </div>

        {{-- Zigzag Dekoratif --}}
        <div class="zigzag"></div>
    </div>

</body>

</html>
