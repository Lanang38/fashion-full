<?php
require_once "php_create_product.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dressclo - Create Product</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Create new product page for Dressclo" />
    <meta name="keywords" content="admin templates, bootstrap admin templates, create product" />
    <meta name="author" content="CodedThemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/Dressclo.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

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
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu">
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
                                    <div class="card-header">
                                        <h4 class="d-flex justify-content-between align-items-center">Create New Product</h4>
                                    </div>
                                    <div class="card-block">
                                        <form method="post" action="create_product.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>" id="category" name="category" required>
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($categories as $category_item) : ?>
                                                        <option value="<?php echo $category_item['category_id']; ?>" <?php echo ($category == $category_item['category_id']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($category_item['name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="invalid-feedback"><?php echo $category_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="tag">Tag</label>
                                                <select class="form-control <?php echo (!empty($tag_err)) ? 'is-invalid' : ''; ?>" id="tag" name="tag" required>
                                                    <option value="">Select Tag</option>
                                                    <?php foreach ($tags as $tag_item) : ?>
                                                        <option value="<?php echo $tag_item['tag_id']; ?>" <?php echo ($tag == $tag_item['tag_id']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($tag_item['name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="invalid-feedback"><?php echo $tag_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="link">Product Link</label>
                                                <input type="text" class="form-control <?php echo (!empty($link_err)) ? 'is-invalid' : ''; ?>" id="link" name="link" value="<?php echo htmlspecialchars($link); ?>" required>
                                                <span class="invalid-feedback"><?php echo $link_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="link">Product Price</label>
                                                <input type="text" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required>
                                                <span class="invalid-feedback"><?php echo $price_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Product Image</label>
                                                <input type="file" class="form-control-file <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" id="image" name="image" accept="image/*" required>
                                                <span class="invalid-feedback"><?php echo $image_err; ?></span>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="product.php" class="btn btn-secondary">Cancel</a>
                                        </form>
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