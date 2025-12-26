<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - FoodFusion</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
</head>
<body class="login-body">
    <div class="login-box">
        <h2>Admin Panel</h2>
        <?php if(isset($_GET['error'])): ?>
            <div class="login-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <form method="POST" action="../controllers/admin/AdminLoginController.php">
            <div class="login-form-group">
                <label>Email</label>
                <input type="email" name="email" required class="login-form-input">
            </div>
            <div class="login-form-group">
                <label>Password</label>
                <input type="password" name="password" required class="login-form-input">
            </div>
            <button type="submit" class="login-submit-btn">Login</button>
        </form>
        <a href="../index.php" class="login-back-link">Back to Website</a>
    </div>
</body>
</html>
