<?php 
//ENTERKOMPUTER
$data = file_get_contents('https://enterkomputer.com/api/product/memoryram.json');
$ram = json_decode($data, true);

foreach($ram as $item) :
	$id = $item['id'];
	$nama = $item['name'];
	$harga = $item['price'];
    $link = $item['link_toped'];
    $subcat = $item['subcategory_description'];

	// perintah sql untuk masukan data ke tabel ram_ek
	$query = "INSERT IGNORE INTO ram_ek VALUES ('$id','$nama','Enterkomputer','$harga','$link')";

	mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
endforeach;

// RAKITAN NIAGA NUSANTARA
include('../asset/simple_html_dom.php');

// Create DOM from URL
$ddr4 = file_get_html("https://www.rakitan.com/kategori.php?id=22");
$ddr3 = file_get_html("https://www.rakitan.com/kategori.php?id=24");

// Mencari data barang, harga, dan link
// RAM DDR4
foreach($ddr4->find('table[cellpadding="2"] tr[bgcolor=#FFFFFF]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
foreach($ddr4->find('table[cellpadding="2"] tr[bgcolor=#DDDDDD]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
// RAM DDR3
foreach($ddr3->find('table[cellpadding="2"] tr[bgcolor=#FFFFFF]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}
foreach($ddr3->find('table[cellpadding="2"] tr[bgcolor=#DDDDDD]') as $tb) {
    $item['nama'] = $tb->find('td.teks', 0)->plaintext;
    $item['harga'] = $tb->find('td[align="RIGHT"]', 0)->plaintext;
    $item['link'] = $tb->find('a[href*="https://wa.me/"]', 0)->href;
    $items[] = $item;
}

// delete data dalam tabel karena data pada website ini
// tidak memiliki id, jadi kalau tidak di delete,
// data akan terus bertambah setiap di insert
$reset = "DELETE FROM ram_rn";
mysqli_query($koneksi,$reset) or die(mysqli_error($koneksi));

foreach($items as $item) :
	$nama = $item['nama'];
	$harga = $item['harga'];
	$link = $item['link'];

	// perintah sql untuk insert data ke tabel ram_rn	
	$idreset = "ALTER TABLE ram_rn AUTO_INCREMENT = 0";
	$query = "INSERT INTO ram_rn VALUES ('','$nama','Rakitan Niaga Nusantara','$harga','$link')";
	
	mysqli_query($koneksi,$idreset) or die(mysqli_error($koneksi));
	mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
endforeach;

$ddr4->clear();
unset($ddr4);
$ddr3->clear();
unset($ddr3);
?>