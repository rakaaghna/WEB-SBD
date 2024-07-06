<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer - Flower Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Additional styling specific to customer page */
        .bg-gradient-customer {
            background: linear-gradient(90deg, #f54ea2, #c533ec); /* Gradient from pink to purple */
            text-align: center;
            padding: 100px 0;
            color: #fff;
            font-size: 2rem;
        }
        .btn-gradient-customer {
            background: linear-gradient(90deg, #f54ea2, #c533ec);
            border-color: #f54ea2;
            color: #fff;
            transition: transform 0.3s ease;
        }
        .btn-gradient-customer:hover {
            transform: scale(1.05); /* Scale up on hover */
        }
        .form-container {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-10px); /* Move up on hover */
        }
        form input,
        form select {
            margin-top: 10px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        form input:focus,
        form select:focus {
            border-color: #f54ea2; /* Highlight border on focus */
        }
        form button {
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #f54ea2; /* Pink color */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #de3b8e; /* Darker pink color on hover */
        }
    </style>
</head>
<body>
    <header class="bg-gradient-customer">
        <h1>Data Customer</h1>
        <p>Masukkan atau cari data customer.</p>
        <a href="index.php" class="btn btn-lg btn-gradient-customer">HOME PAGE</a>
    </header>
    <main class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto form-container">
                <?php
                include 'db.php';

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $customerId = $_POST['id_customer'];
                    $name = $_POST['nama_customer'];
                    $phone = $_POST['no_telepon'];

                    if (isset($_POST['addBtn'])) {
                        $sql = "INSERT INTO customers (nama_customer, no_telepon) VALUES ('$name', '$phone')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<p class='success'>Data customer berhasil ditambahkan!</p>";
                        } else {
                            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                        }
                    } elseif (isset($_POST['searchBtn'])) {
                        $sql = "SELECT * FROM customers WHERE id_customer = '$customerId'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $customer = $result->fetch_assoc();
                            echo "<p class='success'>Data Customer:<br>Nama: " . $customer['nama_customer'] . "<br>Nomor Telepon: " . $customer['no_telepon'] . "</p>";
                        } else {
                            echo "<p class='error'>Data customer tidak ditemukan.</p>";
                        }
                    }
                }
                ?>
                <form id="customerForm" method="POST" action="customer.php">
                    <div class="form-group">
                        <label for="customerId">ID Customer:</label>
                        <input type="text" class="form-control" id="customerId" name="customerId" placeholder="Masukkan ID Customer">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                    <div class="form-group text-center">
                        <button id="addBtn" type="submit" name="addBtn" class="btn btn-lg btn-gradient-customer">ADD</button>
                        <button id="searchBtn" type="submit" name="searchBtn" class="btn btn-lg btn-gradient-customer">SEARCH</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-gradient-customer text-white text-center py-3">
        &copy; 2024 Flower Shop. All Rights Reserved.
    </footer>
</body>
</html>



