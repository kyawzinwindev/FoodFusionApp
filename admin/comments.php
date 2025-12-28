<?php
include("../database/config.php"); 
include("auth_check.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comments - Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Comments</h1>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Recipe ID</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Join with users and community_cookbook to get readable names if needed
                $sql = "SELECT comments.*, users.first_name, users.last_name, community_cookbook.title as recipe_title 
                        FROM comments 
                        LEFT JOIN users ON comments.user_id = users.id 
                        LEFT JOIN community_cookbook ON comments.community_recipe_id = community_cookbook.id 
                        ORDER BY comments.created_at DESC";
                
                $result = $connection->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['community_recipe_id'] . " (" . substr($row['recipe_title'], 0, 15) . "...)</td>";
                        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                        echo "<td>" . substr(htmlspecialchars($row['comment']), 0, 50) . "...</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>
                                <form action='../controllers/admin/AdminCommentsController.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='delete_comment' class='admin-action-btn delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No comments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
