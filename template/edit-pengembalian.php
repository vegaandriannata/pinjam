<?php
session_start();
include("koneksi.php");

if (isset($_GET['id'])) {
    $id_edit = $_GET['id'];
    $query_edit = "SELECT * FROM peminjaman WHERE id = $id_edit";
    $result_edit = mysqli_query($koneksi, $query_edit);
    $data_edit = mysqli_fetch_assoc($result_edit);
} else {
    header("Location: dashboard-pengembalian.php");
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
	
    header("Location: dashboard-pengembalian.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mash Able - Premium Admin Template</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="#">
      <meta name="keywords" content="Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="#">
      <!-- Favicon icon -->
      
      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="../../../../css.css?family=Mada:300,400,500,600,700" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- flag icon framework css -->
      <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
      <!-- Menu-Search css -->
      <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">
      <!-- jpro forms css -->
      <link rel="stylesheet" type="text/css" href="assets/pages/j-pro/css/demo.css">
      <link rel="stylesheet" type="text/css" href="assets/pages/j-pro/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/pages/j-pro/css/j-pro-modern.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <!-- color .css -->

      <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css">
      <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css">
      <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
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
                        <a href="index.html">
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
                           
                        </div>
                    </div>
                </div>
            </nav>

            
            
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
                                            <a href="index.html">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Default</span>
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
                                </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page header start -->
                                    
                                  
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Job application card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Job Application</h5>
                                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-rounded-down"></i>
                                                            <i class="icofont icofont-refresh"></i>
                                                            <i class="icofont icofont-close-circled"></i>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper j-wrapper-640">
															<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" onsubmit="submitForm(event)" novalidate="">
                                                                <!-- end /.header-->
																
                                                                <div class="j-content">
                                                                    <!-- start name -->
                                                                    <div class="j-row">
																	<input type="hidden" name="id" value="<?php echo $data_edit['id']; ?>">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="nama_peminjam">
                                                                                    <i class="icofont icofont-ui-user"></i>
                                                                                </label>
                                                                                <input type="text" name="nama_peminjam" value="<?php echo $data_edit['nama_peminjam']; ?>" required><br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="barang">
                                                                                    <i class="icofont icofont-ui-user"></i>
                                                                                </label>
                                                                                <input type="text" name="barang" value="<?php echo $data_edit['barang']; ?>" required><br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    
                                                                        <div class=" j-unit">
                                                                            <div class="j-input">
                                                                                
                                                                                <input type="text" name="jumlah" value="<?php echo $data_edit['jumlah']; ?>" required><br>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    
																	<div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                           <span class="j-hint">Tanggal Pinjam</span>
                                                                                <input type="date" name="tanggal_pinjam" value="<?php echo $data_edit['tanggal_pinjam']; ?>" required><br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                           <span class="j-hint">Estimasi Pinjam</span>
                                                                                <input type="text" name="estimasi_peminjaman" value="<?php echo $data_edit['estimasi_peminjaman']; ?>" required><br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="divider gap-bottom-25"></div>
                                                                    
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="kondisi_awal">
                                                                                <i class="icofont icofont-building"></i>
                                                                            </label>
                                                                           <input type="text" name="kondisi_awal" value="<?php echo $data_edit['kondisi_awal']; ?>" required><br>
                                                                        </div>
                                                                    </div>
																	<div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="kondisi_akhir">
                                                                                <i class="icofont icofont-building"></i>
                                                                            </label>
                                                                           <input type="text" placeholder="Kondisi Akhir" name="kondisi_akhir" value="<?php echo $data_edit['kondisi_akhir']; ?>" required><br>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="divider gap-bottom-25"></div>
                                                                   
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <textarea placeholder="Keterangan" name="keterangan"><?php echo $data_edit['keterangan']; ?></textarea><br>
                                                                            <span class="j-tooltip j-tooltip-right-top">Mohon diisi sedetail mungkin</span>
                                                                        </div>
                                                                    </div>
																	
																	<div class="j-unit">
                                                                        <div class="j-input">
                                                                            <select name="status_peminjaman" required>
																			<option value="Sedang Dipinjam" <?php if ($data_edit['status_peminjaman'] == 'Sedang Dipinjam') echo 'selected'; ?>>Sedang Dipinjam</option>
																			<option value="Sudah Dikembalikan" <?php if ($data_edit['status_peminjaman'] == 'Sudah Dikembalikan') echo 'selected'; ?>>Sudah Dikembalikan</option>
																			</select>
                                                                        </div>
                                                                    </div>
                                                                 
                                                                    <div class="j-row">
                                                                        
                                                                        <div class="page-body">

                                                                    </div>
                                                                    
                                                                    <div class="j-response"></div>
                                                                   
                                                                </div>
                                                                <!-- end /.content -->
                                                                <div class="j-footer">
                                                                    <button type="submit" value="Update" class="btn btn-primary btn-round">Send</button>
                                                                    <button type="reset" class="btn btn-default m-r-20 btn-round">Reset</button>
                                                                </div>
                                                              
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>
                            </div>
                         
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
<!-- j-pro js -->
<script type="text/javascript" src="assets/pages/j-pro/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="assets/pages/j-pro/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="assets/pages/j-pro/js/jquery.j-pro.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="../bower_components/classie/js/classie.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="../bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="../bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/pages/j-pro/js/custom/form-job.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/jquery.mousewheel.min.js"></script>
<script>
        function submitForm(event) {
    event.preventDefault(); // Prevent the default form submission

    // Your existing AJAX submission logic or form data processing here
    var formData = new FormData(document.getElementById('j-pro'));

    // Assuming you are using jQuery for AJAX
    $.ajax({
        type: 'POST',
        url: 'proses-edit-pengembalian.php', // Replace with the actual URL to handle form submission
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle the success response, if needed
            console.log('Form submitted successfully');
            // Redirect to dashboard-peminjaman.php
            window.location.href = 'dashboard-pengembalian.php';
        },
        error: function(xhr, status, error) {
            // Handle the error, if needed
            console.error('Error submitting form:', error);
        }
    });
}
    </script>
</body>

</html>
