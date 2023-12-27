<?php
// Menghubungkan ke database MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://alyssadiva:<password>@lysaccshop.a8l48kp.mongodb.net/");
$dbName = "lysaccshop";  // Gantikan dengan nama database Anda
?>

<h2>Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor = 1; ?>
	<?php
	// Query untuk mendapatkan semua produk
	$query = new MongoDB\Driver\Query([]);
	$rows = $manager->executeQuery("$dbName.produk", $query);  // Menggantikan 'produk' dengan nama koleksi Anda

	foreach ($rows as $pecah) {
	?>
	<tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo $pecah->nama_produk; ?></td>
		<td><?php echo $pecah->harga_produk; ?></td>
		<td>
			<img src="../foto_produk/<?php echo $pecah->foto_produk; ?>" width="100">
		</td>
		<td>
			<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah->_id; ?>" class="btn-danger btn">hapus</a>
			<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah->_id; ?>" class="btn btn-warning">ubah</a>
		</td>	
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>
