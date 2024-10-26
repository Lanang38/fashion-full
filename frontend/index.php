<?php

require_once '../backend/config.php';
require_once 'function.php';

function formatRupiah($number)
{
  return 'Rp. ' . number_format($number, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dressclo</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet" />

  <!-- icon -->
  <link rel="icon" href="img/Dressclo.ico" type="image/x-icon">

  <!-- Css Styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
      <a href="#"><img src="img/Logo2.png" alt="" /></a>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
      <ul>
        <li class="active"><a href="./index.php">Home</a></li>
        <li><a href="./shop-grid.php">Shop</a></li>

        <li><a href="./contact.php">Contact</a></li>
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
      <a href="https://www.facebook.com/profile.php?id=61561485665155&mibextid=rS40aB7S9Ucbxw6v" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>
      <a href="https://www.instagram.com/dress.clo_?igsh=MXFnbnQ3cm93bnRpeg==" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>
      <a href="https://x.com/RivalAlrasyid?t=w2Ax-N7jTn1fviWIPkmCyw&s=09 " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram"></i></a>
    </div>
    <div class="humberger__menu__contact">
      <ul>
        <li><i class="fa fa-envelope"></i> dressclo6@gmail.com</li>
        <li><i class="fa fa-phone"> +62 819 999 999</i></li>
      </ul>
    </div>
  </div>
  <!-- Humberger End -->

  <!-- Header Section Begin -->
  <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="header__top__left">
              <ul>
                <li>
                  <i class="fa fa-envelope"></i>
                  <a href="mailto:dressclo@gmail.com" target="_blank" rel="noopener noreferrer">dressclo@gmail.com</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="header__top__right">
              <div class="header__top__right__social">
                <a href="https://www.facebook.com/profile.php?id=61561485665155&mibextid=rS40aB7S9Ucbxw6v" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/dress.clo_?igsh=MXFnbnQ3cm93bnRpeg==" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>
                <a href="https://x.com/RivalAlrasyid?t=w2Ax-N7jTn1fviWIPkmCyw&s=09 " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="header__logo">
            <a href="./index.php"><img src="img/Logo2.png" alt="" /></a>
          </div>
        </div>
        <div class="col-lg-5">
          <nav class="header__menu">
            <ul>
              <li class="active">
                <a href="./index.php">Home</a>
              </li>
              <li><a href="./shop-grid.php">Shop</a></li>
              <li><a href="./contact.php">Contact</a></li>
            </ul>
          </nav>
        </div>
        <div class="hero__search__phone header__menu">
          <div class="hero__search__phone__icon">
            <a href="#">
              <i class="fa fa-phone" style="color: white;"></i>
            </a>
          </div>
          <div class="hero__search__phone__text">
            <h5>+62 819 999 999</h5>
            <span>support 24/7 time</span>
          </div>
        </div>
      </div>
      <div class="humberger__open">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <!-- Header Section End -->

  <!-- Hero Section Begin -->
  <section class="hero">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="hero__search">

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Breadcrumb Section Begin -->
  <section class="mb-5">
    <div class="container">
      <div class="hero__item set-bg" data-setbg="img/hero/BANN.jpg">
        <div class="hero__text">
          <span>FASHION</span>
          <h2>Elevate Your Style, <br />Define Your Story.</h2>
          <p>Free Pickup and Delivery Available</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Categories Section Begin -->
  <section class="categories mt-5">
    <div class="container">
      <div class="row">
        <div class="categories__slider owl-carousel">
          <?php
          while ($row = mysqli_fetch_assoc($all_categories)) {
          ?>
            <div class="col-lg-3">
              <div class="categories__item set-bg" data-setbg="../backend/<?php echo $row['image']; ?>">
                <h5><a href=" shop-grid.php?category_id=<?php echo $row['category_id']; ?> "><?php echo $row['name']; ?></a></h5>
              </div>
            </div>

          <?php

          }
          ?>

        </div>
      </div>
    </div>
  </section>
  <!-- Categories Section End -->

  <!-- Featured Section Begin -->
  <section class="featured spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Featured Product</h2>
          </div>
        </div>
      </div>
      <div class="row featured__filter">
        <?php
        while ($row = mysqli_fetch_assoc($product_limit)) {
        ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="featured__item">
              <div class="featured__item__pic set-bg">
                <a href="<?php echo $row['link']; ?> " target="_blank"><img src="../backend/<?php echo $row['image']; ?>" alt="gambar"></a>

              </div>
              <div class="featured__item__text">
                <h6>
                  <a href="<?php echo $row['link']; ?>" target="_blank">
                    <?php echo $row['name']; ?>
                  </a>
                </h6>
                <h5><?php echo (formatRupiah($row['price'])); ?></h5>
              </div>
            </div>
          </div>

        <?php

        }
        ?>
      </div>
  </section>
  <!-- Featured Section End -->

  <!-- Banner Begin -->
  <div class="banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="banner__pic">
            <img src="img/banner/BAN1.jpg" alt="" />
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="banner__pic">
            <img src="img/banner/BAN3.jpg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner End -->

  <!-- Footer Section Begin -->
  <footer class="footer spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="footer__about">
            <div class="footer__about__logo">
              <a href="./index.php"><img src="img/Logo2.png" alt="" /></a>
            </div>
            <ul>
              <li>Phone: +62 819 999 999</li>
              <li>Email: dressclo6@gmail.com</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 offset-lg-6">
          <div class="footer__widget">
            <div class="footer__widget">
              <div class="footer__widget__social">
                <h6>Find Us</h6>
                <ul>
                  <li><a href="https://www.facebook.com/profile.php?id=61561485665155&mibextid=rS40aB7S9Ucbxw6v" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>Dressclo</li>
                  <li><a href="https://www.instagram.com/dress.clo_?igsh=MXFnbnQ3cm93bnRpeg==" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram"></i></a>@Dressclo</li>
                  <li><a href="https://x.com/RivalAlrasyid?t=w2Ax-N7jTn1fviWIPkmCyw&s=09 " target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>Dressclo.id</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
  </footer>
  <!-- Footer Section End -->

  <!-- Js Plugins -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/jquery.slicknav.js"></script>
  <script src="js/mixitup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>