<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Cookbook - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="page-header custom-header">
        <h1>Community Cookbook</h1>
        <p>A collaborative space where members can share their favourite recipes, cooking tips and culinary experiences.</p>
        <?php if(isset($_SESSION['id'])): ?>
            <a href="community_cookbook_create.php" class="create-btn" >Share a Post</a>
        <?php else: ?>
            <p class="guest-message"><em><a href="#" onclick="openModal('loginModal')">Log in</a> to share your own recipes and tips!</em></p>
        <?php endif; ?>
    </div>

    <div class="container section">
        <!-- Search & Filter -->
        <div class="search-filter-container">
            <form method="GET" action="community_cookbook.php" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search by title, ingredients, content..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <select name="category" class="filter-select">
                    <option value="">All Categories</option>
                    <option value="recipe" <?php if(isset($_GET['category']) && $_GET['category'] == 'recipe') echo 'selected'; ?>>Recipe</option>
                    <option value="tip" <?php if(isset($_GET['category']) && $_GET['category'] == 'tip') echo 'selected'; ?>>Cooking Tip</option>
                    <option value="experience" <?php if(isset($_GET['category']) && $_GET['category'] == 'experience') echo 'selected'; ?>>Culinary Experience</option>
                </select>
                <button type="submit" class="search-btn">Search</button>
                <?php if(isset($_GET['search']) || isset($_GET['category'])): ?>
                    <a href="community_cookbook.php" class="search-btn" style="background:#777; text-decoration:none; display:flex; align-items:center;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="card-grid">
            <?php
            $where_clauses = [];
            if (!empty($_GET['search'])) {
                $search = $connection->real_escape_string($_GET['search']);
                $where_clauses[] = "(title LIKE '%$search%' OR description LIKE '%$search%' OR ingredients LIKE '%$search%' OR content LIKE '%$search%')";
            }
            if (!empty($_GET['category'])) {
                $category = $connection->real_escape_string($_GET['category']);
                $where_clauses[] = "category = '$category'";
            }

            $sql = "SELECT * FROM community_cookbook";
            if (!empty($where_clauses)) {
                $sql .= " WHERE " . implode(" AND ", $where_clauses);
            }
            $sql .= " ORDER BY id DESC";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/600x400?text=No+Image';
                    ?>
                    <div class="card">
                        <a href="community_view.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo $image; ?>" alt="<?php echo $row['title']; ?>">
                        </a>
                        <div class="card-body">
                            <span class="badge"><?php echo ucfirst($row['category']); ?></span>
                            <h3><a href="community_view.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo $row['title']; ?></a></h3>
                            <p><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                            
                            <?php if($row['category'] == 'recipe' && !empty($row['ingredients'])): ?>
                                <small><strong>Ingredients:</strong> <?php echo substr($row['ingredients'], 0, 50) . '...'; ?></small>
                            <?php elseif(!empty($row['content'])): ?>
                                <small><strong>Content:</strong> <?php echo substr($row['content'], 0, 50) . '...'; ?></small>
                            <?php endif; ?>
                            
                            <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                            <div class="card-actions">
                                <form action="./controllers/client/ClientCommunityController.php" method="POST" style="display:inline; width: 50%;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="redirect" value="../../community_cookbook.php">
                                    <button type="submit" name="delete_community_recipe" class="btn-delete" style="width:100%" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="community_cookbook_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="width: 48%; display:inline-block; text-align:center;">Edit</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No community recipes found yet. Be the first to share!</p>";
            }
            ?>
        </div>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
