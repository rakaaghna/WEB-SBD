<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Flower Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Additional styling specific to home page */
        .bg-gradient {
            background: linear-gradient(90deg, #f54ea2, #c533ec); /* Gradient from pink to purple */
            text-align: center;
            padding: 100px 0;
            color: #fff;
            font-size: 2rem;
        }
        .btn-gradient {
            background: linear-gradient(90deg, #f54ea2, #c533ec);
            border-color: #f54ea2;
            color: #fff;
            transition: transform 0.3s ease;
        }
        .btn-gradient:hover {
            transform: scale(1.05); /* Scale up on hover */
        }
    </style>
</head>
<body>
    <header class="bg-gradient">
        <h1>INDAH FLOWER SHOP</h1>
        <p>Temukan dan pesan bunga favorit Anda!</p>
    </header>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Customer</h5>
                            <p class="card-text">Tambah atau cari data customer.</p>
                            <a href="customer.php" class="btn btn-gradient">Lihat Customer</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Daftar Bunga</h5>
                            <p class="card-text">Lihat berbagai macam bunga yang ready.</p>
                            <a href="bunga.php" class="btn btn-gradient">Lihat Bunga</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pemesanan</h5>
                            <p class="card-text">Lakukan pemesanan bunga favorit Anda.</p>
                            <a href="pesanan.php" class="btn btn-gradient">Lihat Pemesanan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Stok Bunga</h5>
                            <p class="card-text">Penambahan Stok Bunga</p>
                            <a href="addstock_bunga.php" class="btn btn-gradient">Lihat Stok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-gradient text-white text-center py-3">
        <p>Salam Hangat Kelompok 5 :D</p>
    </footer>
</body>
</html>


