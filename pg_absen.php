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
		elseif($_SESSION['level'] == 3) {
			echo "<script type='text/javascript'>window.location = 'pr_dashboard.php';</script>";
		}
	}
	if (isset($_POST['absen-pagi'])) {
		date_default_timezone_set('Asia/Jakarta');
		pgabsenpagi($_SESSION['id'],date('Y-m-d H:i:s'));
	}
	if (isset($_POST['absen-pulang'])) {
		pgabsenpulang($_POST['id']);
	}
	if (isset($_POST['absen-lembur'])) {
		$hasil = $_FILES['hasil'];
		pgabsenlembur($_POST['id'],$hasil);
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
	<script>
		function startTime() {
		  const today = new Date();
		  let h = today.getHours();
		  let m = today.getMinutes();
		  let s = today.getSeconds();
		  m = checkTime(m);
		  s = checkTime(s);
		  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
		  
		  getLocation();
		  setTimeout(startTime, 1000);
		}

		function checkTime(i) {
			  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
			  return i;
			}

		function getLocation() {
		  if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(showPosition);
		  } else { 
		    console.log("Geolocation is not supported by this browser.");
		  }
		}

		function showPosition(position) {
		  getDistanceFromLatLonInKm(position.coords.latitude,position.coords.longitude,-6.981777620591613, 107.673994967218680);
		  
		}

		function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
		  var R = 6371; // Radius of the earth in km
		  var dLat = deg2rad(lat2-lat1);  // deg2rad below
		  var dLon = deg2rad(lon2-lon1); 
		  var a = 
		    Math.sin(dLat/2) * Math.sin(dLat/2) +
		    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
		    Math.sin(dLon/2) * Math.sin(dLon/2)
		    ; 
		  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		  var d = R * c; // Distance in km
		  var z = document.getElementById("demo3");

		  if (d <= 15.01500) {
		    const today = new Date();
			  /*let h = today.getHours();
			  let m = today.getMinutes();*/
			   let h = 18;
			   let m = 0;
			  let s = today.getSeconds();
			  m = checkTime(m);
			  s = checkTime(s);
		    if (h >= 9 && h < 10 && m <= 30) {
			  	document.getElementById('form-kerja-masuk').style.cssText = 'display:block !important';
			  } else if(h >= 17 && h < 18) {
			  	document.getElementById('form-kerja-masuk').style.cssText = 'display:none !important';
			  	document.getElementById('form-kerja-pulang').style.cssText = 'display:block !important';
			  } else if(h >= 18 && h < 23) {
			  	document.getElementById('form-kerja-pulang').style.cssText = 'display:none !important';
			  	document.getElementById('form-kerja-masuk').style.cssText = 'display:none !important';
			  	document.getElementById('form-lembur').style.cssText = 'display:block !important';
			  } else {
			  	document.getElementById('diluar-jam').style.cssText = 'display:block !important';
			  	document.getElementById('form-kerja-masuk').style.cssText = 'display:none !important';
			  	document.getElementById('form-kerja-pulang').style.cssText = 'display:none !important';
			  	document.getElementById('form-lembur').style.cssText = 'display:none !important';
			  }
		  } else {
		    document.getElementById('diluar-lokasi').style.cssText = 'display:block !important';
		  	document.getElementById('form-kerja-pulang').style.cssText = 'display:none !important';
		  	document.getElementById('form-lembur').style.cssText = 'display:none !important';
		  	document.getElementById('diluar-jam').style.cssText = 'display:none !important';
		  }
		}

		function deg2rad(deg) {
		  return deg * (Math.PI/180);
		}
		</script>
	<title>INOVINDO - Manajemen Absensi</title>
</head>

 <body onload="startTime();"> 
	<!-- <body> -->
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
					<a href="pg_dashboard.php" class="">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="pg_profile.php" class="">
						<div class="parent-icon"><i class='bx bx-user-circle'></i>
						</div>
						<div class="menu-title">Profile</div>
					</a>
				</li>
				<li >
					<a href="pg_jadwal.php" class="">
						<div class="parent-icon"><i class='bx bxs-calendar'></i>
						</div>
						<div class="menu-title">Jadwal</div>
					</a>
				</li>
				<li class="mm-active">
					<a href="pg_absen.php" class="">
						<div class="parent-icon"><i class='bx bx-location-plus'></i>
						</div>
						<div class="menu-title">Absensi</div>
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
							<img <?php echo "src='foto/".$_SESSION['foto']."'"; ?> class="user-img" alt="user avatar">
							<!-- <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar"> -->
							 
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?= $_SESSION['nama']; ?> </p>
								<p class="designattion mb-0"><?= $_SESSION['jabatan']; ?> </p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="pg_absen.php?logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
					<div class="breadcrumb-title pe-3">Absensi</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="pg_dashboard.php"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Absensi</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">ABSENSI PEGAWAI INOVINDO</h6>
				<hr/>
        <div class="text-center">
          <h1 class="my-1" id="txt">19:30:57</h1>
        </div>
        <?php 
        		date_default_timezone_set('Asia/Jakarta');
						$sql = "SELECT * FROM `absen_pegawai` WHERE nip = '".$_SESSION['id']."' AND absen_pegawai.tgl_absen BETWEEN '".date('Y-m-d')." 00:00:00.00' AND '".date('Y-m-d')." 23:59:59.999';";
						$query = mysqli_query(koneksi(),$sql);
						
						$show = "SELECT content FROM libur WHERE tahun = '".date('Y')."';";
						$obj = json_decode(mysqli_fetch_assoc(mysqli_query(koneksi(),$show))['content']);
						//$json = file_get_contents('https://kalenderindonesia.com/api/APICprp2ZzIWc/libur/masehi/2021');
						//$obj = json_decode($json);
						//$date = date_create("2021-10-17");
						$libur = false;
						for ($i=1; $i <= 12; $i++) { 
					    for ($j=0; $j < $obj->data->holiday->{$i}->count; $j++) { 
					        if(Date('Y-m-d') == $obj->data->holiday->{$i}->data[$j]->date){
					          $libur = true;
					        }
					    }
						}
						for ($i=1; $i <= 12; $i++) { 
					    for ($j=0; $j < $obj->data->leave->{$i}->count; $j++) { 
					        if(Date('Y-m-d') == $obj->data->leave->{$i}->data[$j]->date){
					          $libur = true;
					        }
					    }
						}
			if (Date("D") == "Sun" && $libur == true) { ?>
				<div class="col" id="libur" style="display: block;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-calendar-exclamation p-2"></i>
        						<p class="p-2 mb-0">Hari Libur, Tidak Perlu Absen</p>
						</div>
			<?php } else { ?>


				<div class="row row-cols-1 row-cols-md-1 row-cols-xl-1 d-flex justify-content-around" id="form-kerja">
					<div class="col" id="diluar-jam" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-x p-2"></i>
        						<p class="p-2 mb-0">Anda Diluar Jam Absen</p>
						</div>
					</div>
					<div class="col" id="diluar-lokasi" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-x p-2"></i>
        						<p class="p-2 mb-0">Anda Diluar Lokasi Absen</p>
						</div>
					</div>
					<?php 
						date_default_timezone_set('Asia/Jakarta');
						$sql = "SELECT * FROM `absen_pegawai` WHERE nip = '".$_SESSION['id']."' AND absen_pegawai.tgl_absen BETWEEN '".date('Y-m-d')." 00:00:00.00' AND '".date('Y-m-d')." 23:59:59.999';";
						$data = mysqli_query(koneksi(),$sql);
						if (mysqli_num_rows($data) > 0) {
					?>
					<div class="col" id="form-kerja-masuk" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-success mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Anda Telah Melakukan Absen</p>
						</div>
					</div>
					<?php } else { ?>
					<div class="col" id="form-kerja-masuk" style="display: none;">
						<div class="card radius-10">
							<div class="card-body p-0 pb-3">
								<div class="text-center text-dark d-flex justify-content-center bg-warning mb-3" style="border-radius: 10px 10px 0 0;">
									<i class="bx bx-info-circle p-2"></i>
        								<p class="p-2 mb-0">Segera Lakukan Absen</p>
								</div>
								<div class="text-center">
                  						<h3 class="my-1">Absen Masuk</h3> <br>
                  						<div class="mb-2">
                  							<form action="#" method="POST">
                  								<button style="width:225px;" type="submit" class="btn btn-primary px-5 radius-10" name="absen-pagi"><i class='bx bx-task'></i>Absen</button>	
                  							</form>
                    						<!-- <a href="#"> -->
                    						
                  						</div>
                  						<!-- <div class="mb-1" width="175">
                  								<input type="file" name="" id='input_file' hidden>
                    							<button onclick="open_file()" style="width:225px;" type="button" class="btn btn-primary px-5 radius-10"><i class='bx bx-image-add'></i>Pilih Gambar</button></a>
                  						</div>  -->
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php 
						date_default_timezone_set('Asia/Jakarta');
						$sql = "SELECT * FROM `absen_pegawai` WHERE nip = '".$_SESSION['id']."' AND absen_pegawai.tgl_absen BETWEEN '".date('Y-m-d')." 00:00:00.00' AND '".date('Y-m-d')." 23:59:59.999';";
						$query = mysqli_query(koneksi(),$sql);
						if (mysqli_num_rows($query) > 0) {
							$data = mysqli_fetch_assoc($query);
							if ($data['ket'] == "Masuk-Pagi") {
								
							
					?>
					<div class="col"  id="form-kerja-pulang" style="display: none;">
						<div class="card radius-10">
							<div class="card-body p-0 pb-3">
								<div class="text-center text-dark d-flex justify-content-center bg-warning mb-3" style="border-radius: 10px 10px 0 0;">
									<i class="bx bx-info-circle p-2"></i>
        								<p class="p-2 mb-0">Segera Lakukan Absen</p>
								</div>
								<div class="text-center">
                  						<h3 class="my-1">Absen Pulang</h3><br>
                  						<div class="mb-1">
                    						<form action="#" method="POST">
          												<input type="hidden" name="id" <?php echo "value='".$data['id_absen_pegawai']."'"; ?>>
                    							<button style="width:225px;" type="submit" class="btn btn-primary px-5 radius-10" name="absen-pulang"><i class='bx bx-task'></i>Absen</button>
                    						</form>
                  						</div><br> 
                  						<!-- <div class="mb-1">
                    						<input type="file" name="" id='input_file' hidden>
                    						<button style="width:225px;" onclick="open_file()" type="button" class="btn btn-primary px-5 radius-10"><i class='bx bx-image-add'></i>Pilih Gambar</button></a>	
                  						</div>  -->
								</div>
							</div>
						</div>
					</div>
					<?php } elseif($data['ket'] == "Masuk") { ?>
						<div class="col" id="form-kerja-pulang" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-success mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Anda Telah Melakukan Absen</p>
						</div>
					</div>
					<?php } else { ?>
						<div class="col" id="form-kerja-pulang" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Absensi Anda Hari Ini : Tidak Hadir</p>
						</div>
					</div>
					<?php }} else { ?>
					<div class="col" id="form-kerja-pulang" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Absensi Anda Hari Ini : Tidak Hadir</p>
						</div>
					</div>
					<?php } ?>
					<?php 
						date_default_timezone_set('Asia/Jakarta');
						$sql = "SELECT * FROM `absen_pegawai` WHERE nip = '".$_SESSION['id']."' AND absen_pegawai.tgl_absen BETWEEN '".date('Y-m-d')." 00:00:00.00' AND '".date('Y-m-d')." 23:59:59.999';";
						$query = mysqli_query(koneksi(),$sql);
						if (mysqli_num_rows($query) > 0) {
							$data = mysqli_fetch_assoc($query);
							if ($data['ket'] == "Masuk" && $data['lembur'] == "Tidak") {
					?>
					<div class="col"  id="form-lembur" style="display: none;">
						<div class="card radius-10">
							<div class="card-body p-0 pb-3">
								<div class="text-center text-dark d-flex justify-content-center bg-warning mb-3" style="border-radius: 10px 10px 0 0;">
									<i class="bx bx-info-circle p-2"></i>
        								<p class="p-2 mb-0">Segera Lakukan Absen</p>
								</div>
								<div class="text-center">
                  						<h3 class="my-1">Absen Lembur</h3><br>
                  						<div class="mb-1">
                    						<form action="#" method="POST" enctype="multipart/form-data">
                    							<input type="hidden" name="id" <?php echo " value='".$data['id_absen_pegawai']."'"; ?> >
                    							<input type="file" class="form-control text-center m-auto mb-3" placeholder="Hasil" style="width: 250px;" name="hasil">
                    							<button style="width:225px;" type="submit" class="btn btn-primary px-5 radius-10"  name="absen-lembur"><i class='bx bx-task'></i>Absen</button></form>	          							
                  						</div><br>
                  						<!-- <div class="mb-1">
                    						<input type="file" name="" id='input_file' hidden>
                    						<button style="width:225px;" onclick="open_file()" type="button" class="btn btn-primary px-5 radius-10"><i class='bx bx-image-add'></i>Pilih Gambar</button></a>	
                  						</div> --> 
								</div>
							</div>
						</div>
					</div>
					<?php } elseif($data['ket'] == "Masuk" && $data['lembur'] == "Wait") { ?>
						<div class="col" id="form-lembur" style="display: none;">
						<div class="text-center text-dark d-flex justify-content-center radius-10 bg-warning mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Absen Lembur Anda Menunggu Konfirmasi Admin</p>
						</div>
					</div>
					<?php } elseif($data['ket'] == "Masuk" && $data['lembur'] == "Ya") { ?>
						<div class="col" id="form-lembur" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-success mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Anda Telah Melakukan Absen</p>
						</div>
					</div>
					<?php } else { ?>
						<div class="col" id="form-lembur" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Absensi Anda Hari Ini : Tidak Hadir</p>
						</div>
					</div>
				<?php	} } else { ?>
					<div class="col" id="form-lembur" style="display: none;">
						<div class="text-center text-light d-flex justify-content-center radius-10 bg-danger mb-3"> 
							<i class="bx bx-check p-2"></i>
        						<p class="p-2 mb-0">Absensi Anda Hari Ini : Tidak Hadir</p>
						</div>
					</div>
				<?php } 
			}?>
				</div>
				<!--end row-->

        <hr/>
				
        <div class="row">
				
					<div class="col-xl-12 mx-auto">
					<!-- <div class="mb-3 d-flex justify-content-end">
						<input style='width: 200px;' type="month" class="form-control">
					</div> -->
						<div class="card">
							<div class="card-body">
								
							<div class="table-responsive">
								<table id='tbnobutton' class="table table-striped table-bordered">
								<?php
										
											detailabsenpg($_SESSION['id']);
										
									?>
								</table>	
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
  <script type="text/javascript">
  function open_file(){
    document.getElementById('input_file').click();
  }
  </script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="assets/js/widgets.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/table-datatable.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	
</body>

</html>