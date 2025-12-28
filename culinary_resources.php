<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Resources - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="page-header">
        <h1>Culinary Resources</h1>
        <p>Explore guides, tips, and tools to elevate your cooking.</p>
        <a href="culinary_resources_create.php" class="create-btn">Add Resource</a>
    </div>

    <div class="container section">
        <!-- Search -->
        <div class="search-filter-container">
            <form method="GET" action="culinary_resources.php" class="search-form" style="justify-content:center;">
                <input type="text" name="search" class="search-input" placeholder="Search by title, description..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="flex:1; max-width:600px;">
                <button type="submit" class="search-btn">Search</button>
                <?php if(isset($_GET['search'])): ?>
                    <a href="culinary_resources.php" class="search-btn" style="background:#777; text-decoration:none; display:flex; align-items:center;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="card-grid">
            <?php
            $sql = "SELECT * FROM resources WHERE resource_type = 'culinary'";
            
            if (!empty($_GET['search'])) {
                $search = $connection->real_escape_string($_GET['search']);
                $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
            }
            
            $sql .= " ORDER BY id DESC";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $file_url = !empty($row['file_url']) ? $row['file_url'] : 'https://placehold.co/600x400?text=Resource';
                    $display_img = (strpos($row['file_type'], 'image') !== false || empty($row['file_type'])) ? $file_url : 'https://placehold.co/600x400?text=File';
                    ?>
                    <div class="card">
                        <a href="resource_view.php?id=<?php echo $row['id']; ?>">
                            <?php if(strpos($row['file_type'], 'video') !== false): ?>
                                 <video src="<?php echo $row['file_url']; ?>" style="width:100%; height:200px; object-fit:cover;"></video>
                            <?php else: ?>
                                <img src="<?php echo $display_img; ?>" alt="<?php echo $row['title']; ?>">
                            <?php endif; ?>
                        </a>
                        <div class="card-body">
                            <span class="badge"><?php echo ucfirst(!empty($row['file_type']) ? $row['file_type'] : 'image'); ?></span>
                            <h3><a href="resource_view.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo $row['title']; ?></a></h3>
                            <p><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                            <div class="card-actions" style="justify-content: flex-start; padding-top:10px;">
                                <!-- View -->
                                <a href="resource_view.php?id=<?php echo $row['id']; ?>" class="btn-link" title="View Resource" style="width:auto; display:inline-block; margin:0; background:#777;"><i class="fa fa-eye"></i></a>
                                
                                <!-- Download -->
                                <?php if(!empty($row['file_url'])): ?>
                                    <a href="<?php echo $row['file_url']; ?>" download class="btn-link" style="width: auto; padding: 6px 12px; display:inline-block; text-align:center; background:#4CAF50; color:white; margin:0;" title="Download"><i class="fa fa-download"></i></a>
                                <?php endif; ?>

                                <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                                    <!-- Edit -->
                                    <a href="culinary_resources_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="width: auto; padding: 6px 12px; display:inline-block; text-align:center;" title="Edit"><i class="fa fa-edit"></i></a>

                                    <!-- Delete -->
                                    <form action="./controllers/client/ClientCulinaryController.php" method="POST" style="display:inline; width: auto;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="redirect" value="../../culinary_resources.php">
                                        <button type="submit" name="delete_resource" class="btn-delete" style="width:auto; padding: 6px 12px;" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No culinary resources found.</p>";
            }
            ?>
        </div>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
