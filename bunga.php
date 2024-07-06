<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bunga - Flower Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Additional styling specific to flowers page */
        .bg-gradient-flowers {
            background: linear-gradient(90deg, #f54ea2, #c533ec); /* Gradient from pink to purple */
            text-align: center;
            padding: 50px 0;
            color: #fff;
            font-size: 2rem;
        }
        .btn-gradient-flowers {
            background: linear-gradient(90deg, #f54ea2, #c533ec);
            border-color: #f54ea2;
            color: #fff;
            transition: transform 0.3s ease;
        }
        .btn-gradient-flowers:hover {
            transform: scale(1.05); /* Scale up on hover */
        }
        .flower-item {
            margin-bottom: 30px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .flower-item:hover {
            transform: translateY(-10px); /* Move up on hover */
        }
        .flower-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .flower-img:hover {
            transform: scale(1.1); /* Zoom in on hover */
        }
        .size-options {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header class="bg-gradient-flowers">
        <h1>Daftar Bunga</h1>
        <p>Pilih bunga favorit Anda.</p>
        <a href="index.html" class="btn btn-lg btn-gradient-flowers">HOME PAGE</a>
    </header>
    <main class="container my-5">
        <div class="row">
            <div class="col-md-4">
            <?php
            include 'db.php';

            $sql = "SELECT * FROM bunga";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Tampilkan data bunga di sini sesuai kebutuhan
                    echo "<div class='col-md-4'>
                            <div class='flower-item'>
                                <img src='image/{$row['gambar']}' alt='{$row['tipe_bunga']}' class='flower-img'>
                                <h3>{$row['tipe_bunga']}</h3>
                                <p>Harga: {$row['harga_bunga']}</p>
                                <div class='size-options'>
                                    <label><input type='radio' name='size' value='small'> Small</label>
                                    <label><input type='radio' name='size' value='medium'> Medium</label>
                                    <label><input type='radio' name='size' value='large'> Large</label>
                                </div>
                                <button type='button' class='btn btn-gradient-flowers mt-3'>Pilih</button>
                            </div>
                          </div>";
                }
            } else {
                echo "0 results";
            }
            
            $conn->close();
            
            ?>



                <div class="flower-item">
                    <img src="image/ -4.jpg" alt="Bunga 1" class="flower-img">
                    <h3>Mawar Jahat</h3>
                    <div class="size-options">
                        <label><input type="radio" name="size" value="small"> Small</label>
                        <label><input type="radio" name="size" value="medium"> Medium</label>
                        <label><input type="radio" name="size" value="large"> Large</label>
                    </div>
                    <button type="button" class="btn btn-gradient-flowers mt-3">Pilih</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="flower-item">
                    <img src="image/ᴘɪɴᴛᴇʀᴇꜱᴛ_ ɴᴀᴛᴀꜱʜᴀᴏʀᴄʜɪꜱᴏɴ ɪɴꜱᴛᴀɢʀᴀᴍ_ ɴᴀᴛᴀꜱʜᴀᴀᴏ.jpg" alt="Bunga 2" class="flower-img">
                    <h3>Matahari Pagi</h3>
                    <div class="size-options">
                        <label><input type="radio" name="size" value="small"> Small</label>
                        <label><input type="radio" name="size" value="medium"> Medium</label>
                        <label><input type="radio" name="size" value="large"> Large</label>
                    </div>
                    <button type="button" class="btn btn-gradient-flowers mt-3">Pilih</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="flower-item">
                    <img src="image/Unknown.jpg" alt="Bunga 3" class="flower-img">
                    <h3>Lily was a little girl</h3>
                    <div class="size-options">
                        <label><input type="radio" name="size" value="small"> Small</label>
                        <label><input type="radio" name="size" value="medium"> Medium</label>
                        <label><input type="radio" name="size" value="large"> Large</label>
                    </div>
                    <button type="button" class="btn btn-gradient-flowers mt-3">Pilih</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-gradient-flowers text-white text-center py-3">
        
    </footer>
</body>
</html>