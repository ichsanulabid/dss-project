<?php
//login
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: login/userLogin.php");
    header("location: login/adminLogin.php");
    exit();
}
?>

<!-- <?php header('Location: home/home.php'); ?> -->
<!-- <?php header('Location: admin/admin.php'); ?> -->