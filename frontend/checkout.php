<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>

    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap"
      rel="stylesheet"
    />

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
      <div class="humberger__menu__cart">
        <ul>
          <li>
            <a href="#"><i class="fa fa-heart"></i> <span>1</span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a>
          </li>
        </ul>
        <div class="header__cart__price">item: <span>Rp.150,000</span></div>
      </div>
      <div class="humberger__menu__widget">
        <div class="header__top__right__language">
          <img src="img/language.png" alt="" />
          <div>English</div>
          <span class="arrow_carrot-down"></span>
          <ul>
            <li><a href="#">Indonesia</a></li>
            <li><a href="#">English</a></li>
          </ul>
        </div>
        <div class="header__top__right__language header__top__right__auth">
          <a class="d-inline" href="#">
          <i class="fa fa-user"></i> Login</a>
          <span class="arrow_carrot-down"></span>
        <ul>
          <li><a href="#">Login</a></li>
          <li><a href="#">Register</a></li>
        </ul>
      </div>
      </div>
      <nav class="humberger__menu__nav mobile-menu">
        <ul>
          <li class="active"><a href="./index.php">Home</a></li>
          <li><a href="./shop-grid.php">Shop</a></li>
          <li>
            <a href="#">Shortcut</a>
            <ul class="header__menu__dropdown">
              <li><a href="./shop-details.php">Shop Details</a></li>
              <li><a href="./shoping-cart.php">Shoping Cart</a></li>
              <li><a href="./checkout.php">Check Out</a></li>
            </ul>
          </li>
          <li><a href="./contact.php">Contact</a></li>
        </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
      </div>
      <div class="humberger__menu__contact">
        <ul>
          <li><i class="fa fa-envelope"></i> dressclo@gmail.com</li>
          <li><i class="fa fa-phone"> +62 819 999 999</i></li>
          <li>Free Shipping for all Order of 1jt+</li>
        </ul>
      </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="header__top__left">
                <ul>
                  <li><i class="fa fa-envelope"></i> dressclo@gmail.com</li>
                  <li>Free Shipping for all Order of 1jt+ </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="header__top__right">
                <div class="header__top__right__social">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                  <a href="#"><i class="fa fa-pinterest-p"></i></a>
                </div>
                <div class="header__top__right__language">
                  <img src="img/language.png" alt="" />
                  <div>English</div>
                  <span class="arrow_carrot-down"></span>
                  <ul>
                    <li><a href="#">Indonesia</a></li>
                    <li><a href="#">English</a></li>
                  </ul>
                </div>
                <div
                  class="header__top__right__language header__top__right__auth"
                >
                  <a class="d-inline" href="#"
                    ><i class="fa fa-user"></i> Login</a
                  >
                  <span class="arrow_carrot-down"></span>
                  <ul>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                  </ul>
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
                <li><a href="./index.php">Home</a></li>
                <li class="active"><a href="./shop-grid.php">Shop</a></li>
                <li>
                  <a href="#">shortcut</a>
                  <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.php">Shop Details</a></li>
                    <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                    <li><a href="./checkout.php">Check Out</a></li>
                  </ul>
                </li>
                <li><a href="./contact.php">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-lg-3">
            <div class="header__cart header__menu">
              <ul>
                <li>
                  <a href="#"><i class="fa fa-heart"></i> <span>1</span></a>
                </li>
                <li>
                  <a href="#"
                    ><i class="fa fa-shopping-bag"></i> <span>3</span></a
                  >
                </li>
              </ul>
              <div class="header__cart__price">item: <span>Rp.150,000</span></div>
            </div>
          </div>
        </div>
        <div class="humberger__open">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/BANNE1.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>Checkout</h2>
              <div class="breadcrumb__option">
                <a href="./index.php">Home</a>
                <span>Checkout</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
      <div class="container">
        <div class="checkout__form">
          <h4>Billing Details</h4>
          <form action="#">
            <div class="row">
              <div class="col-lg-8 col-md-6">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <p>First Name<span>*</span></p>
                      <input type="text" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <p>Last Name<span>*</span></p>
                      <input type="text" />
                    </div>
                  </div>
                </div>
                <div class="checkout__input">
                  <p>Country<span>*</span></p>
                  <input type="text" />
                </div>
                <div class="checkout__input">
                  <p>Address<span>*</span></p>
                  <input
                    type="text"
                    placeholder="Street Address"
                    class="checkout__input__add"
                  />
                  <input
                    type="text"
                    placeholder="Apartment, suite, unite ect (optinal)"
                  />
                </div>
                <div class="checkout__input">
                  <p>Town/City<span>*</span></p>
                  <input type="text" />
                </div>
                <div class="checkout__input">
                  <p>Country/State<span>*</span></p>
                  <input type="text" />
                </div>
                <div class="checkout__input">
                  <p>Postcode / ZIP<span>*</span></p>
                  <input type="text" />
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <p>Phone<span>*</span></p>
                      <input type="text" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <p>Email<span>*</span></p>
                      <input type="text" />
                    </div>
                  </div>
                </div>
                <div class="checkout__input">
                  <p>Order notes<span>*</span></p>
                  <input
                    type="text"
                    placeholder="Notes about your order, e.g. special notes for delivery."
                  />
                </div>
              </div>
              <div class="col-lg-4 col-md-6 ">
                <div class="checkout__order">
                  <h4>Your Order</h4>
                  <div class="checkout__order__products">
                    Products & Total
                  </div>
                  <ul>
                    <li>Black Skinny Jeans</li>
                    <span>Rp.300,000</span>
                    <li>Screamous Jacket Quilted Liner</li>
                    <span>Rp.890,000</span>
                    <li>Jordan 11</li>
                    <span>Rp.1,850,000</span>
                  </ul>
                  <div class="checkout__order__subtotal">
                    Subtotal <span>Rp.3,040,000</span>
                  </div>
                  <div class="checkout__order__total">
                    Total <span>Rp.3,040,000</span>
                  </div>
                  <button type="submit" class="site-btn">PLACE ORDER</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- Checkout Section End -->

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
                <li>Email: dressclo@gmail.com</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
            <div class="footer__widget">
              <h6>Useful Links</h6>
              <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">About Our Shop</a></li>
                <li><a href="#">Secure Shopping</a></li>
                <li><a href="#">Delivery infomation</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Our Sitemap</a></li>
              </ul>
              <ul>
                <li><a href="#">Who We Are</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Innovation</a></li>
                <li><a href="#">Testimonials</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="footer__widget">
              <h6>Join Our Newsletter Now</h6>
              <p>
                Get E-mail updates about our latest shop and special offers.
              </p>
              <form action="#">
                <input type="text" placeholder="Enter your mail" />
                <button type="submit" class="site-btn">Subscribe</button>
              </form>
              <div class="footer__widget__social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="footer__copyright">
              <div class="footer__copyright__text"></div>
              <div class="footer__copyright__payment">
                <img src="img/payment-item-indo-1.png" alt="" />
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
