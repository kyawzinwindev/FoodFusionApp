<?php 
include("../database/config.php"); 
include("auth_check.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Community Cookbook</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Community Cookbook</h1>
            <a href="community_cookbook_create.php" class="admin-btn">Add Community Cookbook</a> 
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <!-- Admin Search & Filter -->
        <div style="margin-bottom: 20px; text-align: right;">
            <form method="GET" action="community_cookbook.php" style="display: inline-block;">
                <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="padding: 8px; margin-right: 5px; border-radius: 5px; border: 1px solid #ccc;">
                <select name="category" style="padding: 8px; margin-right: 5px; border-radius: 5px; border: 1px solid #ccc;">
                    <option value="">All Categories</option>
                    <option value="recipe" <?php if(isset($_GET['category']) && $_GET['category'] == 'recipe') echo 'selected'; ?>>Recipe</option>
                    <option value="tip" <?php if(isset($_GET['category']) && $_GET['category'] == 'tip') echo 'selected'; ?>>Cooking Tip</option>
                    <option value="experience" <?php if(isset($_GET['category']) && $_GET['category'] == 'experience') echo 'selected'; ?>>Culinary Experience</option>
                </select>
                <button type="submit" class="admin-btn" style="padding: 8px 15px; font-size: 14px;">Search</button>
                <?php if(isset($_GET['search']) || isset($_GET['category'])): ?>
                    <a href="community_cookbook.php" class="admin-btn" style="padding: 8px 15px; font-size: 14px; background: #666; margin-left: 5px; text-decoration:none;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

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
                $where_clauses = [];
                if (!empty($_GET['search'])) {
                    $search = $connection->real_escape_string($_GET['search']);
                    $where_clauses[] = "(title LIKE '%$search%' OR description LIKE '%$search%' OR ingredients LIKE '%$search%' OR content LIKE '%$search%')";
                }
                if (!empty($_GET['category'])) {
                    $category = $connection->real_escape_string($_GET['category']);
                    $where_clauses[] = "category = '$category'";
                }

                $sql = "SELECT * FROM community_cookbook";
                if (!empty($where_clauses)) {
                    $sql .= " WHERE " . implode(" AND ", $where_clauses);
                }
                $sql .= " ORDER BY created_at DESC";
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
    <script src="../js/admin.js" defer></script>
</body>
</html>
