<?php
/**
* NIM : 2257401048
* Nama : Saefullah
* Kelas : MI22B
*/

include("config.php");
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    
    // Dapatkan id_kategori dari nama_kategori yang dipilih
    $nama_kategori = $_POST['nama_kategori'];
    $result_kategori = mysqli_query($conn, "SELECT id FROM categories WHERE kategori = '$nama_kategori'");
    $row_kategori = mysqli_fetch_assoc($result_kategori);
    $id_kategori = $row_kategori['id'];

    // Insert produk baru ke database
    $query = "INSERT INTO products (nama_produk, harga, id_kategori) VALUES ('$nama_produk', '$harga', '$id_kategori')";
    if (mysqli_query($conn, $query)) {
        header("Location: produk.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575d63;
        }
        .main {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-white text-center">Admin</h2>
        <a href="admin.php">Beranda</a>
        <a href="produk.php">Produk</a>
        <a href="kategori.php">Kategori</a>
        <a href="users.php">User</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <h1>Tambah Produk</h1>
        <form method="POST" action="tambah_produk.php">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_kategori">Kategori</label>
                <select class="form-control" id="nama_kategori" name="nama_kategori" required>
                    <?php
                    // Ambil data kategori dari database
                    $result_kategori = mysqli_query($conn, "SELECT * FROM categories");
                    while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                        echo '<option value="' . htmlspecialchars($row_kategori['kategori']) . '">' . htmlspecialchars($row_kategori['kategori']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="produk.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
