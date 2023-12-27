<?php 
session_start();
// Filter berdasarkan id_produk yang diterima dari $_GET
$filter = ['id_produk' => $_GET['id']];

// Mendapatkan detail produk sebelum menghapus
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery('nama_koleksi_produk', $query); // Gantikan 'nama_koleksi_produk' dengan nama koleksi Anda
$pecah = current($cursor->toArray());

// Menghapus file gambar produk jika ada
$fotoproduk = $pecah->foto_produk;
if (file_exists("../foto_produk/$fotoproduk")) {
    unlink("../foto_produk/$fotoproduk");
}

// Menghapus data produk dari MongoDB
$bulkWrite = new MongoDB\Driver\BulkWrite();
$bulkWrite->delete($filter, ['limit' => 1]); // Menghapus satu dokumen yang sesuai dengan filter
$manager->executeBulkWrite('nama_koleksi_produk', $bulkWrite); // Gantikan 'nama_koleksi_produk' dengan nama koleksi Anda

echo "<script>alert('Produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";
?>
