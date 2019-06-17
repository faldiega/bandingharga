<?php 
/*$data = file_get_contents('http://www.viraindo.com/vga.html');
var_dump($data);*/

// BUKA KONEKSI DATABASE
$servername='localhost';
$username='root';
$password='';
$dbname = "kurs";

$koneksi= mysqli_connect($servername,$username,$password,"$dbname");

if(!$koneksi){
	die('Could not Connect My Sql:' .mysqli_error());
}
/*
// AMBIL DATA
$url = file_get_contents('http://www.bi.go.id/id/moneter/informasi-kurs/referensi-jisdor/Default.aspx');

$pecah = explode('<table class="table1">', $url);
$pecah2 = explode ('</table>',$pecah[1]);
$pecah3 = explode ('<td>',$pecah2[0]);
$integ=str_replace(",","", $pecah3[2]);
$trimmed = str_replace(".00","", $integ);
// echo $trimmed;
var_dump(explode(',', $trimmed));

echo '<br><br>';

// AMBIL DATA VIRAINDO
$url = file_get_contents('http://www.viraindo.com/vga.html');

$pecah = explode('<table border="0" cellpadding="0" cellspacing="0" width="1414" style="border-collapse:
	collapse;width:1061pt>', $url);
$hasil = explode ('<td>',$pecah[0]);
echo $trimmed;
*/

// PHP DOCUMENTATION
/* 
   A string that doesn't contain the delimiter will simply
   return a one-length array of the original string.
*/
/*$input1 = "hello";
$input2 = "hello,there";
$input3 = ',';
var_dump( explode( ',', $input1 ) );
var_dump( explode( ',', $input2 ) );
var_dump( explode( ',', $input3 ) );*/

// COBA TEROOOS
$isi_teks = "1,23456,Prothelord,http://prothelon.com";
 
$potongan_teks = explode(",", $isi_teks); 
echo $potongan_teks[0]; // data1 
echo $potongan_teks[1]; // data2
echo $potongan_teks[2]; // data3
echo $potongan_teks[3]; // data4
echo '<pre>';
print_r($potongan_teks);
echo '</pre>';
?>