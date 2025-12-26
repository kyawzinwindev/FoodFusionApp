<?php 
include("../database/config.php"); 
include("auth_check.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Culinary Resources</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Culinary Resources</h1>
            <a href="culinary_resources_create.php" class="admin-btn">Add Resource</a>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <!-- Admin Search -->
        <div style="margin-bottom: 20px; text-align: right;">
            <form method="GET" action="culinary_resources.php" style="display: inline-block;">
                <input type="text" name="search" placeholder="Search title, description..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="padding: 8px; margin-right: 5px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
                <button type="submit" class="admin-btn" style="padding: 8px 15px; font-size: 14px;">Search</button>
                <?php if(isset($_GET['search'])): ?>
                    <a href="culinary_resources.php" class="admin-btn" style="padding: 8px 15px; font-size: 14px; background: #666; margin-left: 5px; text-decoration:none;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM resources WHERE resource_type = 'culinary'";
                if (!empty($_GET['search'])) {
                    $search = $connection->real_escape_string($_GET['search']);
                    $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
                }
                $sql .= " ORDER BY created_at DESC";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['file_type'] . "</td>";
                        echo "<td>
                                <form action='../controllers/admin/AdminCulinaryResourcesController.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='delete_resource' class='admin-action-btn delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                                </form>
                                <a href='culinary_resources_edit.php?id=" . $row['id'] . "' class='admin-action-btn edit'>Update</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No resources found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
