<?php
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$old_password = $new_password = $confirm_password = "";
$old_password_err = $new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate old password
    if (empty(trim($_POST["old_password"]))) {
        $old_password_err = "Please enter your old password.";
    } else {
        $old_password = trim($_POST["old_password"]);
    }

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($old_password_err) && empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare a select statement
        $sql = "SELECT password FROM users WHERE id = ?";

        if ($stmt = mysqli_prepare($conection_db, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $_SESSION["id"];

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        // Check if old password matches the one in database
                        if (password_verify($old_password, $hashed_password)) {
                            // Hash the new password
                            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                            // Prepare an update statement
                            $sql_update = "UPDATE users SET password = ? WHERE id = ?";

                            if ($stmt_update = mysqli_prepare($conection_db, $sql_update)) {
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt_update, "si", $param_password, $param_id);

                                // Set parameters
                                $param_password = $hashed_new_password;

                                // Attempt to execute the prepared statement
                                if (mysqli_stmt_execute($stmt_update)) {
                                    // Password updated successfully. Destroy the session, and redirect to login page
                                    session_destroy();
                                    header("location: login.php");
                                    exit();
                                } else {
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                            }
                        } else {
                            $old_password_err = "The old password you entered was not valid.";
                        }
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conection_db);
}
?>
