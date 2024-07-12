<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDAH FLOWER SHOP</title>
    <link rel="stylesheet" href="styles.css">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,
    wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;
    1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
    rel="stylesheet">

    <style>
        /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    color: #333;
}

h1, p {
    margin: 0;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Header Styles */
header.bg-gradient {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    color: white;
    padding: 60px 0;
    text-align: center;
}

header h1 {
    font-weight: 600;
    font-style: normal;
    font-size: 70px;
    margin-bottom: 10px;
}

header p {
    font-size: 1.2em;
}

/* Section Styles */
section.py-5 {
    padding: 3rem 0;
}

.grid {
    display: block;
    align-items:center;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Card Styles */
.card {
    background: white;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.card-body {
    padding: 20px;
    text-align: center;
}

.card-title {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.card-text {
    font-size: 1em;
    margin-bottom: 20px;
}

.btn-gradient {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(90deg, #182848, #4b6cb7);
}

/* Footer Styles */
footer.bg-gradient {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    font-size: 25px;
    text-align: center;
    color: white;
    padding: 20px 0;
    margin-top: 3rem;
}

    </style>
</head>
<body>
    <header class="bg-gradient">
        <div class="container">
            <h1>INDAH FLOWER SHOP</h1>
            <p>Temukan dan pesan bunga favorit Anda!</p>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            <div class="grid">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Customer</h5>
                        <p class="card-text">Tambah atau cari data customer.</p>
                        <a href="customer.php" class="btn btn-gradient">Lihat Customer</a>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Bunga</h5>
                        <p class="card-text">Lihat berbagai macam bunga yang ready.</p>
                        <a href="bunga.php" class="btn btn-gradient">Lihat Bunga</a>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pemesanan</h5>
                        <p class="card-text">Lakukan pemesanan bunga favorit Anda.</p>
                        <a href="pesanan.php" class="btn btn-gradient">Lihat Pemesanan</a>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Stok Bunga</h5>
                        <p class="card-text">Penambahan Stok Bunga</p>
                        <a href="addstock.php" class="btn btn-gradient">Lihat Stok</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-gradient text-white text-center py-3">
        <div class="container">
            <p>Salam Hangat Kelompok 5 :D</p>
        </div>
    </footer>
</body>
</html>
