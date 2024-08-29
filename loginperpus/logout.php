<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login first please!');
    document.location.href = 'index.php';
    </script>";
    exit;
}
//kosongkan $_SESSION user login
$_SESSION =[];

session_unset();
session_destroy();
header("location: index.php");
?>