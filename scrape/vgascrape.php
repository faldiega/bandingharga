<?php 
//ENTERKOMPUTER
$data = file_get_contents('https://enterkomputer.com/api/product/vga.json');
$vga = json_decode($data, true);

foreach($vga as $item) :
	$id = $item['id'];
	$nama = $item['name'];
	$harga = $item['price'];
	$link = $item['link_toped'];

	// perintah sql untuk masukan data ke tabel vga_ek
	$query = "INSERT IGNORE INTO vga_ek VALUES ('$id','$nama','Enterkomputer','$harga','$link')";

	mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
endforeach;

// RAKITAN NIAGA NUSANTARA
include('../asset/simple_html_dom.php');

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

// delete data dalam tabel karena data pada website ini
// tidak memiliki id, jadi kalau tidak di delete,
// data akan terus bertambah setiap di insert
$reset = "DELETE FROM vga_rn";
mysqli_query($koneksi,$reset) or die(mysqli_error($koneksi));

foreach($items as $item) :
	$nama = $item['nama'];
	$harga = $item['harga'];
	$link = $item['link'];

	// perintah sql untuk insert data ke tabel vga_rn	
	$idreset = "ALTER TABLE vga_rn AUTO_INCREMENT = 0";
	$query = "INSERT INTO vga_rn VALUES ('','$nama','Rakitan Niaga Nusantara','$harga','$link')";
	
	mysqli_query($koneksi,$idreset) or die(mysqli_error($koneksi));
	mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
endforeach;

$htmlNvd->clear();
unset($htmlNvd);
$htmlRdn->clear();
unset($htmlRdn);
?>