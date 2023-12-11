<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_brg = mysqli_real_escape_string($koneksi, $_POST['nama_brg']);
	$merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
    $harga = intval($_POST['harga']);
    $tgl_pembelian = $_POST['tgl_pembelian'];
    $serial_key = mysqli_real_escape_string($koneksi, $_POST['serial_key']);
	$kode_brg = mysqli_real_escape_string($koneksi, $_POST['kode_brg']);
	$qr = $nama_brg . ' ' . $harga . ' ' . $serial_key . ' ' . $merek . ' ' . $kode_brg . ' ' . $tgl_pembelian;

	

    // File upload handling
    $targetDirectory = "assets/images/barang/";
    $targetFile = $targetDirectory . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Error: File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["gambar"]["size"] > 2000000) {
        echo "Error: Sorry, your file is too large. Maximum allowed size is 2 MB.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Error: Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Error: Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
            // If file upload is successful, proceed with database insertion
            $query = "INSERT INTO barang (nama_brg,merek,kode_brg, harga, tgl_pembelian, serial_key, gambar, qr) 
                      VALUES ('$nama_brg','$merek','$kode_brg', $harga, '$tgl_pembelian', '$serial_key', '$targetFile', '$qr')";

            if (mysqli_query($koneksi, $query)) {
                header("Location: dashboard-barang.php");
                exit;
            } else {
                // Display the error message
                echo "Error: " . mysqli_error($koneksi);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
