<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Resources - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="page-header">
        <h1>Educational Resources</h1>
        <p>Learn about nutrition, food history, and sustainability.</p>
        <a href="educational_resources_create.php" class="create-btn">Add Resource</a>
    </div>

    <div class="container section">
        <!-- Search -->
        <div class="search-filter-container">
            <form method="GET" action="educational_resources.php" class="search-form" style="justify-content:center;">
                <input type="text" name="search" class="search-input" placeholder="Search by title, description..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="flex:1; max-width:600px;">
                <button type="submit" class="search-btn">Search</button>
                <?php if(isset($_GET['search'])): ?>
                    <a href="educational_resources.php" class="search-btn" style="background:#777; text-decoration:none; display:flex; align-items:center;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="card-grid">
            <?php
            $sql = "SELECT * FROM resources WHERE resource_type = 'educational'";
            
            if (!empty($_GET['search'])) {
                $search = $connection->real_escape_string($_GET['search']);
                $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
            }
            
            $sql .= " ORDER BY id DESC";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $file_url = !empty($row['file_url']) ? $row['file_url'] : 'https://placehold.co/600x400?text=Edu+Resource';
                     $display_img = (strpos($row['file_type'], 'image') !== false || empty($row['file_type'])) ? $file_url : 'https://placehold.co/600x400?text=File';
                    ?>
                    <div class="card">
                        <a href="resource_view.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo $display_img; ?>" alt="<?php echo $row['title']; ?>">
                        </a>
                        <div class="card-body">
                            <h3><a href="resource_view.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo $row['title']; ?></a></h3>
                            <p><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                            <a href="resource_view.php?id=<?php echo $row['id']; ?>" class="btn-link">View Resource</a>
                            
                            <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                            <div class="card-actions">
                                <form action="./controllers/client/ClientEducationalController.php" method="POST" style="display:inline; width: 32%;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="redirect" value="../../educational_resources.php">
                                    <button type="submit" name="delete_resource" class="btn-delete" style="width:100%" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="educational_resources_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="width: 32%; display:inline-block; text-align:center;">Edit</a>
                                <?php if(!empty($row['file_url'])): ?>
                                    <a href="<?php echo $row['file_url']; ?>" download class="btn-link" style="width: 32%; display:inline-block; text-align:center; background:#4CAF50; color:white; margin:0;">Download</a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No educational resources found.</p>";
            }
            ?>
        </div>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
