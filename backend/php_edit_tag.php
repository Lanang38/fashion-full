<?php
session_start();
require 'config.php';

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Initialize an error message variable
$error_message = "";

// Initialize the tag variable
$tag = ['tag_id' => '', 'name' => ''];

// Check if the ID of the tag to be edited is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tag_id'])) {
    $id = $_GET['tag_id'];

    // Retrieve the tag's data from the database
    $sql = "SELECT * FROM tags WHERE tag_id = ?";
    if ($stmt = $conection_db->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $tag = $result->fetch_assoc();
        } else {
            echo "Tag tidak ditemukan.";
            exit;
        }
    }
}

// Process the tag edit form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["tag_id"];
    $name = $_POST["name"];
    $slug = slugify($name); // automatically generate slug from name

    // Check if there is another tag with the same name
    $sql_check = "SELECT tag_id FROM tags WHERE name = ? AND tag_id != ?";
    if ($stmt_check = $conection_db->prepare($sql_check)) {
        $stmt_check->bind_param("si", $name, $id);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $error_message = "This tag name is already taken.";
        } else {
            // Update the tag in the database
            $sql_update = "UPDATE tags SET name = ?, slug = ? WHERE tag_id = ?";
            if ($stmt_update = $conection_db->prepare($sql_update)) {
                $stmt_update->bind_param("ssi", $name, $slug, $id);
                if ($stmt_update->execute()) {
                    header("location: tag.php");
                    exit;
                } else {
                    $error_message = "Terjadi kesalahan. Silakan coba lagi.";
                }
            }
        }
    }

    // Ensure the $tag variable is set correctly when there is an error
    $tag['tag_id'] = $id;
    $tag['name'] = $name;
}

function slugify($string)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = trim($slug, '-');
    return strtolower($slug);
}
?>