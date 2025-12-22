<?php
include("../database/config.php");

if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
    header("Location: dashboard.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND type='admin'"; 
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password (assuming simple comparison for now as per previous code, or password_verify if hashed)
        // Previous controller used password_hash, so use password_verify
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['type'] = $row['type'];
            header("Location: dashboard.php");
            exit;
        } else {
             $error = "Invalid password.";
        }
    } else {
        $error = "Admin account not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - FoodFusion</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login-box">
        <h2>Admin Panel</h2>
        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required class="form-input">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required class="form-input">
            </div>
            <button type="submit" class="submit-btn">Login</button>
        </form>
        <a href="../index.php" class="back-link">Back to Website</a>
    </div>
</body>
</html>
