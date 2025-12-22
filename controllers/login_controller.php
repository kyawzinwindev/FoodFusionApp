<?php 
include('../database/config.php');

if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email == '' || $password == ''){
        echo "<script>alert('Please Fill Required Information!');</script>";
        echo "<script>history.back();</script>";
        exit;
    }

    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 0;
    }

    if (!isset($_SESSION['lockout_until'])) {
        $_SESSION['lockout_until'] = null;
    }

    if ($_SESSION['lockout_until'] !== null && $_SESSION['lockout_until'] > time()) {
        $remaining = $_SESSION['lockout_until'] - time();
        $minutes = floor($remaining / 60);
        $seconds = $remaining % 60;

        echo "<script>alert('Account locked. Try again in $minutes minutes $seconds seconds.');</script>";
        echo "<script>history.back();</script>";
        exit;
    }

    $query = "SELECT * FROM users WHERE email='$email';";
    $response = mysqli_query($connection, $query);
    $arr = mysqli_fetch_array($response);

    if (!$arr) {
        echo "<script>alert('Invalid Email');</script>";
        echo "<script>history.back();</script>";
        exit;
    }

    $encrypted_password = $arr['password'];
    $userId = $arr['id'];

    if (password_verify($password, $encrypted_password)) {

        // Reset session counters
        $_SESSION['failed_attempts'] = 0;
        $_SESSION['lockout_until'] = null;

        $_SESSION['id'] = $userId;

        echo "<script>alert('Login Success.')</script>";
        echo "<script>history.back();</script>";
        exit;

    } else {
        // Increase failed attempts
        $_SESSION['failed_attempts']++;

        if ($_SESSION['failed_attempts'] >= 3) {
            // Lock account for 3 minutes
            $_SESSION['lockout_until'] = time() + (3 * 60);

            echo "<script>alert('Too many failed attempts. Account locked for 3 minutes.');</script>";
            echo "<script>history.back();</script>";
        } else {
            $attempt = $_SESSION['failed_attempts'];
            echo "<script>alert('Login failed! Attempt $attempt of 3');</script>";
            echo "<script>history.back();</script>";
        }

        echo "<script>history.back();</script>";
        exit;
    }
}
?>
