<?php require("./database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM resources WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['title']; ?> - Resource</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">

</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="view-header resource">
        <h1><?php echo $row['title']; ?></h1>
        <p><?php echo ucfirst($row['resource_type']); ?> Resource • Added on <?php echo date('F j, Y', strtotime($row['created_at'])); ?></p>
    </div>

    <div class="container section">
        
        <div class="detail-section">
            <div class="resource-preview">
                <?php if(strpos($row['file_type'], 'image') !== false || empty($row['file_type'])): ?>
                    <img src="<?php echo $row['file_url']; ?>" alt="Resource">
                <?php elseif(strpos($row['file_type'], 'video') !== false): ?>
                    <video controls style="width: 100%; max-height: 500px; border-radius: 8px;">
                        <source src="<?php echo $row['file_url']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php elseif(strpos($row['file_type'], 'pdf') !== false): ?>
                    <embed src="<?php echo $row['file_url']; ?>" type="application/pdf" width="100%" height="600px" style="border-radius: 8px;">
                <?php else: ?>
                    <div class="resource-icon-placeholder">
                        📄 <?php echo ucfirst($row['file_type']); ?> File
                    </div>
                <?php endif; ?>
            </div>

            <div style="margin-bottom: 30px;">
                <h2>About this Resource</h2>
                <div class="detail-text">
                    <?php echo $row['description']; ?>
                </div>
            </div>

            <?php if(!empty($row['content'])): ?>
            <div style="margin-bottom: 30px;">
                <h2>Content</h2>
                <div class="detail-text">
                   <?php echo $row['content']; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="view-actions">
                <a href="<?php echo $row['file_url']; ?>" download class="btn-primary download-btn">Download / View File</a>
            </div>

            <?php 
            $controller = ($row['resource_type'] == 'culinary') ? 'ClientCulinaryController.php' : 'ClientEducationalController.php';
            $edit_page = ($row['resource_type'] == 'culinary') ? 'culinary_resources_edit.php' : 'educational_resources_edit.php';
            ?>
            
             <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                <div class="divider"></div>
                <div class="view-actions">
                     <form action="./controllers/client/<?php echo $controller; ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="redirect" value="../../<?php echo $row['resource_type']; ?>_resources.php">
                        <button type="submit" name="delete_resource" class="btn-delete btn-view-action" onclick="return confirm('Are you sure?')">Delete Resource</button>
                    </form>
                    <a href="<?php echo $edit_page; ?>?id=<?php echo $row['id']; ?>" class="btn-edit btn-view-action">Edit Resource</a>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
