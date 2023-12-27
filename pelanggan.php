<?php
// Menghubungkan ke database MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://alyssadiva:<password>@lysaccshop.a8l48kp.mongodb.net/");
$dbName = "lysaccshop";
?>

<h2>Data Pelanggan</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Telepon</th>
			<th>No.Rumah</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor = 1; ?>
	<?php
	// Menggunakan query untuk mendapatkan semua data pelanggan
	$query = new MongoDB\Driver\Query([]); // Mengambil semua data, Anda mungkin perlu menambahkan filter atau sortir jika diperlukan
	$rows = $manager->executeQuery("$dbName.pelanggan", $query); // Gantikan 'pelanggan' dengan nama koleksi Anda

	foreach ($rows as $pecah) {
	?>
	<tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo $pecah->nama_pelanggan; ?></td>
		<td><?php echo $pecah->email_pelanggan; ?></td>
		<td><?php echo $pecah->telepon_pelanggan; ?></td>
		<td><?php echo $pecah->alamat_rumah; ?></td>
		<td>
			<a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah->_id; ?>" class="btn btn-danger">hapus</a> <!-- Disarankan menggunakan _id sebagai identifikasi unik di MongoDB -->
		</td>	
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
