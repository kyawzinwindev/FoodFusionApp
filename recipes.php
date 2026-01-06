<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="page-header custom-header">
        <h1>Recipes</h1>
        <p>Explore our collection of delicious recipes.</p>
        <?php if(isset($_SESSION['id'])): ?>
            <a href="recipes_create.php" class="create-btn">Add New Recipe</a>
        <?php else: ?>
             <p style="margin-top:20px; color: #666;"><em><a href="#" onclick="openModal('loginModal')">Log in</a> to create your own recipes!</em></p>
        <?php endif; ?>
    </div>

    <div class="container section">
        <!-- Search & Filter -->
        <div class="search-filter-container">
            <form method="GET" action="recipes.php" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search by title, ingredients..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <select name="cuisine_type" class="filter-select">
                    <option value="">All Cuisines</option>
                    <option value="Italian" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Italian') echo 'selected'; ?>>Italian</option>
                    <option value="Japanese" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Japanese') echo 'selected'; ?>>Japanese</option>
                    <option value="Asian" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Asian') echo 'selected'; ?>>Asian</option>
                    <option value="Mexican" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Mexican') echo 'selected'; ?>>Mexican</option>
                    <option value="American" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'American') echo 'selected'; ?>>American</option>
                    <option value="Other" <?php if(isset($_GET['cuisine_type']) && $_GET['cuisine_type'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
                <button type="submit" class="search-btn">Search</button>
                <?php if(isset($_GET['search']) || isset($_GET['cuisine_type'])): ?>
                    <a href="recipes.php" class="search-btn" style="background:#777; text-decoration:none; display:flex; align-items:center;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="card-grid">
            <?php
            // Show all recipes
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
            $sql .= " ORDER BY id DESC";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/600x400?text=No+Image';
                    ?>
                    <div class="card">
                        <a href="recipe_view.php?id=<?php echo $row['id']; ?>">
<img src="<?php echo $image; ?>" alt="<?php echo $row['title']; ?>" onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=No+Image';">
                        </a>
                        <div class="card-body">
                            <span class="badge"><?php echo $row['cuisine_type']; ?></span>
                            <h3><a href="recipe_view.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo $row['title']; ?></a></h3>
                            <div class="meta-info">
                                <span>Diff: <?php echo $row['difficulty']; ?></span>
                                <span>Diet: <?php echo $row['dietary_preference']; ?></span>
                            </div>
                            <p><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                            
                            <div class="card-actions" style="justify-content: flex-start; padding-top:10px;">
                                <!-- View -->
                                <a href="recipe_view.php?id=<?php echo $row['id']; ?>" class="btn-link" title="View" style="width:auto; display:inline-block; margin:0; background:#777;"><i class="fa fa-eye"></i></a>

                                <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                                    <!-- Edit -->
                                    <a href="recipes_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="width: auto; padding: 6px 12px; display:inline-block; text-align:center;" title="Edit"><i class="fa fa-edit"></i></a>
                                    
                                    <!-- Delete -->
                                    <form action="./controllers/client/ClientRecipesController.php" method="POST" style="display:inline; width: auto;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="redirect" value="../../recipes.php">
                                        <button type="submit" name="delete_recipe" class="btn-delete" style="width:auto; padding: 6px 12px;" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No recipes found.</p>";
            }
            ?>
        </div>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
