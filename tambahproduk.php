<?php
// Menghubungkan ke database MongoDB
$manager = new MongoDB\Driver\Manager("mongodb+srv://alyssadiva:<password>@lysaccshop.a8l48kp.mongodb.net/");
$dbName = "lysaccshop"; 
if (isset($_POST['save'])) {
    $namaFoto = $_FILES['foto']['name'];
    $lokasiFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasiFoto, "../foto_produk/" . $namaFoto);

    $bulk = new MongoDB\Driver\BulkWrite;

    $produk = [
        'nama_produk' => $_POST['nama'],
        'harga_produk' => $_POST['harga'],
        'foto_produk' => $namaFoto,
        'deskripsi_produk' => $_POST['deskripsi']
    ];

    $bulk->insert($produk);

    $manager->executeBulkWrite("$dbName.produk", $bulk);  // Menggantikan 'produk' dengan nama koleksi Anda

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>

<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">        
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="save">simpan</button>
</form>
