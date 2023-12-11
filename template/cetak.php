<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
	

    <style type="text/css" media="print">
        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }
            body {
                padding-top: 72px;
                padding-bottom: 72px;
                font-size: 10pt;
            }
            table {
                width:80%;
				
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
			
        }
    </style>
</head>
<body>

    <center>
        <br>
        <h2>KARTU LAPORAN PEMINJAMAN BARANG</h2>
    </center>
    <br>

    <?php
    include 'koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $result = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id = $id");

        if ($result) {
            $data = mysqli_fetch_array($result);
    ?>
<center>
            <table border="1">
                <tr>
                    <th>NO</th>
                    <td>1</td>
                </tr>
                <tr>
                    <th>Nama Peminjam</th>
                    <td><?php echo $data['nama_peminjam']; ?></td>
                </tr>
                <tr>
                    <th>Barang</th>
                    <td><?php echo $data['barang']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?php echo $data['jumlah']; ?></td>
                </tr>
				<tr>
                    <th>Kondisi Awal</th>
                    <td><?php echo $data['kondisi_awal']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?php echo $data['tanggal_pinjam']; ?></td>
                </tr>
                <tr>
                    <th>Estimasi Peminjaman</th>
                    <td><?php echo $data['estimasi_peminjaman']; ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td><?php echo $data['keterangan']; ?></td>
                </tr>
				
            </table>

            <script>
                window.onload = function () {
                    window.print();
                }
            </script>
</center>
    <?php
        } else {
            echo "Error in SQL query: " . mysqli_error($koneksi);
        }
    } else {
        echo "ID parameter is not set in the URL.";
    }
    ?>

</body>
</html>
