<?php
session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
  alert('login dulu dong');
  document.location.href = 'loginperpus/index.php';
  </script>";
  exit;
}
include 'config/app.php';

$data_loaning = select("SELECT * FROM loaning ORDER BY id_loaning ASC");
$query_loan = mysqli_query($db, "SELECT * FROM loaning");
$row_loan = mysqli_num_rows($query_loan);

$query_buku = mysqli_query($db, "SELECT * FROM book");
$row_book = mysqli_num_rows($query_buku);
$total_quantity = getTotalQuantity();

$data_buku = select("SELECT * FROM book ORDER BY id_book ASC");


// Pemrosesan form pengembalian buku
// Pemrosesan form pengembalian buku
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['return'])) {
  $id_book = $_POST['id_book'];
  $id_loaning = $_POST['id_loaning'];

  // Memanggil fungsi returnBook() untuk menambah kembali kuantitas buku
  if (returnBook($id_book, $id_loaning)) {
      echo "<script>alert('Quantity for book with ID $id_book has been updated successfully.'); window.location.href = 'dashboard.php';</script>";
  } else {
      echo "<script>alert('Failed to update quantity for book with ID $id_book.'); window.location.href = 'dashboard.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<style>
    .side_navbar{
  padding: 1px;
  display: flex;
  flex-direction: column;
  width: 200px;
}
    .sidebar{
  width: 15%;
  padding: 2rem 1rem;
  background: #fff;
  width: 200px;
}
    .main-body{
  padding: 1rem;
  flex-grow: 1;
  margin-left:20px;
}
    .promo_card_container {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  flex-wrap: wrap; /* Ensure cards wrap on smaller screens */
}

/* Each promo card */
.promo_card {
  flex: 1 1 calc(25% - 20px); /* Four cards per row */
  min-width: 200px; /* Minimum width to maintain layout */
  background: rgb(37, 37, 37);
  color: #fff;
  border-radius: 8px;
  padding: 0.5rem 1rem 1rem 3rem;
  margin-top: 10px;
}
.sidebar {
      width: 15%;
      padding: 2rem 1rem;
      opacity: 0;
    }
</style>
<body>
    <?php
  include 'header.php';
  ?>
  <div class="container">
    <?php
    include 'sidebar.php';
    ?>
    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card_container">
        <div class="promo_card">
          <h1><?=$row_loan;?></h1>
          <span>Loaning</span>
          <button></button>
        </div>
        <div class="promo_card">
          <h1> <?= $total_quantity?></h1>
          <span>All Book Quantity</span>
          <button></button>
        </div>
            <div class="history_lists">
        <div class="list1">
          <div class="row">
            <h4>History</h4>
            <a href="#">See all</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>#ID</th>
                <th>Judul</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Phone</th>
                <th>ID Book</th>
                <th>Loan Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_loaning as $loaning) : ?>
              <tr>
                <td><?= $loaning['id_loaning'];  ?></td>
                <td><?= $loaning['judul'];  ?></td>
                <td><?= $loaning['fullname'];  ?></td>
                <td><?= $loaning['username'];  ?></td>
                <td><?= $loaning['nim'];  ?></td>
                <td><?= $loaning['prodi'];  ?></td>
                <td><?= $loaning['phone'];  ?></td>
                <td><?= $loaning['id_book'];  ?></td>
                <td><?= $loaning['loan_date'];  ?></td>
                <td>    <form method="post" action="">
                                            <input type="hidden" name="id_book" value="<?= $loaning['id_book']; ?>">
                                            <input type="hidden" name="id_loaning" value="<?= $loaning['id_loaning']; ?>">
                                            <input type="submit" name="return" value="Return">
                                        </form>
                    <a href="deleteloan.php?id_loaning=<?= $loaning['id_loaning']; ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure loan data will be deleted?')">Delete</a></td>
              </tr>
              <?php endforeach;?>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="sidebar">
      <h4>dsadadsa</h4>
      
      </div>
    </div>
  </div>
  <script>
$(document).ready(function(){
    $(".return_link").click(function(e){
        e.preventDefault(); // Mencegah tindakan default dari tautan
        var loan_id = $(this).data('loan-id'); // Ambil ID peminjaman dari atribut data
        $.ajax({
            url: "return_book.php", // Ganti dengan URL script PHP yang akan memproses pengembalian
            method: "POST",
            data: { loan_id : loan_id },
            success: function(response){
                // Update kuantitas di dalam promo_card
                var new_quantity = parseInt(response);
                $(".promo_card:nth-child(2) h1").text(new_quantity);
                alert("Quantity updated successfully!");
            }
        });
    });
});
</script>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#menu_buku").click(function(){
        $.ajax({
            url: "data_buku.php",
            success: function(response){
                $("#content").html(response);
            }
        });
    });
});
</script>
