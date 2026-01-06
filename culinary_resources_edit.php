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
        <h2>Edit Culinary Resource</h2>
        <form action="./controllers/client/ClientCulinaryController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="redirect" value="../../culinary_resources.php">

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
                <label>File Type</label>
                <select name="file_type" class="form-input">
                    <option value="image" <?php if($row['file_type'] == 'image') echo 'selected'; ?>>Image</option>
                    <option value="video" <?php if($row['file_type'] == 'video') echo 'selected'; ?>>Video</option>
                    <option value="pdf" <?php if($row['file_type'] == 'pdf') echo 'selected'; ?>>PDF</option>
                    <option value="file" <?php if($row['file_type'] == 'file') echo 'selected'; ?>>File</option>
                </select>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileTypeSelect = document.querySelector('select[name="file_type"]');
            const fileInput = document.querySelector('input[type="file"]');
            
            function updateFileAccept() {
                const type = fileTypeSelect.value;
                if (type === 'image') {
                    fileInput.setAttribute('accept', 'image/*');
                } else if (type === 'video') {
                    fileInput.setAttribute('accept', 'video/*');
                } else if (type === 'pdf') {
                    fileInput.setAttribute('accept', 'application/pdf');
                } else {
                    fileInput.removeAttribute('accept');
                }
            }

            if(fileTypeSelect && fileInput) {
                fileTypeSelect.addEventListener('change', updateFileAccept);
                updateFileAccept(); 
            }
        });
    </script>
</body>
</html>
