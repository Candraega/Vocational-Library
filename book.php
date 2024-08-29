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

$data_buku = select("SELECT * FROM book ORDER BY id_book ASC");
$query_buku = mysqli_query($db, "SELECT * FROM book");
$row_book = mysqli_num_rows($query_buku);
$total_quantity = getTotalQuantity();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
  if (!addBook($_POST) > 0) {
      echo "Failed to add book.";
  }  else {
    echo "<script>
    alert('User Data added successfully');
    document.location.href = 'book.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <style>
    /* CSS untuk modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.4);
      padding-top: 0px;
    }
    .modal-content {
        border-radius: 15px;
      background-color: #fefefe;
      margin: 0.5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
      height: 830px
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    .signup-box {
      width: 360px;
      height: 720px;
      margin: auto;
      background-color: white;
      border-radius: 3px;
    }
    .login-box {
      width: 360px;
      height: 280px;
      margin: auto;
      border-radius: 3px;
      background-color: white;
    }
    form {
      width: 300px;
      margin-left: 20px;
    }
    form label {
      display: flex;
      margin-top: 20px;
      font-size: 18px;
    }
    form input {
      width: 100%;
      padding: 7px;
      border: 1px solid gray;
      border-radius: 6px;
      outline: none;
    }
    input[type="submit"] {
      width: 320px;
      height: 35px;
      margin-top: 20px;
      border: none;
      background-color: #49c1a2;
      color: white;
      font-size: 18px;
    }
    p {
      text-align: center;
      padding-top: 20px;
      font-size: 15px;
    }
    .para-2 {
      text-align: center;
      color: white;
      font-size: 15px;
      margin-top: -10px;
    }
    .para-2 a {
      color: #49c1a2;
    }
    table th {
      font-size: 15px;
      text-align: center;
    }
    .sidebar {
      width: 15%;
      padding: 2rem 1rem;
      opacity: 0;
    }
    .dropdown-container {
  position: relative;
 }

 .dropdown {
  width: 100%;
  padding: 7px;
  border: 1px solid gray;
  border-radius: 6px;
  outline: none;
  appearance: none; /* Remove default arrow */
}

.dropdown-container::after {
  content: "\f078"; /* Unicode for arrow-down icon */
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}

/* Style untuk dropdown ketika sedang aktif */
.dropdown-container.active::after {
  content: "\f077"; /* Unicode for arrow-up icon */
}

/* Style untuk dropdown item */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  z-index: 1;
  top: 100%;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.dropdown-content.show {
  display: block;
}

.dropdown-item {
  padding: 10px;
  cursor: pointer;
}

.dropdown-item:hover {
  background-color: #ddd;
}
    /* CSS tambahan lainnya */
    /* Tambahkan CSS lain yang diperlukan untuk tata letak halaman */
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <?php include 'sidebar.php'; ?>
    <div class="main-body">
      <h2>Book</h2>
      <div class="promo_card_container">
        <div class="promo_card">
          <h1><?= $row_book ?></h1>
          <span>Book Available</span>
          <button type="button" onclick="openModal()">Add More +</button>
        </div>
        <div class="promo_card">
          <h1><?= $total_quantity ?></h1>
          <span>All Book Quantity</span>
        </div>
      </div>
      <div class="history_lists">
        <div class="list1">
          <div class="row">
            <h4>Book Data</h4>
            <a href="#">See all</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>#ID Book</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>Publisher</th>
                <th>Description</th>
                <th>Prodi</th>
                <th>Photo</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data_buku as $index => $book) : 
                $deskripsi = $book['deskripsi'];
                $deskripsi_pendek = strlen($deskripsi) > 100 ? substr($deskripsi, 0, 50) . "..." : $deskripsi;
              ?>
              <tr>
                <td><?= $book['id_book']; ?></td>
                <td><?= $book['nama']; ?></td>
                <td><?= $book['penulis']; ?></td>
                <td><?= $book['jenis']; ?></td>
                <td><?= $book['penerbit']; ?></td>
                <td><?= $deskripsi_pendek; ?></td>
                <td><?= $book['prodi']; ?></td>
                <td><img width="80%" src="assets/<?= $book['foto']; ?>" /></td>
                <td><?= $book['quantity']; ?></td>
                <td><a href="header.php">Edit</a></td>
                <td>  <a href="deletebook.php?id_book=<?=$book['id_book'];?>" class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure book data will be deleted?')">Delete</a></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
     <div class="sidebar">
      <h4></h4>
      
      </div>

    <!-- Modal Structure -->
    <div id="borrowModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="signup-box">
          <h1>Add Book</h1>
          <h4>Feel this form to add book for database</h4>
          <form method="post" action="" enctype="multipart/form-data">
            <label>Book Title</label>
            <input type="text" name="nama" value="" required/>
            <label>Author</label>
            <input type="text" name="author" placeholder="" required />
            <label>Type</label>
            <div class="dropdown-container">
            <select name="type" id="level" class="dropdown" required>
                <option value="">--Choose Type--</option>
                <option value="Self Development">Self Development</option>
                <option value="Fiction">Fiction</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Art">Art</option>
                <option value="Biographies">Biographies</option>
            </select>  
            <div class="dropdown-content">
  </div>
</div>          
            <label>Publisher</label>
            <input type="text" name="publisher" placeholder="" required />
            <label>Description</label>
            <input type="text" name="description" placeholder="" required />
            <label>Prodi</label>
            <div class="dropdown-container">
            <select name="prodi" id="level" class="dropdown" required>
                <option value="">--Choose Prodi--</option>
                <option value="Teknologi Informasi">Teknologi Informasi</option>
                <option value="Administrasi Bisnis">Administrasi Bisnis</option>
                <option value="Desain Grafis">Desain Grafis</option>
                <option value="Keubank">Keubank</option>
                <option value="Manajemen Perhotelan">Manajemen Perhotelan</option>
            </select>  
              </div>
          <label>Photo</label>
            <input type="file" name="foto" placeholder="" required />
            <label>Quantity</label>
            <input type="number" name="quantity" placeholder="" required />

            <input type="submit" name="add" value="Add" />
          </form>
          <p><br />
          </p>
        </div>
      </div>
    </div>

  </div>
  <script>
    // JavaScript untuk menangani modal
    function openModal() {
      console.log("openModal called"); // Debugging
      document.getElementById('borrowModal').style.display = "block";
    }

    function closeModal() {
      console.log("closeModal called"); // Debugging
      document.getElementById('borrowModal').style.display = "none";
    }

    // Menutup modal saat pengguna mengklik di luar modal
    window.onclick = function(event) {
      if (event.target == document.getElementById('borrowModal')) {
        closeModal();
      }
    }
    // JavaScript untuk dropdown
document.querySelectorAll('.dropdown-container').forEach(item => {
  const dropdown = item.querySelector('.dropdown');
  const dropdownContent = item.querySelector('.dropdown-content');

  dropdown.addEventListener('click', function() {
    dropdownContent.classList.toggle('show');
    item.classList.toggle('active');
  });

  dropdownContent.querySelectorAll('.dropdown-item').forEach(option => {
    option.addEventListener('click', function() {
      dropdown.value = option.textContent;
      dropdownContent.classList.remove('show');
      item.classList.remove('active');
    });
  });

  window.addEventListener('click', function(event) {
    if (!item.contains(event.target)) {
      dropdownContent.classList.remove('show');
      item.classList.remove('active');
    }
  });
});

  </script>
</body>
</html>
