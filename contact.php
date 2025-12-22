<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require("./components/navbar.php") ?>

    <div class="form-container section">
        <h2>Contact Us</h2>
        <p style="margin-bottom: 20px; color: #666;">Have questions or feedback? We'd love to hear from you!</p>
        
        <?php if(isset($_GET['msg'])): ?>
            <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <form action="./controllers/ContactController.php" method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required class="form-input">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required class="form-input">
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-input" placeholder="Check this out">
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" required class="form-input" rows="6"></textarea>
            </div>

            <button type="submit" name="send_message" class="submit-btn">Send Message</button>
        </form>
    </div>

    <?php require("./components/footer.php") ?>
    <script src="./js/app.js"></script>
</body>
</html>
