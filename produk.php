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

// Ambil data produk dari database dengan query yang benar
$result = mysqli_query($conn, "SELECT products.*, categories.kategori FROM products JOIN categories ON products.id_kategori = categories.id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
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
        <h1>Kelola Produk</h1>
        <a href="tambah_produk.php" class="btn btn-primary mb-3">Tambah Produk</a>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
                            echo "<td><a href='edit_produk.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a> <a href='hapus_produk.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
