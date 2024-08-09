<?php
/**
* NIM : 2257401048
* Nama : Saefullah
* Kelas : MI22B
*/

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'uas-php-saefullah';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>