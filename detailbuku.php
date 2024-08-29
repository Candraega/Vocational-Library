<?php
session_start();
include 'config/app.php';
if (!isset($_SESSION["login"])) {
  echo "<script>
  alert('login dulu dong');
  document.location.href = 'loginperpus/index.php';
  </script>";
  exit;
}
// Include the necessary configuration or function files
$title = 'Book Detail';


// Retrieve the book ID from the URL parameter
$id_book = (int)$_GET['id_book'];

// Fetch the book details from the database
$book = select("SELECT * FROM book WHERE id_book = $id_book")[0]; // Assuming select returns an array

// Fetch the available quantity of the book from the database
$quantity = $book['quantity']; // Assuming 'quantity' is the column name for available quantity
$successMessage = '';
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
    $query = "INSERT INTO loaning (judul, fullname, username, nim, prodi, phone, id_book) 
              VALUES ('$judul', '$fullname', '$username', '$nim', '$prodi', '$phone', '$id_book')";

    if (insert($query)) {
        // Update book quantity
        $book = select("SELECT quantity FROM book WHERE id_book = $id_book")[0];
        $updatedQuantity = $book['quantity'] - 1;
        update("UPDATE book SET quantity = $updatedQuantity WHERE id_book = $id_book");

        // Redirect to home or confirmation page
        echo "<script>
        alert('Loaning a book success.');
        </script>";
        header("Location: detailbuku.php?id_book=$id_book");
        exit;
    } else {
        // Display an error message if the book is out of stock
        $errorMessage = "Sorry, this book is out of stock.";
    }
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $successMessage = "Book borrowed successfully!";
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
.success-message {
        color: green;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
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
                <?php if (!empty($successMessage)) : ?>
                    <div class="success-message"><?= $successMessage ?></div>
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
