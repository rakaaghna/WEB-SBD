<?php
// Sertakan file koneksi database
include('db.php');

// Inisialisasi variabel untuk menyimpan pesan
$errorMessage = "";
$successMessage = "";

// Harga bunga per tipe
$flowerPrices = [
    "Mawar Jahat" => 50000,
    "Matahari Pagi" => 30000,
    "Lily Was A Little Girl" => 40000
];

// Fungsi untuk menyimpan data pemesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_customer']) && isset($_POST['tipe_bunga']) && isset($_POST['penerima']) && isset($_POST['alamat']) && isset($_POST['quantity']) && isset($_POST['id_pesanan'])) {
        $customerId = $_POST['id_customer'];
        $flowerId = $_POST['tipe_bunga'];
        $receiverName = $_POST['penerima'];
        $address = $_POST['alamat'];
        $quantity = $_POST['quantity'];
        $pesananid = $_POST['id_pesanan'];

        // Hitung total harga berdasarkan tipe bunga dan jumlah
        $total = $flowerPrices[$flowerId] * $quantity;
        $discountApplied = false;
        $discountPercent = 0;

        if (strpos($customerId, 'b') !== false && $total > 1000000) {
            $total *= 0.95; // 5% discount
            $discountApplied = true;
            $discountPercent = 5;
        } elseif (strpos($customerId, 'a') !== false) {
            $total *= 0.90; // 10% discount
            $discountApplied = true;
            $discountPercent = 10;
        }

        // If customer ID contains 'b', replace 'b' with 'a' to mark as a regular customer
        if (strpos($customerId, 'b') !== false) {
            $customerId = str_replace('b', 'a', $customerId);
        }

        // Prepare the SQL statement
        $sql = $conn->prepare("INSERT INTO pesanan (id_customer, tipe_bunga, penerima, alamat, total_harga, id_pesanan, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssdii", $customerId, $flowerId, $receiverName, $address, $total, $pesananid, $quantity);

        if ($sql->execute()) {
            if ($discountApplied) {
                echo "<script>alert('Pemesanan Berhasil dan Anda mendapatkan diskon $discountPercent%. Total setelah diskon adalah: Rp. " . number_format($total, 2) . "');</script>";
            } else {
                echo "<script>alert('Pemesanan berhasil!');</script>";
            }
        } else {
            echo "<script>alert('Error: " . $sql->error . "');</script>";
        }

        $sql->close();
    } else {
        echo "<script>alert('ERROR: Data Tidak Lengkap.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Flower Shop</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,
    wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;
    1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
    rel="stylesheet">
    <style>
        /* General Styles */
body {
    font-family: 'Montserrat', sans-serif;
    font-weight: 100;
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
header.bg-gradient-order {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    color: #fff;
    padding: 40px 0;
    text-align: center;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 3em;
    font-weight: 600;
    margin-bottom: 15px;
    color: #fff;
}

header p {
    font-size: 1.2em;
}

header .btn-gradient-order {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    font-size: 23px;
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    display: inline-block;
    margin-top: 15px;
}

header .btn-gradient-order:hover {
    background: linear-gradient(90deg, #182848, #4b6cb7);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2)
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


/* Main Styles */
main {
    padding: 50px 0;
}

.form-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

form .form-group {
    margin-bottom: 20px;
}

form .form-group label {
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}

form .form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    font-size: 1em;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

form .form-control:focus {
    border-color: #4b6cb7;
    box-shadow: 0 0 5px rgba(75, 108, 183, 0.5);
}

form .btn-gradient-order {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    font-size: 23px;
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    display: inline-block;
    margin-top: 15px;
}

form .btn-gradient-order:hover {
    background: linear-gradient(90deg, #182848, #4b6cb7);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Footer Styles */
footer.bg-gradient-order {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    color: white;
    padding: 20px 0;
    margin-top: 50px;
    text-align: center;
}

    </style>
</head>
<body>
    <header class="bg-gradient-order">
        <h1>Pemesanan Bunga</h1>
        <p>Lengkapi formulir untuk memesan bunga favorit Anda.</p>

        <!-- Navigation Bar -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="customer.php">Customer</a></li>
                <li><a href="bunga.php">Katalog</a></li>
                <li><a href="addstock.php">Stok</a></li>
            </ul>
        </nav>

    </header>
    <main class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto form-container">
                <form id="orderForm" class="shadow-sm p-4 bg-white rounded" method="POST" action="pesanan.php">
                    <div class="form-group">
                        <label for="id_pesanan">ID Pesanan:</label>
                        <input type="text" class="form-control" id="id_pesanan" name="id_pesanan" placeholder="Masukkan ID Pesanan" required>
                    </div>
                    <div class="form-group">
                        <label for="id_customer">ID Customer:</label>
                        <input type="text" class="form-control" id="id_customer" name="id_customer" placeholder="Masukkan ID Customer" required>
                    </div>
                    <div class="form-group">
                        <label for="tipe_bunga">Tipe Bunga:</label>
                        <select class="form-control" id="tipe_bunga" name="tipe_bunga" required>
                            <option value="Mawar Jahat">Mawar Jahat</option>
                            <option value="Matahari Pagi">Matahari Pagi</option>
                            <option value="Lily Was A Little Girl">Lily Was A Little Girl</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penerima">Nama Penerima:</label>
                        <input type="text" class="form-control" id="penerima" name="penerima" placeholder="Masukkan Nama Penerima" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Penerima:</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Penerima" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Jumlah Bunga:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah Bunga" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-lg btn-gradient-order">Buat Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-gradient-order text-white text-center py-3">
        <p>&copy; SEHAT SEHAT SEMUA MAKASIH DAH BELI.</p>
    </footer>
</body>
</html>

