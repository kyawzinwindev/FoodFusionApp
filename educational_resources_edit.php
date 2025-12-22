<?php 
require("./database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM resources WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resource - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="form-container section">
        <h2>Edit Educational Resource</h2>
        <form action="./controllers/client/ClientEducationalController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="redirect" value="../../educational_resources.php">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>" required class="form-input">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required class="form-input" rows="4"><?php echo $row['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Content (Optional)</label>
                <textarea name="content" class="form-input" rows="4"><?php echo $row['content']; ?></textarea>
            </div>

            <div class="form-group">
                <label>File (Leave blank to keep current)</label>
                <input type="file" name="file" class="form-input">
                <?php if($row['file_url']): ?>
                    <small>Current: <a href="<?php echo $row['file_url']; ?>" target="_blank">View File</a></small>
                <?php endif; ?>
            </div>

            <button type="submit" name="update_resource" class="submit-btn">Update Resource</button>
        </form>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
