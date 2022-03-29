<?php
include('function.php');
/*
image.php
*/
/*    header("Content-type: image/jpeg");
    $imgPath = 'assets/images/sert.jpg';
    $image = imagecreatefromjpeg($imgPath);
    $color = imagecolorallocate($image, 0, 255, 255);
    $string = "Mohammad Iksan Badruzaman";
    $fontSize = 755;
    $x = 115;
    $y = 200;
    imagestring($image, $fontSize, $x, $y, $string, $color);
    imagejpeg($image);

    imagettftext(
    GdImage $image,
    float $fontsize,
    float $angle,
    int $x,
    int $y,
    int $color,
    string $font_filename,
    string $text,
    array $options = []
): array|false*/
//echo date_default_timezone_get();
//date_default_timezone_set('Asia/Jakarta');
//echo date('Y-m-d H:i:s')."<br><br><br>";
//if (isset($_POST['simpanpenilaian'])) {
    //$num = 0;
        //echo $_POST['sikapAspek0'];
    /*for ($i=0; $i < 5; $i++) { 
        echo $_POST['sikapAspek'.$i].$_POST['sikapNilai'.$i].$_POST['sikapKet'.$i]."<br>";
    }*/
    //for ($i=0; $i < (count($_POST)/4)-1; $i++) { 
        //echo "INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES (NULL, '4', '".$_POST['aspek'.$i]."', '".$_POST['cat'.$i]."', '".$_POST['nilai'.$i]."', '".$_POST['ket'.$i]."', '10118148');"."<br>";
        //echo $_POST['cat'.$i]." ".$_POST['aspek'.$i]." ".$_POST['nilai'.$i]." ".$_POST['ket'.$i]."<br>";
    //}
    /*foreach ($_POST as $field => $value) {
        if (substr($field,0,5) == "sikap") {
            echo "INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES (NULL, '4', '".$field."', 'Sikap', '".$value."', 'dsa', '10118148');"
        }
        echo "INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES (NULL, '4', 'dsa', 'Sikap', '100', 'dsa', '10118148');"
        echo $field." : ".$value."<br>";
    }*/
    /*echo '<pre>';
    var_dump($_POST);
    echo '</pre>';*/
//}
/* function getx($pdf,$string){
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
} */



/*    require('assets/fpdf/fpdf.php');
    // Instanciation of inherited class
    $pdf = new FPDF('L','mm','A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->AddFont('hbd','','happybirthday.php');

    $pdf->Image('assets/images/cert-temp.jpg',0,0,297,210);

    $pdf->SetFont('arial','',16);
    $pdf->setXY(getx($pdf,$no), 62); 
    $pdf->Write(0, '$no'); 

    $pdf->SetFont('hbd','U',42);
    $pdf->SetTextColor(48,164,221);
    $pdf->setXY(getx($pdf,$nama), 110); 
    $pdf->Write(0, $nama); 
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',16);
    $pdf->setXY(getx($pdf,'Telah melaksanan Praktik Kerja Lapangan (PKL)'), 130); 
    $pdf->Write(0, 'Telah melaksanan Praktik Kerja Lapangan (PKL)'); 
    $pdf->setXY(getx($pdf,'untuk kompetensi keahlian '.$pk), 140); 
    $pdf->Write(0, 'untuk kompetensi keahlian '.$pk); 
    $pdf->setXY(getx($pdf,'tanggal '.$tanggal_mulai.' s.d. '.$tanggal_selesai), 150); 
    $pdf->Write(0, 'tanggal '.$tanggal_mulai.' s.d. 13 Oktober 2021'); 
    $pdf->setXY(228, 163); 
    $pdf->SetFont('Arial','',12);
    $pdf->Write(0, 'Bandung, 13 Oktober 2021'); 
    //$pdf->Output('D','filename.pdf');
    $pdf->Output();*/

//createpdf();
/*echo (int) substr("2021-04-04", 5, 2)+1;
echo gantitanggal("09");*/
/*echo "SELECT 
pegawai.nip,pegawai.nama_pgw,";
echo "GROUP_CONCAT(if(DAY(absen_pegawai.tgl_absen) = '01',absen_pegawai.ket,NULL)) AS \"01\"";    
for ($i=2; $i < 32; $i++) { 
    if ($i < 10) {
        $i = "0".$i;
    }
    echo ",GROUP_CONCAT(if(DAY(absen_pegawai.tgl_absen) = '".$i."',absen_pegawai.ket,NULL)) AS \"".$i."\" ";    
}
echo "FROM absen_pegawai RIGHT JOIN pegawai ON pegawai.nip = absen_pegawai.nip WHERE pegawai.nip = '109837498722'
GROUP BY pegawai.nip";*/


//echo "SELECT prakerin.id_prakerin,prakerin.nama_prakerin,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '01',absen_prakerin.keterangan,NULL)) AS "01",GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '02',absen_prakerin.keterangan,NULL)) AS "02" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '03',absen_prakerin.keterangan,NULL)) AS "03" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '04',absen_prakerin.keterangan,NULL)) AS "04" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '05',absen_prakerin.keterangan,NULL)) AS "05" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '06',absen_prakerin.keterangan,NULL)) AS "06" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '07',absen_prakerin.keterangan,NULL)) AS "07" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '08',absen_prakerin.keterangan,NULL)) AS "08" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '09',absen_prakerin.keterangan,NULL)) AS "09" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '10',absen_prakerin.keterangan,NULL)) AS "10" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '11',absen_prakerin.keterangan,NULL)) AS "11" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '12',absen_prakerin.keterangan,NULL)) AS "12" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '13',absen_prakerin.keterangan,NULL)) AS "13" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '14',absen_prakerin.keterangan,NULL)) AS "14" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '15',absen_prakerin.keterangan,NULL)) AS "15" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '16',absen_prakerin.keterangan,NULL)) AS "16" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '17',absen_prakerin.keterangan,NULL)) AS "17" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '18',absen_prakerin.keterangan,NULL)) AS "18" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '19',absen_prakerin.keterangan,NULL)) AS "19" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '20',absen_prakerin.keterangan,NULL)) AS "20" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '21',absen_prakerin.keterangan,NULL)) AS "21" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '22',absen_prakerin.keterangan,NULL)) AS "22" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '23',absen_prakerin.keterangan,NULL)) AS "23" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '24',absen_prakerin.keterangan,NULL)) AS "24" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '25',absen_prakerin.keterangan,NULL)) AS "25" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '26',absen_prakerin.keterangan,NULL)) AS "26" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '27',absen_prakerin.keterangan,NULL)) AS "27" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '28',absen_prakerin.keterangan,NULL)) AS "28" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '29',absen_prakerin.keterangan,NULL)) AS "29" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '30',absen_prakerin.keterangan,NULL)) AS "30" ,GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '31',absen_prakerin.keterangan,NULL)) AS "31" FROM absen_prakerin RIGHT JOIN prakerin ON prakerin.id_prakerin = absen_prakerin.id_prakerin GROUP BY prakerin.id_prakerin;";


/*echo "SELECT prakerin.id_prakerin,prakerin.nama_prakerin,";
echo "GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '01',absen_prakerin.keterangan,NULL)) AS \"01\"";    
for ($i=2; $i < 32; $i++) { 
    if ($i < 10) {
        $i = "0".$i;
    }
    echo ",GROUP_CONCAT(if(DAY(absen_prakerin.tgl_absen) = '".$i."',absen_prakerin.keterangan,NULL)) AS \"".$i."\" ";    
}
echo "FROM absen_prakerin RIGHT JOIN prakerin ON prakerin.id_prakerin = absen_prakerin.id_prakerin
GROUP BY prakerin.id_prakerin";*/
    # Header informando que é uma imagem JPEG
  /*  header('Content-type: image/jpeg');
    # Declaração das variáveis usadas
    $imgName = strtoupper(substr(md5(date(DATE_RFC822)), 0, 20));
    $imgPath = "assets/images/cert-temp.jpg";
    $imgQuality = 90;
    # Carregar imagem já existente no servidor
    $img = imagecreatefromjpeg("imagem.jpg");
    $font = "assets\fpdf\font\happybirthday.ttf";
    # Cores de saída
    $black = imagecolorallocate($img, 0, 0, 0);
    # Texto que será escrito na imagem
    $texto = urldecode("Texto inserido na imagem\n");
    $texto.= $imgName;
    # Posicionamento
    $bbox = imagettfbbox(10, 45, $font, $texto);
    $x = $bbox[0] + (imagesx($img) / 2) - ($bbox[4] / 2) - 130;
    $y = $bbox[1] + (imagesy($img) / 2) - ($bbox[5] / 2) - 40;
    # Escrever na $img
    imagettftext($img, 25, 0, $x, $y, $black, $font, $texto);
    # Envia a imagem para o arquivo
    imagejpeg($img, $imgPath, $imgQuality);
    # Mostra a imagem no navegador
    imagejpeg($img, NULL, $imgQuality);
    imagedestroy($img);*/



    
/*header("Content-type: image/png");
$imgPath = "assets/images/cert-temp.jpg";
    $imgQuality = 90;
$string = "Halo Dunia";
$font = 2;
$width = imagefontwidth($font + 4) * strlen($string);
$height = imagefontheight($font);
$image = imagecreatetruecolor ($width,$height);
$white = imagecolorallocate ($image,255,255,255);
$black = imagecolorallocate ($image,0,0,0);
imagefill($image,0,0,$white);
imagestring ($image,$font,14,0,$string,$black);
imagejpeg($img, NULL, $imgQuality);
/*imagepng ($image);
imagedestroy($image);*/

/*$img = imagecreatefromjpeg('assets/images/cert-temp.jpg');
$white = imagecolorallocate($img, 0, 0, 0);
$font = "C:\Windows\Fonts\arial.ttf";
imagettftext($img, 24, 0, 5, 24, $white, $font, "TEXT");
imagejpeg($img, "SAVE.JPG", 100);*/




/*header('Content-type: image/jpeg');

// Load And Create Image From Source
$our_image = imagecreatefromjpeg('assets/images/cert-temp.jpg');

// Allocate A Color For The Text Enter RGB Value
$white_color = imagecolorallocate($our_image, 255, 255, 255);

// Set Path to Font File
$font_path = 'font/larabiefont.TTF';

// Set Text to Be Printed On Image
$text ="Welcome To Talkerscode";

$size=20;
$angle=0;
$left=125;
$top=200;
    
// Print Text On Image
imagettftext($our_image, $size,$angle,$left,$top, $white_color, $font_path, $text);

// Send Image to Browser
imagejpeg($our_image);

// Clear Memory
imagedestroy($our_image);
*/

/*function createpdfe($no,$nama,$pk,$tanggal_mulai,$tanggal_selesai,$out,$asal){
    require('assets/fpdf/fpdf.php');
    // Instanciation of inherited class
    $pdf = new FPDF('L','mm','A4');
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
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('poppins','',11);
    $pdf->setXY(getx($pdf,'Nilai Praktik Kerja Lapangan'), 15); 
    $pdf->Write(0, 'Nilai Praktik Kerja Lapangan'); 
    $pdf->setXY(10, 32); 
    $pdf->Write(0, 'Nama Siswa : '.$nama); 
    $pdf->setXY(10, 37); 
    $pdf->Write(0, 'Nomor Induk : 10118161'); 
    $pdf->setXY(10, 42); 
    $pdf->Write(0, 'Program Keahlian : '.$pk); 
    $pdf->setXY(10, 47); 
    $pdf->Write(0, 'Nama Industri/Instansi : PT. INOVINDO DIGITAL MEDIA'); 
    $pdf->setXY(10, 52); 
    $pdf->Write(0, 'Lama PKL : 3 Bulan'); 
    $pdf->setXY(0, 57); 
    $pdf->Ln(); 
    $pdf->Cell(8,5,' ','LTR',0,'L',0);
    $pdf->Ln();
    $pdf->Cell(8,5,'No','LR',0,'C',0);  // cell with left and right borders
    $pdf->Cell(8,15,'Aspek/Kompetensi Yang Dinilai','LR',0,'C',0);
    $pdf->Ln();
    
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    if ($out == "D") {
        $pdf->Output('D',$asal." ".$nama.'.pdf');
    } else {
        $pdf->Output(); 
    }
    //
    

    //figma.com/file/5ZADWuBSwal50LBvo4QgMe/Member-area-Inovindo?node-id=0%3A1
}
$sql = "SELECT *,DATE_ADD(prakerin.tanggal_mulai,INTERVAL prakerin.durasi_prakerin MONTH) AS 'tanggal_selesai' FROM prakerin WHERE id_prakerin = '".$_GET['detail']."';";
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
    createpdfe($no,$data['nama_prakerin'],$data['program_keahlian'],$tanggal_mulai,$tanggal_selesai,"D",$data['asal_sekolah']);
} else {
    createpdfe($no,$data['nama_prakerin'],$data['program_keahlian'],$tanggal_mulai,$tanggal_selesai,"",$data['asal_sekolah']);
}*/

/*$datetime = DateTime::createFromFormat('YmdHi', '201308841830');
echo $datetime->format('D');
*/
/*if(date('d') == 'Wed'){
    echo "LIBUR";
} else {
    echo "MASUK";
}

echo date('D');*/
//$json = file_get_contents('https://kalenderindonesia.com/api/APICprp2ZzIWc/libur/masehi/2021');
//$obj = json_encode(json_decode(str_replace("'","",$json)));

//$sql = "INSERT INTO libur (id,tahun,content) VALUES (NULL,'".date('Y-m-d')."','$obj');";
//echo $sql;
/*$excute = mysqli_query(koneksi(),$sql);
if (!$excute) {
    echo mysqli_error(koneksi());
}*/
/*$show = "SELECT content FROM libur WHERE tahun = '2021';";
$h = json_decode(mysqli_fetch_assoc(mysqli_query(koneksi(),$show))['content']);*/
//var_dump($h->data->holiday->{1}->data[0]->name);
/*for ($i=1; $i <= 12; $i++) { 
    for ($j=0; $j < $h->data->holiday->{$i}->count ; $j++) { 
        if('25' == substr($h->data->holiday->{$i}->data[$j]->date,8,2)) {
            echo "TRUE";
        }
    }
}*/
//echo date_format(date('Y-m-d h-m-s'), date_create('2021-11-15 04:10:52'));
/*$tahun = "2021";
$bulan = "10";
$date=date_create($tahun."-".$bulan."-01");
echo date_format($date,"Y");
echo date_format($date,"m");*/
//echo date('Y-m-d');
//echo var_dump($obj);
//echo Date('d');
/*if (Date('d') < 10) {
    $now = substr(Date('d'),1,1);
} else {
    $now = Date('d');
}*/
//echo Date('Y-m-d');
/*for ($i=1; $i <= 12; $i++) { 
    for ($j=0; $j < $obj->data->holiday->{$i}->count; $j++) { 
        if('2021-03-11' == $obj->data->holiday->{$i}->data[$j]->date){
            //echo "True";
        }
    }
}*/
/*for ($i=1; $i <= 12; $i++) { 
    for ($j=0; $j < $obj->data->leave->{$i}->count; $j++) { 
        if(Date('Y-m-d') == $obj->data->leave->{$i}->data[$j]->date){
            //echo "True";
        }
    }
}*/
/*for ($i=1; $i <= 12; $i++) { 
    for ($j=0; $j < $h->data->longWeekend->{$i}->count; $j++) { 
        echo $h->data->longWeekend->{$i}->data[$j]->date." ";    
        echo $h->data->longWeekend->{$i}->data[$j]->name."<br>";    
    }
}*/
/*for ($i=1; $i <= 12; $i++) { 
    for ($j=0; $j < $obj->data->harpitnas->{$i}->count; $j++) { 
       // echo $obj->data->harpitnas->{$i}->data[$j]->date." ";    
       // echo $obj->data->harpitnas->{$i}->data[$j]->name."<br>";    
    }
}*/
 /*[0]=>
  object(stdClass)#1 (3) {
    ["holiday_date"]=>
    string(9) "2021-01-1"
    ["holiday_name"]=>
    string(17) "Tahun Baru Masehi"
    ["is_national_holiday"]=>
    bool(true)
  }*/
 /* echo date('Y-m-d',strtotime('2021-10-14'))."<br>";
  echo Date('Y-m-d');
  if(date('Y-m-d',strtotime('2021-10-11')) < Date('Y-m-d')){
    echo "true";
  }*/
/*  $d = Date('D',strtotime('2021'."-".'10'."-".'2'));
  echo $d;*/
  function pg($tahun,$bulan){
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
        $sql = $sql."GROUP_CONCAT(if(DAY(absen_pegawai.tgl_absen) = '01',absen_pegawai.ket,NULL)) AS \"01\"";    
        for ($i=2; $i <= $chari; $i++) { 
            if ($i < 10) {
                $i = "0".$i;
            }
            $sql = $sql.",GROUP_CONCAT(if(DAY(absen_pegawai.tgl_absen) = '".$i."',absen_pegawai.ket,NULL)) AS \"".$i."\" ";    
        }
        $sql = $sql."FROM absen_pegawai RIGHT JOIN pegawai ON pegawai.nip = absen_pegawai.nip
        WHERE YEAR(absen_pegawai.tgl_absen) = '".$tahun."' AND MONTH(absen_pegawai.tgl_absen) = '".$bulan."' GROUP BY pegawai.nip";
        //echo $sql;
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
            for ($i=1; $i <= 31; $i++) { 
                if ($i < 10) {
                    $i = "0".$i;
                }
                if ($row[$i] == "Masuk") {
                    $ab = "Masuk";
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
                               echo substr($h->data->holiday->{$j}->data[$k]->date,8,2)."<br>";
                              $libur = true;
                            }
                        }
                    }
                    for ($j=1; $j <= 12; $j++) { 
                        for ($k=0; $k < $h->data->leave->{$j}->count; $k++) { 
                            if($i == substr($h->data->leave->{$j}->data[$k]->date,8,2) && $bulan == substr($h->data->leave->{$j}->data[$k]->date,5,2)){
                            echo substr($h->data->leave->{$j}->data[$k]->date,8,2)."<br>";
                              $libur = true;
                            }
                        }
                    }
                    /*if ($libur == true) {
                        echo "console.log('true')"; 
                    }*/
                    if ($d == "Sun") {
                        $ab = "Minggu";
                    } elseif($libur == true){
                        $ab = "Merah";
                    } else {
                        $ab = "Alpha";
                    }
                    
                }
                
                echo "<td>".$ab."</td>";
            }
            echo "<td>".$cabsen."<br>
                ".(int)($cabsen/$chari*100)."%
                </td>
            </tr>";
            $num++;
            
        }
        echo "</tbody>";    
    }
?>
<table class="table table-striped table-bordered" border="1">
                                
                                    <?php
                                        pg('2021','02');
                                    ?>
                                
                            </table>