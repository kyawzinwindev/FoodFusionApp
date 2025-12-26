<?php 
include("../database/config.php"); 
include("auth_check.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Recipes</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Manage Recipes</h1>
            <a href="recipes_create.php" class="admin-btn">Create Recipe</a>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <!-- Admin Search & Filter -->
        <div style="margin-bottom: 20px; text-align: right;">
            <form method="GET" action="recipes.php" style="display: inline-block;">
                <input type="text" name="search" placeholder="Title, ingredients..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="padding: 8px; margin-right: 5px; border-radius: 5px; border: 1px solid #ccc;">
                <select name="cuisine_type" style="padding: 8px; margin-right: 5px; border-radius: 5px; border: 1px solid #ccc;">
                    <option value="">All Cuisines</option>
                    <option value="Italian" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Italian') echo 'selected'; ?>>Italian</option>
                    <option value="Asian" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Asian') echo 'selected'; ?>>Asian</option>
                    <option value="Mexican" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Mexican') echo 'selected'; ?>>Mexican</option>
                    <option value="American" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'American') echo 'selected'; ?>>American</option>
                    <option value="Other" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
                <button type="submit" class="admin-btn" style="padding: 8px 15px; font-size: 14px;">Search</button>
                <?php if(isset($_GET['search']) || isset($_GET['cuisine_type'])): ?>
                    <a href="recipes.php" class="admin-btn" style="padding: 8px 15px; font-size: 14px; background: #666; margin-left: 5px; text-decoration:none;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Cuisine</th>
                    <th>Difficulty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $where_clauses = [];
                if (!empty($_GET['search'])) {
                    $search = $connection->real_escape_string($_GET['search']);
                    $where_clauses[] = "(title LIKE '%$search%' OR description LIKE '%$search%' OR ingredients LIKE '%$search%')";
                }
                if (!empty($_GET['cuisine_type'])) {
                    $cuisine = $connection->real_escape_string($_GET['cuisine_type']);
                    $where_clauses[] = "cuisine_type = '$cuisine'";
                }

                $sql = "SELECT * FROM recipes";
                if (!empty($where_clauses)) {
                    $sql .= " WHERE " . implode(" AND ", $where_clauses);
                }
                $sql .= " ORDER BY created_at DESC";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['cuisine_type'] . "</td>";
                        echo "<td>" . $row['difficulty'] . "</td>";
                        echo "<td>
                                <form action='../controllers/admin/AdminRecipesController.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='delete_recipe' class='admin-action-btn delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                                </form>
                                <a href='recipes_edit.php?id=" . $row['id'] . "' class='admin-action-btn edit'>Update</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No recipes found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
