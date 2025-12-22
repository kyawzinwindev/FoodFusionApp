<?php require("./database/config.php"); 
if(!isset($_SESSION['id'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="form-container section">
        <h2>Add New Recipe</h2>
        <form action="./controllers/client/ClientRecipesController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="redirect" value="../../recipes.php">

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
            <button type="submit" name="create_recipe" class="submit-btn" style="background: #e67e22; color: #fff;">Create Recipe</button>
        </form>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
