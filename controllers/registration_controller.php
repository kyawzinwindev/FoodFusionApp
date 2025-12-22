<?php
include('../database/config.php');

if (isset($_POST['btnRegister'])) {
    if($_POST['first_name'] == '' || $_POST['last_name'] == '' || $_POST['email'] == '' || $_POST['password'] == ''){
        echo "<script>alert('Please Fill Required Information!');</script>";
        echo "<script>history.back();</script>";
        exit;
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $type = "user";

    $query = "SELECT * FROM users WHERE email='$email';";
    $response = mysqli_query($connection, $query);
    $arr = mysqli_fetch_array($response);

    if ($email == $arr['email']) {
        echo "<script>window.alert('Email already exists!')</script>";
        echo "<script>history.back();</script>";

        return;
    }

    $query = "INSERT INTO users (first_name, last_name, email, password, type) VALUES ('$first_name', '$last_name', '$email', '$encrypted_password', '$type');";

    $response = mysqli_query($connection, $query);

    if ($response) {
        echo "<script>window.alert('Register Success. You can login now<3')</script>";
        echo "<script>history.back();</script>";
    } else {
        echo "<script>window.alert('Register Fail!')</script>";
        echo "<script>history.back();</script>";
    }
}
