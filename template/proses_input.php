<?php
include("koneksi.php");

$nama_peminjam = $_POST['nama_peminjam'];
$barang = $_POST['barang'];
$jumlah = $_POST['jumlah'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$estimasi_peminjaman = $_POST['estimasi_peminjaman'];
$keterangan = $_POST['keterangan'];
$kondisi_awal = $_POST['kondisi_awal'];


$query = "INSERT INTO peminjaman (nama_peminjam, barang, jumlah, tanggal_pinjam, estimasi_peminjaman, keterangan, kondisi_awal, status_peminjaman) 
          VALUES ('$nama_peminjam', '$barang', $jumlah, '$tanggal_pinjam', '$estimasi_peminjaman', '$keterangan','$kondisi_awal', 'Sedang Dipinjam')";
mysqli_query($koneksi, $query);

header("Location: dashboard-peminjaman.php");
exit;


?>
