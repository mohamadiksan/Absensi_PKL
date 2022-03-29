<?php
 include 'fpdf/fpdf.php';
 include 'fpdf/exfpdf.php';
 include 'fpdf/easyTable.php';

 $pdf=new exFPDF();
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',10);

 $pdf->AddFont('lato','','Lato-Regular.php');

 $pdf->AddFont('FontUTF8','','Arimo-Regular.php'); 
 $pdf->AddFont('FontUTF8','B','Arimo-Bold.php'); 
 $pdf->AddFont('FontUTF8','BI','Arimo-BoldItalic.php'); 
 $pdf->AddFont('FontUTF8','I','Arimo-Italic.php'); 
 
 $table=new easyTable($pdf, '%{5, 45, 15, 15, 20}', 'border:1;font-size:12;');
   $table->rowStyle('min-height:10; align:{C};font-size:12;');
   $table->easyCell("No",'rowspan:2;'); 
   $table->easyCell("Aspek/Kompetensi Yang Dinilai",'rowspan:2;');
   $table->easyCell("Nilai",'colspan:2;');
   $table->easyCell("Keterangan",'rowspan:2;');
   $table->printRow();

   $table->rowStyle('min-height:10; align:{C};font-size:12;');   // let's adjust the height of this row
   $table->easyCell("aa", 'font-family:FontUTF8; font-size:12;');
   $table->easyCell("aa", 'font-family:FontUTF8; font-size:12;');
   $table->printRow();

 $table->endTable(4);
 
//-----------------------------------------

 $pdf->Output(); 

?>