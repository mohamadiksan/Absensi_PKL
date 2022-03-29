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
	if (isset($_POST['editprakerin'])) {
		$nilama = $_GET['id'];
		$nibaru = $_POST['ni'];
		$nama = $_POST['nama'];
		$tgl_lahir = $_POST['tgl_lahir'];
		$tempat_lahir = $_POST['tempat_lahir'];
		$jk = $_POST['jk'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$agama = $_POST['agama'];
		$asal_sekolah = $_POST['asal_sekolah'];
		$program_keahlian = $_POST['program_keahlian'];
		$nama_ayah = $_POST['nama_ayah'];
		$telp_ayah = $_POST['telp_ayah'];
		$nama_ibu = $_POST['nama_ibu'];
		$telp_ibu = $_POST['telp_ibu'];
		$tgl_mulai = $_POST['tgl_mulai'];
		$durasi = $_POST['durasi'];
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$id = $_SESSION['id'];
		$foto = $_FILES['foto'];
		$password = $_POST['password'];
		$sql = "SELECT user.id FROM user JOIN prakerin ON prakerin.id_user = user.id WHERE prakerin.id_prakerin = '".$nilama."';";
		$id = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql))['id'];
		$level = 1;
		editprakerin($id,$nilama,$nibaru,$nama,$tgl_lahir,$tempat_lahir,$jk,$telepon,$email,$alamat,$agama,$asal_sekolah,$program_keahlian,$nama_ayah,$telp_ayah,$nama_ibu,$telp_ibu,$tgl_mulai,$durasi,$username,$password,$foto,$level);
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
				<li class="mm-active">
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
							<li><a class="dropdown-item" href="pg_editprofile.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
					<div class="breadcrumb-title pe-3">Prakerin</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="ad_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Prakerin</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Prakerin</li>
							</ol>
						</nav>
					</div>
				</div>
				
				<h6 class="mb-0 text-uppercase">Edit Biodata Prakerin</h6><hr>
				<a href="ad_peserta.php">
					<button type="button" class="btn btn-primary px-5 mb-3 radius-10"><i class='bx bx-arrow-back 1'></i>Kembali</button>
				</a>
				<div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div style="width:100%;"> 
                        
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">
                        <div class="col">
                        <style type="text/css">
                            .tab td:nth-child(1){
                                font-weight: bold;
                                height: 45px;
                            }
                        </style>
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <table class="m-auto mb-5 tab">

														<tr>
														<td width="120px">Nomor Induk</td>
														<td width="120px">:</td>
														<td><input type="text" class="form-control" id="inputEnterYourName" placeholder="NIS" <?= "value='".$_GET['id']."'" ?> name="ni"></td>
													</tr>
													<tr>
														<td>Nama Lengkap</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputPhoneNo2" placeholder="Nama Lengkap" <?php echo "value='".tampilprakerinpr($_GET['id'],"nama_prakerin")."'"; ?> name="nama"></td>
													</tr>
													<tr>
														<td>Tanggal Lahir</td>
														<td>:</td>
														<td><input type="date" class="form-control" <?php echo "value='".tampilprakerinpr($_GET['id'],"tanggal_lahir_prakerin")."'"; ?> name="tgl_lahir"></td>
													</tr>
													<tr>
														<td>Tempat Lahir</td>
														<td>:</td>
														<td>
															<select id='city' class="form-control" name="tempat_lahir">
																<option value='0' disabled>Pilih Kota/Kabupaten</option>
																<?php
																	for ($i=0; $i < count(kota()); $i++) { 
																		if (kota()[$i] == tampilprakerinpr($_GET['id'],"tempat_lahir_pgw")) {
																			echo "<option value='".kota()[$i]."' selected>".kota()[$i]."</option>"; 
																		} else {
																			echo "<option value='".kota()[$i]."'>".kota()[$i]."</option>"; 		
																		}
																	}

																?>
															</select>
														</td>
													</tr>
													<tr>
														<td>Jenis Kelamin</td>
														<td>:</td>
														<td>
															<select class="form-control" id="inputEmailAddress2" placeholder="Jenis Kelamin" name="jk">
																	<option value=''>Pilih Jenis Kelamin</option>
																	<?php
																		for ($i=0; $i < count(jk()); $i++) { 
																			if (jk()[$i] == "l") {
																				$text = "Laki - Laki";
																			} else {
																				$text = "Perempuan";
																			}
																			if (jk()[$i] == tampilprakerinpr($_GET['id'],"jk_pgw")) {
																				echo "<option value='".jk()[$i]."' selected>".$text."</option>"; 
																			} else {
																				echo "<option value='".jk()[$i]."'>".$text."</option>"; 		
																			}
																		}

																	?>
																</select>
														</td>
													</tr>
													<tr>
														<td>Telepon</td>
														<td>:</td>
														<td><input type="number" class="form-control" id="inputEmailAddress2" placeholder="Telepon" <?php echo "value='".tampilprakerinpr($_GET['id'],"telp_prakerin")."'"; ?> name="telepon"></td>
													</tr>
													<tr>
														<td>Email</td>
														<td>:</td>
														<td><input type="email" class="form-control" id="inputEmailAddress2" placeholder="Email" <?php echo "value='".tampilprakerinpr($_GET['id'],"email_prakerin")."'"; ?> name="email"></td>
													</tr>
													<tr>
														<td>Alamat</td>
														<td>:</td>
														<td><textarea class="form-control" id="inputAddress4" rows="3" placeholder="Alamat" name="alamat"><?php echo tampilprakerinpr($_GET['id'],"alamat_prakerin"); ?></textarea></td>
													</tr>
													<tr>
														<td>Agama</td>
														<td>:</td>
														<td>
															<select class="form-control" id="inputEmailAddress2" placeholder="Agama" name="agama">
																	<option value='0' disabled selected>Pilih Agama</option>
																	<?php 
																		for ($i=0; $i < count(agama()); $i++) { 
																			if (agama()[$i] == tampilprakerinpr($_GET['id'],"agama_prakerin")) {
																				echo "<option value='".agama()[$i]."' selected>".agama()[$i]."</option>";
																			} else {
																				echo "<option value='".agama()[$i]."'>".agama()[$i]."</option>";
																			}
																			
																		}
																	?>
																</select>
														</td>
													</tr>
													<tr>
														<td>Institusi</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Asal Sekolah" <?php echo "value='".tampilprakerinpr($_GET['id'],"asal_sekolah")."'"; ?> name="asal_sekolah"></td>
													</tr>
													<tr>
														<td>Program Keahlian</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Program Keahlian" <?php echo "value='".tampilprakerinpr($_GET['id'],"program_keahlian")."'"; ?> name="program_keahlian"></td>
													</tr>
													<tr>
														<td>Nama Ayah</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Nama Ayah" <?php echo "value='".tampilprakerinpr($_GET['id'],"nama_ayah")."'"; ?> name="nama_ayah"></td>
													</tr>
													<tr>
														<td>Telp Ayah</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Telpon Ayah" <?php echo "value='".tampilprakerinpr($_GET['id'],"telp_ayah")."'"; ?> name="telp_ayah"></td>
													</tr>
													<tr>
														<td>Nama Ibu</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Nama Ibu" <?php echo "value='".tampilprakerinpr($_GET['id'],"nama_ibu")."'"; ?> name="nama_ibu"></td>
													</tr>
													<tr>
														<td>Telp Ibu</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Telpon Ibu" <?php echo "value='".tampilprakerinpr($_GET['id'],"telp_ibu")."'"; ?> name="telp_ibu"></td>
													</tr>
													<tr>
														<td>Tanggal Mulai</td>
														<td>:</td>
														<td><input type="date" class="form-control" <?php echo "value='".tampilprakerinpr($_GET['id'],"tanggal_mulai")."'"; ?> name="tgl_mulai"></td>
													</tr>
													<tr>
														<td>Durasi</td>
														<td>:</td>
														<td>
															<div class="input-group">
																<input type="text" class="form-control border-end-0" placeholder="Durasi" <?php echo "value='".tampilprakerinpr($_GET['id'],"durasi_prakerin")."'"; ?> name="durasi">
																<i class="input-group-text bg-transparent">
																	Bulan
																</i>
															</div>
														</td>
													</tr>
													<tr>
				                                        <td>Foto</td>
				                                        <td>:</td>
				                                        <td><input type="file" class="form-control" id="inputEmailAddress2" placeholder="Username" name="foto"></td>
				                                    </tr>
													<tr>
														<td>Username</td>
														<td>:</td>
														<td><input type="text" class="form-control" id="inputEmailAddress2" placeholder="Username" <?php echo "value='".tampilprakerinpr($_GET['id'],"username")."'"; ?> name="username"></td>
													</tr>
													<tr>
														<td>Password</td>
														<td>:</td>
														<td><div class="input-group" id="show_hide_password">
																	<input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Masukkan Kata Sandi"> 
																	<a href="javascript:;" class="input-group-text bg-transparent">
																		<i class='bx bx-hide'></i>
																	</a>
																</div></td>
													</tr>
													<tr>
														<td></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td>
															<button type="submit" class="btn btn-primary px-5 radius-10" name="editprakerin"><i class='bx bx-save 1'></i>Simpan</button>
														</td>
													</tr>
													</table>
                            </form>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
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
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
</body>

</html>