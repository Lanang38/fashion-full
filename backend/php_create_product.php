<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
include('config.php');

// Initialize variables with empty values
$name = $category = $tag = $link = $price = "";
$name_err = $category_err = $tag_err = $link_err = $price_err = $image_err = "";

// Fetch categories from database
$sql_categories = "SELECT * FROM categories";
$result_categories = $conection_db->query($sql_categories);
$categories = $result_categories->fetch_all(MYSQLI_ASSOC);

// Fetch tags from database
$sql_tags = "SELECT * FROM tags";
$result_tags = $conection_db->query($sql_tags);
$tags = $result_tags->fetch_all(MYSQLI_ASSOC);

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a product name.";
    } else {
        // Check if the name already exists
        $check_name = trim($_POST["name"]);
        $check_query = "SELECT product_id FROM products WHERE name = ?";
        if ($stmt = mysqli_prepare($conection_db, $check_query)) {
            mysqli_stmt_bind_param($stmt, "s", $check_name);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $name_err = "This product name is already taken.";
                } else {
                    $name = $check_name;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Validate link
    if (empty(trim($_POST["link"]))) {
        $link_err = "Please enter a product link.";
    } else {
        // Check if the link already exists
        $check_link = trim($_POST["link"]);
        $check_query = "SELECT product_id FROM products WHERE link = ?";
        if ($stmt = mysqli_prepare($conection_db, $check_query)) {
            mysqli_stmt_bind_param($stmt, "s", $check_link);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $link_err = "This product link is already taken.";
                } else {
                    $link = $check_link;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Validate Price
    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter product price.";
    } else {
        $price = trim($_POST["price"]);
        if (!is_numeric($price)) {
            $price_err = "Price must be a number.";
        }
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
            } else {
                $image_err = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $image_err = "No image file selected.";
    }

    // Check if there are no errors before inserting into database
    if (empty($name_err) && empty($link_err) && empty($price_err) && empty($category_err) && empty($tag_err) && empty($image_err)) {
        // Convert price to Rupiah format
        // $price_rupiah = 'Rp.' . number_format($price, 0, ',', '.');

        $sql = "INSERT INTO products (name, category_id, tag_id, link, price, image) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conection_db, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_category, $param_tag, $param_link, $param_price, $param_image);

            $param_name = $name;
            $param_category = $category;
            $param_tag = $tag;
            $param_link = $link;
            $param_price = $price;
            $param_image = $target_file;

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to product.php after successful insert
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
}
