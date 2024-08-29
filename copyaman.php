<?php
// Include the necessary configuration or function files
$title = 'Book Detail';
include('config/app.php');

// Retrieve the book ID from the URL parameter
$id_book = (int)$_GET['id_book'];

// Fetch the book details from the database
$book = select("SELECT * FROM book WHERE id_book = $id_book")[0]; // Assuming select returns an array

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title><?= $title ?></title>
</head>
<style>
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #007BFF; /* Change to your desired hover background color */
            color: white; /* Change to your desired hover text color */
        }

        .buttons button.add-to-cart {
            background-color: #28a745; /* Initial background color */
            color: white; /* Initial text color */
        }

        .buttons button.add-to-cart:hover {
            background-color: #218838; /* Hover background color */
            color: white; /* Hover text color */
        }
    </style>
<body>
    <div class="container">
        <div class="title">BOOK DETAIL</div>
        <div class="detail">
            <div class="image">
                <img src="assets/<?= $book['foto']; ?>" alt="Book Cover">
            </div>
            <div class="content">
                <h1 class="name"><?= $book['nama']; ?></h1>
                <div class="author"><?= $book['penulis']; ?></div>
                <div class="description"><?= $book['deskripsi']; ?></div>
                <div class="price"><?= $book['jenis']; ?></div> <!-- Display the genre if available -->
                <div class="buttons">
                <button onclick="window.location.href='index.php';">Back to Home</button>
                    <button>Borrow Now!
                        <span>
                            <svg class="" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18V3H3zm2 2h14v14H5V5zm2 2v2h2V7H7zm0 4v2h2v-2H7zm4-4v2h6V7h-6zm0 4v2h6v-2h-6z"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="title">Similar Books</div>
        <div class="listProduct">
            <?php
            $similar_books = select("SELECT * FROM book WHERE id_book != $id_book");
            foreach ($similar_books as $similar_book) : ?>
                <a href="detailbuku.php?id_book=<?= $similar_book['id_book']; ?>" class="item">
                    <img src="assets/<?= $similar_book['foto']; ?>" alt="Book Cover">
                    <h2><?= $similar_book['nama']; ?></h2>
                    <div class="author"><?= $similar_book['penulis']; ?></div>
                    <div class="price"><?= $similar_book['jenis']; ?></div> 
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>




<?php
// Include the necessary configuration or function files
$title = 'Book Detail';
include('config/app.php');

// Retrieve the book ID from the URL parameter
$id_book = (int)$_GET['id_book'];

// Fetch the book details from the database
$book = select("SELECT * FROM book WHERE id_book = $id_book")[0]; // Assuming select returns an array

// Fetch the available quantity of the book from the database
$quantity = $book['quantity']; // Assuming 'quantity' is the column name for available quantity

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrow'])) {
    $judul = $book['nama'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $phone = $_POST['phone'];
    $id_book = $_POST['id_book'];
    // Check if the quantity is greater than 0 before borrowing
    if ($quantity > 0) {
        // Perform borrowing action
        // Update the quantity of the book in the database
        $updatedQuantity = $quantity - 1;
        update("UPDATE book SET quantity = $updatedQuantity WHERE id_book = $id_book");

        // Optionally, you can perform additional actions like logging the borrowing transaction
        $query = "INSERT INTO loaning (judul, fullname, username, nim, prodi, phone, id_book)
        VALUES ('$judul', '$fullname', '$username', '$nim', '$prodi', '$phone', '$id_book')";
insert($query);

        // Redirect to the home page or any other page after borrowing
        header("Location: index.php");
        exit;
    } else {
        // Display an error message if the book is out of stock
        $errorMessage = "Sorry, this book is out of stock.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    
    <title><?= $title ?></title>
</head>
<style>
     .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #007BFF; /* Change to your desired hover background color */
            color: white; /* Change to your desired hover text color */
        }

        .buttons button.add-to-cart {
            background-color: #28a745; /* Initial background color */
            color: white; /* Initial text color */
        }

        .buttons button.add-to-cart:hover {
            background-color: #218838; /* Hover background color */
            color: white; /* Hover text color */
        }
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
            padding-top: px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 2px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
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
h1 {
  text-align: center;
  padding-top: 15px;
}
h4 {
  text-align: center;
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
  border: none;
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
</style>
<body>
    <div class="container">
        <div class="title">BOOK DETAIL</div>
        <div class="detail">
            <div class="image">
                <img src="assets/<?= $book['foto']; ?>" alt="Book Cover">
            </div>
            <div class="content">
                <h1 class="name"><?= $book['nama']; ?></h1>
                <div class="author"><?= $book['penulis']; ?></div>
                <br>
                <div class="description"><?= $book['deskripsi']; ?></div>
                <div class="price"><?= $book['jenis']; ?></div> <!-- Display the genre if available -->
                <div class="quantity">Available Quantity: <?= $quantity ?></div> <!-- Display the available quantity -->
                <br>
                <form method="post">
                    <?php if ($quantity > 0) : ?>
                        <button type="button" onclick="openModal()">Borrow Now!</button>
                    <?php else : ?>
                        <button disabled>No Stock Available</button>
                    <?php endif; ?>
                </form>
                <?php if (isset($errorMessage)) : ?>
                    <div class="error"><?= $errorMessage ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="title">Similar Books</div>
        <div class="listProduct">
            <?php
            $similar_books = select("SELECT * FROM book WHERE id_book != $id_book");
            foreach ($similar_books as $similar_book) : ?>
                <a href="detailbuku.php?id_book=<?= $similar_book['id_book']; ?>" class="item">
                    <img src="assets/<?= $similar_book['foto']; ?>" alt="Book Cover">
                    <h2><?= $similar_book['nama']; ?></h2>
                    <div class="author"><?= $similar_book['penulis']; ?></div>
                    <div class="price"><?= $similar_book['jenis']; ?></div> 
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Modal Structure -->
    <div id="borrowModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="signup-box">
      <h1>Book Loaning</h1>
      <h4>Feel this form and get your book!</h4>
      <form method="post" action="">
                    <label>Judul</label>
                    <input type="text" name="judul" value="<?= $book['nama']; ?>" readonly />
                    <label>Your Full Name</label>
                    <input type="text" name="fullname" placeholder="" required/>
                    <label>Username</label>
                    <input type="text" name="username" placeholder="" required/>
                    <label>NIM</label>
                    <input type="text" name="nim" placeholder="" required/>
                    <label>Prodi</label>
                    <input type="text" name="prodi" placeholder="" required/>
                    <label>No HP</label>
                    <input type="text" name="phone" placeholder="" required/>
                    <input type="hidden" name="id_book" value="<?php echo $id_book; ?>">

                    <input type="submit" name="borrow" value="Submit" />
                </form>
      <p>
        By Submit you have been loan the book, and you can take it from library <br />
        <a href="#">Terms and Condition</a> and <a href="#">Policy Privacy</a>
      </p>
    </div>
        </div>
    </div>

    <script>
        // JavaScript to handle modal
        function openModal() {
            document.getElementById('borrowModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('borrowModal').style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('borrowModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>



<?php
include ('config/app.php');
$data_buku = select("SELECT * FROM book ORDER BY id_book ASC");
$query_buku = mysqli_query($db, "SELECT * FROM book");
$row_book = mysqli_num_rows($query_buku);
$total_quantity = getTotalQuantity();

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
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 2px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
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
  border: none;
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
    table th{
  font-size: 15px;
  text-align: center;
}
    .sidebar{
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
      <h2>Book</h2>
      <div class="promo_card_container">     
      <div class="promo_card">
        <h1><?=$row_book?></h1>
        <span>Book Available</span>
        <button type="button" onclick="openModal()">Add More +</button>
      </div>
      <div class="promo_card">
        <h1><?=$total_quantity?></h1>
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
                <th>Deskripsi</th>
                <th>Prodi</th>
                <th>Photo</th>
                <th>Quantity</th>
                <th>Action</th>
                
              </tr>
            </thead>
            <tbody>
            <?php foreach ($data_buku as $index => $book) : $deskripsi =$book['deskripsi'];
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
                <td><img width="80%" src="assets/<?= $book['foto']; ?>"/></td>
                <td><?= $book['quantity']; ?></td>
                <td><a href="header.php">Edit</a></td>
                <td><a href="header.php">Delete</a></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="list2">
          <div class="row">
            <h4></h4>
            <a href="#"></a>
          </div>
          
        </div>
      </div>
    </div>

    <div class="sidebar">
      <h4></h4>
      
      <div class="balance">
        <i class=""></i>
        <div class="info">
          <h5></h5>
          <span></span>
        </div>
      </div>
      
    <!-- Modal Structure -->
      <div id="borrowModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="signup-box">
      <h1>Book Loaning</h1>
      <h4>Feel this form and get your book!</h4>
      <form method="post" action="">
                    <label>Judul</label>
                    <input type="text" name="judul" value="<?= $book['nama']; ?>" readonly />
                    <label>Your Full Name</label>
                    <input type="text" name="fullname" placeholder="" required/>
                    <label>Username</label>
                    <input type="text" name="username" placeholder="" required/>
                    <label>NIM</label>
                    <input type="text" name="nim" placeholder="" required/>
                    <label>Prodi</label>
                    <input type="text" name="prodi" placeholder="" required/>
                    <label>No HP</label>
                    <input type="text" name="phone" placeholder="" required/>
                    <input type="hidden" name="id_book" value="<?php echo $id_book; ?>">

                    <input type="submit" name="borrow" value="Submit" />
                </form>
      <p>
        By Submit you have been loan the book, and you can take it from library <br />
        <a href="#">Terms and Condition</a> and <a href="#">Policy Privacy</a>
      </p>
    </div>
        </div>
    </div>
      

    </div>
  </div>
  <script>
        // JavaScript to handle modal
        function openModal() {
            document.getElementById('borrowModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('borrowModal').style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('borrowModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>