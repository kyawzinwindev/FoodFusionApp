<?php
// admin/auth_check.php
// Include this at the TOP of every admin page
// session_start(); // config.php usually starts session, but ensure it exists.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id']) || !isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    // If not logged in or not admin, redirect to admin login
    header("Location: login.php");
    exit();
}
?>
