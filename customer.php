<?php
include 'db.php';

$message = "";
$customerData = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_POST['id_customer'];
    $name = $_POST['nama_customer'];
    $phone = $_POST['no_telepon'];

    if (isset($_POST['addBtn'])) {
        $sql = "INSERT INTO customers (id_customer, nama_customer, no_telepon) VALUES ('$customerId', '$name', '$phone')";
        if ($conn->query($sql) === TRUE) {
            $message = "Data customer berhasil ditambahkan!";
            echo "<script>document.addEventListener('DOMContentLoaded', function() { document.querySelector('.container').classList.add('updated'); });</script>";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['searchBtn'])) {
        $sql = "SELECT * FROM customers WHERE id_customer = '$customerId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $customerData = $result->fetch_assoc();
            $message = "Data Customer:<br>Nama: " . $customerData['nama_customer'] . "<br>Nomor Telepon: " . $customerData['no_telepon'];
            echo "<script>document.addEventListener('DOMContentLoaded', function() { document.querySelector('.container').classList.add('updated'); });</script>";
        } else {
            $message = "Data customer tidak ditemukan.";
            echo "<script>document.addEventListener('DOMContentLoaded', function() { document.querySelector('.container').classList.add('updated'); });</script>";
        }
    } elseif (isset($_POST['updateBtn'])) {
        $newCustomerId = str_replace('b', 'a', $customerId);
        $sql = "UPDATE customers SET id_customer = '$newCustomerId' WHERE id_customer = '$customerId'";
        if ($conn->query($sql) === TRUE) {
            $message = "ID customer berhasil diubah dari $customerId menjadi $newCustomerId!";
            $customerData = ['id_customer' => $newCustomerId, 'nama_customer' => $name, 'no_telepon' => $phone];
            echo "<script>document.addEventListener('DOMContentLoaded', function() { document.querySelector('.container').classList.add('updated'); });</script>";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer - Flower Shop</title>
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

form .btn-gradient-customer {
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

form .btn-gradient-customer:hover {
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
        <h1>Data Customer</h1>
        <p>Masukkan atau cari data customer.</p>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pesanan.php">Pesanan</a></li>
                <li><a href="bunga.php">Katalog</a></li>
                <li><a href="addstock.php">Stok</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <div class="form-container">
            <form id="customerForm" method="POST" action="customer.php">
                <div class="form-group">
                    <label for="id_customer">ID Customer:</label>
                    <input type="text" class="form-control" id="id_customer" name="id_customer" placeholder="Masukkan ID Customer">
                </div>
                <div class="form-group">
                    <label for="nama_customer">Nama:</label>
                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon:</label>
                    <input type="tel" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon" required>
                </div>
                <div class="form-group text-center">
                    <button id="addBtn" type="submit" name="addBtn" class="btn btn-lg btn-gradient-customer">ADD</button>
                    <button id="searchBtn" type="submit" name="searchBtn" class="btn btn-lg btn-gradient-customer">SEARCH</button>
                    <button id="updateBtn" type="submit" name="updateBtn" class="btn btn-lg btn-gradient-customer">UPDATE</button>
                </div>
            </form>
        </div>
        <div class="message-container">
            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
                <?php if (!empty($customerData)): ?>
                    <p>ID Customer: <?php echo $customerData['id_customer']; ?></p>
                    <p>Nama: <?php echo $customerData['nama_customer']; ?></p>
                    <p>Nomor Telepon: <?php echo $customerData['no_telepon']; ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>
    <footer class="bg-gradient-customer text-white text-center py-3">
        &copy; 2024 Flower Shop. All Rights Reserved.
    </footer>
</body>
</html>



