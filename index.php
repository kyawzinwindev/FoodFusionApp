<?php require("./database/config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FoodFusion Home Page</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            $sql_recipes = "SELECT * FROM recipes ORDER BY id ASC LIMIT 3";
            $res_recipes = $connection->query($sql_recipes);

            if ($res_recipes->num_rows > 0) {
                while($row = $res_recipes->fetch_assoc()) {
                    $image = !empty($row['image']) ? $row['image'] : 'https://placehold.co/600x400?text=No+Image';
                    
                    $recipeHref = "javascript:void(0)";
                    $recipeOnclick = "openModal('registerModal')"; 
                    
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
        $sql_trends = "SELECT * FROM resources WHERE resource_type = 'culinary' ORDER BY id ASC LIMIT 2";
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
                <?php if(isset($trend['file_type']) && strpos($trend['file_type'], 'video') !== false): ?>
                    <div class="video-placeholder">
                        <video src="<?php echo $trend['file_url']; ?>" preload="metadata" style="width:100%; height:300px; object-fit:cover; pointer-events: none; border-radius: 15px;"></video>
                        <div class="play-overlay"><i class="fas fa-play"></i></div>
                    </div>
                <?php else: ?>
                    <img src="<?php echo $trendImage; ?>" alt="<?php echo $trend['title']; ?>">
                <?php endif; ?>
            </div>
            <div class="zigzag-content">
                <h3><?php echo $trend['title']; ?></h3>
                <p><?php echo substr($trend['content'], 0, 250) . '...'; ?></p>
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
                    'content' => 'Sustainable cooking is not just a trend; it is a necessary shift towards a healthier planet and a more mindful lifestyle. It involves sourcing ingredients locally to reduce carbon footprints, choosing seasonal produce to support local farmers, and minimizing food waste through creative cooking techniques. By embracing plant-based meals and energy-efficient cooking methods, we can significantly lower our environmental impact while enjoying fresh, nutritious, and delicious food. It is about making conscious choices in the kitchen that resonate with the rhythm of nature.',
                    'file_url' => 'resources/trend1.jpg'
                ],
                [
                    'title' => 'The Art of Plating',
                    'content' => 'Elevate your dishes with professional plating techniques.',
            'content' => 'The art of plating is where culinary skills meet visual artistry. A well-plated dish engages the diner\'s senses before they even take the first bite. It relies on the balance of colors, textures, and negative space to create a visually appealing composition. Techniques such as the rule of thirds, using contrasting colors, and garnishing with precision can transform a simple meal into a gourmet experience. Whether it is a rustic arrangement or a minimalistic design, plating tells a story and sets the tone for the dining experience.',
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
                <?php if(isset($trend['file_type']) && strpos($trend['file_type'], 'video') !== false): ?>
                    <div class="video-placeholder">
                        <video src="<?php echo $trend['file_url']; ?>" preload="metadata" style="width:100%; height:300px; object-fit:cover; pointer-events: none; border-radius: 15px;"></video>
                        <div class="play-overlay"><i class="fas fa-play"></i></div>
                    </div>
                <?php else: ?>
                    <img src="<?php echo $trendImage; ?>" alt="<?php echo $trend['title']; ?>">
                <?php endif; ?>
            </div>
            <div class="zigzag-content">
                <h3><?php echo $trend['title']; ?></h3>
                <p><?php echo substr($trend['content'], 0, 250) . '...'; ?></p>
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

    <!--COOKIE CONSENT -->
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