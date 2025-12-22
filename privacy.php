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
            <h1>Privacy Policy</h1>

            <p>
                At FoodFusion, your privacy is important to us. This Privacy Policy explains how we collect,
                use, and protect your personal information when you use our website.
            </p>

            <h2>Information We Collect</h2>
            <p>
                When you register or interact with FoodFusion, we may collect personal information such as
                your name, email address, and login credentials. We also collect basic usage data to improve
                user experience.
            </p>

            <h2>How We Use Your Information</h2>
            <ul>
                <li>To create and manage your user account</li>
                <li>To allow participation in the community cookbook</li>
                <li>To improve website functionality and content</li>
                <li>To communicate updates or important notices</li>
            </ul>

            <h2>Data Protection</h2>
            <p>
                We take appropriate security measures to protect your personal data from unauthorized access,
                alteration, or disclosure. User accounts are protected with authentication and login limits.
            </p>

            <h2>Third-Party Services</h2>
            <p>
                FoodFusion does not sell or share your personal information with third parties, except where
                required by law or for essential site functionality.
            </p>

            <h2>Your Rights</h2>
            <p>
                You have the right to access, update, or delete your personal information at any time.
                If you have questions about your data, please contact us.
            </p>

            <p>
                By using FoodFusion, you agree to this Privacy Policy.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <?php require("./components/footer.php") ?>

    <script src="./js/app.js"></script>
</body>

</html>