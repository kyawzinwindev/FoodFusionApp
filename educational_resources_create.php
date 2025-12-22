<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Educational Resource - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="form-container section">
        <h2>Add Educational Resource</h2>
        <form action="./controllers/client/ClientEducationalController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="redirect" value="../../educational_resources.php">
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required class="form-input">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required class="form-input" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Content (Optional Text)</label>
                <textarea name="content" class="form-input" rows="6"></textarea>
            </div>

            <div class="form-group">
                <label>File Type</label>
                <select name="file_type" class="form-input">
                    <option value="image">Image</option>
                    <option value="pdf">PDF</option>
                    <option value="video">Video</option>
                </select>
            </div>

            <div class="form-group">
                <label>Upload File</label>
                <input type="file" name="file" class="form-input">
            </div>

            <button type="submit" name="create_resource" class="submit-btn">Add Resource</button>
        </form>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js"></script>
</body>
</html>
