<!DOCTYPE html>
<html>
<head>
    <title>Bukti Transaksi di Jati Kopi</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .total { text-align: right; margin-top: 20px; font-size: 18px; }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>

    <h2>Nota Pembelian</h2>
    <p>Tanggal Transaksi : {{ $saleItem->first()->created_at->format('d-m-Y H:i') }}</p>
    <p>No Transaksi: {{ $saleItem->first()->id }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($saleItem as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->subtotal) }}</td>
                    <td>{{ number_format($item->subtotal * $item->quantity) }}</td>
                </tr>
                @php $grandTotal += $item->subtotal * $item->quantity; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <strong>Total: Rp {{ number_format($grandTotal) }}</strong>
    </div>

    <div style="text-align:right; margin-top:2rem;font-weight:200;">
        <div style="margin-bottom:3rem">
            Jati Kopi, Tegal {{ now()->format('d-m-Y H:i') }}
        </div>
        <strong>
            Kasir : {{ $sale->User->name }}
        </strong>
    </div>

    <button onclick="window.print()">Print</button>

</body>
</html>
