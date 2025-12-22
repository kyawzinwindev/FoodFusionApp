<?php 
require("./database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM community_cookbook WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

// Security check: ideally check if session user id matches recipe user id
// if($_SESSION['id'] != $row['user_id']) { header("Location: community_cookbook.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="form-container section">
        <h2>Edit Post</h2>
        <form action="./controllers/client/ClientCommunityController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="redirect" value="../../community_cookbook.php">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>" required class="form-input">
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-input" onchange="toggleFields(this.value)">
                    <option value="recipe" <?php if($row['category']=='recipe') echo 'selected'; ?>>Recipe</option>
                    <option value="tip" <?php if($row['category']=='tip') echo 'selected'; ?>>Cooking Tip</option>
                    <option value="experience" <?php if($row['category']=='experience') echo 'selected'; ?>>Culinary Experience</option>
                </select>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required class="form-input" rows="4"><?php echo $row['description']; ?></textarea>
            </div>

            <div class="form-group" id="ingredientsGroup" style="<?php echo ($row['category']=='recipe') ? 'display:block;' : 'display:none;'; ?>">
                <label>Ingredients (For Recipes)</label>
                <textarea name="ingredients" class="form-input" rows="3"><?php echo $row['ingredients']; ?></textarea>
            </div>

            <div class="form-group" id="contentGroup" style="<?php echo ($row['category']!='recipe') ? 'display:block;' : 'display:none;'; ?>">
                <label>Detailed Content (For Tips/Experiences)</label>
                <textarea name="content" class="form-input" rows="5"><?php echo $row['content']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Image (Leave blank to keep current)</label>
                <input type="file" name="image" class="form-input">
                <?php if($row['image']): ?>
                    <div style="margin-top:5px;">
                        <small>Current Image:</small><br>
                        <img src="<?php echo $row['image']; ?>" style="width: 100px; border-radius: 5px;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" name="update_community_recipe" class="submit-btn">Update</button>
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
