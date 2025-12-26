<?php
include("../database/config.php");
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        
        <div class="admin-header">
            <h1>Dashboard</h1>
        </div>

        <div class="card-grid">
            <div class="card">
                <div class="card-body">
                    <h3>Users</h3>
                    <p>Manage system users.</p>
                    <a href="users.php" class="btn-link">Go to Users</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3>Recipes</h3>
                    <p>Manage official recipes.</p>
                    <a href="recipes.php" class="btn-link">Go to Recipes</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3>Community Cookbook</h3>
                    <p>Moderate community submissions.</p>
                    <a href="community_cookbook.php" class="btn-link">Review Submissions</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3>Resources</h3>
                    <p>Manage culinary & educational content.</p>
                    <a href="culinary_resources.php" class="btn-link">Mange Resources</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/admin.js" defer></script>
</body>
</html>
