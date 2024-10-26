<?php
// Include config file
require_once "config.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Fetch data
$total_categories = $total_tags = $total_products = 0;

// Function to fetch count from a given table
function getCount($conection_db, $table)
{
    $sql = "SELECT COUNT(*) as total FROM " . $table;
    $result = mysqli_query($conection_db, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0; // or handle error
    }
}

// Define how many results you want per page
$results_per_page = 4;

// Pagination for categories
$sql = "SELECT * FROM categories";
$result = $conection_db->query($sql);
$number_of_category_results = $result->num_rows;
$number_of_category_pages = ceil($number_of_category_results / $results_per_page);
if (!isset($_GET['category_page'])) {
    $category_page = 1;
} else {
    $category_page = $_GET['category_page'];
}
$this_category_first_result = ($category_page - 1) * $results_per_page;
$sql = "SELECT * FROM categories LIMIT " . $this_category_first_result . ',' . $results_per_page;
$result = $conection_db->query($sql);
$categories = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Pagination for tags
$sql = "SELECT * FROM tags";
$result = $conection_db->query($sql);
$number_of_tag_results = $result->num_rows;
$number_of_tag_pages = ceil($number_of_tag_results / $results_per_page);
if (!isset($_GET['tag_page'])) {
    $tag_page = 1;
} else {
    $tag_page = $_GET['tag_page'];
}
$this_tag_first_result = ($tag_page - 1) * $results_per_page;
$sql = "SELECT * FROM tags LIMIT " . $this_tag_first_result . ',' . $results_per_page;
$result = $conection_db->query($sql);
$tags = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Pagination for products
$sql = "SELECT * FROM products";
$result = $conection_db->query($sql);
$number_of_product_results = $result->num_rows;
$number_of_product_pages = ceil($number_of_product_results / $results_per_page);
if (!isset($_GET['product_page'])) {
    $product_page = 1;
} else {
    $product_page = $_GET['product_page'];
}
$this_product_first_result = ($product_page - 1) * $results_per_page;
$sql = "SELECT * FROM products LIMIT " . $this_product_first_result . ',' . $results_per_page;
$result = $conection_db->query($sql);
$products = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

function formatRupiah($number)
{
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

$total_categories = getCount($conection_db, 'categories');
$total_tags = getCount($conection_db, 'tags');
$total_products = getCount($conection_db, 'products');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dressclo</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Free Datta Able Admin Template come up with latest Bootstrap 4 framework with basic components, form elements and lots of pre-made layout options" />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template" />
    <meta name="author" content="CodedThemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/Dressclo.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .custom-card {
            background-color: #3f4d67;
            /* Ganti dengan warna yang sesuai dengan navbar Anda */
            color: white;
        }

        .custom-card h3,
        .custom-card p {
            color: white;
        }

        table.table-bordered tbody td.view-column {
            max-width: 200px;
            /* Set your desired max-width */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .pagination .page-item.active .page-link {
            background-color: #3f4d67;
            border-color: #3f4d67;
            color: white !important
        }

        .pagination .page-item .page-link {
            color: black;
        }
    </style>

</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="home.php" class="b-brand">
                    <div>
                        <img class="rounded-circle" style="width:40px;" src="assets/images/Dressclo.ico" alt="activity-user">
                    </div>
                    <span class="b-title">Dressclo</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item active">
                        <a href="home.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Management Product</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="category.php">Category</a></li>
                            <li><a href="tag.php">Tag</a></li>
                            <li><a href="product.php">Product</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:void(0);" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Account</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="reset_password.php">Change Password</a></li>
                            <li><a href="logout.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
            <a href="home.php" class="b-brand">
                <div>
                    <img class="rounded-circle" style="width:40px;" src="assets/images/Dressclo.ico" alt="activity-user">
                </div>
                <span class="b-title">Admin</span>
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->
    <!-- Main Container -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- Breadcrumb -->
                    <!-- Add your breadcrumb here if needed -->

                    <!-- Main Content -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <h3 class="text-center">Total Categories</h3>
                                    <p class="text-center display-4"><?php echo $total_categories; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <h3 class="text-center">Total Tags</h3>
                                    <p class="text-center display-4"><?php echo $total_tags; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <h3 class="text-center">Total Products</h3>
                                    <p class="text-center display-4"><?php echo $total_products; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories table with pagination -->
                    <div class="col-md-13">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">Categories</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Slug</th>
                                                <th class="text-center">Category Count</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($categories as $index => $category) : ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $index + 1 + ($category_page - 1) * $results_per_page; ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($category['name']); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($category['slug']); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($category['category_count']); ?></td>
                                                    <td class="text-center"><img src="<?php echo htmlspecialchars($category['image']); ?>" alt="Category Image" style="width:40px;"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- Pagination for categories -->
                                    <?php if ($number_of_category_pages > 1) : ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if ($category_page > 1) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link text-dark" href="home.php?category_page=<?php echo $category_page - 1; ?>" aria-label="Previous">
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
                                                <?php for ($i = 1; $i <= $number_of_category_pages; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $category_page) echo 'active'; ?>"><a class="page-link text-dark" href="home.php?category_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                <?php endfor; ?>
                                                <?php if ($category_page < $number_of_category_pages) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link text-dark" href="home.php?category_page=<?php echo $category_page + 1; ?>" aria-label="Next">
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
                    </div>
                    <!-- Tags table with pagination -->
                    <div class="col-md-13">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">Tags</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Slug</th>
                                                <th class="text-center">Tag Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tags as $index => $tag) : ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $index + 1 + ($tag_page - 1) * $results_per_page; ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($tag['name']); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($tag['slug']); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($tag['tag_count']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- Pagination for tags -->
                                    <?php if ($number_of_tag_pages > 1) : ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if ($tag_page > 1) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link text-dark" href="home.php?tag_page=<?php echo $tag_page - 1; ?>" aria-label="Previous">
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
                                                <?php for ($i = 1; $i <= $number_of_tag_pages; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $tag_page) echo 'active'; ?>"><a class="page-link text-dark" href="home.php?tag_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                <?php endfor; ?>
                                                <?php if ($tag_page < $number_of_tag_pages) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link text-dark" href="home.php?tag_page=<?php echo $tag_page + 1; ?>" aria-label="Next">
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
                    </div>
                    <!-- Products table with pagination -->
                    <div class="col-md-13">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">Products</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center view-column">Name</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Tag</th>
                                                <th class="text-center view-column">Link</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $index => $product) : ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $index + 1 + ($product_page - 1) * $results_per_page; ?></td>
                                                    <td class="text-center view-column"><?php echo htmlspecialchars($product['name']); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($product['category_id']); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($product['tag_id']); ?></td>
                                                    <td class="text-center view-column"><?php echo htmlspecialchars($product['link']); ?></td>
                                                    <td class="text-center"><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" style="width:40px;"></td>
                                                    <td class="text-center"><?php echo htmlspecialchars(formatRupiah($product['price'])); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- Pagination for products -->
                                    <?php if ($number_of_product_pages > 1) : ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if ($product_page > 1) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link text-dark" href="home.php?product_page=<?php echo $product_page - 1; ?>" aria-label="Previous">
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
                                                <?php for ($i = 1; $i <= $number_of_product_pages; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $product_page) echo 'active'; ?>"><a class="page-link text-dark" href="home.php?product_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                <?php endfor; ?>
                                                <?php if ($product_page < $number_of_product_pages) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link text-dark" href="home.php?product_page=<?php echo $product_page + 1; ?>" aria-label="Next">
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
                    </div>
                    <!-- End of Main Content -->
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>

</html>