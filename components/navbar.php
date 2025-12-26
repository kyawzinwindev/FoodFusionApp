<nav class="navbar">
    <div class="navbar-left">
        <div class="navbar-logo">FoodFusion</div>
    </div>

    <!-- HAMBURGER -->
    <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- NAV LINKS -->
    <ul class="navbar-links" id="navbarMenu">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./about.php">About</a></li>
        
        <?php if(isset($_SESSION['id'])): ?>
            <li><a href="./recipes.php">Recipes</a></li>
        <?php endif; ?>

        <li><a href="./community_cookbook.php">Community Cookbook</a></li>
        <li><a href="./contact.php">Contact Us</a></li>
        
        <?php if(isset($_SESSION['id'])): ?>
            <li><a href="./culinary_resources.php">Culinary Resources</a></li>
            <li><a href="./educational_resources.php">Educational Resources</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['id'])): ?>
            <li><a href="./components/logout.php" class="mobile-btn logout-btn">Logout</a></li>
        <?php else: ?>
            <li><button class="mobile-btn login-btn" id="mobileLoginBtn">Login</button></li>
        <?php endif; ?>
    </ul>

    <!-- DESKTOP BUTTON (right side) -->
    <div class="navbar-auth desktop-auth">
        <?php if (isset($_SESSION['id'])): ?>
            <a href="./components/logout.php" class="logout-btn desk-btn">Logout</a>
        <?php else: ?>
            <button class="desk-btn login-btn" id="openLogin">Login</button>
        <?php endif; ?>
    </div>
    <?php include("modals.php"); ?>
</nav>
