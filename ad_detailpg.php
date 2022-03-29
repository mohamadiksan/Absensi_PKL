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
	if (isset($_GET['hapusid'])) {
		hapuspegawai($_GET['hapusid']);
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
				<li class="mm-active">
					<a href="ad_pegawai.php" class="">
						<div class="parent-icon"><i class='bx bx-id-card'></i>
						</div>
						<div class="menu-title">Pegawai</div>
					</a>
				</li>
				<li >
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
							
							<li><a class="dropdown-item" href="ad_pegawai.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
					<div class="breadcrumb-title pe-3">Pegawai</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="ad_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Pegawai</li>
								<li class="breadcrumb-item active" aria-current="page">Detail Pegawai</li>
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
				<h6 class="mb-0 text-uppercase">Detail Pegawai Inovindo</h6>
						<hr/>
						<div class="mb-3">
			<div class="col">
                <a href="ad_pegawai.php">
				<button type="button" class="btn btn-primary px-5 radius-10"><i class='bx bx-arrow-back 1'></i>Kembali</button></a>
			</div>

			</div>
				<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div style="width:100%;">
										
										<?php 
											$sql = "SELECT nip FROM pegawai where id_user = '".$_GET['id']."';"; 
											$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql))['nip'];
										?>
										<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
											<div class="col">
												<?php 
												if (tampilpegawaipg($data, "foto") != "avatar.png") {
													echo "<img src='foto/".tampilpegawaipg($data, "foto")."' class=\"m-auto mb-5 d-block\" style=\"border-radius: 10px; max-width: 200px;\" alt=\"user avatar\">";	
												} else {
													echo "<img src='foto/avatar.png' class=\"m-auto mb-5 d-block\" style=\"border-radius: 10px; max-width: 200px;\" alt=\"user avatar\">";
												}
												?>
											</div>
											<div class="col">
												<style type="text/css">
													.tab td:nth-child(1){
														font-weight: bold;
														height: 45px;
													}
												</style>
												<table class="m-auto mb-5 tab">
													
													<tr>
														<td width="120px">NIP</td>
														<td width="120px">:</td>
														<td><?php echo tampilpegawaipg($data,"nip") ?></td>
													</tr>
													<tr>
														<td>Nama Lengkap</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"nama_pgw") ?></td>
													</tr>
													<tr>
														<td>NIK</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"nik_pgw") ?></td>
													</tr>
													<tr>
														<td>Tanggal Lahir</td>
														<td>:</td>
														<td><?php 
														if (tampilpegawaipg($data,"tgl_lahir_pgw") != "") {
															echo substr(tampilpegawaipg($data,"tgl_lahir_pgw"), 8,2)." ".gantibulan(substr(tampilpegawaipg($data,"tgl_lahir_pgw"), 5,2))." ".substr(tampilpegawaipg($data,"tgl_lahir_pgw"), 0,4); 	
														}
														?></td>
													</tr>
													<tr>
														<td>Tempat Lahir</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"tempat_lahir_pgw") ?></td>
													</tr>
													<tr>
														<td>Jenis Kelamin</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"jk_pgw") ?></td>
													</tr>
													<tr>
														<td>Telepon</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"telp_pgw") ?></td>
													</tr>
													<tr>
														<td>Email</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"email_pgw") ?></td>
													</tr>
													<tr>
														<td>Alamat</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"alamat_pgw") ?></td>
													</tr>
													<tr>
														<td>Jabatan</td>
														<td>:</td>
														<td><?php
														echo tampilpegawaipg($data,"jabatan_pgw") ?></td>
													</tr>
													<tr>
														<td>Status</td>
														<td>:</td>
														<td><?php
														if (tampilpegawaipg($data,"status") != ''){
															echo tampilpegawaipg($data,"status");
														}?></td>
													</tr>
													<tr>
														<td>Agama</td>
														<td>:</td>
														<td><?php
														if (tampilpegawaipg($data,"agama") != ''){
														echo tampilpegawaipg($data,"agama");} ?></td>
													</tr>
													<tr>
														<td>Username</td>
														<td>:</td>
														<td><?php echo tampilpegawaipg($data,"username") ?></td>
													</tr>
												</table>
											</div>
											<div class="col"></div>
											<div class="col"></div>
										</div>
										
									</div>
								</div>
								
							</div>
						</div>
			
			</div>
						<!-- <div style="display:flex;justify-content: end;">
			<div class="m-3 text-center">
			    <button type="button" class="btn btn-primary px-5 radius-30"><i class='bx bx-cloud-download mr-1'></i>Unduh</button>
			</div>
		</div> -->
		
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
	<!-- <script type="text/javascript">
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [
							{
                extend: 'copy',
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                }
            	}, 
							{
                extend: 'excelHtml5',
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                }
            	},
				    	{
				       	extend: 'pdfHtml5',
				       	pageSize: 'A4',
				       	exportOptions: {
                  columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
              	}
				    	}, 
				    	{
                extend: 'print',
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                },
              	customize: function(doc) {
					        doc.styles.tableHeader.alignment = 'center';
					      }
            	},
				]
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script> -->
	<script src="assets/js/index.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	
</body>

</html>