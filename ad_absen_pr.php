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
	<script type="text/javascript">
		function hidePagination() {
			var x = document.getElementsByClassName('paginate_button');
			for (i = 0; i < x.length; i++) {
			  x[i].style.display = "none";
			}
		}
	</script>
</head>

<body  <?php if (isset($_GET['i'])) {echo "onload='hidePagination();'";} ?> >
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
					<a href="ad_dashboard.php">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="ad_pegawai.php">
						<div class="parent-icon"><i class='bx bx-id-card'></i>
						</div>
						<div class="menu-title">Pegawai</div>
					</a>
				</li>
				<li>
					<a href="ad_peserta.php">
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
					<a href="ad_sertifikat.php">
						<div class="parent-icon"><i class='bx bx-award'></i>
						</div>
						<div class="menu-title">Sertifikat</div>
					</a>
				</li>
				<li>
					<a href="ad_jadwal.php">
						<div class="parent-icon"><i class='bx bxs-calendar'></i>
						</div>
						<div class="menu-title">Jadwal</div>
					</a>
				</li>
				<li class="mm-active">
					<a href="ad_absen_pg.php">
						<div class="parent-icon"><i class='bx bx-location-plus'></i>
						</div>
						<div class="menu-title">Absensi</div>
					</a>
				</li>
				<li>
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
							<li><a class="dropdown-item" href="ad_absen_pr.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Absen</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="ad_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Data Absen</li>
								<?php
										if (isset($_GET['i'])) {
											echo "<li class='breadcrumb-item active' aria-current='page'>Detail Data Absen</li>";
										} else {
											
										}
									?>
							</ol>
						</nav>
					</div>
					
						<?php
										if (empty($_GET['i'])) {
											echo "<div class=\"ms-auto\">
											<div class=\"btn-group\">
												<div class=\"d-flex justify-content-end\">
												<button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">Kategori</button>
												<ul class=\"dropdown-menu dropdown-menu-right dropdown-menu-lg-end\">
													<li><a class=\"dropdown-item\" href=\"ad_absen_pg.php\">Pegawai</a>
													</li>
													<li><a class=\"dropdown-item\" href=\"ad_absen_pr.php\">Peserta Prakerin</a>
													</li>
												</ul>
												</div>
											</div></div>";
										}  
									?>
					
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">
					<?php
						if (isset($_GET['i'])) {
							$sql = "SELECT nama_prakerin FROM prakerin WHERE id_prakerin = '".$_GET['i']."';";
							$nama = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql))['nama_prakerin'];
							echo "Data Absensi <b>".$nama."</b>";
						} else {
							echo "Data Absensi Peserta Prakerin";
						}
					?>
				</h6>
				<hr/>
				<div class="mb-3" style="display:flex; justify-content:space-between;">
				<?php
					if (isset($_GET['i'])) {
						echo "
							<a href='ad_absen_pr.php'>
							<button type='button' class='btn btn-primary px-5 radius-10'><i class='bx bx-arrow-back 1'></i>Kembali</button></a>
						";
					} else {
						echo "<div class='mb-3 d-flex justify-content-between'>
						<form action=\"\" method=\"GET\" style=\"display:flex; flex:end; justify-content:end;\">
							<input style='width: 200px;' type=\"month\" class=\"form-control\" name=\"month\" ";
							if (isset($_GET['month'])) {
									echo "value='".$_GET['month']."'";
								}
						echo "><button type=\"submit\" class=\"btn btn-primary\"><i class='bx bx-search-alt me-0'></i></button>
						</form></div>
					";
					}
				?>
				
					</div>
					
					
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table <?php if (isset($_GET['i'])) {echo "id='tbnobutton'";} else {echo "id='tbnobutton'";} ?> class="table table-striped table-bordered">
								
									<?php
										if (isset($_GET['i'])) {
											detailabsenpr($_GET['i']);
										} else {
											if (isset($_GET['month'])) {
												$tahun = substr($_GET['month'],0,4);
												$bulan = substr($_GET['month'],5,2);
												tampilpr($tahun,$bulan);
											} else {
												tampilpr(date('Y'),date('m'));
											}
										}
									?>
								
							</table>
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
			<p class="mb-0">Copyright © <?php echo date("Y"); ?>. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/table-datatable.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>