<?php require("./database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM recipes WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['title']; ?> - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">

</head>
<body>
    <?php require("./components/navbar.php") ?>

    <?php 
    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/1200x600?text=Delicious';
    ?>
    <div class="view-header" style="background-image: url('<?php echo $image; ?>');">
        <div class="view-header-content">
            <span class="badge" style="font-size: 1em; padding: 5px 15px;"><?php echo $row['cuisine_type']; ?></span>
            <h1 style="font-size: 3.5em; margin: 10px 0;"><?php echo $row['title']; ?></h1>
            <div class="detail-meta">
                <span><strong>Difficulty:</strong> <?php echo $row['difficulty']; ?></span>
                <span><strong>Diet:</strong> <?php echo $row['dietary_preference']; ?></span>
                <span><strong>Date:</strong> <?php echo date('F j, Y', strtotime($row['created_at'])); ?></span>
            </div>
        </div>
    </div>

    <div class="container section">
        
        <div class="detail-section">
            <h2>Description</h2>
            <div class="detail-text"><?php echo $row['description']; ?></div>
        </div>

        <div class="detail-section">
            <h2>Ingredients</h2>
            <div class="detail-text detail-text-box"><?php echo $row['ingredients']; ?></div>
        </div>

        <!-- If instructions were separate, show here. Assuming included in description or we only have description/ingredients -->
        
        <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
            <div class="detail-section view-actions">
                <form action="./controllers/client/ClientRecipesController.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="redirect" value="../../recipes.php">
                    <button type="submit" name="delete_recipe" class="btn-delete btn-view-action" onclick="return confirm('Are you sure?')">Delete Recipe</button>
                </form>
                <a href="recipes_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit btn-view-action">Edit Recipe</a>
            </div>
        <?php endif; ?>

    </div>

    <?php require("./components/footer.php") ?>
    <!-- Ensure modal JS works if login needed on header -->
    <script src="./js/app.js"></script>
</body>
</html>
