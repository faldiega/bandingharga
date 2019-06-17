<?php 
include('simple_html_dom.php');

// Create DOM from URL
$htmlNvd = file_get_html("https://www.rakitan.com/kategori.php?id=27");
$htmlRdn = file_get_html("https://www.rakitan.com/kategori.php?id=28");

// Mencari data barang, harga, dan link
// NVIDIA
foreach($htmlNvd->find('table[cellpadding="2"] tr[bgcolor=#FFFFFF]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
foreach($htmlNvd->find('table[cellpadding="2"] tr[bgcolor=#DDDDDD]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
// RADEON
foreach($htmlRdn->find('table[cellpadding="2"] tr[bgcolor=#FFFFFF]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
foreach($htmlRdn->find('table[cellpadding="2"] tr[bgcolor=#DDDDDD]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
// print_r($items);

include_once '../database.php';

foreach($items as $item) :
	$nama = $item['nama'];
	$harga = $item['harga'];
	$link = $item['link'];

	// perintah sql untuk masukan data ke tabel rakitan_niaga
	$idreset = "ALTER TABLE rakitan_niaga AUTO_INCREMENT=0";
	$query = "INSERT IGNORE INTO rakitan_niaga VALUES ('','$nama','Rakitan Niaga Nusantara','$harga','$link')";
	mysqli_query($koneksi,$idreset) or die(mysqli_error($koneksi));
	mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
endforeach;

$htmlNvd->clear();
unset($htmlNvd);
$htmlRdn->clear();
unset($htmlRdn);
?>