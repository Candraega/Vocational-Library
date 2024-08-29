<?php
//fungsi menampilkan database
function select($query)
{
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function update($query) {
    global $db;

    $result = mysqli_query($db, $query);

    if (!$result) {
        die('Error updating record: ' . mysqli_error($db));
    }
}

function getTotalQuantity() {
    // Koneksi ke database
global $db;
    // Query untuk mengambil jumlah total quantity
    $query = "SELECT SUM(quantity) AS total_quantity FROM book";

    // Eksekusi query
    $result = mysqli_query($db, $query);

    // Cek hasil query
    if (!$result) {
        echo "Error: " . $db . "<br>" . mysqli_error($db);
        exit();
    }

    // Ambil jumlah total quantity dari hasil query
    $row = mysqli_fetch_assoc($result);
    $total_quantity = $row['total_quantity'];

    // Tutup koneksi ke database

    return $total_quantity;
}
function upload_file()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // Define allowed file formats
    $allowedFormats = ['jpg', 'jpeg', 'png'];

    // Get the file extension and convert it to lowercase
    $extensifile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    // Check if the file format is valid
    if (!in_array($extensifile, $allowedFormats)) {
        // Invalid file format
        echo "<script>
            alert('File format is not valid. Allowed formats: JPG, JPEG, PNG');
            window.location.href = 'book.php';
            </script>";
        exit(); // Exit the script
    }

    // Check the file size
    if ($ukuranFile >= 2048000) {
        // File size exceeds the limit
        echo "<script>
            alert('File size exceeds the limit (2 MB)');
            window.location.href = 'book.php';
            </script>";
        exit(); // Exit the script
    }

    // Generate a unique file name
    $namaFileBaru = uniqid() . '.' . $extensifile;

    // Move the file to the upload directory
    if (!move_uploaded_file($tmpName, 'assets/' . $namaFileBaru)) {
        // Failed to move the file
        echo "<script>
            alert('Failed to upload the file. Please try again later.');
            window.location.href = 'book.php';
            </script>";
        exit(); // Exit the script
    }

    // Return the generated file name
    return $namaFileBaru;
}
function addBook($post) {
    global $db;

    $nama = strip_tags($post['nama']);
    $author = strip_tags ($post['author']);
    $type = strip_tags($post['type']);
    $publisher = strip_tags ($post['publisher']);
    $description =strip_tags ($post['description']);
    $prodi = strip_tags($post['prodi']);
    $photo = upload_file();
    $quantity = strip_tags ($post['quantity']);

    $query = "INSERT INTO book VALUES (null, '$nama', '$author', '$type', '$publisher', '$description', '$prodi', '$photo','$quantity')";
     
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function insert($query) {
    global $db;
    if (!$db) {
        die('Database connection not established.');
    }

    $result = mysqli_query($db, $query);
    if (!$result) {
        die('Error: ' . mysqli_error($db));
    }
    return mysqli_affected_rows($db);
}

function delete_book($id_book)
{
  global $db;

  // query hapus data barang 
  $query = "DELETE FROM book WHERE id_book = $id_book";

  mysqli_query($db, $query );

    return mysqli_affected_rows($db);
}

function addUser($post) {
    global $db;

    $fullname = strip_tags($post['fullname']);
    $username = strip_tags ($post['username']);
    $password = strip_tags($post['password']);
    $nim = strip_tags ($post['nim']);
    $prodi =strip_tags ($post['prodi']);
    $level = strip_tags($post['level']);

    $query = "INSERT INTO user VALUES (null, '$fullname', '$username', '$password', '$nim', '$prodi', '$level')";
     
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_user($id_user)
{
  global $db;

  // query hapus data barang 
  $query = "DELETE FROM user WHERE id_user = $id_user";

  mysqli_query($db, $query );

    return mysqli_affected_rows($db);
}
function returnBook($id_book, $id_loaning) {
    global $db;

    // Tambahkan 1 ke kuantitas buku
    $update_query = "UPDATE book SET quantity = quantity + 1 WHERE id_book = $id_book";
    if (mysqli_query($db, $update_query)) {
        // Hapus data peminjaman dari tabel loaning
        $delete_query = "DELETE FROM loaning WHERE id_loaning = $id_loaning";
        if (mysqli_query($db, $delete_query)) {
            return true;
        } else {
            // Logging error jika query delete gagal
            error_log("Failed to delete loaning data for ID $id_loaning: " . mysqli_error($db));
            return false;
        }
    } else {
        // Logging error jika query update gagal
        error_log("Failed to update quantity for book with ID $id_book: " . mysqli_error($db));
        return false;
    }
}

function delete_loan($id_loaning)
{
  global $db;

  // query hapus data barang 
  $query = "DELETE FROM loaning WHERE id_loaning = $id_loaning";

  mysqli_query($db, $query );

    return mysqli_affected_rows($db);
}