<?php 
session_start();
$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah=$ambil->fetch_assoc();


$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('pelanggan dihapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";
?>