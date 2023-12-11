<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "peminjaman_db";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
