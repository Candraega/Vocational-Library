<?php
include 'config/app.php';
$id_user = isset($_GET['id_user']) ? (int)$_GET['id_user'] : 0; // Pastikan ID buku diterima dengan benar

if ($id_user <= 0) {
    echo "<script>
            alert('Invalid User ID');
            window.location.href = 'user.php';
            </script>";
    exit; // Jika ID user tidak valid, hentikan eksekusi skrip
}

if (delete_user($id_user)) { // Panggil fungsi delete_book() dengan parameter ID buku
    echo "<script>
            alert('Book Data Deleted Successfully');
            window.location.href = 'user.php';
            </script>";
} else {
    echo "<script>
            alert('Failed to Delete Book Data');
            window.location.href = 'user.php';
            </script>";
}
