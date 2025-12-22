<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FoodFusion Home Page</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- Navigation -->
    <?php require("./components/navbar.php") ?>

    <!-- Hero -->
    <section class="intro-section">
        <div class="intro-content">
            <h1>Welcome to FoodFusion</h1>
            <p>FoodFusion is dedicated to bringing people together through the joy of delicious, high-quality food. Our mission is to blend authentic flavors with modern creativity, offering meals that are not only satisfying but also crafted with care. We aim to inspire a love for good food, promote healthier choices, and deliver an unforgettable culinary experience—whether enjoyed at home or shared with friends and family.</p>
            <?php if (isset($_SESSION['id'])): ?>
                <a class="join-btn" href="./community_cookbook.php">Explore</a>
            <?php else: ?>
                <button class="join-btn" onclick="openModal('registerModal')">Join Us</button>
            <?php endif; ?>
        </div>
        <img src="resources/hero.jpg" class="intro-img">
    </section>

    <!-- FEATURED RECIPES -->
    <section class="featured">
        <h2>Featured Recipes</h2>
        <div class="recipe-container">
            <?php
            // Fetch 3 recipes
            $sql_recipes = "SELECT * FROM recipes ORDER BY created_at DESC LIMIT 3";
            $res_recipes = $connection->query($sql_recipes);

            if ($res_recipes->num_rows > 0) {
                while($row = $res_recipes->fetch_assoc()) {
                    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/600x400?text=No+Image';
                    
                    // Logic for Link
                    $recipeHref = "javascript:void(0)";
                    $recipeOnclick = "openModal('registerModal')"; // Using registerModal or loginModal? User said "login modal". 
                    // Wait, previous code used registerModal for "Join Us" and loginModal for others. User said "open the login modal".
                    // I will use 'loginModal'.
                    
                    if(isset($_SESSION['id'])) {
                        $recipeHref = "recipes.php";
                        $recipeOnclick = "";
                    } else {
                        $recipeHref = "#";
                        $recipeOnclick = "openModal('loginModal'); return false;";
                    }
            ?>
                <div class="recipe-card">
                    <a href="<?php echo $recipeHref; ?>" onclick="<?php echo $recipeOnclick; ?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $row['title']; ?>">
                    </a>
                    <div class="card-body">
                        <!-- 1. Name -->
                        <h3 style="margin-top:0;"><?php echo $row['title']; ?></h3>
                        
                        <!-- 2. Cuisine Type -->
                        <span class="cuisine-tag"><?php echo $row['cuisine_type']; ?></span>

                        <!-- 3. Paragraph (Description) -->
                        <p><?php echo substr($row['description'], 0, 80) . '...'; ?></p>

                        <?php
                            $diffLower = strtolower($row['difficulty']);
                            $diffClass = 'medium';
                            if($diffLower == 'easy') $diffClass = 'easy';
                            if($diffLower == 'hard') $diffClass = 'hard';
                        ?>
                        
                        <!-- 4. Difficulty & Vegetarian (Space Around) -->
                        <div class="meta-info-centered">
                            <span class="badge-diff <?php echo $diffClass; ?>"><?php echo $row['difficulty']; ?></span>
                            <span class="badge-diet"><?php echo $row['dietary_preference']; ?></span>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
                // FALLBACK STATIC DATA
                $static_recipes = [
                    [
                        'id' => 0,
                        'title' => 'Classic Margherita Pizza',
                        'description' => 'A simple yet delicious classic pizza with fresh basil, mozzarella, and tomato sauce.',
                        'cuisine_type' => 'Italian',
                        'difficulty' => 'Medium',
                        'dietary_preference' => 'Vegetarian',
                        'image' => 'resources/recipe1.jpg'
                    ],
                    [
                        'id' => 0,
                        'title' => 'Spicy Ramen Bowl',
                        'description' => 'A warming bowl of spicy ramen with soft-boiled eggs, green onions, and savory broth.',
                        'cuisine_type' => 'Japanese',
                        'difficulty' => 'Hard',
                        'dietary_preference' => 'Non-Vegetarian',
                        'image' => 'resources/recipe2.jpg'
                    ],
                    [
                        'id' => 0,
                        'title' => 'Avocado Toast Deluxe',
                        'description' => 'Healthy and filling avocado toast topped with cherry tomatoes, radish, and poached eggs.',
                        'cuisine_type' => 'American',
                        'difficulty' => 'Easy',
                        'dietary_preference' => 'Vegetarian',
                        'image' => 'resources/recipe3.jpg'
                    ]
                ];

                foreach($static_recipes as $row) {
                    $image = $row['image'];
                    
                     // Logic for Link
                    $recipeHref = "";
                    $recipeOnclick = "";
                    
                    if(isset($_SESSION['id'])) {
                        $recipeHref = "recipes.php";
                        $recipeOnclick = "";
                    } else {
                        $recipeHref = "#";
                        $recipeOnclick = "openModal('loginModal'); return false;";
                    }
            ?>
                <div class="recipe-card">
                     <a href="<?php echo $recipeHref; ?>" onclick="<?php echo $recipeOnclick; ?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $row['title']; ?>">
                    </a>
                    <div class="card-body">
                        <!-- 1. Name -->
                        <h3 style="margin-top:0;"><?php echo $row['title']; ?></h3>
                        
                        <!-- 2. Cuisine Type -->
                        <span class="cuisine-tag"><?php echo $row['cuisine_type']; ?></span>

                        <!-- 3. Paragraph (Description) -->
                        <p><?php echo substr($row['description'], 0, 80) . '...'; ?></p>

                        <?php
                            $diffLower = strtolower($row['difficulty']);
                            $diffClass = 'medium';
                            if($diffLower == 'easy') $diffClass = 'easy';
                            if($diffLower == 'hard') $diffClass = 'hard';
                        ?>
                        
                        <!-- 4. Difficulty & Vegetarian (Space Around) -->
                        <div class="meta-info-centered">
                            <span class="badge-diff <?php echo $diffClass; ?>"><?php echo $row['difficulty']; ?></span>
                            <span class="badge-diet"><?php echo $row['dietary_preference']; ?></span>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </section>

    <!-- CULINARY TRENDS -->
    <section class="culinary-trends">
        <h2>Culinary Trends</h2>
        
        <?php
        // Fetch 2 resources
        $sql_trends = "SELECT * FROM resources ORDER BY created_at DESC LIMIT 2";
        $res_trends = $connection->query($sql_trends);

        if ($res_trends->num_rows > 0) {
            $count = 0;
            while($trend = $res_trends->fetch_assoc()) {
                $count++;
                // Check auth
                $trendAction = "";
                if(isset($_SESSION['id'])) {
                    $trendAction = "window.location.href='culinary_resources.php'";
                } else {
                    $trendAction = "openModal('loginModal')";
                }
                
                $trendImage = !empty($trend['file_url']) ? $trend['file_url'] : 'https://placehold.co/600x400?text=Trend';
        ?>
        <div class="zigzag-row">
            <div class="zigzag-img" onclick="<?php echo $trendAction; ?>" style="cursor: pointer;">
                <img src="<?php echo $trendImage; ?>" alt="<?php echo $trend['title']; ?>">
            </div>
            <div class="zigzag-content">
                <h3><?php echo $trend['title']; ?></h3>
                <p><?php echo substr($trend['description'], 0, 150) . '...'; ?></p>
                <button class="join-btn" onclick="<?php echo $trendAction; ?>">Explore</button>
            </div>
        </div>
        <?php
            }
        } else {
             // FALLBACK STATIC DATA
             $static_trends = [
                [
                    'title' => 'Sustainable Cooking',
                    'description' => 'Learn how to cook with the environment in mind. Discover zero-waste recipes and sustainable ingredient sourcing.',
                    'file_url' => 'resources/trend1.jpg'
                ],
                [
                    'title' => 'The Art of Plating',
                    'description' => 'Elevate your dishes with professional plating techniques. Make your food look as good as it tastes.',
                    'file_url' => 'resources/trend2.jpg'
                ]
             ];
             
             foreach($static_trends as $trend) {
                 $trendImage = $trend['file_url'];
                 $trendAction = "";
                 if(isset($_SESSION['id'])) {
                     $trendAction = "window.location.href='culinary_resources.php'";
                 } else {
                     $trendAction = "openModal('loginModal')";
                 }
        ?>
        <div class="zigzag-row">
            <div class="zigzag-img" onclick="<?php echo $trendAction; ?>" style="cursor: pointer;">
                <img src="<?php echo $trendImage; ?>" alt="<?php echo $trend['title']; ?>">
            </div>
            <div class="zigzag-content">
                <h3><?php echo $trend['title']; ?></h3>
                <p><?php echo substr($trend['description'], 0, 150) . '...'; ?></p>
                <button class="join-btn" onclick="<?php echo $trendAction; ?>">Explore</button>
            </div>
        </div>
        <?php
             }
        }
        ?>
    </section>

    <!-- EVENT CAROUSEL -->
    <section class="carousel-section">
        <h2>Upcoming Events</h2>

        <div class="carousel" id="eventCarousel">
            <div class="slide">
                <img src="resources/carousel1.jpg">
                <p>Exclusive Dining Experience</p>
            </div>
            <div class="slide">
                <img src="resources/carousel2.jpg">
                <p>Wine & Cheese Tasting</p>
            </div>
            <div class="slide">
                <img src="resources/carousel3.jpg">
                <p>Masterclass: Culinary Arts</p>
            </div>
             <div class="slide">
                <img src="resources/carousel4.jpg">
                <p>Summer BBQ Festival</p>
            </div>
             <div class="slide">
                <img src="resources/carousel5.jpg">
                <p>Gourmet Buffet Night</p>
            </div>
        </div>

        <!-- DOTS -->
        <div class="carousel-dots" id="carouselDots"></div>
    </section>

    <!-- Footer -->
    <?php require("./components/footer.php") ?>

    <!-- Redesigned COOKIE CONSENT -->
    <div id="cookieConsent">
        <div class="cookie-wrapper">
            <p>
                🍪 This website uses cookies to ensure you get the best experience.
                Read our <a href="./privacy.php">Privacy Policy</a> and <a href="./cookie.php">Cookies Policy</a> 
            </p>
            <button id="acceptCookieBtn">Accept Cookies</button>
        </div>
    </div>

    <script src="./js/app.js" defer></script>
</body>

</html>