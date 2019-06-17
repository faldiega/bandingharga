<?php 
$json = file_get_contents('pizza.json');
$data = json_decode($json, true);

include_once '../database.php';

foreach($data as $item) :
	$id = $item['id'];
	$kategori = $item['kategori'];
	$nama = $item['nama'];
	$deskripsi = $item['deskripsi'];
	$harga = $item['harga'];
	$gambar = $item['gambar'];

// insert data ke database
	// mysqli_query($koneksi,"ALTER TABLE pizza AUTO_INCREMENT = 1");
	mysqli_query($koneksi,"INSERT IGNORE INTO pizza VALUES ('$id','$kategori','$nama','$deskripsi','$harga','$gambar')") or die(mysqli_error($koneksi));

// COBA SCHEDULER UPDATE HARGA
	mysqli_query($koneksi,"DROP EVENT EVENT_REINSERT");
	mysqli_query($koneksi,"CREATE EVENT EVENT_REINSERT ON SCHEDULE EVERY 1 SECOND DO INSERT INTO pizza VALUES ('$id','$kategori','$nama','$deskripsi','$harga','$gambar') ON DUPLICATE KEY UPDATE harga = VALUES(harga)") or die(mysqli_error($koneksi));
endforeach;

// close koneksi database
    // mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tes JSON to MYSQL</title>
	<link rel="stylesheet" href="/bandingharga/css/bootstrap.css">
</head>
<body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">Web Skripsi</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link " href="/bandingharga/index.php">Home <span class="sr-only">(current)</span></a>
					<a class="nav-item nav-link" href="/bandingharga/contoh/test-json.php">Tes JSON</a>
					<a class="nav-item nav-link" href="test-curl.php">Tes CURL</a>	
					<a class="nav-item nav-link" href="#">About</a>	
				</div>
			</div>
		</div>
	</nav>

	<!-- BOX PENCARIAN -->
	<div class="container">
		<br>
		<h1><center>MENU PIZZA</center></h1>
		<h5><center>Tes JSON</center></h5>
		<form action="" method="post">
			<div class="mt-5">
				<div class="input-group mb-3">
					<input type="text" name="search-input" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Masukkan nama menu...">
				</div>
			</div>

			<!-- TOMBOL -->
			<div class="mt-2, mb-5">
				<button type="submit" name="search-button" id="search-button" class="btn btn-primary btn-lg btn-block">Cari Menu</button>
			</div>
		</form>


		<?php 
		// TOMBOL CARI DITEKAN
		if (isset($_POST["search-button"])) {
			$search = $_POST['search-input'];
			$result = mysqli_query($koneksi,"SELECT * FROM pizza WHERE nama LIKE '%$search%'");
			?>

		<div class="row">	
			<!-- TABEL HASIL PENCARIAN -->
			<?php while($searchdata = mysqli_fetch_array($result)) : ?> 
				<div class="col-md-4">
					<div class="card mb-4">
						<img src="img/menu/<?= $searchdata["gambar"]; ?>" class="card-img-top">
						<div class="card-body">
							<h5 class="card-title"><?= $searchdata["nama"]; ?></h5>
							<p class="card-text"><?= $searchdata["deskripsi"]; ?></p>
							<h5 class="card-title">
								Rp. <?php echo number_format($searchdata["harga"],2,",","."); ?>
							</h5>
							<a href="#" class="btn btn-primary">Pesan Sekarang</a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php }	?>
		<?php mysqli_close($koneksi); ?>
		</div>
	</div>

	<!-- JQuery dulu baru Javascript -->
	<script
	src="https://code.jquery.com/jquery-3.4.0.js"
	integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
	crossorigin="anonymous"></script>

	<script src="js/mystyle.js"></script>	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>