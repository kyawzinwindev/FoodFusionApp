<?php require("./database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM community_cookbook WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['title']; ?> - FoodFusion Community</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">

</head>
<body>
    <?php require("./components/navbar.php") ?>

    <?php 
    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/1200x600?text=Community';
    ?>
    <div class="view-header" style="background-image: url('<?php echo $image; ?>');">
        <div class="view-header-content">
            <span class="badge" style="font-size: 1em; padding: 5px 15px;"><?php echo ucfirst($row['category']); ?></span>
            <h1 style="font-size: 3em; margin: 10px 0;"><?php echo $row['title']; ?></h1>
            <p>Posted by Member #<?php echo $row['user_id']; ?> on <?php echo date('F j, Y', strtotime($row['created_at'])); ?></p>
        </div>
    </div>

    <div class="container section">
        
        <div class="detail-section">
            <h2 style="color:#ff7a30; margin-bottom:15px;">Description</h2>
            <div class="detail-text"><?php echo $row['description']; ?></div>
        </div>

        <?php if(!empty($row['ingredients'])): ?>
        <div class="detail-section">
            <h2 style="color:#ff7a30; margin-bottom:15px;">Ingredients</h2>
            <div class="detail-text"><?php echo $row['ingredients']; ?></div>
        </div>
        <?php endif; ?>

        <?php if(!empty($row['content'])): ?>
        <div class="detail-section">
            <h2 style="color:#ff7a30; margin-bottom:15px;">Full Content</h2>
            <div class="detail-text"><?php echo $row['content']; ?></div>
        </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
            <div class="detail-section view-actions">
                 <form action="./controllers/client/ClientCommunityController.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="redirect" value="../../community_cookbook.php">
                    <button type="submit" name="delete_community_recipe" class="btn-delete btn-view-action" onclick="return confirm('Are you sure?')">Delete Post</button>
                </form>
                <a href="community_cookbook_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit btn-view-action">Edit Post</a>
            </div>
        <?php endif; ?>

    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js"></script>
</body>
</html>
