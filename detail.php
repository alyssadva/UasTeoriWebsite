<?php
// Inisialisasi koneksi ke MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://alyssadiva:sandygeo26@lysaccshop.a8l48kp.mongodb.net/");

// Mengganti kueri SQL Anda dengan kueri MongoDB
$filter = ['id_pembelian' => $_GET['id']];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('nama_koleksi_pembelian', $query); // Gantikan 'nama_koleksi_pembelian' dengan nama koleksi Anda

$detail = current($cursor->toArray());  // Mengambil hasil pertama dari kueri

?>

<strong><?php echo $detail->nama_pelanggan; ?></strong> <br>
<p>
	<?php echo $detail->telepon_pelanggan; ?><br>
	<?php echo $detail->email_pelanggan; ?><br>
	<?php echo $detail->alamat_rumah; ?>
</p>
<p>
	Tanggal: <?php echo $detail->tanggal_pembelian; ?><br>
	Total: <?php echo $detail->total_pembelian; ?>
</p>

<!-- Daftar Produk -->
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor = 1; ?>
	<?php
	// Kueri untuk mendapatkan detail produk yang dibeli
	$filter_produk = ['id_pembelian' => $_GET['id']];
	$options_produk = [];
	$query_produk = new MongoDB\Driver\Query($filter_produk, $options_produk);
	$cursor_produk = $manager->executeQuery('nama_koleksi_pembelian_produk', $query_produk); // Gantikan 'nama_koleksi_pembelian_produk' dengan nama koleksi Anda

	foreach ($cursor_produk as $pecah) {
	?>
	<tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo $pecah->nama_produk; ?></td>
		<td><?php echo $pecah->harga_produk; ?></td>
		<td><?php echo $pecah->jumlah_pembelian; ?></td>
		<td>
			<?php echo $pecah->harga_produk * $pecah->jumlah_pembelian; ?>
		</td>
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
