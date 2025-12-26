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

    <!-- Main About Section -->
    <section class="intro-section" style="padding-top: 120px; padding-bottom: 50px;">
        <div class="intro-content">
            <h1>About FoodFusion</h1>
            <p>FoodFusion is a vibrant culinary platform built to inspire creativity in every kitchen. Our mission is to bring food lovers together by offering diverse recipes, helpful cooking tips, and a welcoming space for home chefs to share their passion. We celebrate global flavors, encourage community-driven cooking, and empower individuals to explore, learn, and grow through food.</p>
            
            <div class="about-socials">
                <a href="https://www.facebook.com/FoodFusionPK/"><img src="resources/icon_fb.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/foodfusionpk/"><img src="resources/icon_insta.png" alt="Instagram"></a>
                <a href="https://twitter.com/foodfusionpk"><img src="resources/icon_twitter.png" alt="Twitter"></a>
            </div>
        </div>
        <img src="resources/about_main.jpg" class="intro-img">
    </section>

    <!-- Zig Zag Sections -->
    <section class="culinary-trends" style="padding-top: 20px;">
        
        <!-- Philosophy -->
        <div class="zigzag-row">
            <div class="zigzag-img">
                <img src="resources/philosophy.jpg" alt="Our Philosophy">
            </div>
            <div class="zigzag-content">
                <h3>Our Philosophy</h3>
                <p>We believe that food is a universal language capable of bringing people together. At FoodFusion, we celebrate the beauty of blending cultures, flavors, and traditions, encouraging creativity in every kitchen and inspiring memorable, delicious experiences for everyone.</p>
            </div>
        </div>

        <!-- Values -->
        <div class="zigzag-row">
            <div class="zigzag-img">
                <img src="resources/values.jpg" alt="Our Values">
            </div>
            <div class="zigzag-content">
                <h3>Our Values</h3>
                <p>Quality, creativity, inclusivity, and a genuine love for food guide everything we do. We are committed to sharing reliable, thoughtfully crafted content that empowers both beginners and seasoned cooks to explore, experiment, and enjoy the process of cooking.</p>
            </div>
        </div>

        <!-- Team -->
        <div class="zigzag-row">
            <div class="zigzag-img">
                <img src="resources/team.jpg" alt="Our Team">
            </div>
            <div class="zigzag-content">
                <h3>Our Team</h3>
                 <p>Our team is a passionate group of chefs, home cooks, food lovers, and creative storytellers. Together, we work to bring fresh ideas, inspiring recipes, and meaningful culinary experiences to a global community of food enthusiasts.</p>
            </div>
        </div>

    </section>

    <!-- Footer -->
    <?php require("./components/footer.php") ?>

    <script src="./js/app.js" defer></script>
</body>

</html>