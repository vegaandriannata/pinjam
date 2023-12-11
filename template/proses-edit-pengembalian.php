<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_edit = $_POST['id'];
    $nama_peminjam_edit = $_POST['nama_peminjam'];
    $barang_edit = $_POST['barang'];
    $jumlah_edit = $_POST['jumlah'];
    $tanggal_pinjam_edit = $_POST['tanggal_pinjam'];
    $keterangan_edit = $_POST['keterangan'];
    $estimasi_peminjaman_edit = $_POST['estimasi_peminjaman'];
    $kondisi_awal_edit = $_POST['kondisi_awal'];
    $kondisi_akhir_edit = $_POST['kondisi_akhir'];
    $status_peminjaman_edit = $_POST['status_peminjaman'];

    $query_update = "UPDATE peminjaman SET 
                    nama_peminjam='$nama_peminjam_edit', 
                    barang='$barang_edit', 
                    jumlah='$jumlah_edit', 
                    tanggal_pinjam='$tanggal_pinjam_edit', 
                    keterangan='$keterangan_edit', 
                    estimasi_peminjaman='$estimasi_peminjaman_edit', 
                    kondisi_awal='$kondisi_awal_edit' ,
                    kondisi_akhir='$kondisi_akhir_edit',
                    status_peminjaman='$status_peminjaman_edit' 
                    
                    WHERE id=$id_edit";

    $result = mysqli_query($koneksi, $query_update);

    if ($result) {
        // Form submitted successfully
        header("Location: dashboard-pengembalian.php");
        exit();
    } else {
        // Handle the error, e.g., display an error message
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    // If not a POST request, redirect to the dashboard
    header("Location: dashboard-pengembalian.php");
    exit();
}
?>
