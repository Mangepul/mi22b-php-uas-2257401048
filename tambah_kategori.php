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
    $nama_kategori = $_POST['nama_kategori'];

    // Insert kategori baru ke database
    $query = "INSERT INTO categories (kategori) VALUES ('$nama_kategori')";
    if (mysqli_query($conn, $query)) {
        header("Location: kategori.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>
