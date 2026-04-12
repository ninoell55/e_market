<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        /* Setup Halaman */
        @page {
            margin: 0;
            /* Menghilangkan margin default agar bisa dikontrol via body */
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #0f172a;
            margin: 0;
            padding: 40px;
            line-height: 1.5;
            background-color: #ffffff;
        }

        /* Tipografi & Identitas */
        .header {
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 30px;
            margin-bottom: 40px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header h1 {
            font-size: 32px;
            margin: 0;
            letter-spacing: -1.5px;
            font-style: italic;
            font-weight: 900;
            text-transform: uppercase;
        }

        .header p {
            font-size: 11px;
            color: #64748b;
            margin: 8px 0 0 0;
            letter-spacing: 2px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Grid Statistik Utama - Menggunakan Table untuk kompatibilitas PDF */
        .stats-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 15px 0;
            margin-left: -15px;
            /* Kompensasi spacing */
            margin-bottom: 40px;
        }

        .stat-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 25px;
            border-radius: 20px;
        }

        .stat-card.dark {
            background: #0f172a;
            color: #ffffff;
            border: none;
        }

        .label {
            font-size: 9px;
            font-weight: 900;
            color: #94a3b8;
            margin-bottom: 12px;
            display: block;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .stat-card.dark .label {
            color: #e11d48;
        }

        .value {
            font-size: 22px;
            font-weight: 900;
            font-style: italic;
        }

        /* Tabel Styling */
        h3 {
            font-size: 13px;
            font-weight: 900;
            border-left: 5px solid #e11d48;
            padding-left: 15px;
            margin: 40px 0 20px 0;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #1e293b;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
        }

        th {
            background: #f8fafc;
            text-align: left;
            padding: 15px;
            font-size: 10px;
            font-weight: 900;
            color: #475569;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 15px;
            font-size: 11px;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 500;
        }

        .link-style {
            color: #0f172a;
            text-decoration: none;
            border-bottom: 1px solid #e2e8f0;
        }

        .text-right {
            text-align: right;
        }

        .text-rose {
            color: #e11d48;
            font-weight: 900;
        }

        .text-muted {
            color: #94a3b8;
            font-size: 10px;
            font-style: italic;
        }

        /* Footer PDF */
        .footer {
            position: fixed;
            bottom: 30px;
            left: 40px;
            right: 40px;
            font-size: 9px;
            color: #94a3b8;
            text-align: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td>
                    <h1>Executive Summary<span style="color: #e11d48;">.</span></h1>
                    <p>Report Period:
                        {{ $filters['date'] ?? $filters['month'] . ' / ' . ($filters['year'] ?? now()->year) }}</p>
                </td>
                <td class="text-right">
                    <p style="color: #e11d48">Business Intelligence Unit</p>
                    <p style="font-size: 8px">Internal Confidential Document</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="stats-table">
        <tr>
            <td width="50%">
                <div class="stat-card dark">
                    <span class="label">Net Revenue</span>
                    <div class="value">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </td>
            <td width="50%">
                <div class="stat-card">
                    <span class="label">Total Transactions</span>
                    <div class="value">{{ $totalOrders }} Units</div>
                </div>
            </td>
        </tr>
    </table>

    {{-- Produk Terlaris --}}
    <h3>Top Performing Inventory</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th class="text-right">Quantity Sold</th>
                <th class="text-right">Total Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bestSellers as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td class="text-right">{{ $product->total_qty }} Units</td>
                    <td class="text-right text-rose">IDR {{ number_format($product->total_sales, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Produk Kurang Laku --}}
    <h3>Low Velocity Stock</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Performance Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($slowMoving as $slow)
                <tr>
                    <td>{{ $slow->name }}</td>
                    <td class="text-muted">No sales recorded during this period</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-muted">All inventory items are performing at optimal levels.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Ringkasan Transaksi --}}
    <h3>Transaction History Log</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Reference ID</th>
                <th class="text-right">Settlement</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->created_at->format('d M Y • H:i') }}</td>
                    <td>
                        <span class="link-style">#{{ $order->order_number }}</span>
                    </td>
                    <td class="text-right">IDR {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Automated System Report — {{ now()->format('d F Y / H:i:s') }} — Page 1 of 1
    </div>

</body>

</html>
