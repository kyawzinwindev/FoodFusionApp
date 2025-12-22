<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FoodFusion About Page</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Navigation -->
    <?php require("./components/navbar.php") ?>

    <section class="about-section">
        <h1>About FoodFusion</h1>
        <p>FoodFusion is a vibrant culinary platform built to inspire creativity in every kitchen. Our mission is to bring food lovers together by offering diverse recipes, helpful cooking tips, and a welcoming space for home chefs to share their passion. We celebrate global flavors, encourage community-driven cooking, and empower individuals to explore, learn, and grow through food. Whether you're discovering new recipes, contributing to our community cookbook, or diving into culinary resources, FoodFusion is here to make your cooking journey exciting, accessible, and truly enjoyable.</p>

        <div class="about-grid">
            <div class="about-card">
                <h2>Our Philosophy</h2>
                <p>
                    We believe that food is a universal language capable of bringing people together.
                    At FoodFusion, we celebrate the beauty of blending cultures, flavors, and traditions,
                    encouraging creativity in every kitchen and inspiring memorable, delicious experiences for everyone.
                </p>
            </div>

            <div class="about-card">
                <h2>Our Values</h2>
                <p>
                    Quality, creativity, inclusivity, and a genuine love for food guide everything we do.
                    We are committed to sharing reliable, thoughtfully crafted content that empowers both
                    beginners and seasoned cooks to explore, experiment, and enjoy the process of cooking.
                </p>
            </div>

            <div class="about-card">
                <h2>Our Team</h2>
                <p>
                    Our team is a passionate group of chefs, home cooks, food lovers, and creative storytellers.
                    Together, we work to bring fresh ideas, inspiring recipes, and meaningful culinary experiences
                    to a global community of food enthusiasts.
                </p>
            </div>
        </div>

    </section>

    <!-- Footer -->
    <?php require("./components/footer.php") ?>

    <script src="./js/app.js"></script>
</body>

</html>