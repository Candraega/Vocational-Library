<?php
include 'config/app.php';
$id_loaning = isset($_GET['id_loaning']) ? (int)$_GET['id_loaning'] : 0; // Pastikan ID buku diterima dengan benar

if ($id_loaning <= 0) {
    echo "<script>
            alert('Invalid Book ID');
            window.location.href = 'dashboard.php';
            </script>";
    exit; // Jika ID buku tidak valid, hentikan eksekusi skrip
}

if (delete_loan($id_loaning)) { // Panggil fungsi delete_book() dengan parameter ID buku
    echo "<script>
            alert('Book Data Deleted Successfully');
            window.location.href = 'dashboard.php';
            </script>";
} else {
    echo "<script>
            alert('Failed to Delete Book Data');
            window.location.href = 'dashboard.php';
            </script>";
}
