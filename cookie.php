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

    <section class="policy-section">
        <div class="policy-box">
            <h1>Cookie Policy</h1>

            <p>
                This Cookie Policy explains how FoodFusion uses cookies and similar technologies
                to enhance your browsing experience.
            </p>

            <h2>What Are Cookies?</h2>
            <p>
                Cookies are small text files stored on your device when you visit a website.
                They help websites remember user preferences and improve functionality.
            </p>

            <h2>How We Use Cookies</h2>
            <ul>
                <li>To remember user login sessions</li>
                <li>To store cookie consent preferences</li>
                <li>To analyze website performance and usage</li>
            </ul>

            <h2>Types of Cookies We Use</h2>
            <p>
                FoodFusion uses essential cookies required for basic site functionality.
                We may also use analytical cookies to improve content and user experience.
            </p>

            <h2>Managing Cookies</h2>
            <p>
                You can control or disable cookies through your browser settings.
                Please note that disabling cookies may affect certain features of the website.
            </p>

            <p>
                By continuing to use FoodFusion, you consent to the use of cookies as described
                in this policy.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <?php require("./components/footer.php") ?>

    <script src="./js/app.js"></script>
</body>

</html>