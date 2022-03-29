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
	if (isset($_GET['detail']) && isset($_GET['d'])) {
		createpdf($_GET['detail'],$_GET['d']);
		/*$sql = "SELECT *,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin WHERE id_prakerin = '".$_GET['detail']."';";
		$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
		
		$month = (int) substr($data['tanggal_mulai'],5,2) + (int) $data['durasi_prakerin'];
		
		$year = substr($data['tanggal_mulai'], 0, 4);
		if ($data['no_sertifikat'] < 10) {
			$nomor = "00".$data['no_sertifikat'];	
		} elseif($data['no_sertifikat'] < 100) {
			$nomor = "0".$data['no_sertifikat'];
		} else {
			$nomor = $data['no_sertifikat'];
		}
		
		$no = "No. ".$nomor."/IDM/PKL.SERTIFIKAT/".gantitanggal(substr($data['tanggal_selesai'],5,2))."/".$year;
		
		$tanggal_mulai = substr($data["tanggal_mulai"], 8,2)." ".gantibulan(substr($data["tanggal_mulai"], 5,2))." ".substr($data["tanggal_mulai"], 0,4);

		$tanggal_selesai = substr($data["tanggal_selesai"], 8,2)." ".gantibulan(substr($data["tanggal_selesai"], 5,2))." ".substr($data["tanggal_selesai"], 0,4);
		if ($_GET['d'] == "true") {
			createpdf($no,$data['nama_prakerin'],$data['program_keahlian'],$tanggal_mulai,$tanggal_selesai,"D",$data['asal_sekolah']);
		} else {
			createpdf($no,$data['nama_prakerin'],$data['program_keahlian'],$tanggal_mulai,$tanggal_selesai,"",$data['asal_sekolah']);
		}*/
		
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
	<title>Inovindo - Manajemen Absensi</title>
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
				<li class="mm-active">
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
							<i class="bx bx-user-circle" style="font-size: 30px;"></i>
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?= strtoupper($_SESSION['username']); ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							
							<li><a class="dropdown-item" href="ad_sertifikat.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
								<li class="breadcrumb-item"><a href="ad_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Sertifikat</li>
							</ol>
						</nav>
					</div>
				</div>
				<h6 class="mb-0 text-uppercase">Tabel Peserta Prakerin Yang Telah Selesai</h6>
						<hr/>


				<div class="card">
					<style type="text/css">
					::-webkit-scrollbar {
					    width: 8px;
					    height: 8px;
					}

					/* Track */
					::-webkit-scrollbar-track {
					    background: #f1f1f1; 

					}

					/* Handle */
					::-webkit-scrollbar-thumb {
					    background: #888; 
					    border-radius: 20px ;

					}

					/* Handle on hover */
					::-webkit-scrollbar-thumb:hover {
					    background: #555; 
					}
				</style>

					<div class="card-body">
						<div class="table-responsive">
							<table id="tbnobutton" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th scope="col">No</th>
		                <th scope="col">Nomor Induk</th>
		                <th scope="col">Nama</th>
		                <th scope="col">Institusi</th>
		                <!-- <th scope="col">Tanggal Mulai</th>
		                <th scope="col">Tanggal Selesai</th> -->
		                <th scope="col">Sertifikat</th>
									</tr>
								</thead>
								<tbody>
									<?php tampilsertifikat(); ?>
								</tbody>
							</table>
						</div>
					</div>
       <!--  <div class="card-body" style="overflow-x:scroll;">
        	<form action="" method="POST">
	          <table class="table mb-0 table-striped">
						<thead>
	              <tr>
	                <th scope="col">No</th>
	                <th scope="col">Nomor Induk</th>
	                <th scope="col">Nama</th>
	                <th scope="col">Tanggal Mulai</th>
	                <th scope="col">Tanggal Selesai</th>
	                <th scope="col">Nilai</th>
	              </tr>
	            </thead>
	            <tbody>
	              
	            </tbody>
	          </table>
          </form>
          <div class="col m-3">
                <a href="peserta.php" style="float: right;">
									<button type="button" class="btn btn-primary px-2 radius-10"><i class='bx bx-save'></i>Simpan</button>
								</a>
					</div>
        </div> -->
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
	<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/table-datatable.js"></script>
	<script src="assets/js/index.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	
</body>

</html>