<?php include("../database/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Create User</h1>
            <a href="users.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminUsersController.php" method="POST">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="type" class="form-input">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" name="create_user" class="submit-btn">Create User</button>
            </form>
        </div>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
