<?php
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	date_default_timezone_set('Asia/Jakarta');
	function koneksi(){
		//$koneksi = mysqli_connect("localhost", "yaxxxxyz_admin", "Aryadila1234", "yaxxxxyz_inovindo_db");
		$koneksi = mysqli_connect("localhost", "root", "", "inovindo_db");
		return $koneksi;
	}

	function login($username,$password){
		/*if ($level == 1) {
			//sql level admin
			$sql = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."';";
		} elseif($level == 2) {
			//level pegawai
			$sql = "SELECT * FROM pegawai WHERE username_pgw = '".$username."' AND password_pgw = '".$password."';";
		} else {
			//level prakerin
			$sql = "SELECT * FROM prakerin WHERE username_prakerin = '".$username."' AND password_prakerin = '".$password."';";
		}*/
		$sql = "SELECT * FROM user WHERE username = '".$username."';";
		$query = mysqli_query(koneksi(), $sql); 
		//$data = mysqli_fetch_assoc($query);
		foreach ($query as $row) {
			if (password_verify($password,$row['password'])) {
				if ($row['level'] == 1) {
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $username;
					$_SESSION['level'] = $row['level'];
					echo "<script type='text/javascript'>window.location = 'ad_dashboard.php';</script>";
				} elseif($row['level'] == 2){
					$id = $row['id'];
					$detail = mysqli_fetch_assoc(mysqli_query(koneksi(),"SELECT * FROM pegawai JOIN user ON pegawai.id_user = user.id WHERE pegawai.id_user = '".$id."';"));
					$_SESSION['level'] = $row['level'];
					$_SESSION['id'] = $detail['nip'];
					$_SESSION['nama'] = $detail['nama_pgw'];
					$_SESSION['jabatan'] = $detail['jabatan_pgw'];
					$_SESSION['foto'] = $detail['foto'];
					echo "<script type='text/javascript'>window.location = 'pg_dashboard.php';</script>";
				} else {
					$id = $row['id'];
					$detail = mysqli_fetch_assoc(mysqli_query(koneksi(),"SELECT * FROM prakerin JOIN user ON prakerin.id_user = user.id WHERE prakerin.id_user = '".$id."';"));
					$_SESSION['level'] = $row['level'];
					$_SESSION['id'] = $detail['id_prakerin'];
					$_SESSION['nama'] = $detail['nama_prakerin'];
					$_SESSION['asal_sekolah'] = $detail['asal_sekolah'];
					$_SESSION['foto'] = $detail['foto'];
					echo "<script type='text/javascript'>window.location = 'pr_dashboard.php';</script>";
				}
			} else {
				echo "<script type='text/javascript'>alert('Data salah, silahkan coba kembali!');window.location = 'index.php';</script>";
			}	
		}
		/*if(mysqli_num_rows($query) > 0) {
			
		} */
	}

	function login1($username,$password){
		/*if ($level == 1) {
			//sql level admin
			$sql = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."';";
		} elseif($level == 2) {
			//level pegawai
			$sql = "SELECT * FROM pegawai WHERE username_pgw = '".$username."' AND password_pgw = '".$password."';";
		} else {
			//level prakerin
			$sql = "SELECT * FROM prakerin WHERE username_prakerin = '".$username."' AND password_prakerin = '".$password."';";
		}*/
		$sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."';";
		$query = mysqli_query(koneksi(), $sql); 
		$data = mysqli_fetch_assoc($query);
		if(mysqli_num_rows($query) > 0) {
			if ($data['level'] == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['level'] = $data['level'];
				echo "<script type='text/javascript'>window.location = 'ad_dashboard.php';</script>";
			} elseif($data['level'] == 2){
				$id = $data['id'];
				$detail = mysqli_fetch_assoc(mysqli_query(koneksi(),"SELECT * FROM pegawai JOIN user ON pegawai.id_user = user.id WHERE pegawai.id_user = '".$id."';"));
				$_SESSION['level'] = $data['level'];
				$_SESSION['id'] = $detail['nip'];
				$_SESSION['nama'] = $detail['nama_pgw'];
				$_SESSION['jabatan'] = $detail['jabatan_pgw'];
				$_SESSION['foto'] = $detail['foto'];
				echo "<script type='text/javascript'>window.location = 'pg_dashboard.php';</script>";
			} else {
				$id = $data['id'];
				$detail = mysqli_fetch_assoc(mysqli_query(koneksi(),"SELECT * FROM prakerin JOIN user ON prakerin.id_user = user.id WHERE prakerin.id_user = '".$id."';"));
				$_SESSION['level'] = $data['level'];
				$_SESSION['id'] = $detail['id_prakerin'];
				$_SESSION['nama'] = $detail['nama_prakerin'];
				$_SESSION['asal_sekolah'] = $detail['asal_sekolah'];
				$_SESSION['foto'] = $detail['foto'];
				echo "<script type='text/javascript'>window.location = 'pr_dashboard.php';</script>";
			}
		} else {
			echo "<script type='text/javascript'>alert('Data salah, silahkan coba kembali!');window.location = 'index.php';</script>";
		}
	}

	function tambahpegawai($nip,$nama,$jabatan,$username,$password){
		$conn = koneksi();
		mysqli_autocommit($conn, false);
		mysqli_begin_transaction($conn);
		$hash = password_hash($password, 
          PASSWORD_DEFAULT);
		$sqlcheck = "SELECT nip FROM pegawai WHERE nip='".$nip."';";
		$check = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($check)>0) {
			echo "<script type='text/javascript'>alert('Data sudah ada, silahkan coba kembali!');</script>";
		}else{

		
		try {
			$sqluser = "INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES (NULL, '".$username."', '".$hash."', '2');";
			if (mysqli_query($conn, $sqluser)) {
				$lastid = mysqli_insert_id($conn);
				$sql = "INSERT INTO `pegawai` (`nip`, `nama_pgw`, `jabatan_pgw`, `foto`, `id_user`) VALUES ('".$nip."', '".$nama."', '".$jabatan."', 'avatar.png', '".$lastid."');";
				mysqli_query($conn, $sql);
			}
			if (mysqli_commit($conn)) {
				echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'ad_pegawai.php';</script>";
			} else {
				throw Exception;
			}
		} catch (\Exception $e) {
	    	mysqli_rollback($conn);
	    	echo "<script type='text/javascript'>alert('Error');window.location = 'ad_pegawai.php';</script>";
		} catch (mysqli_sql_exception $exception) {
	    	mysqli_rollback($conn);
	    	echo "<script type='text/javascript'>alert('Error');window.location = 'ad_pegawai.php';</script>";
		}
	}
		//$check = "SELECT * FROM siswa WHERE nis='".$nis."';"; 

		//2021-09-01

	}


	function tampilpegawai(){
        $sql = "SELECT * FROM pegawai;";
        $data = mysqli_query(koneksi(),$sql);
        foreach ($data as $row) {
            echo "
              <tr>
                  	
      				<td>".$row['nip']."</td>
					<td>".$row['nama_pgw']."</td>					
					<td>".$row['jabatan_pgw']."</td>
					<td scope=\"row\">
						<div class='d-flex justify-content-around'>
	                    	<a href='ad_detailpg.php?id=".$row['id_user']."'>
		                    	<button type='button' class='btn btn-primary radius-10 p-1' style='display:flex;width: 80px;'>
		                      	<i class='bx bx-info-circle' style='margin:auto'></i><p style='margin:auto'>Lihat</p>
		                    	</button>
	                    	</a>
												<a href='ad_editpegawai.php?id=".$row['nip']."'>
		                    	<button type='button' class='btn btn-primary radius-10 p-1' style='display:flex;width: 80px;'>
		                      	<i class='bx bxs-edit' style='margin:auto'></i><p style='margin:auto'>Edit</p>
		                    	</button>
	                    	</a>
	                    	<a href='ad_pegawai.php?hapusid=".$row['id_user']."'>
		                    	<button type='button' class='btn btn-danger radius-10 p-1' style='display:flex;width: 80px;'>
		                      	<i class='bx bx-trash' style='margin:auto'></i><p style='margin:auto'>Hapus</p>
		                    	</button>
	                    	</a>
                    	</div>
                  	</td>
              </tr>";
        }
    }


	function hapuspegawai($id){
    	$sqlnama = "SELECT foto FROM pegawai WHERE id_user = '".$id."'; ";
    	$namafile = mysqli_fetch_assoc(mysqli_query(koneksi(),$sqlnama))['foto'];
    	$sql = "DELETE FROM user WHERE id = '".$id."';";
    	if (mysqli_query(koneksi(),$sql)) {
    		if ($namafile != "avatar.png" && $namafile != "") {
    			unlink('foto/'.$namafile);
    		}
			echo "<script type='text/javascript'>alert('berhasil!');window.location = 'ad_pegawai.php';</script>";
		}
    }


    function tambahprakerin($ni,$nama,$asal_sekolah,$program_keahlian,$tgl_mulai,$durasi_prakerin,$password){
        $conn = koneksi();
		mysqli_autocommit($conn, false);
		mysqli_begin_transaction($conn);
		$hash = password_hash($password, 
          PASSWORD_DEFAULT);

		$sqlcheck = "SELECT id_prakerin FROM prakerin WHERE id_prakerin='".$ni."';";
		$check = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($check)>0) {
			echo "<script type='text/javascript'>alert('Data sudah ada, silahkan coba kembali!');</script>";
		}else{  
		try {
			// $namagambar = $foto['name'];
			// $extension = pathinfo($namagambar,PATHINFO_EXTENSION);
			$sqluser = "INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES (NULL, '".$ni."', '".$hash."', '3');";
			$sqlnomerr = "SELECT MAX(`no_sertifikat`) AS 'no' FROM `prakerin`";
			$no = (int)mysqli_fetch_assoc(mysqli_query($conn, $sqlnomerr))['no']+1;

			if (mysqli_query($conn, $sqluser)) {
				$lastid = mysqli_insert_id($conn);
				$sql = "INSERT INTO prakerin (id_prakerin, nama_prakerin, asal_sekolah, program_keahlian, tanggal_mulai, durasi_prakerin, id_user, no_sertifikat, foto) VALUES ('".$ni."', '".$nama."', '".$asal_sekolah."', '".$program_keahlian."', '".$tgl_mulai."',  '".$durasi_prakerin."', '".$lastid."', '".$no."', 'avatar.png');";
				mysqli_query($conn, $sql);
				// if () {
				// 	move_uploaded_file($foto['tmp_name'], 'foto/'.$namagambar);
				// 	rename('foto/'.$namagambar, 'foto/'.$lastid.'.'.$extension);
				// }
			}
			if (mysqli_commit($conn)) {
				echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'ad_peserta.php';</script>";
			} else {
				throw Exception;
			}
		} catch (\Exception $e) {
	    	mysqli_rollback($conn);
	    	echo "<script type='text/javascript'>alert('Error');window.location = 'ad_peserta.php';</script>";
		} catch (mysqli_sql_exception $exception) {
	    	mysqli_rollback($conn);
	    	echo "<script type='text/javascript'>alert('Error');window.location = 'ad_peserta.php';</script>";
		}
	}

        //$check = "SELECT * FROM siswa WHERE nis='".$nis."';"; 

        //2021-09-01

    }

    function tampilprakerin(){
        $sql = "SELECT * FROM prakerin;";
        $data = mysqli_query(koneksi(),$sql);
        foreach ($data as $row) {
            echo "
              <tr>
                  	
      				<td>".$row['id_prakerin']."</td>
					<td>".$row['nama_prakerin']."</td>
					<td>".$row['asal_sekolah']."</td>
					<td scope=\"row\">
						<div class='d-flex justify-content-around'>
	                    	<a href='ad_detailpr.php?id=".$row['id_user']."'>
		                    	<button type='button' class='btn btn-primary radius-10 p-1' style='display:flex;width:80px;'>
		                      	<i class='bx bx-info-circle' style='margin:auto'></i><p style='margin:auto'>Lihat</p>
		                    	</button>
	                    	</a>
	                    	<a href='ad_editprakerin.php?id=".$row['id_prakerin']."'>
		                    	<button type='button' class='btn btn-primary radius-10 p-1' style='display:flex;width:80px;'>
		                      	<i class='bx bxs-edit' style='margin:auto'></i><p style='margin:auto'>Edit</p>
		                    	</button>
	                    	</a>
	                    	<a href='ad_peserta.php?hapusid=".$row['id_user']."'>
		                    	<button type='button' class='btn btn-danger radius-10 p-1' style='display:flex;width:80px;'>
		                      	<i class='bx bx-trash' style='margin:auto'></i><p style='margin:auto'>Hapus</p>
		                    	</button>
	                    	</a>
                    	</div>
                  	</td>
              </tr>";
        }
    }

    function hapusprakerin($id){
    	$sqlnama = "SELECT foto FROM prakerin WHERE id_user = '".$id."';";
    	$namafile = mysqli_fetch_assoc(mysqli_query(koneksi(),$sqlnama))['foto'];
    	$sql = "DELETE FROM user WHERE id = '".$id."';";
    	if (mysqli_query(koneksi(),$sql)) {
    		if ($namafile != "avatar.png" && $namafile != "") {
    			unlink('foto/'.$namafile);	
    		}
			echo "<script type='text/javascript'>alert('berhasil!');window.location = 'ad_peserta.php';</script>";
		}
    }










	function tampiljadwalpegawai($hari){
        $sql = "SELECT * FROM jadwal WHERE level='Pegawai' AND hari='".$hari."' ORDER BY mulai;";
        $data = mysqli_query(koneksi(),$sql);
        $num = 1;
        foreach ($data as $row) {
            echo "<tr>
			<td scope=\"col\">".$num."</td>
			<td scope=\"col\">".$row['mulai']."</td>
			<td scope=\"col\">".$row['selesai']."</td>
			<td scope=\"col\">".$row['kegiatan']."</td>
			<td scope=\"col\"><a href='ad_editjadwal.php?id=".$row['id']."'><button type='button' style='width:100px;' class='btn btn-primary px-2 radius-10 me-3'><i class='bx bxs-edit'></i>Edit</button></a>
			<a href='ad_jadwal.php?hapusid=".$row['id']."'> <button type='button' class='btn btn-danger px-2 radius-10' style='width:100px;'><i class='bx bx-trash'></i>Hapus</button></a></td>
		</tr>";
            $num++;
        }

    }

	function tampiljadwalprakerin($hari){
        $sql = "SELECT * FROM jadwal WHERE level='Prakerin' AND hari='".$hari."' ORDER BY mulai;";
        $data = mysqli_query(koneksi(),$sql);
        $num = 1;
        foreach ($data as $row) {
            echo "<tr>
			<td scope=\"col\">".$num."</td>
			<td scope=\"col\">".$row['mulai']."</td>
			<td scope=\"col\">".$row['selesai']."</td>
			<td scope=\"col\">".$row['kegiatan']."</td>
			<td scope=\"col\"><a href='ad_editjadwal.php?id=".$row['id']."'><button type='button' style='width:100px;' class='btn btn-primary px-2 radius-10 me-3'><i class='bx bxs-edit'></i>Edit</button></a>
			<a href='ad_jadwal.php?hapusid=".$row['id']."'> <button type='button' class='btn btn-danger px-2 radius-10' style='width:100px;'><i class='bx bx-trash'></i>Hapus</button></a></td>
		</tr>";
            $num++;
        }
    }

	function tambahjadwal($hari,$level,$mulai,$selesai,$kegiatan){
            $sql = "INSERT INTO `jadwal` (`id`, `hari`, `level`, `mulai`, `selesai`, `kegiatan`) VALUES ('','".$hari."', '".$level."', '".$mulai."', '".$selesai."', '".$kegiatan."');";
            if (mysqli_query(koneksi(), $sql)) {
            	echo "<script type='text/javascript'>alert('tambah berhasil!');window.location = 'ad_jadwal.php';</script>";
            }
        
		//$check = "SELECT * FROM siswa WHERE nis='".$nis."';"; 

		//2021-09-01

	}

	function tampiljadwaledit($id,$field){
        $sql = "SELECT * FROM jadwal WHERE id='".$id."';";
        $data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
		return $data[$field];
    }

	function optionharijadwal($id){
		$hari = array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		for($i = 0;$i < count($hari);$i++){
			if (tampiljadwaledit($id,"hari") == $hari[$i]) {
				echo "<option selected>".$hari[$i]."</option>";	
			} else {
				echo "<option>".$hari[$i]."</option>";	
			}
			
		}
	}

	function optionleveljadwal($id){
		$level = array("Pegawai","Prakerin");
		for($i = 0;$i < count($level);$i++){
			if (tampiljadwaledit($id,"level") == $level[$i]) {
				echo "<option selected>".$level[$i]."</option>";	
			} else {
				echo "<option>".$level[$i]."</option>";	
			}
		}
	}

	function editjadwal($id,$hari,$level,$mulai,$selesai,$kegiatan){	
		$query = "UPDATE jadwal SET hari = '".$hari."', level = '".$level."', mulai = '".$mulai."', selesai = '".$selesai."', kegiatan = '".$kegiatan."' WHERE id = '".$id."';";
		if (mysqli_query(koneksi(), $query)){
			echo "<script type='text/javascript'>alert('edit berhasil!');window.location = 'ad_jadwal.php';</script>";
		}
	}

	function hapusjadwal($id){
		$query = "DELETE FROM jadwal WHERE id = '".$id."';";
		if (mysqli_query(koneksi(), $query)){
			echo "<script type='text/javascript'>alert('hapus berhasil!');window.location = 'ad_jadwal.php';</script>";
		}
	}

	function tampiljadwalhalpg($hari){
        $sql = "SELECT * FROM jadwal WHERE level='Pegawai' AND hari='".$hari."' ORDER BY mulai;";
        $data = mysqli_query(koneksi(),$sql);
        $num = 1;
        foreach ($data as $row) {
            echo "<tr>
			<td scope=\"col\">".$num."</td>
			<td scope=\"col\">".$row['mulai']."</td>
			<td scope=\"col\">".$row['selesai']."</td>
			<td scope=\"col\">".$row['kegiatan']."</td>
			</tr>";
            $num++;
        }
    }
    
	function tampiljadwalhalpr($hari){
        $sql = "SELECT * FROM jadwal WHERE level='Prakerin' AND hari='".$hari."' ORDER BY mulai;";
        $data = mysqli_query(koneksi(),$sql);
        $num = 1;
        foreach ($data as $row) {
            echo "<tr>
			<td scope=\"col\">".$num."</td>
			<td scope=\"col\">".$row['mulai']."</td>
			<td scope=\"col\">".$row['selesai']."</td>
			<td scope=\"col\">".$row['kegiatan']."</td>
			</tr>";
            $num++;
        }
    }

		function tampilsertifikat(){
			$sql = "SELECT prakerin.id_prakerin,prakerin.nama_prakerin,prakerin.asal_sekolah FROM prakerin;";
			$data = mysqli_query(koneksi(),$sql);
			$num = 1;
			foreach ($data as $row) {
					echo "<tr>
		<td scope=\"col\">".$num."</td>
		<td scope=\"col\">".$row['id_prakerin']."</td>
		<td scope=\"col\">".$row['nama_prakerin']."</td>
		<td scope=\"col\">".$row['asal_sekolah']."</td>
		<td scope=\"col\"><a href='ad_sertifikat.php?detail=".$row['id_prakerin']."&d=false'><button type='button' class='btn btn-primary radius-10 me-2'><i class='bx bx-info-circle'></i>Lihat</button></a>
		<a href='ad_sertifikat.php?detail=".$row['id_prakerin']."&d=true'><button type='button' class='btn btn-primary radius-10'><i class='bx bx-download'></i>Download</button></a>
		</td>
		</tr>";
					$num++;
			}
	}

	


	function tampilpegawaipg($nip,$field){
        $sql = "SELECT * FROM pegawai JOIN user ON pegawai.id_user = user.id WHERE nip='".$nip."';";
        
        $data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
        if ($field == "jk_pgw") {
            if ($data['jk_pgw'] == "l") {
                return "Laki - Laki";
            } elseif($data['jk_pgw'] == "p"){
                return "Perempuan";
            } 
        }else{
            return $data[$field];
        }

    }

	function tampilprakerinpr($id_prakerin,$field){
        $sql = "SELECT *,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin JOIN user ON prakerin.id_user = user.id WHERE id_prakerin='".$id_prakerin."';";
        $data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
        if ($field == "jk_prakerin") {
            if ($data['jk_prakerin'] == "l") {
                return "Laki - Laki";
            } elseIF($data['jk_prakerin'] == "P") {
                return "Perempuan";
            }
        }else{
            return $data[$field];
        }

    }

    function kota(){
    	$kota = array("Kabupaten Aceh Barat","Kabupaten Aceh Barat Daya","Kabupaten Aceh Besar","Kabupaten Aceh Jaya","Kabupaten Aceh Selatan","Kabupaten Aceh Singkil","Kabupaten Aceh Tamiang","Kabupaten Aceh Tengah","Kabupaten Aceh Tenggara","Kabupaten Aceh Timur","Kabupaten Aceh Utara","Kabupaten Agam","Kabupaten Alor","Kota Ambon","Kabupaten Asahan","Kabupaten Asmat","Kabupaten Badung","Kabupaten Balangan","Kota Balikpapan","Kota Banda Aceh","Kota Bandar Lampung","Kabupaten Bandung","Kota Bandung","Kabupaten Bandung Barat","Kabupaten Banggai","Kabupaten Banggai Kepulauan","Kabupaten Bangka","Kabupaten Bangka Barat","Kabupaten Bangka Selatan","Kabupaten Bangka Tengah","Kabupaten Bangkalan","Kabupaten Bangli","Kabupaten Banjar","Kota Banjar","Kota Banjarbaru","Kota Banjarmasin","Kabupaten Banjarnegara","Kabupaten Bantaeng","Kabupaten Bantul","Kabupaten Banyuasin","Kabupaten Banyumas","Kabupaten Banyuwangi","Kabupaten Barito Kuala","Kabupaten Barito Selatan","Kabupaten Barito Timur","Kabupaten Barito Utara","Kabupaten Barru","Kota Batam","Kabupaten Batang","Kabupaten Batang Hari","Kota Batu","Kabupaten Batu Bara","Kota Bau-Bau","Kabupaten Bekasi","Kota Bekasi","Kabupaten Belitung","Kabupaten Belitung Timur","Kabupaten Belu","Kabupaten Bener Meriah","Kabupaten Bengkalis","Kabupaten Bengkayang","Kota Bengkulu","Kabupaten Bengkulu Selatan","Kabupaten Bengkulu Tengah","Kabupaten Bengkulu Utara","Kabupaten Berau","Kabupaten Biak Numfor","Kabupaten Bima","Kota Bima","Kota Binjai","Kabupaten Bintan","Kabupaten Bireuen","Kota Bitung","Kabupaten Blitar","Kota Blitar","Kabupaten Blora","Kabupaten Boalemo","Kabupaten Bogor","Kota Bogor","Kabupaten Bojonegoro","Kabupaten Bolaang Mongondow (Bolmong)","Kabupaten Bolaang Mongondow Selatan","Kabupaten Bolaang Mongondow Timur","Kabupaten Bolaang Mongondow Utara","Kabupaten Bombana","Kabupaten Bondowoso","Kabupaten Bone","Kabupaten Bone Bolango","Kota Bontang","Kabupaten Boven Digoel","Kabupaten Boyolali","Kabupaten Brebes","Kota Bukittinggi","Kabupaten Buleleng","Kabupaten Bulukumba","Kabupaten Bulungan (Bulongan)","Kabupaten Bungo","Kabupaten Buol","Kabupaten Buru","Kabupaten Buru Selatan","Kabupaten Buton","Kabupaten Buton Utara","Kabupaten Ciamis","Kabupaten Cianjur","Kabupaten Cilacap","Kota Cilegon","Kota Cimahi","Kabupaten Cirebon","Kota Cirebon","Kabupaten Dairi","Kabupaten Deiyai (Deliyai)","Kabupaten Deli Serdang","Kabupaten Demak","Kota Denpasar","Kota Depok","Kabupaten Dharmasraya","Kabupaten Dogiyai","Kabupaten Dompu","Kabupaten Donggala","Kota Dumai","Kabupaten Empat Lawang","Kabupaten Ende","Kabupaten Enrekang","Kabupaten Fakfak","Kabupaten Flores Timur","Kabupaten Garut","Kabupaten Gayo Lues","Kabupaten Gianyar","Kabupaten Gorontalo","Kota Gorontalo","Kabupaten Gorontalo Utara","Kabupaten Gowa","Kabupaten Gresik","Kabupaten Grobogan","Kabupaten Gunung Kidul","Kabupaten Gunung Mas","Kota Gunungsitoli","Kabupaten Halmahera Barat","Kabupaten Halmahera Selatan","Kabupaten Halmahera Tengah","Kabupaten Halmahera Timur","Kabupaten Halmahera Utara","Kabupaten Hulu Sungai Selatan","Kabupaten Hulu Sungai Tengah","Kabupaten Hulu Sungai Utara","Kabupaten Humbang Hasundutan","Kabupaten Indragiri Hilir","Kabupaten Indragiri Hulu","Kabupaten Indramayu","Kabupaten Intan Jaya","Kota Jakarta Barat","Kota Jakarta Pusat","Kota Jakarta Selatan","Kota Jakarta Timur","Kota Jakarta Utara","Kota Jambi","Kabupaten Jayapura","Kota Jayapura","Kabupaten Jayawijaya","Kabupaten Jember","Kabupaten Jembrana","Kabupaten Jeneponto","Kabupaten Jepara","Kabupaten Jombang","Kabupaten Kaimana","Kabupaten Kampar","Kabupaten Kapuas","Kabupaten Kapuas Hulu","Kabupaten Karanganyar","Kabupaten Karangasem","Kabupaten Karawang","Kabupaten Karimun","Kabupaten Karo","Kabupaten Katingan","Kabupaten Kaur","Kabupaten Kayong Utara","Kabupaten Kebumen","Kabupaten Kediri","Kota Kediri","Kabupaten Keerom","Kabupaten Kendal","Kota Kendari","Kabupaten Kepahiang","Kabupaten Kepulauan Anambas","Kabupaten Kepulauan Aru","Kabupaten Kepulauan Mentawai","Kabupaten Kepulauan Meranti","Kabupaten Kepulauan Sangihe","Kabupaten Kepulauan Seribu","Kabupaten Kepulauan Siau Tagulandang Biaro (Sitaro)","Kabupaten Kepulauan Sula","Kabupaten Kepulauan Talaud","Kabupaten Kepulauan Yapen (Yapen Waropen)","Kabupaten Kerinci","Kabupaten Ketapang","Kabupaten Klaten","Kabupaten Klungkung","Kabupaten Kolaka","Kabupaten Kolaka Utara","Kabupaten Konawe","Kabupaten Konawe Selatan","Kabupaten Konawe Utara","Kabupaten Kotabaru","Kota Kotamobagu","Kabupaten Kotawaringin Barat","Kabupaten Kotawaringin Timur","Kabupaten Kuantan Singingi","Kabupaten Kubu Raya","Kabupaten Kudus","Kabupaten Kulon Progo","Kabupaten Kuningan","Kabupaten Kupang","Kota Kupang","Kabupaten Kutai Barat","Kabupaten Kutai Kartanegara","Kabupaten Kutai Timur","Kabupaten Labuhan Batu","Kabupaten Labuhan Batu Selatan","Kabupaten Labuhan Batu Utara","Kabupaten Lahat","Kabupaten Lamandau","Kabupaten Lamongan","Kabupaten Lampung Barat","Kabupaten Lampung Selatan","Kabupaten Lampung Tengah","Kabupaten Lampung Timur","Kabupaten Lampung Utara","Kabupaten Landak","Kabupaten Langkat","Kota Langsa","Kabupaten Lanny Jaya","Kabupaten Lebak","Kabupaten Lebong","Kabupaten Lembata","Kota Lhokseumawe","Kabupaten Lima Puluh Koto/Kota","Kabupaten Lingga","Kabupaten Lombok Barat","Kabupaten Lombok Tengah","Kabupaten Lombok Timur","Kabupaten Lombok Utara","Kota Lubuk Linggau","Kabupaten Lumajang","Kabupaten Luwu","Kabupaten Luwu Timur","Kabupaten Luwu Utara","Kabupaten Madiun","Kota Madiun","Kabupaten Magelang","Kota Magelang","Kabupaten Magetan","Kabupaten Majalengka","Kabupaten Majene","Kota Makassar","Kabupaten Malang","Kota Malang","Kabupaten Malinau","Kabupaten Maluku Barat Daya","Kabupaten Maluku Tengah","Kabupaten Maluku Tenggara","Kabupaten Maluku Tenggara Barat","Kabupaten Mamasa","Kabupaten Mamberamo Raya","Kabupaten Mamberamo Tengah","Kabupaten Mamuju","Kabupaten Mamuju Utara","Kota Manado","Kabupaten Mandailing Natal","Kabupaten Manggarai","Kabupaten Manggarai Barat","Kabupaten Manggarai Timur","Kabupaten Manokwari","Kabupaten Manokwari Selatan","Kabupaten Mappi","Kabupaten Maros","Kota Mataram","Kabupaten Maybrat","Kota Medan","Kabupaten Melawi","Kabupaten Merangin","Kabupaten Merauke","Kabupaten Mesuji","Kota Metro","Kabupaten Mimika","Kabupaten Minahasa","Kabupaten Minahasa Selatan","Kabupaten Minahasa Tenggara","Kabupaten Minahasa Utara","Kabupaten Mojokerto","Kota Mojokerto","Kabupaten Morowali","Kabupaten Muara Enim","Kabupaten Muaro Jambi","Kabupaten Muko Muko","Kabupaten Muna","Kabupaten Murung Raya","Kabupaten Musi Banyuasin","Kabupaten Musi Rawas","Kabupaten Nabire","Kabupaten Nagan Raya","Kabupaten Nagekeo","Kabupaten Natuna","Kabupaten Nduga","Kabupaten Ngada","Kabupaten Nganjuk","Kabupaten Ngawi","Kabupaten Nias","Kabupaten Nias Barat","Kabupaten Nias Selatan","Kabupaten Nias Utara","Kabupaten Nunukan","Kabupaten Ogan Ilir","Kabupaten Ogan Komering Ilir","Kabupaten Ogan Komering Ulu","Kabupaten Ogan Komering Ulu Selatan","Kabupaten Ogan Komering Ulu Timur","Kabupaten Pacitan","Kota Padang","Kabupaten Padang Lawas","Kabupaten Padang Lawas Utara","Kota Padang Panjang","Kabupaten Padang Pariaman","Kota Padang Sidempuan","Kota Pagar Alam","Kabupaten Pakpak Bharat","Kota Palangka Raya","Kota Palembang","Kota Palopo","Kota Palu","Kabupaten Pamekasan","Kabupaten Pandeglang","Kabupaten Pangandaran","Kabupaten Pangkajene Kepulauan","Kota Pangkal Pinang","Kabupaten Paniai","Kota Parepare","Kota Pariaman","Kabupaten Parigi Moutong","Kabupaten Pasaman","Kabupaten Pasaman Barat","Kabupaten Paser","Kabupaten Pasuruan","Kota Pasuruan","Kabupaten Pati","Kota Payakumbuh","Kabupaten Pegunungan Arfak","Kabupaten Pegunungan Bintang","Kabupaten Pekalongan","Kota Pekalongan","Kota Pekanbaru","Kabupaten Pelalawan","Kabupaten Pemalang","Kota Pematang Siantar","Kabupaten Penajam Paser Utara","Kabupaten Pesawaran","Kabupaten Pesisir Barat","Kabupaten Pesisir Selatan","Kabupaten Pidie","Kabupaten Pidie Jaya","Kabupaten Pinrang","Kabupaten Pohuwato","Kabupaten Polewali Mandar","Kabupaten Ponorogo","Kabupaten Pontianak","Kota Pontianak","Kabupaten Poso","Kota Prabumulih","Kabupaten Pringsewu","Kabupaten Probolinggo","Kota Probolinggo","Kabupaten Pulang Pisau","Kabupaten Pulau Morotai","Kabupaten Puncak","Kabupaten Puncak Jaya","Kabupaten Purbalingga","Kabupaten Purwakarta","Kabupaten Purworejo","Kabupaten Raja Ampat","Kabupaten Rejang Lebong","Kabupaten Rembang","Kabupaten Rokan Hilir","Kabupaten Rokan Hulu","Kabupaten Rote Ndao","Kota Sabang","Kabupaten Sabu Raijua","Kota Salatiga","Kota Samarinda","Kabupaten Sambas","Kabupaten Samosir","Kabupaten Sampang","Kabupaten Sanggau","Kabupaten Sarmi","Kabupaten Sarolangun","Kota Sawah Lunto","Kabupaten Sekadau","Kabupaten Selayar (Kepulauan Selayar)","Kabupaten Seluma","Kabupaten Semarang","Kota Semarang","Kabupaten Seram Bagian Barat","Kabupaten Seram Bagian Timur","Kabupaten Serang","Kota Serang","Kabupaten Serdang Bedagai","Kabupaten Seruyan","Kabupaten Siak","Kota Sibolga","Kabupaten Sidenreng Rappang/Rapang","Kabupaten Sidoarjo","Kabupaten Sigi","Kabupaten Sijunjung (Sawah Lunto Sijunjung)","Kabupaten Sikka","Kabupaten Simalungun","Kabupaten Simeulue","Kota Singkawang","Kabupaten Sinjai","Kabupaten Sintang","Kabupaten Situbondo","Kabupaten Sleman","Kabupaten Solok","Kota Solok","Kabupaten Solok Selatan","Kabupaten Soppeng","Kabupaten Sorong","Kota Sorong","Kabupaten Sorong Selatan","Kabupaten Sragen","Kabupaten Subang","Kota Subulussalam","Kabupaten Sukabumi","Kota Sukabumi","Kabupaten Sukamara","Kabupaten Sukoharjo","Kabupaten Sumba Barat","Kabupaten Sumba Barat Daya","Kabupaten Sumba Tengah","Kabupaten Sumba Timur","Kabupaten Sumbawa","Kabupaten Sumbawa Barat","Kabupaten Sumedang","Kabupaten Sumenep","Kota Sungaipenuh","Kabupaten Supiori","Kota Surabaya","Kota Surakarta (Solo)","Kabupaten Tabalong","Kabupaten Tabanan","Kabupaten Takalar","Kabupaten Tambrauw","Kabupaten Tana Tidung","Kabupaten Tana Toraja","Kabupaten Tanah Bumbu","Kabupaten Tanah Datar","Kabupaten Tanah Laut","Kabupaten Tangerang","Kota Tangerang","Kota Tangerang Selatan","Kabupaten Tanggamus","Kota Tanjung Balai","Kabupaten Tanjung Jabung Barat","Kabupaten Tanjung Jabung Timur","Kota Tanjung Pinang","Kabupaten Tapanuli Selatan","Kabupaten Tapanuli Tengah","Kabupaten Tapanuli Utara","Kabupaten Tapin","Kota Tarakan","Kabupaten Tasikmalaya","Kota Tasikmalaya","Kota Tebing Tinggi","Kabupaten Tebo","Kabupaten Tegal","Kota Tegal","Kabupaten Teluk Bintuni","Kabupaten Teluk Wondama","Kabupaten Temanggung","Kota Ternate","Kota Tidore Kepulauan","Kabupaten Timor Tengah Selatan","Kabupaten Timor Tengah Utara","Kabupaten Toba Samosir","Kabupaten Tojo Una-Una","Kabupaten Toli-Toli","Kabupaten Tolikara","Kota Tomohon","Kabupaten Toraja Utara","Kabupaten Trenggalek","Kota Tual","Kabupaten Tuban","Kabupaten Tulang Bawang","Kabupaten Tulang Bawang Barat","Kabupaten Tulungagung","Kabupaten Wajo","Kabupaten Wakatobi","Kabupaten Waropen","Kabupaten Way Kanan","Kabupaten Wonogiri","Kabupaten Wonosobo","Kabupaten Yahukimo","Kabupaten Yalimo","Kota Yogyakarta");
    	return $kota;
    }

    function jabatan(){
    	$jabatan = array('Direktur','General Manager','Project Manager','Finance','Marketing','Analyst System','Programmer','Designer','Quality Control');
		return $jabatan;
	}

	function status(){
		$status = array("Menikah","Belum Menikah");
		return $status;
	}

	function agama(){
		$agama = array('Islam','Protestan','Katolik','Hindu','Buddha','Khonghucu');
		return $agama;
	}

	function jk(){
		$jk = array("l","p");
		return $jk;
	}

	function editpegawai($id,$niplama,$nipbaru,$nama,$nik,$tgl_lahir,$tempat_lahir,$jk,$telepon,$email,$alamat,$jabatan,$status,$agama,$username,$password,$foto,$level){
		
		$conn = koneksi();
		mysqli_autocommit($conn, false);
		mysqli_begin_transaction($conn);
		try {
			
			if ($password != "") {
				$hash = password_hash($password,PASSWORD_DEFAULT);
				$sqlpass = "UPDATE `user` SET `password` = '".$hash."' WHERE `id` = '".$id."';";
				mysqli_query($conn, $sqlpass);
			}
			if ($foto['size'] != 0) {
				$namagambar = $foto['name'];
				$extension = pathinfo($namagambar,PATHINFO_EXTENSION);
				
				

				$sqlpegawai = "UPDATE `pegawai` SET `nip` = '".$nipbaru."',`nama_pgw` = '".$nama."',`nik_pgw` = '".$nik."',`tgl_lahir_pgw` = '".$tgl_lahir."',`jk_pgw` = '".$jk."',`telp_pgw` = '".$telepon."',`email_pgw` = '".$email."',`alamat_pgw` = '".$alamat."',`jabatan_pgw` = '".$jabatan."',`status` = '".$status."',`agama` = '".$agama."',`tempat_lahir_pgw` = '".$tempat_lahir."', `foto` = '".$id.".".$extension."' WHERE `pegawai`.`nip` = '".$niplama."';";
			} else {
				$sqlpegawai = "UPDATE `pegawai` SET `nip` = '".$nipbaru."',`nama_pgw` = '".$nama."',`nik_pgw` = '".$nik."',`tgl_lahir_pgw` = '".$tgl_lahir."',`jk_pgw` = '".$jk."',`telp_pgw` = '".$telepon."',`email_pgw` = '".$email."',`alamat_pgw` = '".$alamat."',`jabatan_pgw` = '".$jabatan."',`status` = '".$status."',`agama` = '".$agama."',`tempat_lahir_pgw` = '".$tempat_lahir."' WHERE `pegawai`.`nip` = '".$niplama."';";
			}
			
			$sqluser = "UPDATE `user` SET `username` = '".$username."' WHERE `id` = '".$id."';";
			
			if (mysqli_query($conn, $sqlpegawai) && mysqli_query($conn, $sqluser)) {
				if (mysqli_commit($conn)) {
					if ($foto['size'] != 0) {
						$sql = "SELECT foto FROM pegawai WHERE id_user = '".$id."';";
						$oldfoto = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql))['foto'];
						if (file_exists('foto/'.$oldfoto)) {
							unlink('foto/'.$oldfoto);
						}
						move_uploaded_file($foto['tmp_name'], 'foto/'.$namagambar);
						rename('foto/'.$namagambar, 'foto/'.$id.'.'.$extension);	
					}
					
					//$_SESSION['foto'] = $foto;
					if ($level == 1) {
						echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'ad_pegawai.php';</script>";	
					} else {
						$_SESSION['id'] = $nipbaru;
						$_SESSION['nama'] = $nama;
						$_SESSION['jabatan'] = $jabatan;
						if ($foto['size'] != 0) {
							$_SESSION['foto'] = $id.'.'.$extension;	
						}
						echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'pg_profile.php';</script>";	
					}
				} 
			} else {
				throw Exception;
			}
		
		} catch (\Exception $e) {
	    	mysqli_rollback($conn);
	    	if ($level == 1) {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_pegawai.php';</script>";	
			} else {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'pg_profile.php';</script>";	
			}
		} catch (mysqli_sql_exception $exception) {
	    	mysqli_rollback($conn);
	    	if ($level == 1) {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_pegawai.php';</script>";	
			} else {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'pg_profile.php';</script>";	
			}
		}
	
	}

	function editprakerin($id,$nilama,$nibaru,$nama,$tanggal_lahir,$tempat_lahir,$jk,$telepon,$email,$alamat,$agama,$asal_sekolah,$program_keahlian,$nama_ayah,$telp_ayah,$nama_ibu,$telp_ibu,$tanggal_mulai,$durasi,$username,$password,$foto,$level){
		
		$conn = koneksi();
		mysqli_autocommit($conn, false);
		mysqli_begin_transaction($conn);

		try {
			if ($password != "") {
				$hash = password_hash($password,PASSWORD_DEFAULT);
				$sqlpass = "UPDATE `user` SET `password` = '".$hash."' WHERE `id` = '".$id."';";
				mysqli_query($conn, $sqlpass);
			}
			if ($foto['size'] != 0) {
				$namagambar = $foto['name'];
				$extension = pathinfo($namagambar,PATHINFO_EXTENSION);	

			

				$sqlprakerin = "UPDATE `prakerin` SET `id_prakerin` = '".$nibaru."',`nama_prakerin` = '".$nama."',`tanggal_lahir_prakerin` = '".$tanggal_lahir."',`tempat_lahir_prakerin` = '".$tempat_lahir."',`jk_prakerin` = '".$jk."',`agama_prakerin` = '".$agama."',`telp_prakerin` = '".$telepon."',`email_prakerin` = '".$email."',`alamat_prakerin` = '".$alamat."',`asal_sekolah` = '".$asal_sekolah."',`program_keahlian` = '".$program_keahlian."',`nama_ayah` = '".$nama_ayah."',`telp_ayah` = '".$telp_ayah."',`nama_ibu` = '".$nama_ibu."',`telp_ibu` = '".$telp_ibu."',`tanggal_mulai` = '".$tanggal_mulai."',`durasi_prakerin` = '".$durasi."',`foto` = '".$id.".".$extension."' WHERE `prakerin`.`id_prakerin` = '".$nilama."';";
			} else {
				$sqlprakerin = "UPDATE `prakerin` SET `id_prakerin` = '".$nibaru."',`nama_prakerin` = '".$nama."',`tanggal_lahir_prakerin` = '".$tanggal_lahir."',`tempat_lahir_prakerin` = '".$tempat_lahir."',`jk_prakerin` = '".$jk."',`agama_prakerin` = '".$agama."',`telp_prakerin` = '".$telepon."',`email_prakerin` = '".$email."',`alamat_prakerin` = '".$alamat."',`asal_sekolah` = '".$asal_sekolah."',`program_keahlian` = '".$program_keahlian."',`nama_ayah` = '".$nama_ayah."',`telp_ayah` = '".$telp_ayah."',`nama_ibu` = '".$nama_ibu."',`telp_ibu` = '".$telp_ibu."',`tanggal_mulai` = '".$tanggal_mulai."',`durasi_prakerin` = '".$durasi."' WHERE `prakerin`.`id_prakerin` = '".$nilama."';";
			}
			
			$sqluser = "UPDATE `user` SET `username` = '".$username."' WHERE `id` = '".$id."';";
			if (mysqli_query($conn, $sqlprakerin) && mysqli_query($conn, $sqluser)) {
				if (mysqli_commit($conn)) {
					if ($foto['size'] != 0) {
						$sql = "SELECT foto FROM prakerin WHERE id_user = '".$id."';";
						echo $sql;
						$oldfoto = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql))['foto'];
						if ($oldfoto != "avatar.png") {
							if (file_exists('foto/'.$oldfoto)) {
								unlink('foto/'.$oldfoto);
							}
							move_uploaded_file($foto['tmp_name'], 'foto/'.$namagambar);
							rename('foto/'.$namagambar, 'foto/'.$id.'.'.$extension);	
						}
					}
					if ($level == 1) {
						echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'ad_peserta.php';</script>";	
					} else {
						$_SESSION['id'] = $nibaru;
						$_SESSION['nama'] = $nama;
						$_SESSION['asal_sekolah'] = $asal_sekolah;
						if ($foto['size'] != 0) {
							$_SESSION['foto'] = $id.'.'.$extension;	
						}
						echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'pr_profile.php';</script>";	
					}
				} else {
					throw Exception;
				}
			}
		} catch (\Exception $e) {
	    	mysqli_rollback($conn);
	    	if ($level == 1) {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_pegawai.php';</script>";	
			} else {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'pr_profile.php';</script>";	
			}
		} catch (mysqli_sql_exception $exception) {
	    	mysqli_rollback($conn);
	    	if ($level == 1) {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_pegawai.php';</script>";	
			} else {
				echo "<script type='text/javascript'>alert('Error!');window.location = 'pr_profile.php';</script>";	
			}
		}
	}

	function jumlahpegawai(){
		$sql = "SELECT COUNT(nip) AS 'jumlah' FROM pegawai;";
        $data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
		return $data['jumlah'];
	}

	function jumlahprakerin(){
		$sql = "SELECT COUNT(id_prakerin) AS 'jumlah' FROM prakerin;";
        $data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
		return $data['jumlah'];
	}

	function jumlahalumniprakerin(){
		$sql = "SELECT prakerin.id_prakerin,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin;";
        $data = mysqli_query(koneksi(),$sql);
        $jumlah = 0;
        foreach($data as $row){
            $tgl_selesai = strtotime($row['tanggal_selesai']);
            if (date("Y-m-d",$tgl_selesai) < date("Y-m-d")) {
                $jumlah++;
            }
        }
        return $jumlah;
	}

	function rasiopegawai($jk){
		$sql = "SELECT COUNT((SELECT prakerin.jk_prakerin FROM prakerin WHERE jk_prakerin='p')) AS 'perempuan',COUNT((SELECT prakerin.jk_prakerin FROM prakerin WHERE jk_prakerin='l')) AS 'laki' FROM prakerin;";
        $data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
		if ($jk == "l") {
			return $data['laki'];
		}
		elseif($jk == "p") {
			return $data['perempuan'];
		}
	}

	function rasioprakerinl(){
		$sql = "SELECT COUNT(id_prakerin) AS 'laki' FROM `prakerin` WHERE jk_prakerin = 'l';";
		$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
			echo $data['laki'];
	}

	function rasioprakerinp(){
		$sql = "SELECT COUNT(id_prakerin) AS 'perempuan' FROM `prakerin` WHERE jk_prakerin = 'p';";
		$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
			echo $data['perempuan'];
	}

	function rasiopegawail(){
		$sql = "SELECT COUNT(nip) AS 'laki' FROM `pegawai` WHERE jk_pgw = 'l';";
		$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
			echo $data['laki'];
	}

	function rasiopegawaip(){
		$sql = "SELECT COUNT(nip) AS 'perempuan' FROM `pegawai` WHERE jk_pgw = 'p';";
		$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
			echo $data['perempuan'];
	}

	function pengumumansemua($waktu,$tujuan,$judul,$isi){
		$sql = "INSERT INTO `pengumuman` (`id`, `waktu`, `tujuan`, `judul`) VALUES ('','".$waktu."', '".$tujuan."', '".$judul."', '".$isi."');";
		if (mysqli_query(koneksi(), $sql)) {
			echo "<script type='text/javascript'>alert('tambah berhasil!');window.location = 'ad_das.php';</script>";
		}
	
	//$check = "SELECT * FROM siswa WHERE nis='".$nis."';"; 

	//2021-09-01

	}

	function pengumumanpegawai($waktu,$judul,$isi){
		$sql = "INSERT INTO `pengumuman` (`id`, `waktu`, `tujuan`, `judul`, `isi`) VALUES ('','".$waktu."', 'Pegawai', '".$judul."', '".$isi."');";
		if (mysqli_query(koneksi(), $sql)) {
			echo "<script type='text/javascript'>alert('tambah berhasil!');window.location = 'ad_dashboard.php';</script>";
		}
	
	//$check = "SELECT * FROM siswa WHERE nis='".$nis."';"; 

	//2021-09-01

	}
	
	function pengumumanprakerin($waktu,$judul,$isi){
		$sql = "INSERT INTO `pengumuman` (`id`, `waktu`, `tujuan`, `judul`, `isi`) VALUES ('','".$waktu."', 'Peserta', '".$judul."', '".$isi."');";
		if (mysqli_query(koneksi(), $sql)) {
			
		}
	
	//$check = "SELECT * FROM siswa WHERE nis='".$nis."';"; 

	//2021-09-01

	}


	function rasioabsenpr($id, $ket){
		$sql = "SELECT COUNT(id_absen_prakerin) AS 'tidak_masuk',(SELECT COUNT(id_absen_prakerin) FROM absen_prakerin WHERE id_prakerin = '".$id."' AND keterangan = 'Masuk') AS 'masuk' FROM absen_prakerin WHERE id_prakerin = '".$id."' AND keterangan = 'Tidak Masuk';";
		$data = mysqli_fetch_assoc (mysqli_query(koneksi(),$sql));
		if ($ket=='masuk') {
			return $data['masuk'];
		}else{
			return $data['tidak_masuk'];
		}
	}

	function rasioabsenpg($id, $ket){
		$sql = "SELECT COUNT(id_absen_pegawai) AS 'tidak_masuk',(SELECT COUNT(id_absen_pegawai) FROM absen_pegawai WHERE nip = '".$id."' AND ket = 'Masuk') AS 'masuk' FROM absen_pegawai WHERE nip = '".$id."' AND ket = 'Tidak Masuk';";
		$data = mysqli_fetch_assoc (mysqli_query(koneksi(),$sql));
		if ($ket=='masuk') {
			return $data['masuk'];
		}else{
			return $data['tidak_masuk'];
		}
	}

	function tampilpengumumanpr(){
		$sql = "SELECT * FROM `pengumuman` WHERE tujuan='Peserta' ORDER BY waktu DESC;";
		$data = mysqli_query(koneksi(),$sql);
        $num = 1;
		foreach ($data as $row) {
        	echo "
			<div class='card radius-10' data-bs-toggle='modal' data-bs-target='#pengumuman".$num."'>
							<div class='card-body'>
								<div class='align-items-center'>
									<div>
										
										<h4 class='my-1'>".$row['judul']."</h4><hr>
										<p class='mb-0 text-secondary'>".substr($row['isi'], 0, 300)."...."."</p>
										<div style='float: right;margin-right: 15px;margin-top: 10px;'>
										".$row['waktu']."
										</div>
									</div>
								</div>
							</div>
						</div>";
		echo "<div class='modal fade' id='pengumuman".$num."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>".$row['judul']."</h5>
					<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
				</div>
				<div class='modal-body'>".$row['isi']."</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
				</div>
			</div>
		</div>
	</div>";
						$num++;
        }
	}

	function tampilpengumumanpg(){
		$sql = "SELECT * FROM `pengumuman` WHERE tujuan='Pegawai' ORDER BY waktu DESC;";
		$data = mysqli_query(koneksi(),$sql);
		$num = 1;
        foreach ($data as $row) {
        	echo "
			<div class='card radius-10' data-bs-toggle='modal' data-bs-target='#pengumuman".$num."'>
							<div class='card-body'>
								<div class='align-items-center'>
									<div>
										
										<h4 class='my-1'>".$row['judul']."</h4><hr>
										<p class='mb-0 text-secondary'>".substr($row['isi'], 0, 300)."...."."</p>
										<div style='float: right;margin-right: 15px;margin-top: 10px;'>
										".$row['waktu']."
										</div>
									</div>
								</div>
							</div>
						</div>";
		echo "<div class='modal fade' id='pengumuman".$num."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>".$row['judul']."</h5>
					<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
				</div>
				<div class='modal-body'>".$row['isi']."</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
				</div>
			</div>
		</div>
	</div>";
						$num++;
        }
	}

	function tampilriwayatpengumuman(){
		$sql = "SELECT * FROM `pengumuman` ORDER BY `waktu` DESC;";
		$data = mysqli_query(koneksi(),$sql);
		$num = 1;
        foreach ($data as $row) {
        	echo "
			<div class='card radius-10' data-bs-toggle='modal' data-bs-target='#pengumuman".$num."'>
							<div class='card-body'>
								<div class='align-items-center'>
									<div>
										<h6 class='my-1'>Ke-".$row['tujuan']."</h6>
										<div style='display:flex; justify-content:space-between'>
											<h4 class='my-1'>".$row['judul']."</h4>
												<a href='ad_riwayat_pesan.php?hapusid=".$row['id']."'>
													<button type='button' class='btn btn-danger'><i class='bx bx-trash me-0'></i>
													</button>
												</a>
										</div>
										<hr>
										<p class='mb-0 text-secondary'>".substr($row['isi'], 0, 300)."...."."</p>
										<div style='float: right;margin-right: 15px;margin-top: 10px;'>
										".$row['waktu']."
										</div>
									</div>
								</div>
							</div>
						</div>";
		echo "<div class='modal fade' id='pengumuman".$num."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>".$row['judul']."</h5>
					<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
				</div>
				<div class='modal-body'>".$row['isi']."</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
				</div>
			</div>
		</div>
	</div>";
						$num++;
        }
	}

	function hapusriwayatpengumuman($id){
		$sql = "DELETE FROM `pengumuman` WHERE `id`='".$id."';";
		if (mysqli_query(koneksi(),$sql)) {
			echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'ad_riwayat_pesan.php';</script>";
		}
	}

	function tampilpenilaian(){
			date_default_timezone_set('Asia/Jakarta');
			$sql = "SELECT prakerin.id_prakerin,prakerin.nama_prakerin,prakerin.tanggal_mulai,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai', prakerin.asal_sekolah FROM prakerin WHERE 'tanggal_selesai' > '".date('Y-m-d H:i:s')."';";
			$data = mysqli_query(koneksi(),$sql);
			$num = 1;
			foreach ($data as $row) {
				echo "<tr>
				<td scope=\"col\">".$num."</td>
				<td scope=\"col\">".$row['id_prakerin']."</td>
				<td scope=\"col\">".$row['nama_prakerin']."</td>
				<td scope=\"col\">".substr($row['tanggal_mulai'], 8,2)." ".gantibulan(substr($row['tanggal_mulai'], 5,2))." ".substr($row['tanggal_mulai'], 0,4)."</td>
				<td scope=\"col\">".substr($row['tanggal_selesai'], 8,2)." ".gantibulan(substr($row['tanggal_selesai'], 5,2))." ".substr($row['tanggal_selesai'], 0,4)."</td>
				<td scope=\"col\">".$row['asal_sekolah']."</td>";
				$sqlcheck = "SELECT * FROM hasil_prakerin WHERE id_prakerin = '".$row['id_prakerin']."';";
				echo "<td scope=\"col\">
				<div class='d-flex justify-content-around'>";
				if (mysqli_num_rows(mysqli_query(koneksi(),$sqlcheck)) > 0) {
					echo "
							<form action='ad_editpenilaian.php' method='POST'>
								<input type='hidden' name='id' value='".$row['id_prakerin']."'>
								<button type='submit' name='' class='btn btn-primary radius-10 me-1'><i class='bx bx-edit'></i>Edit</button>
							</form>
							<a href='ad_detailnilai.php?id=".$row['id_prakerin']."'>
								<button type='button' class='btn btn-primary radius-10'><i class='bx bx-info-circle'></i>Detail
								</button>
							</a>";	
				} else {
					echo "
							<form action='ad_tambahpenilaian.php' method='POST'>
								<input type='hidden' name='id' value='".$row['id_prakerin']."'>
								<button type='submit' name='tambahpenilaian' class='btn btn-primary radius-10 me-1'><i class='bx bx-pencil'></i>Nilai</button>
							</form>";
				}
				echo "</div></td>
				</tr>";
				$num++;
			}
	}

	function hapuspenilaian($id,$conn){
		//$conn = koneksi();
		$sqldelete = "DELETE FROM hasil_prakerin WHERE id_prakerin = '".$id."';";
		if(mysqli_query($conn, $sqldelete)){
			
		} else {
			throw new Exception("Error");
		}
	}

	function penilaian($aspek,$cat,$nilai,$ket,$id_prakerin,$conn){
		
        //echo "INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES (NULL, '4', '".$_POST['aspek'.$i]."', '".$_POST['cat'.$i]."', '".$_POST['nilai'.$i]."', '".$_POST['ket'.$i]."', '10118148');"."<br>";
        $sql = "INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES (NULL, '4', '".$aspek."', '".$cat."', '".$nilai."', '".$ket."', '".$id_prakerin."');";
        //echo $_POST['cat'.$i]." ".$_POST['aspek'.$i]." ".$_POST['nilai'.$i]." ".$_POST['ket'.$i]."<br>";
        //echo $sql;
        //echo $sql;
        if(mysqli_query($conn,$sql)){
        	return true;
        }
    	
	}

	function createsertifikat(){
		$sql = "INSERT INTO `sertifikat` (`id`, `no_sertifikat`, `sertifikat`) VALUES (NULL, '1/IDM/SERTIFIKAT/VIII/2021', '10118148.pdf');";
		$sql = "INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES (NULL, '4', 'dsa', 'Sikap', '100', 'dsa', '10118148');";
	}

	function pgabsenpagi($nip,$time){
		$sql = "INSERT INTO `absen_pegawai` (`id_absen_pegawai`, `tgl_absen`, `ket`, `lembur`, `nip`) VALUES (NULL, '".$time."', 'Masuk-Pagi', 'Tidak', '".$nip."');";
		if(mysqli_query(koneksi(),$sql)){
			echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'pg_absen.php';</script>";
		}
	}

	function pgabsenpulang($id){
		$sql = "UPDATE `absen_pegawai` SET `ket` = 'Masuk' WHERE `absen_pegawai`.`id_absen_pegawai` = '".$id."';";
		if(mysqli_query(koneksi(),$sql)){
			echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'pg_absen.php';</script>";
		}
	}

	function pgabsenlembur($id,$foto){
		$namagambar = $foto['name'];
		$extension = pathinfo($namagambar,PATHINFO_EXTENSION);
		$sql = "UPDATE `absen_pegawai` SET `lembur` = 'Wait',`hasil` = '".$id.'.'.$extension."' WHERE `absen_pegawai`.`id_absen_pegawai` = '".$id."';";
		echo $sql;
		if(mysqli_query(koneksi(),$sql)){
			move_uploaded_file($foto['tmp_name'], 'lembur/'.$namagambar);
			rename('lembur/'.$namagambar, 'lembur/'.$id.'.'.$extension);		
			echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'pg_absen.php';</script>";
		}	
	}

	function prabsenpagi($ni,$time,$kegiatan,$type){
		$sql = "INSERT INTO `absen_prakerin` (`id_absen_prakerin`, `tgl_absen`, `keterangan`, `type`, `kegiatan`, `id_prakerin`) VALUES (NULL, '".$time."', 'Masuk-Pagi', '".$type."', '".$kegiatan."', '".$ni."');";
		if(mysqli_query(koneksi(),$sql)){
			echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'pr_absen.php';</script>";
		}
	}

	function prabsenpulang($id){
		$sql = "UPDATE `absen_prakerin` SET `keterangan` = 'Masuk' WHERE `absen_prakerin`.`id_absen_prakerin` = '".$id."';";
		if(mysqli_query(koneksi(),$sql)){
			echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'pr_absen.php';</script>";
		}
	}

	function tampilpg($tahun,$bulan){
		$sql = "SELECT pegawai.nip,pegawai.nama_pgw,absen_pegawai.tgl_absen,";
		/*$val = date_create("2013-03-15 04:10:52");*/
		$val = date_create($tahun."-".$bulan."-01");
		$y = date_format($val,"Y");
		$m = date_format($val,"m");
		if ($tahun % 4 == 0) {
            $mon = array("01"=>"31", "02"=>"29", "03"=>"31", "04"=>"30","05"=>"31","06"=>"30","07"=>"31","08"=>"31","09"=>"30","10"=>"31","11"=>"30","12"=>"31");
        } else {
            $mon = array("01"=>"31", "02"=>"28", "03"=>"31", "04"=>"30","05"=>"31","06"=>"30","07"=>"31","08"=>"31","09"=>"30","10"=>"31","11"=>"30","12"=>"31");
        }
        $chari = $mon[$bulan];
		$sql = $sql."GROUP_CONCAT(if(DAY(absen_pegawai.tgl_absen) = '01' AND YEAR(absen_pegawai.tgl_absen) = '".$tahun."' AND MONTH(absen_pegawai.tgl_absen) = '".$bulan."',absen_pegawai.ket,NULL)) AS \"01\"";
		for ($i=2; $i <= $chari; $i++) { 
		    if ($i < 10) {
		        $i = "0".$i;
		    }
		    $sql = $sql.",GROUP_CONCAT(if(DAY(absen_pegawai.tgl_absen) = '".$i."' AND YEAR(absen_pegawai.tgl_absen) = '".$tahun."' AND MONTH(absen_pegawai.tgl_absen) = '".$bulan."',absen_pegawai.ket,NULL)) AS \"".$i."\" ";    
		}
		$sql = $sql."FROM absen_pegawai RIGHT JOIN pegawai ON pegawai.nip = absen_pegawai.nip GROUP BY pegawai.nip";
		//echo $sql;
		//$sql = "SELECT pegawai.nip,pegawai.nama_pgw FROM pegawai;";
		$data = mysqli_query(koneksi(),$sql);
		$num = 1;
		echo "<thead>
				<tr>
					<th rowspan='2'>No</th>
					<th rowspan='2'>Karyawan</th>
					<th colspan='".$chari."'>Tanggal</th>
					<th rowspan='2'>%</th>
				</tr>
				<tr>";
		for ($i=1; $i <= $chari; $i++) { 
			echo "<th>".$i."</th>";
		}
		echo "</tr>
			</thead>
			<tbody>";
		foreach ($data as $row) {
			echo "<tr style='cursor:pointer' onclick=\"window.location.href = 'ad_absen_pg.php?i=".$row['nip']."';\">
				<td>".$num."</td>
				<td>".$row['nip']."<br>".$row['nama_pgw']."</td>";
			$cabsen = 0;
			for ($i=1; $i <= $chari; $i++) { 
				if ($i < 10) {
			        $i = "0".$i;
			    }
			    if ($row[$i] == "Masuk") {
			    	echo "<td>✓</td>";
			    	$cabsen++;
			    } else {
			    	date_default_timezone_set('Asia/Jakarta');
					$show = "SELECT content FROM libur WHERE tahun = '".$tahun."';";
					$h = json_decode(mysqli_fetch_assoc(mysqli_query(koneksi(),$show))['content']);
					/*var_dump($h->data->holiday->{1}->data[0]->name);*/
					//$date = date_create("2021-10-17");
					
					$libur = false;
					$d = Date('D',strtotime($tahun."-".$bulan."-".$i));
					$day = Date('d',strtotime($tahun."-".$bulan."-".$i));
					//echo $d;
					for ($j=1; $j <= 12; $j++) { 
					    for ($k=0; $k < $h->data->holiday->{$j}->count; $k++) { 
					        if($i == substr($h->data->holiday->{$j}->data[$k]->date,8,2) && $bulan == substr($h->data->holiday->{$j}->data[$k]->date,5,2)){
					          $libur = true;
					        }
					    }
					}
					for ($j=1; $j <= 12; $j++) { 
					    for ($k=0; $k < $h->data->leave->{$j}->count; $k++) { 
					        if($i == substr($h->data->leave->{$j}->data[$k]->date,8,2) && $bulan == substr($h->data->leave->{$j}->data[$k]->date,5,2)){
					          $libur = true;
					        }
					    }
					}
					/*if ($libur == true) {
						echo "console.log('true')";	
					}*/
					if ($d == "Sun") {
						echo "<td style='background-color:red;'></td>";
					} elseif ($libur == true){
						echo "<td style='background-color:red;'></td>";
					} else {

						if ($bulan < date('m')) {
							echo "<td>X</td>";
						} elseif ($bulan == date('m')) {
							if ($i < date('d')) {
								echo "<td>X</td>";
							} else {
								echo "<td style='background-color:white;'></td>";	
							}	
						} else {
							echo "<td style='background-color:white;'></td>";	
						}
					}
			    	
			    }
			    
				//echo "<td>".$ab."</td>";
			}
			echo "<td>".$cabsen."<br>
				".(int)($cabsen/31*100)."%
				</td>
			</tr>";
			$num++;
			
		}
		echo "</tbody>";	
		//echo date('m');
		//echo $bulan;
	}

	function tampilpr($tahun,$bulan){
		$sql = "SELECT prakerin.id_prakerin,prakerin.nama_prakerin,absen_prakerin.tgl_absen,";
		$val = date_create($tahun."-".$bulan."-01");
		$y = date_format($val,"Y");
		$m = date_format($val,"m");
		if ($tahun % 4 == 0) {
            $mon = array("01"=>"31", "02"=>"29", "03"=>"31", "04"=>"30","05"=>"31","06"=>"30","07"=>"31","08"=>"31","09"=>"30","10"=>"31","11"=>"30","12"=>"31");
        } else {
            $mon = array("01"=>"31", "02"=>"28", "03"=>"31", "04"=>"30","05"=>"31","06"=>"30","07"=>"31","08"=>"31","09"=>"30","10"=>"31","11"=>"30","12"=>"31");
        }
        $chari = $mon[$bulan];
		$sql = $sql."GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '01' AND YEAR(absen_prakerin.tgl_absen) = '".$tahun."' AND MONTH(absen_prakerin.tgl_absen) = '".$bulan."',absen_prakerin.keterangan,NULL)) AS \"01\"";    
		for ($i=2; $i < 32; $i++) { 
		    if ($i < 10) {
		        $i = "0".$i;
		    }
		    $sql = $sql.",GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '".$i."' AND YEAR(absen_prakerin.tgl_absen) = '".$tahun."' AND MONTH(absen_prakerin.tgl_absen) = '".$bulan."',absen_prakerin.keterangan,NULL)) AS \"".$i."\" ";    
		}
		$sql = $sql."FROM absen_prakerin RIGHT JOIN prakerin ON prakerin.id_prakerin = absen_prakerin.id_prakerin GROUP BY prakerin.id_prakerin";
		//echo $sql;
		//$sql = "SELECT pegawai.nip,pegawai.nama_pgw FROM pegawai;";
		$data = mysqli_query(koneksi(),$sql);
		$num = 1;
		echo "<thead>
				<tr>
					<th rowspan='2'>No</th>
					<th rowspan='2'>Peserta</th>
					<th colspan='".$chari."'>Tanggal</th>
					<th rowspan='2'>%</th>
				</tr>
				<tr>";
		for ($i=1; $i <= $chari; $i++) { 
			echo "<td>".$i."</td>";
		}
		echo "</tr>
			</thead>
			<tbody>";

		foreach ($data as $row) {
			echo "<tr style='cursor:pointer' onclick=\"window.location.href = 'ad_absen_pr.php?i=".$row['id_prakerin']."';\">
				<td>".$num."</td>
				<td>".$row['id_prakerin']."<br>".$row['nama_prakerin']."</td>";
				$cabsen = 0;
			for ($i=1; $i <= $chari; $i++) { 
				if ($i < 10) {
			        $i = "0".$i;
			    }
					if ($row[$i] == "Masuk") {
			    	//$ab = "<i class='bx bx-check bg-success radius-10 text-white'></i>";
					echo "<td>✓</td>";
			    	$cabsen++;
			    } else {
			    	/*$ab = "<i class='bx bx-x bg-danger radius-10 text-white'></i>";*/

			    	date_default_timezone_set('Asia/Jakarta');
					$show = "SELECT content FROM libur WHERE tahun = '".$tahun."';";
					$h = json_decode(mysqli_fetch_assoc(mysqli_query(koneksi(),$show))['content']);
					/*var_dump($h->data->holiday->{1}->data[0]->name);*/
					//$date = date_create("2021-10-17");
					
					$libur = false;
					$d = Date('D',strtotime($tahun."-".$bulan."-".$i));
					$day = Date('d',strtotime($tahun."-".$bulan."-".$i));
					//echo $d;
					for ($j=1; $j <= 12; $j++) { 
					    for ($k=0; $k < $h->data->holiday->{$j}->count; $k++) { 
					        if($i == substr($h->data->holiday->{$j}->data[$k]->date,8,2) && $bulan == substr($h->data->holiday->{$j}->data[$k]->date,5,2)){
					          $libur = true;
					        }
					    }
					}
					for ($j=1; $j <= 12; $j++) { 
					    for ($k=0; $k < $h->data->leave->{$j}->count; $k++) { 
					        if($i == substr($h->data->leave->{$j}->data[$k]->date,8,2) && $bulan == substr($h->data->leave->{$j}->data[$k]->date,5,2)){
					          $libur = true;
					        }
					    }
					}
					/*if ($libur == true) {
						echo "console.log('true')";	
					}*/
					if ($d == "Sun") {
						echo "<td style='background-color:red;'></td>";
					} elseif ($libur == true){
						echo "<td style='background-color:red;'></td>";
					} else {

						if ($bulan < date('m')) {
							echo "<td>X</td>";
						} elseif ($bulan == date('m')) {
							if ($i < date('d')) {
								echo "<td>X</td>";
							} else {
								echo "<td style='background-color:white;'></td>";	
							}	
						} else {
							echo "<td style='background-color:white;'></td>";	
						}
					}





			    }
			    
				/*echo "<td>".$ab."</td>";*/
			}
			echo "<td>".$cabsen."<br>
				".(int)($cabsen/31*100)."%
				</td>
			</tr>";
			$num++;
		}
		echo "</tbody>";	
	}


	function detailabsenpg($nip){
		$sql = "SELECT tgl_absen,ket,lembur FROM absen_pegawai WHERE nip = '".$nip."' ORDER BY tgl_absen DESC;";
		$data = mysqli_query(koneksi(),$sql);
		echo "<thead><tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th>Lembur</th>
			</tr></thead>
			<tbody>";
		$num = 1;		
		foreach ($data as $row) {
			echo "<tr>
				<td>".$num."</td>
				<td>".$row['tgl_absen']."</td>
				<td>".$row['ket']."</td>
				<td>".$row['lembur']."</td>
			</tr>";
			$num ++;
		}
		echo "</tbody>";
	}

	
	function detailabsenpr($id_prakerin){
		$sql = "SELECT tgl_absen,keterangan,kegiatan,type FROM absen_prakerin WHERE id_prakerin = '".$id_prakerin."';";
		$data = mysqli_query(koneksi(),$sql);
		echo "<thead><tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th>Kegiatan</th>
				<th>Type</th>
			</tr></thead>
			<tbody>";
		$num = 1;		
		foreach ($data as $row) {
			echo "<tr>
				<td>".$num."</td>
				<td>".substr($row['tgl_absen'], 8,2)." ".gantibulan(substr($row['tgl_absen'], 5,2))." ".substr($row['tgl_absen'], 0,4)."</td>
				<td>".$row['keterangan']."</td>
				<td>".$row['kegiatan']."</td>
				<td>".$row['type']."</td>
			</tr>";
			$num ++;
		}
		echo "</tbody>";
	}

function getx($pdf,$string){
    //how wide is the page?
    $midPtX = $pdf->GetPageWidth() / 2;
    //now we need to know how long the write string is
    $attendeeNameWidth = $pdf->GetStringWidth($string);
    //now we need to divide that by two to calculate the shift
    $shiftLeft = $attendeeNameWidth / 2;
    //now calculate our new X value
    $x = $midPtX - $shiftLeft;
    //now apply your shift for the answer
    return $x;
}

function gantitanggal($nomor){
	$bulan = array("01"=>"I", 
					"02"=>"II",
					"03"=>"III",
					"04"=>"IV",
					"05"=>"V",
					"06"=>"VI",
					"07"=>"VII",
					"08"=>"VIII",
					"09"=>"IX",
					"10"=>"X",
					"11"=>"XI",
					"12"=>"XII");
	if ($nomor>12) {
		$nomor=$nomor-12;
	}
	return $bulan[$nomor];
	
}

function gantibulan($nomor){
	$bulan = array("01"=>"Januari", 
					"02"=>"Februari",
					"03"=>"Maret",
					"04"=>"April",
					"05"=>"Mei",
					"06"=>"Juni",
					"07"=>"Juli",
					"08"=>"Agustus",
					"09"=>"September",
					"10"=>"Oktober",
					"11"=>"November",
					"12"=>"Desember");
	if ($nomor>12) {
		$nomor=$nomor-12;
	}
	return $bulan[$nomor];
	
}

function createpdf($id,$method){


	$sql = "SELECT *,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin WHERE id_prakerin = '".$id."';";
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
	$nama = $data['nama_prakerin'];
	$pk = $data['program_keahlian'];
	$no = "No. ".$nomor."/IDM/PKL.SERTIFIKAT/".gantitanggal(substr($data['tanggal_selesai'],5,2))."/".$year;
	$tanggal_mulai = substr($data["tanggal_mulai"], 8,2)." ".gantibulan(substr($data["tanggal_mulai"], 5,2))." ".substr($data["tanggal_mulai"], 0,4);
	$tanggal_selesai = substr($data["tanggal_selesai"], 8,2)." ".gantibulan(substr($data["tanggal_selesai"], 5,2))." ".substr($data["tanggal_selesai"], 0,4);

	


    /*require('assets/fpdf/fpdf.php');*/
    include 'assets/fpdf/fpdf.php';
 	include 'assets/fpdf/exfpdf.php';
 	include 'assets/fpdf/easyTable.php';
    // Instanciation of inherited class
    $pdf=new exFPDF('L','mm','A4');
    /*$pdf = new FPDF('L','mm','A4');*/
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->AddFont('dancing','','DancingScript-VariableFont_wght.php');
    $pdf->AddFont('poppins','','Poppins-Medium.php');

    $pdf->Image('assets/images/cert-temp.jpg',0,0,297,210);

    $pdf->SetFont('poppins','',16);
    $pdf->setXY(getx($pdf,$no), 62); 
    $pdf->Write(0, $no); 

    $pdf->SetFont('dancing','U',42);
    $pdf->SetTextColor(48,164,221);
    $pdf->setXY(getx($pdf,$nama), 110); 
    $pdf->Write(0, $nama); 
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('poppins','',16);
    $pdf->setXY(getx($pdf,'Telah melaksanan Praktik Kerja Lapangan (PKL)'), 130); 
    $pdf->Write(0, 'Telah melaksanan Praktik Kerja Lapangan (PKL)'); 
    $pdf->setXY(getx($pdf,'untuk kompetensi keahlian '.$pk), 140); 
    $pdf->Write(0, 'untuk kompetensi keahlian '.$pk); 
    $pdf->setXY(getx($pdf,'tanggal '.$tanggal_mulai.' s.d. '.$tanggal_selesai), 150); 
    $pdf->Write(0, 'tanggal '.$tanggal_mulai.' s.d. '.$tanggal_selesai); 
    $pdf->setXY(220, 163); 
    $pdf->SetFont('poppins','',12);
    $pdf->Write(0, 'Bandung, '.$tanggal_selesai);




 
 $pdf->AddPage(); 
 $pdf->SetFont('poppins','',10);
 

 $pdf->setXY(getx($pdf,'NILAI PRAKTIK KERJA LAPANGAN'), 10); 
 $pdf->Write(0, 'NILAI PRAKTIK KERJA LAPANGAN'); 

 $pdf->setXY(10, 20); 
 $pdf->Write(0, 'Nama '); 
 $pdf->setXY(60, 20); 
 $pdf->Write(0, ': '.tampilprakerinnilai($id,"nama_prakerin")); 
 $pdf->setXY(10, 25); 
 $pdf->Write(0, 'Nomor Induk ');
 $pdf->setXY(60, 25); 
 $pdf->Write(0, ': '.tampilprakerinnilai($id,"id_prakerin"));
 $pdf->setXY(10, 30); 
 $pdf->Write(0, 'Program Keahlian ');
 $pdf->setXY(60, 30); 
 $pdf->Write(0, ': '.tampilprakerinnilai($id,"program_keahlian"));
 $pdf->setXY(10, 35); 
 $pdf->Write(0, 'Nama Industri/Instansi ');
 $pdf->setXY(60, 35); 
 $pdf->Write(0, ': PT. Inovindo Digital Media');
 $pdf->setXY(10, 40); 
 $pdf->Write(0, 'Lama PKL ');
 $pdf->setXY(60, 40); 
 $pdf->Write(0, ': '.tampilprakerinnilai($id,"durasi_prakerin"));

 $table=new easyTable($pdf, '%{5, 45, 15, 15, 20}', 'border:1;font-size:12;');
 	$pdf->setXY(0, 50); 
   $table->rowStyle('min-height:10; font-size:12;');
   $table->easyCell("No",'rowspan:2;align:C;');
   $table->easyCell("Aspek/Kompetensi Yang Dinilai",'rowspan:2;align:C;');
   $table->easyCell("Nilai",'colspan:2;align:C;');
   $table->easyCell("Keterangan",'rowspan:2;align:C;');
   $table->printRow();

   $table->rowStyle('min-height:10; align:{C};font-size:12;');   // let's adjust the height of this row
   $table->easyCell("Angka", 'font-family:poppins; font-size:12;align:C;');
   $table->easyCell("Huruf", 'font-family:poppins; font-size:12;align:C;');
   $table->printRow();

   $sql="SELECT hasil_prakerin.aspek, hasil_prakerin.nilai, hasil_prakerin.keterangan FROM hasil_prakerin WHERE hasil_prakerin.id_prakerin= '".$id."';";
	$num=1;
	$data = mysqli_query(koneksi(),$sql);
	foreach ($data as $row) {
		if ($row['nilai'] >= 80 ) {
			$huruf="A";
		}elseif($row['nilai'] < 80 && $row['nilai'] >= 70 ){
			$huruf="B";
		}elseif($row['nilai'] < 70 && $row['nilai'] >= 55 ){
			$huruf="C";
		}elseif($row['nilai'] < 55 && $row['nilai'] >= 35 ){
			$huruf="D";
		}else{
			$huruf="E";
		}
		$table->rowStyle('min-height:10; align:{C};font-size:12;');   // let's adjust the height of this row
	   $table->easyCell($num, 'font-family:poppins; font-size:12;');
	   $table->easyCell($row['aspek'], 'font-family:poppins; font-size:12;');
	   $table->easyCell($row['nilai'], 'font-family:poppins; font-size:12;align:C;');
	   $table->easyCell($huruf, 'font-family:poppins; font-size:12;align:C;');
	   $table->easyCell($row['keterangan'], 'font-family:poppins; font-size:12;align:C;');
	   $table->printRow();
	   $num++;
	}
   $pdf->setXY(10, $pdf->getY()+10); 
   $pdf->Write(0, 'Keterangan');
   $pdf->setX(120); 
   $pdf->Write(0, 'ABSENSI');
   $pdf->setXY(10, $pdf->getY()+10);
   $pdf->Write(0, 'Nilai Keterampilan dinyatakan lulus bila >= 75 (Tujuh Lima)');
   $pdf->setX(120);
   $pdf->Write(0, "1.  Hadir : ".jumlahhadir($id)." Hari");
   $pdf->setXY(120, $pdf->getY()+5);
   $pdf->Write(0, "2. Alpha : ".jumlahalpha($id)." Hari");
   $tanggal_selesai = tampilprakerinnilai($id,"tanggal_selesai");
   
   $pdf->setXY(220, $pdf->getY()+10); 
   $pdf->Write(0, "Bandung, ".substr($tanggal_selesai, 8,2)." ".gantibulan(substr($tanggal_selesai, 5,2))." ".substr($tanggal_selesai, 0,4));
   $pdf->setXY(10, $pdf->getY()+5);
   $pdf->Write(0, "Atasan Penilai");
   $pdf->setX(220);
   $pdf->Write(0, "Pembimbing,");
   $pdf->setXY(220, $pdf->getY()+35);
   $pdf->Write(0, "....................");

 $table->endTable(4);
    if ($method == "true") {
    	$pdf->Output('D',$asal." ".$nama.'.pdf');
    } else {
    	$pdf->Output();	
    }
    //
    

    //figma.com/file/5ZADWuBSwal50LBvo4QgMe/Member-area-Inovindo?node-id=0%3A1
}

function copyaspek($asal){
	$sql = "SELECT hasil_prakerin.aspek FROM hasil_prakerin JOIN prakerin ON prakerin.id_prakerin = hasil_prakerin.id_prakerin WHERE prakerin.asal_sekolah = '".$asal."';";
	$data = mysqli_query(koneksi(),$sql);
	foreach ($data as $row) {
		
	}
	
}

function optionasal(){
	$sql = "SELECT DISTINCT asal_sekolah FROM prakerin";
	$data = mysqli_query(koneksi(),$sql);
	foreach ($data as $row) {
		echo "<option value='".$row['asal_sekolah']."'>".$row['asal_sekolah']."</option>";
	}
}

function edituseradmin($id,$username,$password,$level){
		
	$conn = koneksi();
	mysqli_autocommit($conn, false);
	mysqli_begin_transaction($conn);
	
	try {
		
		if ($password != "") {
			$hash = password_hash($password,PASSWORD_DEFAULT);
			$sqlpass = "UPDATE `user` SET `password` = '".$hash."' WHERE `id` = '".$id."';";
			mysqli_query($conn, $sqlpass);
		}
		$sqluser = "UPDATE `user` SET `username` = '".$username."' WHERE `id` = '".$id."';";
		
		if (mysqli_query($conn, $sqluser)) {
			if (mysqli_commit($conn)) {
				echo "<script type='text/javascript'>alert('Berhasil!');window.location = 'ad_setting.php';</script>";
			} 
		} else {
			throw Exception;
		}
		
	} catch (\Exception $e) {
		mysqli_rollback($conn);
		if ($level == 1) {
			echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_pegawai.php';</script>";	
		} else {
			echo "<script type='text/javascript'>alert('Error!');window.location = 'pg_profile.php';</script>";	
		}
	} catch (mysqli_sql_exception $exception) {
		mysqli_rollback($conn);
		if ($level == 1) {
			echo "<script type='text/javascript'>alert('Error!');window.location = 'ad_pegawai.php';</script>";	
		} else {
			echo "<script type='text/javascript'>alert('Error!');window.location = 'pg_profile.php';</script>";	
		}
	}
}

function tampilprakerinnilai($id,$field){
	
	$sql="SELECT prakerin.nama_prakerin, prakerin.id_prakerin, prakerin.program_keahlian,
	prakerin.asal_sekolah, prakerin.durasi_prakerin,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin WHERE prakerin.id_prakerin= '".$id."';";
	$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
	return $data[$field];
}

function hasilprakerinnilai($id){
	$sql="SELECT hasil_prakerin.aspek, hasil_prakerin.nilai, hasil_prakerin.keterangan FROM hasil_prakerin WHERE hasil_prakerin.id_prakerin= '".$id."';";
	$num=1;
	$data = mysqli_query(koneksi(),$sql);
	foreach ($data as $row) {
		if ($row['nilai'] >= 80 ) {
			$huruf="A";
		}elseif($row['nilai'] < 80 && $row['nilai'] >= 70 ){
			$huruf="B";
		}elseif($row['nilai'] < 70 && $row['nilai'] >= 55 ){
			$huruf="C";
		}elseif($row['nilai'] < 55 && $row['nilai'] >= 35 ){
			$huruf="D";
		}else{
			$huruf="E";
		}
		echo "<tr>
		<td>".$num."</td>
		<td>".$row['aspek']."</td>
		<td>".$row['nilai']."</td>
		<td>".$huruf."</td>
		<td>".$row['keterangan']."</td>
		</tr>";
		$num++;
	}
}

function tampilabsennilai($id,$field){
	
	$sql="SELECT prakerin.nama_prakerin, prakerin.id_prakerin, prakerin.program_keahlian,
	prakerin.asal_sekolah, prakerin.durasi_prakerin FROM prakerin WHERE prakerin.id_prakerin= '".$id."';";
	$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
	return $data[$field];
}

function jumlahhadir($id){
	$sql = "SELECT COUNT((SELECT keterangan FROM absen_prakerin WHERE id_prakerin='".$id."' && keterangan='Hadir')) AS 'hadir' FROM `absen_prakerin`;";
	$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
	return $data['hadir'];
}

function jumlahalpha($id){
	$sql = "SELECT durasi_prakerin FROM prakerin WHERE id_prakerin = '".$id."';";
	$data = mysqli_fetch_assoc(mysqli_query(koneksi(),$sql));
	return ($data['durasi_prakerin'] * 30)-jumlahhadir($id);
} 

function adtampillembur(){
	$sql = "SELECT absen_pegawai.*,pegawai.nama_pgw FROM absen_pegawai JOIN pegawai ON pegawai.nip = absen_pegawai.nip WHERE lembur = 'Wait';";
	$data = mysqli_query(koneksi(), $sql);
	$num = 1;
	foreach ($data as $row) {
		echo "<tr>
		<td>".$num."</td>
		<td>".$row['nip']."</td>
		<td>".$row['nama_pgw']."</td>
		<td>
		<a href='lembur/".$row['hasil']."' target='_blank'>
			<button type='button' class='btn btn-primary radius-10'><i class='bx bx-info-circle'></i>Detail
			</button>
		</a>
		</td>
		<td>
		<div class='d-flex'>
			<form action='#' method='POST'>
				<input type='hidden' name='id' value='".$row['id_absen_pegawai']."'>
				<button type='submit' style='width:115px;' name='setujui' class='btn btn-success radius-10 me-1'><i class='bx bx-check'></i>Setujui</button>
			</form>
			<form action='#' method='POST'>
				<input type='hidden' name='id' value='".$row['id_absen_pegawai']."'>
				<button type='submit' style='width:115px;' name='tolak' class='btn btn-danger radius-10 me-1'><i class='bx bx-x'></i>Tolak</button>
			</form>
		</div>
		</td>
		</tr>";
	}
}

function setujuilembur($id){
	$sql = "UPDATE `absen_pegawai` SET `lembur` = 'Ya' WHERE `absen_pegawai`.`id_absen_pegawai` = '".$id."';";
	if(mysqli_query(koneksi(),$sql)){
		echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'ad_lembur.php';</script>";
	}
}

function tolaklembur($id){
	$sql = "UPDATE `absen_pegawai` SET `lembur` = 'Tidak' WHERE `absen_pegawai`.`id_absen_pegawai` = '".$id."';";
	if(mysqli_query(koneksi(),$sql)){
		echo "<script type='text/javascript'>alert('Absen berhasil!');window.location = 'ad_lembur.php';</script>";
	}
}
?>
