<?php include("../database/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Community Recipe</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Add Community Recipe</h1>
            <a href="community_cookbook.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminCommunityController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?? 1; ?>"> 

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
                    <label>Content (For Tips/Experiences)</label>
                    <textarea name="content" class="form-input" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <button type="submit" name="create_community_recipe" class="submit-btn">Add Item</button>
            </form>
        </div>
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
</body>
</html>
