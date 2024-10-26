<?php
// Initialize session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require 'config.php'; // Include database connection file

// Define variables and initialize with empty values
$name = "";
$name_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a tag name.";
    } else {
        // Prepare a select statement
        $sql = "SELECT tag_id FROM tags WHERE name = ?";

        if ($stmt = $conection_db->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_name);

            // Set parameters
            $param_name = trim($_POST["name"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $name_err = "This tag name is already taken.";
                } else {
                    $name = trim($_POST["name"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Check input errors before inserting into database
    if (empty($name_err)) {
        // Generate slug from name
        $slug = strtolower(str_replace(' ', '-', trim($_POST["name"])));

        // Prepare an insert statement
        $sql = "INSERT INTO tags (name, slug) VALUES (?, ?)";

        if ($stmt = $conection_db->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_name, $param_slug);

            // Set parameters
            $param_name = $name;
            $param_slug = $slug;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to tag page
                header("location: tag.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conection_db->close();
}
?>
