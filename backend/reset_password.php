<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
require_once "php_reset_password.php";
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dressclo</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template"/>
    <meta name="author" content="CodedThemes"/>

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/Dressclo.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<style>
    .help-block{
        color:red;
    }
</style>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="feather icon-unlock auth-icon"></i>
                        </div>
                        <h3 class="mb-4">Reset Password</h3>
                        <div class="input-group mb-3 <?= (!empty($old_password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" value="<?= $old_password; ?>">				
                        </div>
                        <span class="help-block"><?= $old_password_err; ?></span>
                        <div class="input-group mb-3 <?= (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" value="<?= $new_password; ?>">				
                        </div>
                        <span class="help-block"><?= $new_password_err; ?></span>
                        <div class="input-group mb-4 <?= (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?= $confirm_password; ?>">				
                        </div>
                        <span class="help-block"><?= $confirm_password_err; ?></span>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" id="show_password">
                                <label for="show_password" class="cr"> Show Password</label>
                            </div>
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('show_password').addEventListener('change', function() {
            var oldPasswordInput = document.getElementById('old_password');
            var newPasswordInput = document.getElementById('new_password');
            var confirmPasswordInput = document.getElementById('confirm_password');
            if (this.checked) {
                oldPasswordInput.type = 'text';
                newPasswordInput.type = 'text';
                confirmPasswordInput.type = 'text';
            } else {
                oldPasswordInput.type = 'password';
                newPasswordInput.type = 'password';
                confirmPasswordInput.type = 'password';
            }
        });
    </script>

</body>
</html>
