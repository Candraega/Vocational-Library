<?php
include 'config/app.php';
$id_book = isset($_GET['id_book']) ? (int)$_GET['id_book'] : 0; // Pastikan ID buku diterima dengan benar

if ($id_book <= 0) {
    echo "<script>
            alert('Invalid Book ID');
            window.location.href = 'book.php';
            </script>";
    exit; // Jika ID buku tidak valid, hentikan eksekusi skrip
}

if (delete_book($id_book)) { // Panggil fungsi delete_book() dengan parameter ID buku
    echo "<script>
            alert('Book Data Deleted Successfully');
            window.location.href = 'book.php';
            </script>";
} else {
    echo "<script>
            alert('Failed to Delete Book Data');
            window.location.href = 'book.php';
            </script>";
}
