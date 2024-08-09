<?php
/**
* NIM : 2257401048
* Nama : Saefullah
* Kelas : MI22B
*/

session_start();
include("config.php");

// Debugging: Cek apakah session username ada
if (!isset($_SESSION['username'])) {
    echo "Session not set. Redirecting to login...";
    header("Location: login.php");
    exit();
}

// Mengambil informasi username yang login
$username = $_SESSION['username'];

// Debugging: Menampilkan username
echo "Logged in as: " . htmlspecialchars($username) . "<br>";

// Menghitung jumlah produk
$result_produk = mysqli_query($conn, "SELECT COUNT(*) AS total_produk FROM products");
if (!$result_produk) {
    die("Query failed: " . mysqli_error($conn));
}
$row_produk = mysqli_fetch_assoc($result_produk);
$total_produk = $row_produk['total_produk'];

// Menghitung jumlah kategori
$result_kategori = mysqli_query($conn, "SELECT COUNT(*) AS total_kategori FROM categories");
if (!$result_kategori) {
    die("Query failed: " . mysqli_error($conn));
}
$row_kategori = mysqli_fetch_assoc($result_kategori);
$total_kategori = $row_kategori['total_kategori'];

// Menghitung jumlah user
$result_user = mysqli_query($conn, "SELECT COUNT(*) AS total_user FROM users");
if (!$result_user) {
    die("Query failed: " . mysqli_error($conn));
}
$row_user = mysqli_fetch_assoc($result_user);
$total_user = $row_user['total_user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <a href="user.php">User</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <div class="dashboard-info mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Products</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($total_produk); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">Total Categories</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($total_kategori); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Users</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($total_user); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>