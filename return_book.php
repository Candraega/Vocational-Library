<?php
// return_book.php
include 'config/app.php';
// Ambil ID peminjaman dari request
$loan_id = $_POST['loan_id'];

// Lakukan operasi pengembalian buku di database
// Misalnya, mengurangi kuantitas buku yang dipinjam

// Simpan kuantitas buku yang baru ke dalam variabel $new_quantity
$new_quantity = 1; // Ganti dengan kuantitas buku yang sesuai

// Kirim kuantitas baru kembali ke halaman JavaScript
echo $new_quantity;
?>