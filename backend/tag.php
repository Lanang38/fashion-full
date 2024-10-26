<?php
// Inisialisasi sesi
session_start();

// Cek apakah pengguna sudah login, jika tidak redirect ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
include('config.php');

// Define jumlah hasil yang ingin ditampilkan per halaman
$results_per_page = 4;

// Ambil jumlah hasil yang tersimpan di database
$sql = "SELECT * FROM tags";
$result = $conection_db->query($sql);
$number_of_results = $result->num_rows;

// Tentukan jumlah halaman yang tersedia
$number_of_pages = ceil($number_of_results / $results_per_page);

// Tentukan halaman saat ini
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Tentukan batas awal untuk hasil yang ditampilkan pada halaman yang ditampilkan
$this_page_first_result = ($page - 1) * $results_per_page;

// Ambil hasil yang dipilih dari database 
$sql = "SELECT * FROM tags LIMIT " . $this_page_first_result . ',' . $results_per_page;
$result = $conection_db->query($sql);

// Periksa apakah query mengembalikan baris apa pun
if (mysqli_num_rows($result) > 0) {
    $tags = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $tags = []; // Array kosong jika tidak ada tag yang ditemukan
}
mysqli_close($conection_db); // Tutup koneksi database menggunakan $conection_db
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dressclo - Tags</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Tag management page for Dressclo" />
    <meta name="keywords" content="admin templates, bootstrap admin templates, tags, product management" />
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
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item ">
                        <a href="home.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item active pcoded-hasmenu">
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

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-body">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4>Tags List</h4>
                                        <div>
                                            <a href="print_tag.php" class="btn btn-success">Print</a>
                                            <a href="create_tag.php" class="btn btn-primary">Create</a>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Slug</th>
                                                        <th class="text-center">Tag Count</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($tags as $index => $tag) : ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $index + 1 + ($page - 1) * $results_per_page; ?></td>
                                                            <td class="text-center"><?php echo htmlspecialchars($tag['name']); ?></td>
                                                            <td class="text-center"><?php echo htmlspecialchars($tag['slug']); ?></td>
                                                            <td class="text-center"><?php echo htmlspecialchars($tag['tag_count']); ?></td>
                                                            <td class="text-center">
                                                                <a href="edit_tag.php?tag_id=<?php echo $tag['tag_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                                <a href="delete_tag.php?tag_id=<?php echo $tag['tag_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <!-- Pagination -->
                                            <?php if ($number_of_pages > 1) : ?>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-center">
                                                        <?php if ($page > 1) : ?>
                                                            <li class="page-item">
                                                                <a class="page-link text-dark" href="tag.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
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

                                                        <?php for ($i = 1; $i <= $number_of_pages; $i++) : ?>
                                                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link text-dark" href="tag.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                        <?php endfor; ?>

                                                        <?php if ($page < $number_of_pages) : ?>
                                                            <li class="page-item">
                                                                <a class="page-link text-dark" href="tag.php?page=<?php echo $page + 1; ?>" aria-label="Next">
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
                                            <!-- Pagination end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</body>

</html>
