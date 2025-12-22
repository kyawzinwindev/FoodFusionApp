<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
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
        <div class="card-grid">
            <?php
            // Show all recipes
            $sql = "SELECT * FROM recipes ORDER BY created_at DESC";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/600x400?text=No+Image';
                    ?>
                    <div class="card">
                        <a href="recipe_view.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo $image; ?>" alt="<?php echo $row['title']; ?>">
                        </a>
                        <div class="card-body">
                            <span class="badge"><?php echo $row['cuisine_type']; ?></span>
                            <h3><a href="recipe_view.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo $row['title']; ?></a></h3>
                            <div class="meta-info">
                                <span>Diff: <?php echo $row['difficulty']; ?></span>
                                <span>Diet: <?php echo $row['dietary_preference']; ?></span>
                            </div>
                            <p><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                            
                            <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                            <div class="card-actions">
                                <form action="./controllers/client/ClientRecipesController.php" method="POST" style="display:inline; width: 50%;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="redirect" value="../../recipes.php">
                                    <button type="submit" name="delete_recipe" class="btn-delete" style="width:100%" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="recipes_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="width: 48%; display:inline-block; text-align:center;">Edit</a>
                            </div>
                            <?php endif; ?>
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
