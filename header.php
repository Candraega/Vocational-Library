
<header class="header">
    <div class="logo">
      <a href="#">Vocational library</a>
      <div class="search_box">
        <input type="text" placeholder="Search">
        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
      </div>
    </div>
    <div class="header-icons">
      <i class="fas fa-bell"></i>
      <div class="account">
        <img src="assets/header2.jpg" alt="">
        <h4><?= $_SESSION['username']; ?></h4>
      </div>
    </div>
  </header>