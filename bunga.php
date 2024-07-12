<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bunga - INDAH FLOWER SHOP</title>
    <link rel="stylesheet" href="styles.css">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, p {
            margin: auto;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        header.bg-gradient-flowers {
            background: linear-gradient(90deg, #4b6cb7, #182848);
            color: white;
            padding: 20px 0;
            text-align: center;
            position: relative;
            z-index: 1000;
        }

        header h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1em;
        }

        header .btn-lg {
            margin-top: 10px;
        }

        /* Navigation Bar */
        nav {
            background-color: #4b6cb7;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            transition: color 0.3s ease;
            position: relative;
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width 0.3s ease;
        }

        nav ul li a:hover {
            color: #f5f5f5;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        /* Main Section Styles */
        main.container {
            padding: 3rem 0;
            flex: 1;
        }

        .flower-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .flower-item {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 20px;
            margin: 15px;
            flex: 0 1 calc(33.333% - 30px);
            box-sizing: border-box;
            overflow: hidden;
            position: relative;
        }

        .flower-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .flower-img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .flower-item:hover .flower-img {
            transform: scale(1.05);
        }

        .flower-item h3 {
            font-size: 1.5em;
            margin-bottom: 15px;
            color: #4b6cb7;
        }

        .size-options {
            margin-bottom: 20px;
        }

        .size-options label {
            margin-right: 10px;
            font-size: 0.9em;
        }

        /* Button Styles */
        .btn-gradient-flowers {
            background: linear-gradient(90deg, #4b6cb7, #182848);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
            display: inline-block;
        }

        .btn-gradient-flowers:hover {
            background: linear-gradient(90deg, #182848, #4b6cb7);
            transform: translateY(-5px);
        }

        .btn-lg {
            font-size: 1.2em;
            padding: 12px 25px;
        }

        /* Footer Styles */
        footer.bg-gradient-flowers {
            background: linear-gradient(90deg, #182848, #4b6cb7);
            font-size: 20px;
            text-align: center;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <header class="bg-gradient-flowers text-center">
        <div class="container">
            <h1>Daftar Bunga</h1>
            <p>Pilih bunga favorit Anda.</p>
        </div>
        <!-- Navigation Bar -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pesanan.php">Pesanan</a></li>
                <li><a href="customer.php">Customer</a></li>
                <li><a href="addstock.php">Stok</a></li>
            </ul>
        </nav>
    </header>
    <main class="container my-5">
        <div class="flower-row">
            <div class="flower-item">
                <img src="img/mawar.jpg" alt="Bunga Mawar Jahat" class="flower-img">
                <h3>Mawar Jahat</h3>
                <div class="size-options">
                    <label><input type="radio" name="size1" value="small"> Small</label>
                    <label><input type="radio" name="size1" value="medium"> Medium</label>
                    <label><input type="radio" name="size1" value="large"> Large</label>
                </div>
                <a href="pesanan.php" class="btn btn-lg btn-gradient-flowers">Pilih</a>
            </div>
            <div class="flower-item">
                <img src="img/matahari_pagi.jpg" alt="Bunga Matahari Pagi" class="flower-img">
                <h3>Matahari Pagi</h3>
                <div class="size-options">
                    <label><input type="radio" name="size2" value="small"> Small</label>
                    <label><input type="radio" name="size2" value="medium"> Medium</label>
                    <label><input type="radio" name="size2" value="large"> Large</label>
                </div>
                <a href="pesanan.php" class="btn btn-lg btn-gradient-flowers">Pilih</a>
            </div>
            <div class="flower-item">
                <img src="img/lily.jpg" alt="Bunga Lily was a little girl" class="flower-img">
                <h3>Lily was a little girl</h3>
                <div class="size-options">
                    <label><input type="radio" name="size3" value="small"> Small</label>
                    <label><input type="radio" name="size3" value="medium"> Medium</label>
                    <label><input type="radio" name="size3" value="large"> Large</label>
                </div>
                <a href="pesanan.php" class="btn btn-lg btn-gradient-flowers">Pilih</a>
            </div>
        </div>
    </main>
    <footer class="bg-gradient-flowers text-white text-center py-3">
        <div class="container">
            <p>© 2024 INDAH FLOWER SHOP. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
