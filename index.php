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
                <button class="join-btn" id="exploreBtn">Explore</button>
            <?php else: ?>
                <button class="join-btn" onclick="openModal('registerModal')">Join Us</button>
            <?php endif; ?>
        </div>
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" class="intro-img">
    </section>

    <!-- FEATURED RECIPES -->
    <section class="featured">
        <h2>Featured Recipes</h2>
        <div class="recipe-container">
            <div class="recipe-card">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836">
                <h3>Italian Pasta</h3>
                <p>Creamy, fresh, and full of flavor.</p>
            </div>

            <div class="recipe-card">
                <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2">
                <h3>BBQ Steak</h3>
                <p>Perfectly grilled with herbs.</p>
            </div>

            <div class="recipe-card">
                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd">
                <h3>Healthy Salad</h3>
                <p>Fresh greens with special dressing.</p>
            </div>
        </div>
    </section>

    <!-- EVENT CAROUSEL -->
    <section class="carousel-section">
        <h2>Upcoming Events</h2>

        <div class="carousel" id="eventCarousel">
            <div class="slide">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836">
                <p>Italian Cooking Class</p>
            </div>
            <div class="slide">
                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd">
                <p>Healthy Eating Workshop</p>
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

    <script src="./js/app.js"></script>
</body>

</html>