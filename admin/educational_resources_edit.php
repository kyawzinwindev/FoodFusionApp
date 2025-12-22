<?php 
include("../database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM resources WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Educational Resource</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Edit Educational Resource</h1>
            <a href="educational_resources.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminEducationalResourcesController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>" required class="form-input">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required class="form-input" rows="3"><?php echo $row['description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-input" rows="4"><?php echo $row['content']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>File (Leave blank to keep current)</label>
                    <input type="file" name="file" class="form-input">
                    <?php if($row['file_url']): ?>
                         <small>Current: <a href="../../FoodFusionApp/<?php echo $row['file_url']; ?>" target="_blank">View File</a></small>
                    <?php endif; ?>
                </div>

                <button type="submit" name="update_resource" class="submit-btn">Update Resource</button>
            </form>
        </div>
    </div>
    <script src="../js/admin.js" defer></script>
</body>
</html>
