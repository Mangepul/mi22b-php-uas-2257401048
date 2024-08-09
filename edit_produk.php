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
    $kategori = $_POST['kategori'];

    // Upload foto
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    // Insert produk baru ke database
    $query = "INSERT INTO products (nama_produk, harga, kategori, foto) VALUES ('$nama_produk', '$harga', '$kategori', '$target_file')";
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
            margin-left: 260px; /* Same as the width of the sidebar */
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
        <form method="POST" action="tambah_produk.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <?php
                    // Ambil data kategori dari database
                    $result_kategori = mysqli_query($conn, "SELECT * FROM categories");
                    while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                        echo '<option value="' . $row_kategori['nama_kategori'] . '">' . $row_kategori['nama_kategori'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto Produk</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
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
