<?php 
	include('function.php');
	session_start();
	if (isset($_GET['logout'])) {
		session_destroy();
		echo "<script type='text/javascript'>window.location = 'index.php';</script>";
	}
	if (empty($_SESSION['level'])) {
		echo "<script type='text/javascript'>window.location = 'index.php';</script>";
	}
	if(isset($_SESSION['level'])){
		if ($_SESSION['level'] == 2) {
			echo "<script type='text/javascript'>window.location = 'pg_dashboard.php';</script>";
		}
		elseif($_SESSION['level'] == 3) {
			echo "<script type='text/javascript'>window.location = 'pr_dashboard.php';</script>";
		}
	}
	if (isset($_POST['setujui'])) {
		setujuilembur($_POST['id']);
	}
	if (isset($_POST['tolak'])) {
		tolaklembur($_POST['id']);
	}
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />

	
<title>INOVINDO - Manajemen Absensi</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Inovindo</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				


				<li>
					<a href="ad_dashboard.php" class="">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="ad_pegawai.php" class="">
						<div class="parent-icon"><i class='bx bx-id-card'></i>
						</div>
						<div class="menu-title">Pegawai</div>
					</a>
				</li>
				<li>
					<a href="ad_peserta.php" class="">
						<div class="parent-icon"><i class='bx bx-group'></i>
						</div>
						<div class="menu-title">Peserta Prakerin</div>
					</a>
				</li>
				<li>
					<a href="ad_penilaian.php">
						<div class="parent-icon"><i class='bx bx-book-alt'></i>
						</div>
						<div class="menu-title">Penilaian Prakerin</div>
					</a>
				</li>
				<li>
					<a href="ad_sertifikat.php" class="">
						<div class="parent-icon"><i class='bx bx-award'></i>
						</div>
						<div class="menu-title">Sertifikat</div>
					</a>
				</li>
				<li>
					<a href="ad_jadwal.php" class="">
						<div class="parent-icon"><i class='bx bxs-calendar'></i>
						</div>
						<div class="menu-title">Jadwal</div>
					</a>
				</li>
				<li>
					<a href="ad_absen_pg.php" class="">
						<div class="parent-icon"><i class='bx bx-location-plus'></i>
						</div>
						<div class="menu-title">Absensi</div>
					</a>
				</li>
				<li class="mm-active">
					<a href="ad_lembur.php" class="">
						<div class="parent-icon"><i class='bx bx-alarm-exclamation'></i>
						</div>
						<div class="menu-title">Lembur</div>
					</a>
				</li>
				<li>
					<a href="ad_setting.php" class="">
						<div class="parent-icon"><i class='bx bx-cog'></i>
						</div>
						<div class="menu-title">Pengaturan Admin</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item">
								<div class="dropdown-menu">
									<div class="header-notifications-list">
									</div>
								</div>
							</li>
							<li class="nav-item">
								<div class="dropdown-menu">
									<div class="header-message-list">
									</div>
								</div>
							</li>
						</ul>
					</div>

					<div class="user-box dropdown">
					
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<!-- <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar"> -->
							<i class="bx bx-user-circle" style="font-size: 30px;"></i>
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?= strtoupper($_SESSION['username']); ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="ad_dashboard.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Lembur</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="ad_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Lembur</li>
							</ol>
						</nav>
					</div>
					<!-- <div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div> -->
				</div>
				<h6 class="mb-0 text-uppercase">Konfirmasi Lembur Pegawai</h6>
			<hr/>
			<div class="row">
					<div class="col-xl-12 mx-auto">
						<div class="card">
							<div class="card-body">
							<div class="table-responsive">
								<table id='tbnobutton' class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>NIP</th>
						<th>Nama Pegawai</th>
						<th>Hasil Lembur</th>
						<th>Konfirmasi</th>
					</tr>
				</thead>
				<tbody>
					<?php adtampillembur(); ?>
				</tbody>
			</table>
			</div>
			</div>
			</div>
			</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright ?? <?php echo date("Y"); ?>. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/table-datatable.js"></script>
	<script src="assets/js/index.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	
</body>

</html>