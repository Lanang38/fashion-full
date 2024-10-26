<?php

require_once '../backend/config.php';

$products_per_page = 6;

// Get the current page number from URL parameter, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calculate the offset for SQL query
$offset = ($page - 1) * $products_per_page;

// Get the search keyword from the form
$search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
$tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : '';
$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Base query
$sql_base = "SELECT * FROM products WHERE 1=1";

// Search product berdasarkan apa yang kita cari
if ($search_keyword != '') {
  $sql_base .= " AND name LIKE '%" . $search_keyword . "%'";
}

// Filter product saat category dipilih
if ($category_id != '') {
  $sql_base .= " AND category_id = " . $category_id;
}

// Filter product saat tag dipilih
if ($tag_id != '') {
  $sql_base .= " AND tag_id = " . $tag_id;
}

// Query to count total products
$sql_count = $sql_base;
$total_products_result = $conection_db->query($sql_count);
$total_products = mysqli_num_rows($total_products_result);

// Calculate total pages
$total_pages = ceil($total_products / $products_per_page);

// Add sorting to the base query
switch ($sort_by) {
  case 'name_asc':
    $sql_base .= " ORDER BY name ASC";
    break;
  case 'name_desc':
    $sql_base .= " ORDER BY name DESC";
    break;
  case 'price_high':
    $sql_base .= " ORDER BY price DESC";
    break;
  case 'price_low':
    $sql_base .= " ORDER BY price ASC";
    break;
  default:
    break;
}

// Add limit and offset to the query for pagination
$sql_page = $sql_base . " LIMIT $products_per_page OFFSET $offset";

function formatRupiah($number)
{
  return 'Rp. ' . number_format($number, 0, ',', '.');
}

$sql_tags = "SELECT * FROM tags";
$sql_categories = "SELECT * FROM categories";

$all_product = $conection_db->query($sql_page);
$all_tags = $conection_db->query($sql_tags);
$all_categories = $conection_db->query(($sql_categories));

?>



<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dressclo - Shop</title>

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

  <style>
    .pagination .page-item.active .page-link {
      background-color: #b29459;
      border-color: #b29459;
      color: white !important
    }

    .pagination .page-item .page-link {
      color: black;
    }

    .tag-link.active {
      background-color: #b29459;
    }

    .tag-link.active a {
      color: white !important;
    }

    .category-link {
      display: inline-block;
      position: relative;
      padding-bottom: 2px;
    }

    .category-link.active::after {
      content: '';
      display: block;
      width: 30%;
      margin: 0 auto;
      border-bottom: 2px solid black;
      position: absolute;
      bottom: 0;
    }
  </style>
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
              <li>
                <a href="./index.php">Home</a>
              </li>
              <li class="active"><a href="./shop-grid.php">Shop</a></li>
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
            <div class="hero__search__form">
              <form action="" method="GET">
                <input type="text" name="search" placeholder="What do you need?" value="<?php echo htmlspecialchars($search_keyword); ?>" />
                <button type="submit" class="site-btn">SEARCH</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/BANNE1.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>Dressclo</h2>
            <div class="breadcrumb__option">
              <a href="./index.php">Home</a>
              <span>Shop</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Product Section Begin -->
  <section class="product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-5">
          <div class="sidebar">
            <div class="sidebar__item">
              <h4>Categories</h4>
              <?php
              while ($row = mysqli_fetch_assoc($all_categories)) {
                $isActive = isset($_GET['category_id']) && $_GET['category_id'] == $row["category_id"] ? 'active' : '';
                $new_category_id = $isActive ? '' : $row["category_id"]; // Set category_id to empty string if already active
              ?>
                <ul>
                  <li><a class="category-link <?php echo $isActive; ?>" href="shop-grid.php?category_id=<?php echo $new_category_id; ?><?php echo $tag_id ? '&tag_id=' . $tag_id : ''; ?>">
                      <?php echo $row["name"]; ?>
                    </a></li>
                </ul>
              <?php
              }
              ?>
            </div>


            <div class="sidebar__item">
              <h4>Tags</h4>
              <?php while ($row = mysqli_fetch_assoc($all_tags)) {
                $isActive = isset($_GET['tag_id']) && $_GET['tag_id'] == $row["tag_id"] ? 'active' : '';
                $new_tag_id = $isActive ? '' : $row["tag_id"]; // Set tag_id to empty string if already active
              ?>
                <div class="sidebar__item__size">
                  <label id="tag-<?php echo $row["tag_id"]; ?>" class="tag-link <?php echo $isActive; ?>">
                    <a class="tag-link <?php echo $isActive; ?>" href="shop-grid.php?tag_id=<?php echo $new_tag_id; ?><?php echo $category_id ? '&category_id=' . $category_id : ''; ?>">
                      <?php echo $row["name"]; ?>
                    </a>
                  </label>
                </div>
              <?php
              }
              ?>
            </div>

          </div>
        </div>
        <div class="col-lg-9 col-md-7">
          <div class="filter__item">
            <div class="row">
              <div class="col-lg-4 col-md-5">
                <div class="filter__sort">

                  <form id="sort-form" method="GET" action="shop-grid.php">
                    <span>Sort By</span>
                    <select id="sort-by" name="sort" onchange="this.form.submit()">
                      <option value="default" <?php if ($sort_by == 'default') echo 'selected'; ?>>Default</option>
                      <option value="name_asc" <?php if ($sort_by == 'name_asc') echo 'selected'; ?>>Name A-Z</option>
                      <option value="name_desc" <?php if ($sort_by == 'name_desc') echo 'selected'; ?>>Name Z-A</option>
                      <option value="price_high" <?php if ($sort_by == 'price_high') echo 'selected'; ?>>Pricey</option>
                      <option value="price_low" <?php if ($sort_by == 'price_low') echo 'selected'; ?>>Cheap</option>
                    </select>
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <input type="hidden" name="tag_id" value="<?php echo $tag_id; ?>">
                    <input type="hidden" name="search" value="<?php echo $search_keyword; ?>">
                  </form>

                </div>
              </div>

              <div class="col-lg-4 col-md-4">
                <div class="filter__found">
                  <h6><span><?php echo $total_products; ?></span> Products found</h6>
                </div>
              </div>

            </div>
          </div>
          <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($all_product)) {
            ?>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg">
                    <a href="<?php echo $row['link']; ?> " target="_blank"><img src="../backend/<?php echo $row['image']; ?>" alt="gambar"></a>

                  </div>
                  <div class="product__item__text">
                    <h6><a href="<?php echo $row['link']; ?> " target="_blank"><?php echo $row['name']; ?></a></h6>
                    <h5><?php echo (formatRupiah($row['price'])); ?></h5>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>

          </div>
          <?php if ($total_pages > 1) : ?>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center ">
                <?php if ($page > 1) : ?>
                  <li class="page-item ">
                    <a class="page-link text-dark" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                <?php else : ?>
                  <li class="page-item disabled">
                    <a class="page-link text-dark" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                  <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link text-dark" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <?php if ($page < $total_pages) : ?>
                  <li class="page-item">
                    <a class="page-link text-dark" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                <?php else : ?>
                  <li class="page-item disabled">
                    <a class="page-link text-dark" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </section>
  <!-- Product Section End -->

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
  <!-- //for tags -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tags = document.querySelectorAll('.tag-link');
      tags.forEach(tag => {
        tag.addEventListener('click', function(event) {
          // Hapus kelas active dari semua tag
          tags.forEach(t => t.classList.remove('active'));
          // Tambahkan kelas active ke tag yang diklik
          tag.classList.add('active');
        });
      });
    });
  </script>
  <!-- for categories -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const categories = document.querySelectorAll('.category-link');
      categories.forEach(category => {
        category.addEventListener('click', function(event) {
          event.preventDefault(); // Prevent the default link behavior

          const url = new URL(category.href);
          const params = new URLSearchParams(url.search);
          const category_id = params.get('category_id');

          // Remove active class from all categories
          categories.forEach(c => c.classList.remove('active'));

          // If category_id is not empty, add active class to clicked category
          if (category_id) {
            category.classList.add('active');
          }

          // Reload the page with new query parameters
          window.location.href = url.toString();
        });
      });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Handle tag click
      const tags = document.querySelectorAll('.tag-link a');
      tags.forEach(tag => {
        tag.addEventListener('click', function(event) {
          event.preventDefault();
          const url = new URL(tag.href);
          const params = new URLSearchParams(url.search);

          tags.forEach(t => t.parentNode.classList.remove('active'));
          tag.parentNode.classList.add('active');

          params.set('sort', document.getElementById('sort-by').value);
          window.location.href = `${url.pathname}?${params.toString()}`;
        });
      });

      // Handle category click
      const categories = document.querySelectorAll('.category-link');
      categories.forEach(category => {
        category.addEventListener('click', function(event) {
          event.preventDefault();
          const url = new URL(category.href);
          const params = new URLSearchParams(url.search);

          categories.forEach(c => c.classList.remove('active'));
          category.classList.add('active');

          params.set('sort', document.getElementById('sort-by').value);
          window.location.href = `${url.pathname}?${params.toString()}`;
        });
      });
    });
  </script>

</body>

</html>