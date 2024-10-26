<?php
session_start();
include('config.php');

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Initialize variables
$name = $slug = $image = "";
$name_err = $image_err = "";

// Fetch category data
$category = null;
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE category_id = ?";
    if ($stmt = $conection_db->prepare($sql)) {
        $stmt->bind_param("i", $category_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $category = $result->fetch_assoc();
            } else {
                echo "No records found";
                exit;
            }
        } else {
            echo "Error executing query: " . $stmt->error;
            exit;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = strtolower(str_replace(" ", "-", $name)); // Generate slug based on name

    // File handling (if you allow image update)
    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads_c/"; // Adjust the upload directory as needed
        $target_file = $target_dir . basename($image);

        // Upload file to server
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            $image_err = "Failed to upload image.";
        }
    } else {
        // If no new image uploaded, retain the existing image path
        $image_path = $_POST['current_image'];
    }

    // Validate name
    if (empty($name)) {
        $name_err = "Please enter a category name.";
    } else {
        // Check for duplicate name
        $sql = "SELECT category_id FROM categories WHERE name = ? AND category_id != ?";
        if ($stmt = $conection_db->prepare($sql)) {
            $stmt->bind_param("si", $name, $category_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $name_err = "This category name is already taken.";
                }
            } else {
                echo "Error executing query: " . $stmt->error;
                exit;
            }
        }
    }

    // Validate input
    if (empty($name_err) && empty($image_err)) {
        // Update category in database
        $sql = "UPDATE categories SET name=?, slug=?, image=? WHERE category_id=?";
        if ($stmt = $conection_db->prepare($sql)) {
            $stmt->bind_param("sssi", $name, $slug, $image_path, $category_id);
            if ($stmt->execute()) {
                // Redirect to category list after successful update
                header("location: category.php");
            } else {
                echo "Error updating category: " . $stmt->error;
            }
        } else {
            echo "Error preparing query: " . $conection_db->error;
        }
    }
}

?>