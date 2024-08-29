<?php
session_start();
include ('config/app.php');
if (!isset($_SESSION["login"])) {
  echo "<script>
  alert('Login to loan a book');
  document.location.href = 'loginperpus/index.php';
  </script>";
  exit;
}
$data_user = select("SELECT * FROM user ORDER BY id_user ASC");

$id_user = $_SESSION['id_user'];

$data_buku = select("SELECT * FROM book ORDER BY id_book ASC");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Vocational Library</title>
  </head>
  <body>
    <header class="header">
      <nav>
        <div class="nav__logo"><a href="#">Vocational Library</a></div>
        <ul class="nav__links" id="nav-links">
          <li class="link"><a href="#home">Home</a></li>
          <li class="link"><a href="#choose">About</a></li>
          <li class="link"><a href="#craft">Daftar Buku</a></li>
          <li class="link"><a href="#testimonial">Testimonials</a></li>
          <?php if($_SESSION['level']=='admin'):?>
          <li class="link"><a href="dashboard.php">Admin</a></li><?php endif; ?>
          <?php if($_SESSION['level']=='operator'):?>
          <li class="link"><a href="dashboard.php">Operator</a></li><?php endif; ?>
          <?php if($_SESSION['level']=='student'):?>
          <li class="link"><a href="loginperpus/logout.php" onclick="return confirm('Are you sure to logout?')">Logout</a></li><?php endif; ?>
        </ul>
        <div class="nav__menu__btn" id="menu-btn">
          <span><i class="ri-menu-line"></i></span>
        </div>
        <div class="nav__actions">
          <span><i class="ri-search-fill"></i></span>
          <?php if($_SESSION['level']=='operator'):?>
          <a href="dashboard.php"><span><i class="ri-user-fill"></i></span></a><?php endif; ?>
          <?php if($_SESSION['level']=='admin'):?>
          <a href="dashboard.php"><span><i class="ri-user-fill"></i></span></a><?php endif; ?>
          <?php if($_SESSION['level']=='student'):?>
          <a href="#"><span><i class="ri-user-fill"></i></span></a><?php endif; ?>
        </div>
      </nav>
      <div class="section__container header__container" id="home">
        <h1>Unlock a World of Knowledge</h1>
        <p>
            Whether you're a student, a researcher, or a curious mind, our vast collection of books, digital resources, and expert staff are here to support your journey.
        </p>
        <form id="search-form">
          <input type="text" id="search-input" placeholder="Search Books" />
          <button type="submit"><i class="ri-search-line"></i></button>
        </form>
        <a href="#craft"><i class="ri-arrow-down-double-line"></i></a>
      </div>
    </header>

    <section class="section__container choose__container" id="choose">
      <img class="choose__bg" src="assets/dot-bg.png" alt="bg" />
      <div class="choose__content">
        <h2 class="section__header">Why Choose Us</h2>
        <p class="section__subheader">
            Choose us and experience a library that is committed to unlocking your potential and fueling your passion for knowledge.
        </p>
        <div class="choose__grid">
          <div class="choose__card">
            <span><i class="ri-truck-line"></i></span>
            <h4>Fast & Free Shipping</h4>
            <p>
              Get your favorite books with our Fast & Free Shipping service
              without delay
            </p>
          </div>
          <div class="choose__card">
            <span><i class="ri-shopping-bag-3-line"></i></span>
            <h4>Extensive Collection</h4>
            <p>
                Our library boasts a diverse and expansive collection of books, journals, digital resources, and multimedia materials, catering to all ages and interests.
            </p>
          </div>
          <div class="choose__card">
            <span><i class="ri-customer-service-2-line"></i></span>
            <h4>24/7 Support</h4>
            <p>
              Experience peace of mind knowing that our dedicated team is
              available round the clock
            </p>
          </div>
          <div class="choose__card">
            <span><i class="ri-loop-right-line"></i></span>
            <h4>Digital Access</h4>
            <p>
                Our online resources and digital library are available 24/7, providing you with access to e-books, audiobooks, journals, and databases from the comfort of your home. Stay connected to learning anytime, anywhere.
            </p>
          </div>
        </div>
      </div>
      <div class="choose__image">
        <img src="assets/choose1.jpg" alt="choose" />
      </div>
    </section>

    <section class="offer__container" id="offer">
      <div class="offer__grid__top">
        <img src="assets/offer1.jpg" alt="offer" />
        <img src="assets/offer2.jpg" alt="offer" />
        <img src="assets/offer3.jpg" alt="offer" />
        <div class="offer__content">
          <h2 class="section__header">Be Smart</h2>
          <p class="section__subheader">
            Unlock a world of knowledge today!
        </p>
          <button class="btn"></button>
        </div>
      </div>

    </section>

    <section class="section__container craft__container" id="craft">
  <div class="craft__content">
    <h2 class="section__header">Choose your favorite books</h2>
    <p class="section__subheader">Get it Now!</p>
    <button class="btn">Explore</button>
  </div>
  <?php foreach ($data_buku as $index => $book) : ?>
  <div class="craft__image" id="book-<?=$index;?>">
    <div class="craft__image__content">
      <img src="assets/<?=$book['foto'];?>" alt="Photo" />
      <h4><?= $book['nama']; ?></h4>
      <p><?= $book['penulis']; ?></p>
    </div>
    <a href="detailbuku.php?id_book=<?=$book['id_book'];?>"><i class="ri-add-line"></i></a>
  </div>
  <?php endforeach; ?>
</section>


    <section class="section__container modern__container" id="modern">
      <div class="modern__image">
        <img src="assets/dot-bg.png" alt="bg" class="modern__bg" />
        <img src="assets/manfaat1.jpg" alt="modern" class="modern__img-1" />
        <img src="assets/manfaat2.jpeg" alt="modern" class="modern__img-2" />
        <img src="assets/manfaat5.jpg" alt="modern" class="modern__img-3" />
      </div>
      <div class="modern__content">
        <h2 class="section__header">
            We help you explore a world of knowledge and imagination        </h2>
        <p class="section__subheader">
            Discover New Horizons with Our Extensive Collection:
            Let us guide you in exploring a vast array of books and resources that ignite your passion for learning and discovery.
        </p>
        <div class="modern__grid">
          <div class="modern__card">
            <span><i class="ri-checkbox-blank-circle-line"></i></span>
            <p>
                Our team specializes in curating personalized reading experiences that embrace a love for knowledge.
            </p>
          </div>
          <div class="modern__card">
            <span><i class="ri-checkbox-blank-circle-line"></i></span>
            <p>
                We stay at the forefront of literary trends, ensuring our collection is diverse and up-to-date.
            </p>
          </div>
          <div class="modern__card">
            <span><i class="ri-checkbox-blank-circle-line"></i></span>
            <p>
                A great library isn't just about books; it's about accessibility and comfort too.
            </p>
          </div>
          <div class="modern__card">
            <span><i class="ri-checkbox-blank-circle-line"></i></span>
            <p>
                We take care of all aspects of your reading journey, from discovery to borrowing and beyond.
            </p>
          </div>
        </div>
        <button class="btn">Explore</button>
      </div>
    </section>

    <section class="section__container testimonial__container" id="testimonial">
      <h2 class="section__header">Testimonials</h2>
      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="testimonial__card">
              <p>
                Ever since I joined this library, my reading habits have soared. The collection is extensive, covering diverse topics, and the borrowing process is seamless. It's truly a haven for book lovers like me.
              </p>
              <img src="assets/candra1.jpg" alt="testimonial" />
              <h4>Candra</h4>
              <h5>Entrepreneur</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="testimonial__card">
              <p>
                The convenience of being able to reserve books online and pick them up at my convenience has made reading a joy again. Thank you to the library team for making it so effortless.
              </p>
              <img src="assets/profile-pic-2.jpg" alt="testimonial" />
              <h4>Najwa</h4>
              <h5>College Student</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="testimonial__card">
              <p>
                As a student, having access to such a vast array of resources has been invaluable to my studies. The library's commitment to providing up-to-date materials has greatly enhanced my learning experience.
              </p>
              <img src="assets/profile-pic-3.jpg" alt="testimonial" />
              <h4>Samsul</h4>
              <h5>Employee</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="testimonial__card">
              <p>
                Using the online library book borrowing service has been a game-changer for me. It's incredibly convenient to browse and borrow books from the comfort of my own home. The process is seamless, and I love how quickly I can access a wide range of titles. Plus, the ability to renew or return books online makes managing my reading list a breeze. Highly recommended for anyone who loves to read but needs a flexible and efficient way to access books!
              </p>
              <img src="assets/profile-pic-4.jpg" alt="testimonial" />
              <h4>Nurdin</h4>
              <h5>Gamer</h5>
            </div>
          </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__content">
          <h4>FOLLOW TO GET THE LATEST NEWS ABOUT US</h4>
          <p>
            Explore, Discover, Learn - Your Gateway to a World of Knowledge 
          </p>
        </div>
        <div class="footer__form">
          <form action="/">
            <input type="text" placeholder="Enter your email" />
            <button>Follow</button>
          </form>
        </div>
      </div>
      <div class="section__container footer__bar">
        <div class="footer__logo">
          <h4><a href="#">Vocational Library</a></h4>
          <p>Copyright © 2023 Vocational Faculty of Brawijaya University. All rights reserved.</p>
        </div>
        <ul class="footer__nav">
          <li class="footer__link"><a href="#">About</a></li>
          <li class="footer__link"><a href="#">Partnership</a></li>
          <li class="footer__link"><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>
<script>
document.getElementById('search-form').addEventListener('submit', function(event) {
  event.preventDefault();
  let input = document.getElementById('search-input').value.toLowerCase();
  let books = document.querySelectorAll('.craft__image');

  let found = false;

  books.forEach((book, index) => {
    let title = book.querySelector('h4').textContent.toLowerCase();
    let author = book.querySelector('p').textContent.toLowerCase();

    if (title.includes(input) || author.includes(input)) {
      book.scrollIntoView({ behavior: 'smooth' });
      book.style.border = '2px solid blue';  // Optional: Highlight the found book
      setTimeout(() => { book.style.border = 'none'; }, 2000);  // Remove highlight after 2 seconds
      found = true;
    }
  });

  if (!found) {
    alert('Book not found');
  }
});
</script>