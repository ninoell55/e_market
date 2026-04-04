<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        /* Setup Halaman */
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            text-transform: uppercase;
            color: #1a1a1a;
            margin: 0;
            padding: 20px;
            line-height: 1.4;
        }

        /* Tipografi & Identitas */
        .header {
            border-bottom: 4px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            letter-spacing: -1px;
            font-style: italic;
            font-weight: 900;
        }

        .header p {
            font-size: 10px;
            color: #666;
            margin: 5px 0 0 0;
            letter-spacing: 2px;
            font-weight: bold;
        }

        /* Grid Statistik Utama */
        .stats-container {
            width: 100%;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #f9f9f9;
            border: 1px solid #eeeeee;
            padding: 20px;
            width: 45%;
            display: inline-block;
            vertical-align: top;
        }

        .stat-card.revenue {
            background: #111111;
            color: #ffffff;
            border: none;
        }

        .label {
            font-size: 8px;
            font-weight: 900;
            color: #888;
            margin-bottom: 10px;
            display: block;
            letter-spacing: 1px;
        }

        .stat-card.revenue .label {
            color: #e11d48;
        }

        .value {
            font-size: 18px;
            font-weight: 900;
            font-style: italic;
        }

        /* Tabel Styling */
        h3 {
            font-size: 12px;
            font-weight: 900;
            border-left: 4px solid #e11d48;
            padding-left: 10px;
            margin: 30px 0 15px 0;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f0f0f0;
            text-align: left;
            padding: 12px 10px;
            font-size: 9px;
            font-weight: 900;
            border-bottom: 2px solid #000;
        }

        td {
            padding: 10px;
            font-size: 10px;
            border-bottom: 1px solid #eeeeee;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-rose {
            color: #e11d48;
        }

        .text-muted {
            color: #888;
            font-size: 8px;
        }

        /* Footer PDF */
        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            font-size: 8px;
            color: #aaa;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Executive_Summary<span style="color: #e11d48;">.</span></h1>
        <p>Report_Period: {{ $filters['date'] ?? $filters['month'] . '/' . $filters['year'] }}</p>
    </div>

    <div class="stats-container">
        <div class="stat-card revenue">
            <span class="label">// Net_Revenue</span>
            <div class="value">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>

        <div class="stat-card" style="margin-left: 20px;">
            <span class="label">// Total_Orders</span>
            <div class="value" style="color: #111;">{{ $totalOrders }} Transactions</div>
        </div>
    </div>

    {{-- Produk Terlaris --}}
    <h3>Top_Selling_Inventory</h3>
    <table>
        <thead>
            <tr>
                <th>Product_Name</th>
                <th class="text-right">Qty_Sold</th>
                <th class="text-right">Total_Value</th>
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
    <h3>Under_Performing_Stock</h3>
    <table>
        <thead>
            <tr>
                <th>Product_Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($slowMoving as $slow)
                <tr>
                    <td>{{ $slow->name }}</td>
                    <td class="text-muted italic">No sales recorded in this period</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-muted">All inventory items are performing optimally.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Ringkasan Transaksi --}}
    <h3>Transaction_Audit_Log</h3>
    <table>
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Order_ID</th>
                <th class="text-right">Settlement</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->created_at->format('d.m.Y / H:i') }}</td>
                    <td>#{{ $order->order_number }}</td>
                    <td class="text-right">IDR {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated_by_System_Admin - {{ now()->format('d/m/Y H:i:s') }} - Internal Confidential
    </div>

</body>

</html>
