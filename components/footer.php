<!-- Redesigned FOOTER -->
<footer class="footer">
    <div class="footer-container">

        <div class="footer-section">
            <h3>FoodFusion</h3>
            <p>FoodFusion is your go-to source for tasty recipes, helpful cooking tips, and everyday kitchen inspiration.</p>
        </div>

        <div class="footer-section">
            <h4>Quick Links</h4>
            <a href="./index.php">Home</a>
            <a href="./about.php">About</a>
            <a href="./community_cookbook.php">Community Cookbook</a>
            <a href="./contact.php">Contact Us</a>
            
            <?php if(isset($_SESSION['id'])): ?>
                <a href="./recipes.php">Recipes</a>
                <a href="./culinary_resources.php">Culinary Resources</a>
                <a href="./educational_resources.php">Educational Resources</a>
            <?php endif; ?>
        </div>

        <div class="footer-section">
            <h4>Follow Us</h4>
            <div class="footer-social">
                <a href="https://www.facebook.com/FoodFusionPK/">Facebook</a>
                <a href="https://www.instagram.com/foodfusionpk/">Instagram</a>
                <a href="https://x.com/FoodFusionPK">Twitter</a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 FoodFusion. All rights reserved.</p>
        <p><a href="./privacy.php">Privacy Policy</a> • <a href="./cookie.php">Cookie Policy</a></p>
    </div>
</footer>

