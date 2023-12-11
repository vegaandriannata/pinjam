<?php
session_start();
include("koneksi.php");

if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $query_hapus = "DELETE FROM peminjaman WHERE id = $id_hapus";
    mysqli_query($koneksi, $query_hapus);
    header("Location: dashboard-peminjaman.php");
    exit();
}



$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'tanggal_pinjam';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';


$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$query = "SELECT * FROM peminjaman WHERE status_peminjaman = 'Sedang Dipinjam'";

if (!empty($start_date) && !empty($end_date)) {
    $query .= " AND tanggal_pinjam BETWEEN '$start_date' AND '$end_date'";
}


if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " AND (nama_peminjam LIKE '%$search%' OR barang LIKE '%$search%' OR keterangan LIKE '%$search%')";
}

$query .= " ORDER BY $order_by $sort_order";

$result = mysqli_query($koneksi, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Website - Data Peminjaman Barang</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="#">
      <meta name="keywords" content="Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="#">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-aAtOqY1tM2n2g0Ijp6/B+KQV98JzoHrPeDm+/i6fXYyMt1iI5EqySsirb+Z1AD1pD9LPzj6uj01QNddFpM4ymA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Favicon icon -->
      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="../../../../css.css?family=Mada:300,400,500,600,700" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
      <!-- Data Table Css -->
      <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
      <!-- Date-time picker css -->
      <link rel="stylesheet" type="text/css" href="assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
      <!-- Date-range picker css  -->
      <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap-daterangepicker/css/daterangepicker.css">
      <!-- Date-Dropper css -->
      <link rel="stylesheet" type="text/css" href="../bower_components/datedropper/css/datedropper.min.css">
      <!-- jquery file upload Frame work -->
      <link href="assets/pages/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet">
      <link href="assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet">
      <!-- animation nifty modal window effects css -->
      <link rel="stylesheet" type="text/css" href="assets/css/component.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- flag icon framework css -->
      <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
      <!-- Menu-Search css -->
      <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <!--color css-->

      <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css">
      <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css">
      <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
	  
	  <script>
        function confirmDelete(id) {
    var result = confirm("Apakah Anda yakin ingin menghapus data ini?");
    console.log("Result:", result);
    if (result) {	
        window.location.href = 'dashboard-peminjaman.php?hapus=' + id;
    }
}
function toggleFilterForm() {
            var filterForm = document.getElementById("filterForm");
            filterForm.style.display = (filterForm.style.display === 'none' || filterForm.style.display === '') ? 'block' : 'none';
        }

		
    </script>
  </head>

  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->


    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.php">
                            <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <div>
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                
                            </ul>
                            <ul class="nav-right">
                               
                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="assets/images/user.png" alt="User-Profile-Image">
                                        <?php
        // Check if the username is set in the session
        if (isset($_SESSION['username'])) {
            // Echo the logged-in username dynamically
            $loggedInUsername = htmlspecialchars($_SESSION['username']);
            echo "<span>Welcome, $loggedInUsername</span>";
        } else {
            // Fallback to default text or handle as needed
            echo '<span>Welcome, Guest</span>';
        }
        ?>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                        <li>
                                            <a href="#!">
                                                <i class="ti-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="user-profile.html">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html">
                                                <i class="ti-email"></i> My Messages
                                            </a>
                                        </li>
                                        <li>
                                            <a href="auth-lock-screen.html">
                                                <i class="ti-lock"></i> Lock Screen
                                            </a>
                                        </li>
                                        <li>
                                            <a href="login.html">
                                                <i class="ti-layout-sidebar-left"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- search -->
                            <div id="morphsearch" class="morphsearch">
                                <form class="morphsearch-form">
                                    <input class="morphsearch-input" type="search" placeholder="Search...">
                                    <button class="morphsearch-submit" type="submit">Search</button>
                                </form>
                                <div class="morphsearch-content">
                                    <div class="dummy-column">
                                        <h2>People</h2>
                                        <a class="dummy-media-object" href="#!">
                                            <img class="round" src="../../../../avatar/81b58502541f9445253f30497e53c280.png?s=50&d=identicon&r=G" alt="Sara Soueidan">
                                            <h3>Sara Soueidan</h3>
                                        </a>
                                        <a class="dummy-media-object" href="#!">
                                            <img class="round" src="../../../../avatar/9bc7250110c667cd35c0826059b81b75.jpeg?s=50&d=identicon&r=G" alt="Shaun Dona">
                                            <h3>Shaun Dona</h3>
                                        </a>
                                    </div>
                                    <div class="dummy-column">
                                        <h2>Popular</h2>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="PagePreloadingEffect">
                                            <h3>Page Preloading Effect</h3>
                                        </a>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="DraggableDualViewSlideshow">
                                            <h3>Draggable Dual-View Slideshow</h3>
                                        </a>
                                    </div>
                                    <div class="dummy-column">
                                        <h2>Recent</h2>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="TooltipStylesInspiration">
                                            <h3>Tooltip Styles Inspiration</h3>
                                        </a>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="NotificationStyles">
                                            <h3>Notification Styles Inspiration</h3>
                                        </a>
                                    </div>
                                </div>
                                <!-- /morphsearch-content -->
                                <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                            </div>
                            <!-- search end -->
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   <nav class="pcoded-navbar">
                    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                    <div class="pcoded-inner-navbar main-menu">

                        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Navigation</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="index.php">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Default</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
									<li class=" ">
                                            <a href="dashboard-barang.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Data Barang</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                    </li>
                                    <li class=" ">
                                            <a href="dashboard-peminjaman.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Peminjaman</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                    </li>
									<li class=" ">
                                            <a href="dashboard-pengembalian.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Pengembalian</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    <li class=" ">
                                        <a href="dashboard-crm.html">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.crm">CRM</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="dashboard-analytics.html">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.analytics">Analytics</span>
                                            <span class="pcoded-badge label label-info ">NEW</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="dashboard-project.html">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.project">Project</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                        
                    </div>
                </nav>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="page-header-title">
                                        <h4>Dashboard Peminjaman</h4>
                                    </div>
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Dashboard Peminjaman</a>
											
											
											
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Page-header end -->
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <div class="card product-add-modal">
                                        <div class="card-header">
                                            
										
										
											<div>
											<button type="button" class="btn btn-primary btn-round waves-effect waves-light f-right d-inline-block md-trigger" data-modal="modal-13" onclick="redirectToForm()"> 
												<i class="icofont icofont-plus m-r-5"></i> Tambah Peminjaman
											</button>
											<button class="btn btn-default-green btn-round" onclick="toggleFilterForm()">Filter</button>
										<div class="j-unit">
    <div class="j-input">
        <form id="filterForm" class="date-filter" method="get" action="" style="display: none;">
            <div class="form-group">
                <span for="start_date">Tanggal Awal:</span>
                <input type="date" name="start_date" id="start_date" class="form-control">
            </div>

            <div class="form-group">
                <span for="end_date">Tanggal Akhir:</span>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-round">Filter</button>
            </div>
        </form>
    </div>
</div>
</div>
											<div>
											<script>
												function redirectToForm() {
													// Menggunakan window.location.href untuk mengarahkan ke halaman form-input-peminjaman.php
													window.location.href = 'form-input-peminjaman.php';
												}
											</script>
											
                                            
                                        </div>
                                        <div class="card-block">
                                            <div class="table-content crm-table">
                                                <div class="project-table">
                                                    <table id="crm-contact" class="table table-striped table-responsive nowrap">
                                                        <thead>
                                                            <tr>
																<th>NO</th>
																<th>Nama Peminjam</th>
																<th>Barang</th>
																<th>Tanggal Pinjam</th>
																<th>Estimasi Pinjam</th>
																<th>Keterangan</th>
																<th>Kondisi Awal</th>
																<th>Status Pinjam</th>
																<th>Action</th>
															</tr>
                                                        </thead>
                                                        <tbody>
															<?php
															$no = 1;

															while ($row = mysqli_fetch_assoc($result)) {
																echo "<tr>";
																echo "<td>" . $no . "</td>";
																echo "<td>" . $row['nama_peminjam'] . "</td>";
																echo "<td>" . $row['barang'] ."  x ".$row['jumlah'].""; "</td>";
																$tanggal_pinjam = date("j M Y", strtotime($row['tanggal_pinjam']));

																// Ubah format tanggal pada kolom 'estimasi_peminjaman'
																
																																echo "<td>" . $tanggal_pinjam . "</td>";
																echo "<td>" . $row['estimasi_peminjaman'] . "</td>";
																echo "<td>" . $row['keterangan'] . "</td>";
																echo "<td>" . $row['kondisi_awal'] . "</td>";
																echo "<td style='padding: 5px;'>
																		<span style='background-color: #cff6dd; color: #1fa750; border-radius: 30px; padding: 5px;'>" . $row['status_peminjaman'] . "</span>
																	  </td>";
																echo "<td>
																		<a href='edit-peminjaman.php?id=" . $row['id'] . "'><i class='icofont icofont-ui-edit' style='background-color: #cce5ff; color: #004080; border-radius: 30px; padding: 5px;'></i></a>
																		<a href='javascript:confirmDelete(" . $row['id'] . ")'><i class='icofont icofont-delete-alt'style='background-color: #ffcccc; color: #cc0000; border-radius: 30px; padding: 5px;'></i></a>
																		<a href='print.php?id=" . $row['id'] . "' target='_blank'><i class='icofont icofont-printer' style='background-color: #fff2cc; color: #cca300; border-radius: 30px; padding: 5px;'></i></a>
																		</td>";
																echo "</tr>";
																$no++;
															}
															?>
														</tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>
                                                                </th>
                                                                
																<th>Nama Peminjam</th>
																<th>Barang</th>
																<th>Tanggal Pinjam</th>
																<th>Estimasi Pinjam</th>
																<th>Keterangan</th>
																<th>Kondisi Awal</th>
																<th>Status Pinjam</th>
																<th>Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add Contact Start Model -->
                                        

                                        <div class="md-overlay"></div>
                                        <!-- Add Contact Ends Model-->
                                    </div>

                                    <!-- Container-fluid ends -->
                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Warning Section Starts -->

                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="../bower_components/classie/js/classie.js"></script>
<!-- datatable js -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="assets/pages/advance-elements/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="../bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="../bower_components/datedropper/js/datedropper.min.js"></script>
<!-- jquery file upload js -->
<script src="assets/pages/jquery.filer/js/jquery.filer.min.js"></script>
<script src="assets/pages/filer/custom-filer.js" type="text/javascript"></script>
<script src="assets/pages/filer/jquery.fileuploads.init.js" type="text/javascript"></script>
<!-- Model animation js -->
<script src="assets/js/classie.js"></script>
<script src="assets/js/modalEffects.js"></script>
<!-- product list js -->
<script type="text/javascript" src="assets/pages/crm-contact/crm-contact.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="../bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="../bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/jquery.mousewheel.min.js"></script>
</body>

</html>
