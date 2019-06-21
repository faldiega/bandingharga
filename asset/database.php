<?php
$servername='localhost';
$username='root';
$password='';
$dbname = 'bandingharga';

$koneksi= mysqli_connect($servername,$username,$password,$dbname);

if(!$koneksi){
	die('Could not Connect My Sql:' .mysqli_error());
}
?>