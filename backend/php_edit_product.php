<?php
// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
include('config.php');

// Define variables and initialize with empty values
$name = $category = $tag = $link = $price = "";
$name_err = $category_err = $tag_err = $link_err = $price_err  = $image_err = "";

// Fetch categories from database
$sql_categories = "SELECT * FROM categories";
$result_categories = $conection_db->query($sql_categories);
$categories = $result_categories->fetch_all(MYSQLI_ASSOC);

// Fetch tags from database
$sql_tags = "SELECT * FROM tags";
$result_tags = $conection_db->query($sql_tags);
$tags = $result_tags->fetch_all(MYSQLI_ASSOC);

// Initialize product data variables
$product_id = $_GET["product_id"] ?? null;
$product_name = $product_category = $product_tag = $product_link = $product_price  = "";
$product_image = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a product name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate link
    if (empty(trim($_POST["link"]))) {
        $link_err = "Please enter a product link.";
    } else {
        $link = trim($_POST["link"]);
    }

    // Validate category
    if (empty(trim($_POST["category"]))) {
        $category_err = "Please select a category.";
    } else {
        $category = trim($_POST["category"]);
    }

    // Validate tag
    if (empty(trim($_POST["tag"]))) {
        $tag_err = "Please select a tag.";
    } else {
        $tag = trim($_POST["tag"]);
    }

    // Validate price
    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter a product price.";
    } else {
        $price = trim($_POST["price"]);
        if (!is_numeric($price)) {
            $price_err = "Price must be a number.";
        }
    }

    // Validate and handle image upload
    if ($_FILES["image"]["error"] == 0) {
        $target_dir = "uploads_p/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $image_err = "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $image_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if $uploadOk is set to 0 by an error
        if (empty($image_err)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully
                $product_image = $target_file;
            } else {
                $image_err = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // No new image uploaded, retain existing image path or handle it as needed
        $product_image = $_POST["existing_image"] ?? "";
    }

    // Check if there are no errors before updating into database
    if (empty($name_err) && empty($link_err) && empty($price_err) && empty($category_err) && empty($tag_err) && empty($image_err)) {
        $sql_update = "UPDATE products SET name=?, category_id=?, tag_id=?, link=?, price=?, image=? WHERE product_id=?";

       // $price_rupiah = 'Rp.' . number_format($price, 0, ',', '.');

        if ($stmt = mysqli_prepare($conection_db, $sql_update)) {
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_name, $param_category, $param_tag, $param_link, $param_price, $param_image, $param_product_id);

            $param_name = $name;
            $param_category = $category;
            $param_tag = $tag;
            $param_link = $link;
            $param_price = $price;
            $param_image = $product_image;
            $param_product_id = $product_id;

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to product.php after successful update
                header("location: product.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conection_db);
} else {
    // Fetch product data to populate form fields
    if (!empty($product_id)) {
        $sql_fetch_product = "SELECT * FROM products WHERE product_id=?";
        if ($stmt = mysqli_prepare($conection_db, $sql_fetch_product)) {
            mysqli_stmt_bind_param($stmt, "i", $product_id);
            if (mysqli_stmt_execute($stmt)) {
                $result_product = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result_product) == 1) {
                    $row = mysqli_fetch_array($result_product, MYSQLI_ASSOC);
                    $product_name = $row["name"];
                    $product_category = $row["category_id"];
                    $product_tag = $row["tag_id"];
                    $product_link = $row["link"];
                    $product_price = $row["price"];
                    $product_image = $row["image"];
                } else {
                    echo "Product not found.";
                    exit;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                exit;
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>
