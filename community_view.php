<?php require("./database/config.php"); 
$id = $_GET['id'];
$sql = "SELECT * FROM community_cookbook WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['title']; ?> - FoodFusion Community</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>
    <?php require("./components/navbar.php") ?>

    <?php 
    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/1200x600?text=Community';
    ?>
    <div class="view-header" style="background-image: url('<?php echo $image; ?>');">
        <div class="view-header-content">
            <span class="badge" style="font-size: 1em; padding: 5px 15px;"><?php echo ucfirst($row['category']); ?></span>
            <h1 style="font-size: 3em; margin: 10px 0;"><?php echo $row['title']; ?></h1>
            <p>Posted by Member #<?php echo $row['user_id']; ?> on <?php echo date('F j, Y', strtotime($row['created_at'])); ?></p>
        </div>
    </div>

    <div class="container section">
        
        <div class="detail-section">
            <h2 style="color:#ff7a30; margin-bottom:15px;">Description</h2>
            <div class="detail-text"><?php echo $row['description']; ?></div>
        </div>

        <?php if(!empty($row['ingredients'])): ?>
        <div class="detail-section">
            <h2 style="color:#ff7a30; margin-bottom:15px;">Ingredients</h2>
            <div class="detail-text"><?php echo $row['ingredients']; ?></div>
        </div>
        <?php endif; ?>

        <?php if(!empty($row['content'])): ?>
        <div class="detail-section">
            <h2 style="color:#ff7a30; margin-bottom:15px;">Full Content</h2>
            <div class="detail-text"><?php echo $row['content']; ?></div>
        </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['id']) && isset($row['user_id']) && $row['user_id'] == $_SESSION['id']): ?>
            <div class="detail-section view-actions">
                 <form action="./controllers/client/ClientCommunityController.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="redirect" value="../../community_cookbook.php">
                    <button type="submit" name="delete_community_recipe" class="btn-delete btn-view-action" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></button>
                </form>
                <a href="community_cookbook_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit btn-view-action" title="Edit"><i class="fa fa-edit"></i></a>
            </div>
        <?php endif; ?>

        <!-- Comments Section -->
        <div class="detail-section" id="comments">
            <h2 style="color:#ff7a30; margin-bottom:15px; display:flex; align-items:center; gap:10px;">
                <i class="fa fa-comments"></i> Comments
            </h2>
            
            <?php
            // Fetch Comments
            $comment_sql = "SELECT c.*, u.first_name, u.last_name, u.profile_image 
                            FROM comments c 
                            JOIN users u ON c.user_id = u.id 
                            WHERE c.community_recipe_id = $id 
                            ORDER BY c.created_at DESC";
            $comment_res = $connection->query($comment_sql);
            
            if ($comment_res->num_rows > 0) {
                while($comment = $comment_res->fetch_assoc()) {
                    $user_img = !empty($comment['profile_image']) ? 'uploads/profiles/' . $comment['profile_image'] : 'https://placehold.co/50x50?text=U';

                    if($comment['profile_image'] == 'default.png') {
                         $user_img = 'https://placehold.co/50x50?text=' . substr($comment['first_name'], 0, 1);
                    }
                    ?>
                    <div class="comment-item" style="border-bottom: 1px solid #eee; padding: 15px 0; display:flex; gap:15px;">
                        <img src="<?php echo $user_img; ?>" alt="User" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
                        <div>
                            <h4 style="margin:0; color:#333;"><?php echo $comment['first_name'] . ' ' . $comment['last_name']; ?> 
                                <span style="font-size:0.8em; color:#999; font-weight:normal;">• <?php echo date('M j, Y', strtotime($comment['created_at'])); ?></span>
                            </h4>
                            <p style="margin:5px 0 0; color:#555;"><?php echo htmlspecialchars($comment['comment']); ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='color:#777; font-style:italic;'>No comments yet. Be the first to share your thoughts!</p>";
            }
            ?>

            <!-- Comment Form -->
            <?php if(isset($_SESSION['id'])): ?>
                <div class="comment-form-container" style="margin-top:25px; padding-top:20px; border-top:2px solid #f0f0f0;">
                    <h3 style="margin-bottom:15px;">Leave a Comment</h3>
                    <form action="./controllers/client/ClientCommunityController.php" method="POST">
                        <input type="hidden" name="community_recipe_id" value="<?php echo $id; ?>">
                        <textarea name="comment" rows="3" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; resize:vertical; font-family:inherit;" placeholder="Write your comment here..." required></textarea>
                        <button type="submit" name="add_comment" class="search-btn" style="margin-top:10px;">Post Comment</button>
                    </form>
                </div>
            <?php else: ?>
                <p style="margin-top:20px;"><em><a href="#" onclick="openModal('loginModal')">Log in</a> to leave a comment.</em></p>
            <?php endif; ?>
        </div>

    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js" defer></script>
</body>
</html>
