<?php
session_start();
require("../../database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND type='admin'"; 
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['type'] = $row['type'];
            header("Location: ../../admin/dashboard.php");
            exit;
        } else {
             header("Location: ../../admin/login.php?error=Invalid password");
             exit;
        }
    } else {
        header("Location: ../../admin/login.php?error=Admin account not found");
        exit;
    }
} else {
    header("Location: ../../admin/login.php");
    exit;
}
?>
