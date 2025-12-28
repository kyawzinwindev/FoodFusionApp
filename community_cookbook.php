<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Cookbook - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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

            $sql = "SELECT community_cookbook.*, (SELECT COUNT(*) FROM comments WHERE community_recipe_id = community_cookbook.id) as comment_count FROM community_cookbook";
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
                            
                            <div style="margin-top:10px; margin-bottom:10px;">
                                <small><strong>
                                    <?php if($row['category'] == 'recipe' && !empty($row['ingredients'])): ?>
                                        Ingredients: <?php echo substr($row['ingredients'], 0, 30) . '...'; ?>
                                    <?php elseif(!empty($row['content'])): ?>
                                        Content: <?php echo substr($row['content'], 0, 30) . '...'; ?>
                                    <?php endif; ?>
                                </strong></small>
                            </div>
                            
                            <div class="card-actions" style="justify-content: flex-start; padding-top:10px;">
                                <!-- View -->
                                <a href="community_view.php?id=<?php echo $row['id']; ?>" class="btn-link" title="View" style="width:auto; display:inline-block; margin:0; background:#777;"><i class="fa fa-eye"></i></a>

                                <!-- Comment -->
                                <a href="community_view.php?id=<?php echo $row['id']; ?>#comments" class="btn-link" title="Comments" style="width:auto; display:inline-block; margin:0; background:#FF7A30;">
                                    <i class="fa fa-comment"></i> <?php echo $row['comment_count']; ?>
                                </a>

                                <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
                                    <!-- Edit -->
                                    <a href="community_cookbook_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="width: auto; padding: 6px 12px; display:inline-block; text-align:center;" title="Edit"><i class="fa fa-edit"></i></a>
                                    
                                    <!-- Delete -->
                                    <form action="./controllers/client/ClientCommunityController.php" method="POST" style="display:inline; width: auto;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="redirect" value="../../community_cookbook.php">
                                        <button type="submit" name="delete_community_recipe" class="btn-delete" style="width:auto; padding: 6px 12px;" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php endif; ?>
                            </div>
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
