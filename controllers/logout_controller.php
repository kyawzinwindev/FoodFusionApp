<?php
session_start();

session_unset();
session_destroy();

echo "<script>alert('Logged out successfully');</script>";
echo "<script>window.location='../index.php';</script>";
exit;
?>
