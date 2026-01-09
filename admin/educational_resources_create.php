<?php include("../database/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Educational Resource</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">

    <?php include("sidebar.php"); ?>

    <div class="main-content">
        <button class="admin-hamburger" id="adminBurger">☰</button>
        <div class="admin-header">
            <h1>Add Educational Resource</h1>
            <a href="educational_resources.php" class="admin-btn">Back</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="../controllers/admin/AdminEducationalResourcesController.php" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" required class="form-input">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required class="form-input" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Content (Optional Text)</label>
                    <textarea name="content" class="form-input" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>File Type</label>
                    <select name="file_type" id="fileTypeSelect" class="form-input">
                        <option value="image">Image</option>
                        <option value="pdf">PDF</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Upload File</label>
                    <input type="file" name="file" id="fileInput" class="form-input">
                </div>

                <button type="submit" name="create_resource" class="submit-btn">Add Resource</button>
            </form>
        </div>
    </div>
    <script src="../js/admin.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileTypeSelect = document.getElementById('fileTypeSelect');
            const fileInput = document.getElementById('fileInput');

            function updateAcceptAttribute() {
                const type = fileTypeSelect.value;
                if (type === 'image') {
                    fileInput.accept = 'image/*';
                } else if (type === 'video') {
                    fileInput.accept = 'video/*';
                } else if (type === 'pdf') {
                    fileInput.accept = 'application/pdf';
                } else {
                    fileInput.removeAttribute('accept');
                }
            }

            // Initial call
            updateAcceptAttribute();

            // On change
            fileTypeSelect.addEventListener('change', updateAcceptAttribute);
        });
    </script>
</body>
</html>
