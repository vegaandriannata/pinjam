<?php
include("koneksi.php");

if (isset($_GET['id'])) {
    $id_edit = $_GET['id'];
    $query_edit = "SELECT * FROM peminjaman WHERE id = $id_edit";
    $result_edit = mysqli_query($koneksi, $query_edit);
    $data_edit = mysqli_fetch_assoc($result_edit);
} else {
    header("Location: list_pengembalian.php");
    exit();
}

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

    mysqli_query($koneksi, $query_update);
    header("Location: list_pengembalian.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengembalian</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
            <h3>Edit Pengembalian</h2>
        </header>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $data_edit['id']; ?>">
        Nama Peminjam: <input type="text" name="nama_peminjam" value="<?php echo $data_edit['nama_peminjam']; ?>" required><br>
        Barang: <input type="text" name="barang" value="<?php echo $data_edit['barang']; ?>" required><br>
        Jumlah: <input type="text" name="jumlah" value="<?php echo $data_edit['jumlah']; ?>" required><br>
        Tanggal Pinjam: <input type="date" name="tanggal_pinjam" value="<?php echo $data_edit['tanggal_pinjam']; ?>" required><br>
        Keterangan: <textarea name="keterangan"><?php echo $data_edit['keterangan']; ?></textarea><br>
        Estimasi Peminjaman: <input type="text" name="estimasi_peminjaman" value="<?php echo $data_edit['estimasi_peminjaman']; ?>" required><br>
        Kondisi Awal: <textarea name="kondisi_awal"><?php echo $data_edit['kondisi_awal']; ?></textarea><br><br>
		Kondisi Akhir: <textarea name="kondisi_akhir"><?php echo $data_edit['kondisi_akhir']; ?></textarea><br><br>
		Status Peminjaman:
        <select name="status_peminjaman" required>
            <option value="Sedang Dipinjam" <?php if ($data_edit['status_peminjaman'] == 'Sedang Dipinjam') echo 'selected'; ?>>Sedang Dipinjam</option>
            <option value="Sudah Dikembalikan" <?php if ($data_edit['status_peminjaman'] == 'Sudah Dikembalikan') echo 'selected'; ?>>Sudah Dikembalikan</option>
        </select>
		
		<button type="submit" value="Update">Update</button>
		<a href="list_pengembalian.php">Kembali Ke List Pengembalian</a>	
    </form>
	
	
	 
	

    <br>
    
</body>
</html>