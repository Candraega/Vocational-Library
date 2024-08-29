<?php
session_start();
include '../config/app.php';

// cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    //ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    //check

    $result = mysqli_query($db,"SELECT * FROM user WHERE username='$username'");

    // jika ada usernya
    if (mysqli_num_rows($result)==1) {
        //cek password
        $hasil = mysqli_fetch_assoc($result);
        if ($password == $hasil['password']) {
            // set session
            $_SESSION['login']=true;
            $_SESSION['id_user'] = $hasil['id_user'];
            $_SESSION['fullname'] = $hasil['fullname'];
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['level'] = $hasil['level'];

            //jika login benar arahkan ke file index.php
            header("location: ../index.php");
            exit;

        }
    }
    //jika tidak ada usernya
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
  <title>Sign in</title>
  <style>
    .alert {
      padding: 1rem;
      border-radius: 5px;
      color: white;
      margin: 1rem 0;
      font-weight: 500;
      width: 65%;
    }

    .alert-success {
      background-color: #42ba96;
    }

    .alert-danger {
      background-color: #fc5555;
    }

    .alert-info {
      background-color: #2E9AFE;
    }

    .alert-warning {
      background-color: #ff9966;
    }
    .Forget-Pass{
      display: flex;
      width: 65%;
    }
    .Forget{
      color: #2E9AFE;
      font-weight: 500;
      text-decoration: none;
      margin-left: auto;
      
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form name="" action="" method="POST" enctype="multipart/form-data"  class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <?php if(isset($error)):?>
        <div class="alert alert-danger text-center">
        <b>WRONG Username/Password!</b>
        </div> <?php endif;?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" id="username" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" id="password"/>
          </div>
          <div class="Forget-Pass">
          <a href="Forget.php" class="Forget">Forget Password ?</a></div>
          <button type="submit"name="login" class="btn solid">Login</button>
          <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
           Register Now!
          </p>
          <a href="#" class="btn transparent" onclick="return confirm('Cannot Sign Up For Now!')" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">
            Sign up
          </a>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>
  <script>
       
    </script>
    <!-- Pesan Pendaftaran -->
    <script>
        <?php
        
        ?>
    </script>
    <script>
        <?php
        
        ?>
    </script>
    <!-- -->
    <script>
        <?php
        
        ?>
    </script>
    <!-- Toastr -->
    <script src="assets/dist/js/toastr.min.js"></script>
    <!-- -->
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <!-- -->
    <script>
        function validateForm() {
            if (document.forms["formLogin"]["username"].value == "") {
                toastr.error("Nama Pengguna harus diisi !!");
                document.forms["formLogin"]["username"].focus();
                return false;
            }
            if (document.forms["formLogin"]["password"].value == "") {
                toastr.error("Kata Sandi harus diisi !!");
                document.forms["formLogin"]["password"].focus();
                return false;
            }
        }
    </script>
</body>

</html>