<?php 
include("../database/config.php"); 
include("auth_check.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Community Cookbook</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Community Cookbook</h1>
            <a href="community_cookbook_create.php" class="admin-btn">Add Recipe</a> 
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>User ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM community_cookbook ORDER BY created_at DESC";
                $result = $connection->query($sql);
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . ucfirst($row['category']) . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>
                                <form action='../controllers/admin/AdminCommunityController.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='delete_community_recipe' class='admin-action-btn delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                                </form>
                                <a href='community_cookbook_edit.php?id=" . $row['id'] . "' class='admin-action-btn edit'>Update</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No community items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../js/admin.js"></script>
</body>
</html>
