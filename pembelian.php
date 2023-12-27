<?php
// Menghubungkan ke database MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://alyssadiva:<password>@lysaccshop.a8l48kp.mongodb.net/");
$dbName = "lysaccshop"; // Gantikan dengan nama database Anda
?>

<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor = 1; ?>
	<?php
	// Menggunakan query untuk mendapatkan data pembelian dan nama pelanggan terkait
	$pipeline = [
		'$lookup' => [
			'from' => 'pelanggan', // Koleksi pelanggan
			'localField' => 'id_pelanggan',
			'foreignField' => 'id_pelanggan',
			'as' => 'pelanggan'
		]
	];

	$query = new MongoDB\Driver\Command([
		'aggregate' => 'pembelian',
		'pipeline' => $pipeline,
		'cursor' => new stdClass
	]);

	$rows = $manager->executeCommand($dbName, $query);

	foreach ($rows as $pecah) {
	?>
	<tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo $pecah->pelanggan[0]->nama_pelanggan; ?></td>
		<td><?php echo $pecah->tanggal_pembelian; ?></td>
		<td><?php echo $pecah->total_pembelian; ?></td>
		<td>
			<a href="index.php?halaman=detail&id=<?php echo $pecah->_id; ?>" class="btn btn-info">detail</a>
		</td>	
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
