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
$data_user = select("SELECT * FROM user ORDER BY id_user ASC");

$id_user = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
  if (!addUser($_POST) > 0) {
      echo "Failed to add user.";
  } else {
    echo "<script>
    alert('User Data added successfully');
    document.location.href = 'user.php';
    </script>";
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
</style>
<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <?php include 'sidebar.php';?>

    <div class="main-body">
      <h2>User</h2>
      <div class="promo_card">
        <h1>7</h1>
        <span>All User</span>
        <?php if($_SESSION['level']=='admin'):?>
        <button type="button" onclick="openModal()">Add More +</button>
        <?php endif; ?>
      </div>

      <div class="history_lists">
        <div class="list1">
          <div class="row">
            <h4>Student</h4>
            <a href="#">See all</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>#ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>NIM</th>
                <th>Prodi</th>
                <?php if($_SESSION['level']=='admin'):?>
                <th>Action</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1;?>
                <?php foreach ($data_user as $user) : 
                       if ($user['level']=='student') : 

                  $fullname = $user['fullname'];
                $fullname_pendek = strlen($fullname) > 15 ? substr($fullname, 0, 7) . "..." : $fullname;?>
              <tr text-align:none;>
                <td><?=$user['id_user']; ?></td>
                <td><?=$fullname_pendek; ?></td>
                <td><?=$user['username']; ?></td>
                <td>-Encrypted-</td>
                <td><?=$user['nim']; ?></td>
                <td><?=$user['prodi']; ?></td>
                <?php if($_SESSION['level']=='admin'):?>
                <td><a href="header.php">Edit</a>
                    <a href="deleteuser.php?id_user=<?= $user['id_user']; ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure user data will be deleted?')">Delete</a></td>
                       <?php endif; ?>
              </tr>
              <?php endif; ?>
              <?php endforeach; ?>
              
            </tbody>
          </table>
        </div>

        <div class="list2">
          <div class="row">
            <h4>Operator</h4>
            <a href="#">.</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>Username</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data_user as $user) : ?>
                <?php if ($user['level']=='operator') : ?>
        
              <tr>
                <td><?= $user['username'];?></td>
                <?php if($_SESSION['level']=='admin') : ?>
                <td><a href="">Edit</a>
                    <a href="deleteuser.php?id_user=<?= $user['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure user data will be deleted?')">Delete</a></td>
                   <?php endif; ?> 
                
              </tr>
              <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="sidebar">
      <h4>Admin</h4>
      <?php foreach($data_user as $user) : ?>
        <?php if ($user['level']=='admin') : ?>
      <div class="balance">
        <i class="fas fa icon"></i>
        <div class="info">
          <h5><?= $user['username']; ?></h5>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
      </div>
      
      
<!-- Modal Structure -->
<div id="borrowModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="signup-box">
          <h1>Add User</h1>
          <h4>Feel this form to add User for database</h4>
          <form method="post" action="" enctype="multipart/form-data">
            <label>Full Name</label>
            <input type="text" name="fullname" value="" required/>
            <label>Username</label>
            <input type="text" name="username" placeholder="" required />
            <label>Password</label>
            <input type="password" name="password" placeholder="" required />
            <label>NIM</label>
            <input type="number" name="nim" placeholder="" required />
            <label>Prodi</label>
            <div class="dropdown-container">
            <select name="prodi" id="level" class="dropdown" required>
                <option value="">--Choose Prodi--</option>
                <option value="Teknologi Informasi">Teknologi Informasi</option>
                <option value="Administrasi Bisnis">Administrasi Bisnis</option>
                <option value="Desain Grafis">Desain Grafis</option>
                <option value="Keubank">Keubank</option>
                <option value="Manajemen Perhotelan">Manajemen Perhotelan</option>
                <option value="-">-</option>
            </select>  
              </div>         
            <label>Level</label>
            <div class="dropdown-container">
            <select name="level" id="level" class="dropdown" required>
                <option value="">--Choose Level--</option>
                <option value="student">Student</option>
                <option value="operator">Operator</option>
                <option value="admin">Admin</option>
            </select>  
              </div>         
            
            <input type="submit" name="add" value="Add" />
          </form>
          <p><br />
          </p>
        </div>
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