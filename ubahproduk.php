<h2>Ubah Produk</h2>
<?php
// Menghubungkan ke database MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://alyssadiva:<password>@lysaccshop.a8l48kp.mongodb.net/");
$dbName = "lysaccshop";  

  ?>

  <form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk'];?>">		
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk'];?>">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"><?php echo $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" class="form-control" name="foto"> 
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
    $bulk = new MongoDB\Driver\BulkWrite;
    
    $filter = ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])];

    $namaFoto = $_FILES['foto']['name'];
    $lokasiFoto = $_FILES['foto']['tmp_name'];

    if (!empty($lokasiFoto)) {
        move_uploaded_file($lokasiFoto, "../foto_produk/" . $namaFoto);
        $data = [
            '$set' => [
                'nama_produk' => $_POST['nama'],
                'harga_produk' => $_POST['harga'],
                'foto_produk' => $namaFoto,
                'deskripsi_produk' => $_POST['deskripsi']
            ]
        ];
    } else {
        $data = [
            '$set' => [
                'nama_produk' => $_POST['nama'],
                'harga_produk' => $_POST['harga'],
                'deskripsi_produk' => $_POST['deskripsi']
            ]
        ];
    }

    $bulk->update($filter, $data);

    $manager->executeBulkWrite("$dbName.produk", $bulk);
    
    echo "<script>alert('Data Produk Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}

$filter = ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])];
$query = new MongoDB\Driver\Query($filter);
$rows = $manager->executeQuery("$dbName.produk", $query);

foreach ($rows as $pecah) {
    // Sekarang, Anda dapat mengakses properti dokumen seperti $pecah->nama_produk, $pecah->harga_produk, dll.
}
?>
