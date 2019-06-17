$.getJSON('data/pizza.json', function(data){
	let menu = data.menu;
	$.each(menu, function(i, data) {
		$('#daftar-menu').append('<div class="col-md-4"><div class="card mb-4"><img src="img/menu/'+ data.gambar +'" class="card-img-top"><div class="card-body"><h5 class="card-title">'+ data.nama +'</h5><p class="card-text">'+ data.deskripsi +'</p><h5 class="card-title">Rp. '+ data.harga +'</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>')
	});
});

$('.nav-link').on('click', function() {
	$('.nav-link').removeClass('active');
	$(this).addClass('active');
})