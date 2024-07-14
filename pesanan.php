<?php
// Sertakan file koneksi database
include('db.php');

// Inisialisasi variabel untuk menyimpan pesan
$errorMessage = "";
$successMessage = "";

// Harga bunga per tipe
$flowerPrices = [
    "Mawar Jahat" => 1500000,
    "Matahari Pagi" => 1250000,
    "Lily Was A Little Girl" => 1000000
];

// Mulai sesi untuk menyimpan data sementara
session_start();

// Fungsi untuk menyimpan data pemesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_customer']) && isset($_POST['tipe_bunga']) && isset($_POST['penerima']) && isset($_POST['alamat']) && isset($_POST['id_pesanan']) && isset($_POST['id_bunga'])) {
        $customerId = $_POST['id_customer'];
        $flowerId = $_POST['tipe_bunga'];
        $receiverName = $_POST['penerima'];
        $address = $_POST['alamat'];
        $pesananid = $_POST['id_pesanan'];
        $bungaId = $_POST['id_bunga'];

        
        // Hitung total harga berdasarkan tipe bunga
        $total = $flowerPrices[$flowerId];
        $discountApplied = false;
        $discountPercent = 0;
        
        if (strpos($customerId, 'A') !== false && $total > 1000000) {
            $total *= 0.95; // 5% discount
            $discountApplied = true;
            $discountPercent = 5;
        } elseif (strpos($customerId, 'B') !== false) {
            $total *= 0.90; // 10% discount
            $discountApplied = true;
            $discountPercent = 10;
        }
        
        // If customer ID contains 'b', replace 'b' with 'a' to mark as a regular customer
        if (strpos($customerId, 'B') !== false) {
            $customerId = str_replace('B', 'A', $customerId);
        }

        // Prepare the SQL statement for inserting the order
        $sql = $conn->prepare("INSERT INTO pesanan (id_customer, tipe_bunga, penerima, alamat, total_harga, id_pesanan) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssdi", $customerId, $flowerId, $receiverName, $address, $total, $pesananid);
        
        if ($sql->execute()) {
            // Prepare the SQL statement for deleting the flower
            $delete_sql = $conn->prepare("DELETE FROM bunga WHERE id_bunga = ?");
            $delete_sql->bind_param("s", $bungaId);
            $delete_sql->execute();

            // Select available couriers
            $courier_sql = "SELECT id_kurir, nama_kurir FROM kurir WHERE status_kurir = 'Sedia' LIMIT 1";
            $courier_result = $conn->query($courier_sql);
            $courier = $courier_result->fetch_assoc();

            if ($courier) {
                // Update courier status to 'Sedang Mengirim'
                $update_courier_sql = $conn->prepare("UPDATE kurir SET status_kurir = 'Sedang Mengirim' WHERE id_kurir = ?");
                $update_courier_sql->bind_param("i", $courier['id_kurir']);
                $update_courier_sql->execute();

                // Save courier data in session
                $_SESSION['courier'] = $courier;
            } else {
                // Handle case where no courier is available
                $_SESSION['courier'] = ['id_kurir' => 0, 'nama_kurir' => 'Tidak Ada Kurir Tersedia'];
            }

            // Simpan data diskon dan total harga dalam sesi
            $_SESSION['discountApplied'] = $discountApplied;
            $_SESSION['discountPercent'] = $discountPercent;
            $_SESSION['total'] = $total;
            
            // Redirect to the same page to display the message
            header("Location: pesanan.php?success=true");
            exit();
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        h1, p {
            margin: 0;
        }

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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
            font-family: 'Poppins', sans-serif;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 0 auto; /* Center the form */
            max-width: 600px;
        }

        form {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
        }
        form select {
            padding: 12px;
            font-family: 'Poppins', sans-serif;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            width: 100%; /* Full width */
            box-sizing: border-box; /* Include padding and border in width */
        }


        label {
            font-weight: 500;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="number"], input[type="email"], textarea {
            padding: 12px;
            font-family: 'Poppins', sans-serif;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            width: 100%; /* Full width */
            box-sizing: border-box; /* Include padding and border in width */
        }

        button[type="submit"] {
            background: linear-gradient(90deg, #4b6cb7, #182848);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        button[type="submit"]:hover {
            background: linear-gradient(90deg, #182848, #4b6cb7);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .download-link {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        .message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>
    <header class="bg-gradient-order">
        <div class="container">
            <h1>Pemesanan</h1>
            <p>Formulir Pemesanan Bunga</p>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="kurir.php">Kurir</a></li>
            <li><a href="bunga.php">Katalog</a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="customer.php">Customer</a></li>
            <li><a href="addstock_bunga.php">Stok</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <div class="form-container">
                <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
                    <p class="message">Pemesanan Anda berhasil!</p>
                    <p class="message">Diskon: <?php echo $_SESSION['discountApplied'] ? $_SESSION['discountPercent'] . '%' : 'Tidak ada'; ?></p>
                    <p class="message">Total Harga: Rp <?php echo number_format($_SESSION['total'], 2, ',', '.'); ?></p>
                    <p class="message">Kurir: <?php echo $_SESSION['courier']['nama_kurir']; ?></p>
                    <a href="download.php" class="download-link">Download Detail Pesanan</a>
                <?php else : ?>
                    <form action="pesanan.php" method="POST">
                        <label for="id_customer">ID Customer:</label>
                        <input type="text" id="id_customer" name="id_customer" required>

                        <label class="option" for="tipe_bunga">Tipe Bunga:</label>
                        <select id="tipe_bunga" name="tipe_bunga" required>
                            <option value="Mawar Jahat">Mawar Jahat</option>
                            <option value="Matahari Pagi">Matahari Pagi</option>
                            <option value="Lily Was A Little Girl">Lily Was A Little Girl</option>
                        </select>

                        <label for="penerima">Nama Penerima:</label>
                        <input type="text" id="penerima" name="penerima" required>

                        <label for="alamat">Alamat Pengiriman:</label>
                        <textarea id="alamat" name="alamat" required></textarea>

                        <label for="id_pesanan">ID Pesanan:</label>
                        <input type="text" id="id_pesanan" name="id_pesanan" required>

                        <label for="id_bunga">ID Bunga:</label>
                        <input type="text" id="id_bunga" name="id_bunga" required>

                        <button type="submit">Kirim Pesanan</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
