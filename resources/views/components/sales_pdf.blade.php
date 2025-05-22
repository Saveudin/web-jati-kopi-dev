<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                @foreach ($sale->saleItems as $item)
                    <tr>
                        <td>{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $item->product->name ?? 'Produk tidak ditemukan' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->quantity * $item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total Pendapatan</strong></td>
                <td><strong>Rp{{ number_format($totalRevenue, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="text-align:right; margin-top:20px;font-family: 'helvetica', sans-serif;">
        <div style="margin-bottom:5rem;">
                Jati Kopi
             {{ now()->format('d-m-Y H:i') }}
        </div>
        <div>
            {{ $sale->User->name }}
        </div>
    </div>
</body>
</html>
