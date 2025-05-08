## Web JatiKopi

web jatikopi adalah sebuah sistem informasi berbasis web. Dalam developmennya menggunakan Laravel, Tailwindcss, Javascript. Fitur yang ada :

- Manajemen Produk.
  Menambahkan, mengedit, dan menghapus produk. Setiap produk dapat memiliki resep (komposisi bahan baku) yang digunakan saat penjualan. Harga produk tercatat dan digunakan dalam transaksi penjualan.
- Manajemen bahan baku (Raw Materials).
  Menambahkan bahan baku baru dengan informasi seperti nama, harga, stok awal, dan satuan. Melakukan pencatatan otomatis ke dalam tabel stock_movements setiap kali bahan baku ditambahkan.
- Penjualan (Sales).
  Mencatat transaksi penjualan dengan memilih produk dan jumlahnya. Total penjualan dihitung otomatis dari harga produk × jumlah. Setiap transaksi mencatat item penjualan ke tabel sale_items
- Pengurangan stock otomatis.
  Saat produk dijual, stok bahan baku akan otomatis dikurangi sesuai resep yang dimiliki produk.
Jika stok bahan baku tidak mencukupi, transaksi tidak akan dilanjutkan.
- Laporan penjualan.
  Menampilkan daftar penjualan dengan tanggal, total, dan detail item yang terjual. Total pendapatan ditampilkan dari akumulasi seluruh subtotal.
- Grafik Penjualan.
  Menampilkan visualisasi data penjualan menggunakan grafik untuk melihat tren secara bulanan.
- Export PDF.
  Laporan penjualan dapat diunduh dalam format PDF. PDF mencakup semua data penjualan dan total pendapatan.
- Manajemen Pergerakan Stock.
  Setiap perubahan stok bahan baku (penambahan atau pengurangan) dicatat otomatis ke tabel stock_movements. Tipe pergerakan mencakup: in (stok masuk), usage (pemakaian saat penjualan), dan lainnya jika dibutuhkan. Tampilan riwayat pergerakan mencantumkan bahan baku, jumlah perubahan, tipe, catatan, serta waktu kejadian.
