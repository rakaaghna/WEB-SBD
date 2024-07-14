<?php
include 'db.php';

$message = "";
$kurirData = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idKurir = $_POST['id_kurir'];
    $namaKurir = $_POST['nama_kurir'];
    $statusKurir = $_POST['status'];

    if (isset($_POST['addBtn'])) {
        // Query untuk menambahkan data kurir
        $sql = "INSERT INTO kurir (id_kurir, nama_kurir, status_kurir) VALUES ('$idKurir', '$namaKurir', '$statusKurir')";

        if ($conn->query($sql) === TRUE) {
            $message = "Data kurir berhasil ditambahkan!";
            echo '<script>alert("Data kurir berhasil ditambahkan.");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['searchBtn'])) {
        // Query untuk mencari data kurir
        $sql = "SELECT * FROM kurir WHERE id_kurir = '$idKurir'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kurirData[] = $row;
            }
        } else {
            $message = "Data kurir tidak ditemukan.";
        }
    }

    if (isset($_POST['updateBtn'])) {
        // Query untuk mengubah status kurir
        $sql = "UPDATE kurir SET status_kurir = 'Sedang Mengirim' WHERE id_kurir = '$idKurir'";

        if ($conn->query($sql) === TRUE) {
            $message = "Status kurir berhasil diubah menjadi Sedang Mengirim.";
            echo '<script>alert("Status kurir berhasil diubah menjadi Sedang Mengirim.");</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kurir - Flower Shop</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    body {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header.bg-gradient-customer {
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

header .btn-gradient-customer {
    background: linear-gradient(90deg, #4b6cb7, #182848);
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

header .btn-gradient-customer:hover {
    background: linear-gradient(90deg, #182848, #4b6cb7);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

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

.container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 20px;
    padding: 20px;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    box-sizing: border-box;
}

.container.updated .form-container {
    transform: translateX(-5%);
}

.form-container {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
    max-width: 500px;
    box-sizing: border-box;
    transition: transform 0.5s ease-in-out;
}

.message-container {
    background: #4b6cb7;
    color: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 50%;
    max-width: 500px;
    box-sizing: border-box;
    transition: opacity 0.5s ease-in-out;
    opacity: 0;
    display: none;
}

.container.updated .message-container {
    opacity: 1;
    display: block;
}

form .form-group {
    margin-bottom: 25px;
}

form .form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 10px;
}

form .form-control {
    border: 2px solid #ddd;
    padding: 10px;
    border-radius: 8px;
    width: 100%;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    font-size: 1em;
    transition: border-color 0.3s ease;
}

form .form-control:focus {
    border-color: #4b6cb7;
    outline: none;
    box-shadow: 0 0 5px rgba(75, 108, 183, 0.5);
}

.form-group.text-center {
    display: flex;
    justify-content: center;
    gap: 10px;
}

form .btn-gradient-courier {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    color: white;
    font-size: 20px;
    padding: 20px 40px;
    text-decoration: none;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    display: inline-block;
    margin-top: 15px;
}

form .btn-gradient-courier:hover {
    background: linear-gradient(90deg, #182848, #4b6cb7);
    color: white;
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

footer {
    background: linear-gradient(90deg, #4b6cb7, #182848);
    color: white;
    padding: 20px 0;
    margin-top: auto;
    text-align: center;
}
    </style>


</head>
<body>
    <header class="bg-gradient-customer">
        <h1>Data Kurir</h1>
        <p>Masukkan atau cari data kurir.</p>
        <p>Awali ID dengan KK(Angka NIK).</p>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pesanan.php">Pesanan</a></li>
                <li><a href="bunga.php">Katalog</a></li>
                <li><a href="addstock_bunga.php">Stok</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <div class="form-container">
            <form id="kurirForm" method="POST" action="kurir.php">
                <div class="form-group">
                    <label for="id_kurir">ID Kurir:</label>
                    <input type="text" class="form-control" id="id_kurir" name="id_kurir" placeholder="Masukkan ID Kurir">
                </div>
                <div class="form-group">
                    <label for="nama_kurir">Nama:</label>
                    <input type="text" class="form-control" id="nama_kurir" name="nama_kurir" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="status_kurir">Status:</label>
                    <select class="form-control" id="status_kurir" name="status" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Kirim">Sedang Mengirim</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-lg btn-gradient-courier" name="addBtn">ADD</button>
                    <button type="submit" class="btn btn-lg btn-gradient-courier" name="searchBtn">SEARCH</button>
                    <button type="submit" class="btn btn-lg btn-gradient-courier" name="updateBtn">UPDATE</button>
                </div>
            </form>
        </div>
        <?php if (!empty($message)) : ?>
            <div class="message-container">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($kurirData)) : ?>
            <div class="form-container">
                <h3>Detail Kurir</h3>
                <?php foreach ($kurirData as $data) : ?>
                    <p>ID Kurir: <?php echo $data['id_kurir']; ?> - Nama: <?php echo $data['nama_kurir']; ?> - Status: <?php echo $data['status_kurir']; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <footer class="bg-gradient-customer text-white text-center py-3">
        &copy; 2024 Flower Shop. All Rights Reserved.
    </footer>
</body>
</html>
</html>
