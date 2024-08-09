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

$id = $_GET['id'];

// Hapus kategori dari database
$query = "DELETE FROM categories WHERE id = '$id'";
if (mysqli_query($conn, $query)) {
    header("Location: kategori.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>
