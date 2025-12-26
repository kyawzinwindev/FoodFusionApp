<?php 
include("../database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Edit User</h1>
            <a href="users.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminUsersController.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="type" class="form-input">
                        <option value="user" <?php if($row['type'] == 'user') echo 'selected'; ?>>User</option>
                        <option value="admin" <?php if($row['type'] == 'admin') echo 'selected'; ?>>Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>New Password (leave blank to keep current)</label>
                    <input type="password" name="password" class="form-input">
                </div>
                <button type="submit" name="update_user" class="submit-btn">Update User</button>
            </form>
        </div>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
