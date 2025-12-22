<?php include("../database/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Recipe</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Create Official Recipe</h1>
            <a href="recipes.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminRecipesController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="recipe_type" value="official">
                <input type="hidden" name="redirect" value="../../admin/recipes.php">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Ingredients</label>
                    <textarea name="ingredients" required class="form-input" rows="3"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Cuisine</label>
                         <select name="cuisine_type" class="form-input">
                            <option value="Italian">Italian</option>
                            <option value="Asian">Asian</option>
                            <option value="Mexican">Mexican</option>
                            <option value="American">American</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Difficulty</label>
                         <select name="difficulty" class="form-input">
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Hard">Hard</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                     <label>Dietary Preference</label>
                    <select name="dietary_preference" class="form-input">
                        <option value="None">None</option>
                        <option value="Vegetarian">Vegetarian</option>
                        <option value="Vegan">Vegan</option>
                        <option value="Gluten-Free">Gluten-Free</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <button type="submit" name="create_recipe" class="submit-btn">Create Recipe</button>
            </form>
        </div>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
