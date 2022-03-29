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
		if ($_SESSION['level'] == 1) {
			echo "<script type='text/javascript'>window.location = 'ad_dashboard.php';</script>";
		}
		elseif($_SESSION['level'] == 2) {
			echo "<script type='text/javascript'>window.location = 'pg_dashboard.php';</script>";
		}
	}
	if (isset($_GET['detail'])) {
		createpdf($_SESSION['id'],"");
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
					<a href="pr_dashboard.php" class="">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="pr_profile.php" class="">
						<div class="parent-icon"><i class='bx bx-user-circle'></i>
						</div>
						<div class="menu-title">Profile</div>
					</a>
				</li>
				<li>
					<a href="pr_jadwal.php" class="">
						<div class="parent-icon"><i class='bx bxs-calendar'></i>
						</div>
						<div class="menu-title">Jadwal</div>
					</a>
				</li>
				<li>
					<a href="pr_absen.php" class="">
						<div class="parent-icon"><i class='bx bx-location-plus'></i>
						</div>
						<div class="menu-title">Absensi</div>
					</a>
				</li>
				<li class="mm-active">
					<a href="pr_sertifikat.php" class="">
						<div class="parent-icon"><i class='bx bx-award'></i>
						</div>
						<div class="menu-title">Sertifikat</div>
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
							<img <?php echo "src='foto/".$_SESSION['foto']."'"; ?> class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?= $_SESSION['nama']; ?> </p>
								<p class="designattion mb-0"><?= $_SESSION['asal_sekolah']; ?> </p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="pr_sertifikat.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
					<div class="breadcrumb-title pe-3">Sertifikat</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="pr_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Sertifikat</li>
							</ol>
						</nav>
					</div>

					
				</div>
				<h6 class="mb-0 text-uppercase">Sertifikat Prakerin Inovindo</h6>
				<hr/><br>
				<?php 
					$sql = "SELECT *,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin WHERE id_prakerin = '".$_SESSION['id']."';";
					$sqlnum = "SELECT * FROM hasil_prakerin WHERE id_prakerin = '".$_SESSION['id']."';";
					$result = mysqli_query(koneksi(),$sql);
					$num = mysqli_num_rows(mysqli_query(koneksi(),$sqlnum));
					//echo date('Y-m-d',strtotime(mysqli_fetch_assoc($result)['tanggal_selesai']));
					//echo date('Y-m-d');
					/*if (mysqli_num_rows($result) > 0){*/
						$data = mysqli_fetch_assoc($result);
						if($num == 0 || date('Y-m-d',strtotime($data['tanggal_selesai'])) < Date('Y-m-d')) {
							echo "<div class=\"text-white bg-danger radius-10\">
									<p class=\"p-2\">Anda Belum Mendapatkan Sertifikat.</p>
								</div>";
						} else {
							
							echo "<div class=\"m-auto d-flex justify-content-between bg-white\" style=\"width: fit-content;box-shadow: 0px 6px 19px -9px rgba(0,0,0,0.56);border-radius: 10px;\">
					
								<div style=\"background-color: wahite;border-radius:10px;padding: 20px;\">
									<h5>Sertifikat Kelulusan</h5>
									<h6>".substr($data["tanggal_selesai"], 8,2)." ".gantibulan(substr($data["tanggal_selesai"], 5,2))." ".substr($data["tanggal_selesai"], 0,4)."</h6>
									<h6 style=\"color:gray;\">PT. INOVINDO DIGITAL MEDIA</h6>
									
								</div>
								<a href=\"pr_sertifikat.php?detail=".$_SESSION['id']."\""."><i class=\"bx bx-info-circle p-3 m-auto colors-white\" style=\"font-size:60px;\"></i></a>
							</div>";
						}
				?>
				



			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © <?php echo date("Y"); ?>. All right reserved.</p>
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
	
	<script src="assets/js/index.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	
</body>

</html>