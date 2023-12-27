<?php 
session_start();
// Filter berdasarkan id_pelanggan yang diterima dari $_GET
$filter = ['id_pelanggan' => $_GET['id']];

// Menghapus data pelanggan berdasarkan filter
$bulkWrite = new MongoDB\Driver\BulkWrite();
$bulkWrite->delete($filter, ['limit' => 1]); // Menghapus satu dokumen yang sesuai dengan filter

// Eksekusi operasi hapus
$result = $manager->executeBulkWrite('nama_koleksi_pelanggan', $bulkWrite); // Gantikan 'nama_koleksi_pelanggan' dengan nama koleksi Anda

echo "<script>alert('Pelanggan dihapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";
?>
