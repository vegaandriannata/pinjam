<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_edit = $_POST['id_brg'];
    $nama_brg_edit = $_POST['nama_brg'];
    $harga_edit = $_POST['harga'];
    $tgl_pembelian_edit = $_POST['tgl_pembelian'];
    $serial_key_edit = $_POST['serial_key'];
    $merek_edit = $_POST['merek'];
    $kode_brg_edit = $_POST['kode_brg']; // Added kode_brg field

    // Use prepared statements to prevent SQL injection
    $query_update = "UPDATE barang SET 
                    nama_brg=?, 
                    harga=?, 
                    tgl_pembelian=?, 
                    serial_key=?, 	
                    merek=?, 
                    kode_brg=?
                    WHERE id_brg=?";
    
    $stmt = mysqli_prepare($koneksi, $query_update);
    mysqli_stmt_bind_param($stmt, "ssssssi", $nama_brg_edit, $harga_edit, $tgl_pembelian_edit, $serial_key_edit, $merek_edit, $kode_brg_edit, $id_edit);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // File upload logic
        $targetDir = "assets/images/barang/";
        $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        $i = 1;
        while (file_exists($targetFile)) {
            $targetFile = $targetDir . pathinfo($targetFile, PATHINFO_FILENAME) . "_" . $i . "." . $imageFileType;
            $i++;
        }
        // Check file size
        if ($_FILES["gambar"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                // Update the database with the new file path
                $query_update_image = "UPDATE barang SET gambar=? WHERE id_brg=?";
                $stmt_image = mysqli_prepare($koneksi, $query_update_image);
                mysqli_stmt_bind_param($stmt_image, "si", $targetFile, $id_edit);
                $result_image = mysqli_stmt_execute($stmt_image);

                if ($result_image) {
                    // Redirect using JavaScript
                    echo '<script>window.location.href = "dashboard-barang.php";</script>';
                    exit();
                } else {
                    echo "Error updating image path: " . mysqli_error($koneksi);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Handle the error, e.g., display an error message
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    // If not a POST request, redirect to the dashboard
    header("Location: dashboard-barang.php");
    exit();
}
?>


