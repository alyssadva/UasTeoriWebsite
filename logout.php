<?php 
session_start(); // Mulai sesi jika belum dimulai

// Menghancurkan sesi
session_destroy();

// Memberikan pesan dan mengarahkan pengguna ke halaman login
echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='login.php';</script>";
?>
