<?php 
include("../database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM recipes WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Edit Recipe</h1>
            <a href="recipes.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminRecipesController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="redirect" value="../../admin/recipes.php">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>" required class="form-input">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required class="form-input" rows="3"><?php echo $row['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Ingredients</label>
                    <textarea name="ingredients" required class="form-input" rows="3"><?php echo $row['ingredients']; ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Cuisine</label>
                         <select name="cuisine_type" class="form-input">
                            <option value="Italian" <?php if($row['cuisine_type']=='Italian') echo 'selected'; ?>>Italian</option>
                            <option value="Asian" <?php if($row['cuisine_type']=='Asian') echo 'selected'; ?>>Asian</option>
                            <option value="Mexican" <?php if($row['cuisine_type']=='Mexican') echo 'selected'; ?>>Mexican</option>
                            <option value="American" <?php if($row['cuisine_type']=='American') echo 'selected'; ?>>American</option>
                            <option value="Other" <?php if($row['cuisine_type']=='Other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Difficulty</label>
                         <select name="difficulty" class="form-input">
                            <option value="Easy" <?php if($row['difficulty']=='Easy') echo 'selected'; ?>>Easy</option>
                            <option value="Medium" <?php if($row['difficulty']=='Medium') echo 'selected'; ?>>Medium</option>
                            <option value="Hard" <?php if($row['difficulty']=='Hard') echo 'selected'; ?>>Hard</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                     <label>Dietary Preference</label>
                    <select name="dietary_preference" class="form-input">
                        <option value="None" <?php if($row['dietary_preference']=='None') echo 'selected'; ?>>None</option>
                        <option value="Vegetarian" <?php if($row['dietary_preference']=='Vegetarian') echo 'selected'; ?>>Vegetarian</option>
                        <option value="Vegan" <?php if($row['dietary_preference']=='Vegan') echo 'selected'; ?>>Vegan</option>
                        <option value="Gluten-Free" <?php if($row['dietary_preference']=='Gluten-Free') echo 'selected'; ?>>Gluten-Free</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Image (Leave blank to keep current)</label>
                    <input type="file" name="image" class="form-input">
                    <?php if($row['image']): ?>
                        <small>Current: <a href="../../FoodFusionApp/<?php echo $row['image']; ?>" target="_blank">View File</a></small>
                    <?php endif; ?>
                </div>
                <button type="submit" name="update_recipe" class="submit-btn">Update Recipe</button>
            </form>
        </div>
    </div>
    <script src="../js/admin.js"></script>
</body>
</html>
