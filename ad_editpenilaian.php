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
	if (isset($_POST['editpenilaian'])) {
		$conn = koneksi();
		mysqli_autocommit($conn, false);
		mysqli_begin_transaction($conn);
		
		try {
			hapuspenilaian($_POST['id'],$conn);
			for ($i=1; $i < (count($_POST)/4); $i++) {
				$aspek = $_POST['aspek'.$i];
				$cat = $_POST['cat'.$i];
				$nilai = $_POST['nilai'.$i];
				$ket = $_POST['ket'.$i];
				$id_prakerin = $_POST['id'];
				if ($aspek != "" && $nilai != 0) {
					if(penilaian($aspek,$cat,$nilai,$ket,$id_prakerin,$conn)){
						
					} else {
						throw new Exception("Error!");
					}
				}
			}
			if(mysqli_commit($conn)){
				echo "<script type='text/javascript'>alert('Berhasil');window.location = 'ad_penilaian.php';</script>";		
			}
		} catch (\Exception $e) {
	    	mysqli_rollback($conn);
	    	echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_penilaian.php';</script>";	
		} catch (mysqli_sql_exception $exception) {
	    	mysqli_rollback($conn);
	    	echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_penilaian.php';</script>";	
		}



		
		
	}
	/*if (isset($_POST['simpanpenilaian'])) {
		var_dump
	}*/
?>
<!doctype html>
<html lang="en">
	<style>
	.flex-container {
	  display: flex;
	  align-items: stretch;
	  background-color: #f1f1f1;
	}

	.flex-container > div {
	  background-color: DodgerBlue;
	  color: white;
	  margin: 10px;
	  text-align: center;
	  line-height: 75px;
	  font-size: 30px;
	}
	</style>

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

	<body onload="sikapUpdate();pengetahuanUpdate();keterampilanUpdate();">
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
					<div class="toggle-icon ms-auto">
						<i class='bx bx-arrow-to-left'></i>
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
					<li class="mm-active">
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
							<li><a class="dropdown-item" href="ad_jadwal.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
					<div class="breadcrumb-title pe-3">Penilaian Prakerin</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="ad_dashboard.php"><i class="bx bx-home-alt"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Penilaian Prakerin</li>
									<li class="breadcrumb-item active" aria-current="page">Ubah Nilai</li>
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
				<h6 class="mb-0 text-uppercase">Penilaian Peserta Prakerin Inovindo</h6>
						<hr/>
						<div class="mb-3">
			<div class="col">
                <a href="ad_penilaian.php">
				<button type="button" class="btn btn-primary px-5 radius-10"><i class='bx bx-arrow-back'></i>Kembali</button></a>
			</div>

			</div>
			<br>
			
			<form action="#" method="POST">
				<input type="hidden" name="id" <?php echo "value='".$_POST['id']."'"; ?> >
			
					<div class="mb-3">
			<h6>SIKAP</h6><hr/>
			<div>
				<span class="bx bx-plus-circle" style="cursor:pointer" onclick="addSikap();"></span>
				<span class="bx bx-minus-circle" style="cursor:pointer" onclick="delSikap();"></span>
				<script>

				function sikapUpdate(){
					var sikap = document.getElementsByClassName("form-sikap");
					for(var i = 0;i < sikap.length;i++){
							sikap[i].children[0].children[0].name = "cat"+(i+1);
				  		sikap[i].children[0].children[1].name = "aspek"+(i+1);
				  		sikap[i].children[0].children[2].name = "nilai"+(i+1);
				  		sikap[i].children[0].children[3].name = "ket"+(i+1);
					}
					pengetahuanUpdate();
					keterampilanUpdate();
				}
				function pengetahuanUpdate(){
					var peng = document.getElementsByClassName("form-pengetahuan");
					var sikap = document.getElementsByClassName("form-sikap");
					for(var i = 0;i < peng.length;i++){
							peng[i].children[0].children[0].name = "cat"+(i+1+sikap.length);
				  		peng[i].children[0].children[1].name = "aspek"+(i+1+sikap.length);
				  		peng[i].children[0].children[2].name = "nilai"+(i+1+sikap.length);
				  		peng[i].children[0].children[3].name = "ket"+(i+1+sikap.length);
					}
				}
				function keterampilanUpdate(){
					var sikap = document.getElementsByClassName("form-sikap");
					var peng = document.getElementsByClassName("form-pengetahuan");
					var ket = document.getElementsByClassName("form-keterampilan");
					for(var i = 0;i < ket.length;i++){
						ket[i].children[0].children[0].name = "cat"+(i+peng.length+sikap.length+1);
				  		ket[i].children[0].children[1].name = "aspek"+(i+peng.length+sikap.length+1);
				  		ket[i].children[0].children[2].name = "nilai"+(i+peng.length+sikap.length+1);
				  		ket[i].children[0].children[3].name = "ket"+(i+peng.length+sikap.length+1);
					}
				}	
				function addSikap() {
				  	var itm = document.getElementsByClassName("form-sikap");
					var cln = itm[0].cloneNode(true);
					
				  	document.getElementById("card-sikap").appendChild(cln);
				  	itm[itm.length-1].children[0].children[1].value = "";
			  		itm[itm.length-1].children[0].children[2].value = "";
			  		itm[itm.length-1].children[0].children[3].value = "";
				  	for(var i = 0;i < itm.length;i++){
				  		itm[i].children[0].children[0].name = "cat"+(i+1);
				  		itm[i].children[0].children[1].name = "aspek"+(i+1);
				  		itm[i].children[0].children[2].name = "nilai"+(i+1);
				  		itm[i].children[0].children[3].name = "ket"+(i+1);
				  		
					}
					pengetahuanUpdate();
					keterampilanUpdate();
				}
				function delSikap(){
					var list = document.getElementById("card-sikap");   // Get the <ul> element with id="myList"
					list.removeChild(list.lastChild); 
					pengetahuanUpdate();
					keterampilanUpdate();
				}

				</script>
			</div>
			<div class="card radius-10">
				<div class="mb-3">
					<div class="card-body" id="card-sikap">
						<?php 
							if (isset($_POST['id'])) {
									$sql = "SELECT * FROM hasil_prakerin WHERE hasil_prakerin.id_prakerin ='".$_POST['id']."' AND hasil_prakerin.category = 'Sikap';";
									$data = mysqli_query(koneksi(),$sql);
									foreach ($data as $row) {
										echo "<div class='row mb-3 form-sikap' id='form-sikap'>
									<div class='col-sm-9' style='display:flex; justify-content:space-around; width:100%'>
										<input type='hidden' name='cat1' value='Sikap'>
										<input type='text' class='form-control' id='form' style='margin-right: 20px;' placeholder='Aspek' name='aspek1' value='".$row['aspek']."'>
										<input type='text' class='form-control' id='form' style='width: 150px; margin-right: 20px; ' placeholder='Nilai' name='nilai1' value='".$row['nilai']."'>
										<input type='text' class='form-control' id='form' placeholder='Keterangan' name='ket1' value='".$row['keterangan']."'>
									</div>
								</div>";
									}
							}
							
						?>
						
						<div class="row mb-3 form-sikap" id="form-sikap">
							<div class="col-sm-9" style="display:flex; justify-content:space-around; width:100%">
								<input type="hidden" name="cat1" value="sikap">
								<input type="text" class="form-control" id="form" style="margin-right: 20px; " placeholder="Aspek" name="aspek1">
								<input type="text" class="form-control" id="form" style="width: 150px; margin-right: 20px; " placeholder="Nilai" name="nilai1">
								<input type="text" class="form-control" id="form" placeholder="Keterangan" name="ket1">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<div class="mb-3">
			<h6>PENGETAHUAN</h6><hr/>
			<div>
				<span class="bx bx-plus-circle" style="cursor:pointer" onclick="addPengetahuan();"></span>
				<span class="bx bx-minus-circle" style="cursor:pointer" onclick="delPengetahuan();"></span>
				<script>
				
				function addPengetahuan() {
				  	var itm = document.getElementsByClassName("form-pengetahuan");
				  	var sikap = document.getElementsByClassName("form-sikap");
						var cln = itm[0].cloneNode(true);
				  	document.getElementById("card-pengetahuan").appendChild(cln);
				  	itm[itm.length-1].children[0].children[1].value = "";
			  		itm[itm.length-1].children[0].children[2].value = "";
			  		itm[itm.length-1].children[0].children[3].value = "";
				  	for(var i = 1;i < itm.length;i++){
				  		itm[i].children[0].children[0].name = "cat"+(i+sikap.length);
				  		itm[i].children[0].children[1].name = "aspek"+(i+sikap.length);
				  		itm[i].children[0].children[2].name = "nilai"+(i+sikap.length);
				  		itm[i].children[0].children[3].name = "ket"+(i+sikap.length);
					}
					keterampilanUpdate();
				}
				function delPengetahuan(){
					var list = document.getElementById("card-pengetahuan");   // Get the <ul> element with id="myList"
					list.removeChild(list.lastChild); 
					keterampilanUpdate();
				}

				</script>
			</div>
			<div class="card radius-10">
				<div class="mb-3">		
					<div class="card-body" id="card-pengetahuan">


						<?php 
							
							if (isset($_POST['id'])) {
							$sql = "SELECT * FROM hasil_prakerin WHERE hasil_prakerin.id_prakerin ='".$_POST['id']."' AND hasil_prakerin.category = 'Pengetahuan';";
							$data = mysqli_query(koneksi(),$sql);
							foreach ($data as $row) {
										echo "<div class='row mb-3 form-pengetahuan' id='form-pengetahuan'>
									<div class='col-sm-9' style='display:flex; justify-content:space-around; width:100%'>
										<input type='hidden' name='cat1' value='Pengetahuan'>
										<input type='text' class='form-control' id='form' style='margin-right: 20px;' placeholder='Aspek' name='aspek1' value='".$row['aspek']."'>
										<input type='text' class='form-control' id='form' style='width: 150px; margin-right: 20px; ' placeholder='Nilai' name='nilai1' value='".$row['nilai']."'>
										<input type='text' class='form-control' id='form' placeholder='Keterangan' name='ket1' value='".$row['keterangan']."'>
									</div>
								</div>";
								}	
							}
							
						?>
						<div class="row mb-3 form-pengetahuan" id="form-pengetahuan">
							<div class="col-sm-9" style="display:flex; justify-content:space-around; width:100%">
								<input type="hidden" name="cat2" value="Pengetahuan">
								<input type="text" class="form-control" id="form" style="margin-right: 20px; " placeholder="Aspek" name="aspek2">
								<input type="text" class="form-control" id="form" style="width: 150px; margin-right: 20px; " placeholder="Nilai" name="nilai2">
								<input type="text" class="form-control" id="form" placeholder="Keterangan" name="ket2">
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
			<div class="mb-3">
				<h6>KETERAMPILAN</h6><hr/>
						<span class="bx bx-plus-circle" style="cursor:pointer" onclick="addKeterampilan();"></span>
						<span class="bx bx-minus-circle" style="cursor:pointer" onclick="delKeterampilan();"></span>
						<script>
						
						function addKeterampilan() {
							var peng = document.getElementsByClassName("form-pengetahuan");
							var sikap = document.getElementsByClassName("form-sikap");
							var itm = document.getElementsByClassName("form-keterampilan");
							var cln = itm[0].cloneNode(true);
							document.getElementById("card-keterampilan").appendChild(cln);
							itm[itm.length-1].children[0].children[1].value = "";
					  		itm[itm.length-1].children[0].children[2].value = "";
					  		itm[itm.length-1].children[0].children[3].value = "";
							for(var i = 1;i < itm.length;i++){
						  		itm[i].children[0].children[0].name = "cat"+(i+peng.length+sikap.length+1);
				  				itm[i].children[0].children[0].name = "aspek"+(i+peng.length+sikap.length+1);
				  				itm[i].children[0].children[1].name = "nilai"+(i+peng.length+sikap.length+1);
				  				itm[i].children[0].children[2].name = "ket"+(i+peng.length+sikap.length+1);
							}
						}
						function delKeterampilan(){
							var list = document.getElementById("card-keterampilan");   // Get the <ul> element with id="myList"
							list.removeChild(list.lastChild); 
						}
						</script>
					<div class="card radius-10">
						
						
				<div class="mb-1">		
					<div class="card-body" id="card-keterampilan">


						<?php 
							if (isset($_POST['id'])) {
								$sql = "SELECT * FROM hasil_prakerin WHERE hasil_prakerin.id_prakerin ='".$_POST['id']."' AND hasil_prakerin.category = 'Keterampilan';";
								$data = mysqli_query(koneksi(),$sql);
								foreach ($data as $row) {
									echo "<div class='row mb-3 form-keterampilan' id='form-keterampilan'>
									<div class='col-sm-9' style='display:flex; justify-content:space-around; width:100%'>
										<input type='hidden' name='cat1' value='Keterampilan'>
										<input type='text' class='form-control' id='form' style='margin-right: 20px;' placeholder='Aspek' name='aspek1' value='".$row['aspek']."'>
										<input type='text' class='form-control' id='form' style='width: 150px; margin-right: 20px; ' placeholder='Nilai' name='nilai1' value='".$row['nilai']."'>
										<input type='text' class='form-control' id='form' placeholder='Keterangan' name='ket1' value='".$row['keterangan']."'>
									</div>
								</div>";
								}
							}
							
						?>
						<div class="row mb-3 form-keterampilan" id="form-keterampilan">
							<div class="col-sm-9" style="display:flex; justify-content:space-around; width:100%">
								<input type="hidden" name="cat3" value="Keterampilan">
								<input type="text" class="form-control" id="inputEnterYourName" style="margin-right: 20px; " placeholder="Aspek" name="aspek3">
								<input type="text" class="form-control" id="inputEnterYourName" style="width: 150px; margin-right: 20px; " placeholder="Nilai" name="nilai3">
								<input type="text" class="form-control" id="inputEnterYourName" placeholder="Keterangan" name="ket3">
							</div>
						</div>	

					</div>
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
			<button type="submit" name="editpenilaian" class="btn btn-primary px-2 radius-10 mb-5"><i class='bx bx-save'></i>Simpan</button>
			</div>
		</form>
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