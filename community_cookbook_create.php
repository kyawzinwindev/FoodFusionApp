<?php require("./database/config.php"); 
if(!isset($_SESSION['id'])) {
    header("Location: index.php?msg=Please login to share");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Recipe - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="form-container section">
        <h2>Share Your Post</h2>
        <form action="./controllers/client/ClientCommunityController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?? 1; ?>"> 
            <input type="hidden" name="redirect" value="../../community_cookbook.php">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required class="form-input">
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-input" onchange="toggleFields(this.value)">
                    <option value="recipe">Recipe</option>
                    <option value="tip">Cooking Tip</option>
                    <option value="experience">Culinary Experience</option>
                </select>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required class="form-input" rows="3"></textarea>
            </div>

            <div class="form-group" id="ingredientsGroup">
                <label>Ingredients (For Recipes)</label>
                <textarea name="ingredients" class="form-input" rows="3"></textarea>
            </div>

            <div class="form-group" id="contentGroup" style="display:none;">
                <label>Detailed Content (For Tips/Experiences)</label>
                <textarea name="content" class="form-input" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-input">
            </div>
            
            <button type="submit" name="create_community_recipe" class="submit-btn">Share</button>
        </form>
    </div>

    <script>
        function toggleFields(category) {
            if(category === 'recipe') {
                document.getElementById('ingredientsGroup').style.display = 'block';
                document.getElementById('contentGroup').style.display = 'none';
            } else {
                document.getElementById('ingredientsGroup').style.display = 'none';
                document.getElementById('contentGroup').style.display = 'block';
            }
        }
    </script>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js"></script>
</body>
</html>
