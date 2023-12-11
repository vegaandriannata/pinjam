<?php
include("koneksi.php");

if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $query_hapus = "DELETE FROM peminjaman WHERE id = $id_hapus";
    mysqli_query($koneksi, $query_hapus);
    header("Location: list_pengembalian.php");
    exit();
}

$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'tanggal_pinjam';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

$filter_month = isset($_GET['filter_month']) ? $_GET['filter_month'] : '';
$filter_year = isset($_GET['filter_year']) ? $_GET['filter_year'] : '';

$query = "SELECT * FROM peminjaman WHERE status_peminjaman = 'Sudah Dikembalikan'";

if (!empty($filter_month) && !empty($filter_year)) {
    $query .= " AND MONTH(tanggal_pinjam) = '$filter_month' AND YEAR(tanggal_pinjam) = '$filter_year'";
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " AND (nama_peminjam LIKE '%$search%' OR barang LIKE '%$search%' OR keterangan LIKE '%$search%') ";
}

$query .= " ORDER BY $order_by $sort_order";

$result = mysqli_query($koneksi, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
	integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="UTF-8">
    <title>List Pengembalian</title>
    <script>
		function confirmDelete(id) {
			var result = confirm("Apakah Anda yakin ingin menghapus data ini?");
			console.log("Result:", result);
			if (result) {
				window.location.href = 'list_pengembalian.php?hapus=' + id;
			}
		}
		function toggleFilterForm() {
            var filterForm = document.getElementById("filterForm");
            filterForm.style.display = (filterForm.style.display === 'none' || filterForm.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <header>
        <h1>LIST PENGEMBALIAN</h1>
    </header>
    <div class="container">
        <div class="container.search-bar">    
            <div class="row">
                <div class="col-md-6">
                    <form class="search-bar" action="list_pengembalian.php" method="GET">
                        <div class="input-group">
                            <input class="search" type="text" name="search" class="form-control" placeholder="Cari...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		
		
		
		<button class="btn-input" onclick="location.href='list_peminjaman.php'">List Data Peminjaman</button>
         <button class="btn-input custom-btn-red" onclick="toggleFilterForm()">Filter Tanggal Pinjam</button>
		<br>
		
		<form id="filterForm" class="date-filter" action="list_pengembalian.php" method="GET" style="display: none;">
            <label for="filter_month">Bulan:</label>
            <select class="date-filter" name="filter_month" id="filter_month">
                <option value="">-- Pilih Bulan --</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            <label for="filter_year">Tahun:</label>
            <select class="date-filter" name="filter_year" id="filter_year">
                <option value="">-- Pilih Tahun --</option>
                <?php
                for ($year = 2020; $year <= 2023; $year++) {
                    $selected = ($year == $filter_year) ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn btn-default" name="filter">Filter</button>
        </form>
        <table border="1">
            <tr>
                <th>NO</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th><a href="?order_by=tanggal_pinjam&sort_order=<?php echo $sort_order === 'ASC' ? 'DESC' : 'ASC'; ?>">Tanggal Pinjam</a></th>
                <th>Estimasi Peminjaman</th>
                <th>Keterangan</th>
				<th>Kondisi Awal</th>
				<th>Kondisi Akhir</th>
                <th>Status Peminjaman</th>         
                <th>Action</th>
            </tr>
            <?php
            $no = 1; 
		
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no . "</td>"; 
                echo "<td>" . $row['nama_peminjam'] . "</td>";
                echo "<td>" . $row['barang'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>" . $row['tanggal_pinjam'] . "</td>";
                echo "<td>" . $row['estimasi_peminjaman'] . "</td>";
                echo "<td>" . $row['keterangan'] . "</td>";
				echo "<td>" . $row['kondisi_awal'] . "</td>";
				echo "<td>" . $row['kondisi_akhir'] . "</td>";
                echo "<td>" . $row['status_peminjaman'] . "</td>";
                
                echo "<td>
						<a href='edit_pengembalian.php?id=" . $row['id'] . "'><i class='fas fa-edit text-blue'></i></a>
<a href='javascript:confirmDelete(" . $row['id'] . ")'><i class='fas fa-trash-alt text-red'></i></a>
                        <!--<a href='cetak.php?id=" . $row['id'] . "' target='_blank'>Cetak</a>--!>
                      </td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</body>
</html>
