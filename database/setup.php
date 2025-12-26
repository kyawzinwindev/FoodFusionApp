<?php
// Buffer output to prevent "Headers sent" error when config.php calls session_start()
ob_start();

$host = "127.0.0.1";
$username = 'root';
$password = '';
$db = 'FoodFusionApp';

// Create Database if not exists
$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($conn->query($sql) === TRUE) {
    echo "Database '$db' created or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}
$conn->close();

// Now include config.php which might start a session
require("config.php");

// Flush the buffer and output everything
ob_end_flush();

echo "<h1>FoodFusion Database Setup</h1>";
echo "<p>Starting setup...</p>";

// Setup Users Table
$users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    type VARCHAR(100) DEFAULT 'user',
    profile_image VARCHAR(255) DEFAULT 'default.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($connection->query($users)) {
    echo "Table 'users': Checked/Created.<br>";
} else {
    echo "Table 'users' Error: " . $connection->error . "<br>";
}

// Setup Recipes Table
$recipes = "CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    ingredients TEXT NOT NULL,
    cuisine_type VARCHAR(100) NOT NULL,
    dietary_preference VARCHAR(100) NOT NULL,
    difficulty TEXT NOT NULL,
    image VARCHAR(255),
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($connection->query($recipes)) {
    echo "Table 'recipes': Checked/Created.<br>";
} else {
    echo "Table 'recipes' Error: " . $connection->error . "<br>";
}

// Setup Community Cookbook Table
$community = "CREATE TABLE IF NOT EXISTS community_cookbook (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category ENUM('recipe', 'tip', 'experience') NOT NULL DEFAULT 'recipe',
    ingredients TEXT,
    content TEXT,
    image VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($connection->query($community)) {
    echo "Table 'community_cookbook': Checked/Created.<br>";
} else {
    echo "Table 'community_cookbook' Error: " . $connection->error . "<br>";
}

// Setup Resources Table
$resources = "CREATE TABLE IF NOT EXISTS resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    content TEXT, 
    file_url VARCHAR(255),
    resource_type VARCHAR(255) NOT NULL,
    file_type VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
)";

if ($connection->query($resources)) {
    echo "Table 'resources': Checked/Created.<br>";
} else {
    echo "Table 'resources' Error: " . $connection->error . "<br>";
}

// Setup Contact Messages Table
$messages = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) DEFAULT 'General Inquiry',
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($connection->query($messages)) {
    echo "Table 'contact_messages': Checked/Created.<br>";
} else {
    echo "Table 'contact_messages' Error: " . $connection->error . "<br>";
}

// Create Default Admin User
$admin_email = 'root@gmail.com';
$admin_id = 0;

$check_admin = "SELECT * FROM users WHERE email = '$admin_email'";
$res_admin = $connection->query($check_admin);

if ($res_admin && $res_admin->num_rows == 0) {
    $first_name = 'Super';
    $last_name = 'Admin';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $type = 'admin';

    $insert_admin = "INSERT INTO users (first_name, last_name, email, password, type) 
                     VALUES ('$first_name', '$last_name', '$admin_email', '$password', '$type')";
    
    if ($connection->query($insert_admin)) {
        $admin_id = $connection->insert_id;
        echo "Default Admin User created (root@gmail.com / password).<br>";
    } else {
        echo "Error creating Admin User: " . $connection->error . "<br>";
    }
} else {
    $row = $res_admin->fetch_assoc();
    $admin_id = $row['id'];
    echo "Admin User already exists.<br>";
}

// --- SEED DATA ---
echo "<h3>Seeding Data...</h3>";

if ($admin_id == 0) {
    echo "Skipping seeding: No Admin ID found.<br>";
} else {
    $user_id = $admin_id; // USE ADMIN ID FOR SEEDING
    echo "Using Admin ID ($user_id) for seeding.<br>";

    // Recipes Data
    $recipes = [
        [
            'title' => 'Classic Margherita Pizza',
            'description' => 'A simple yet delicious classic pizza with fresh basil, mozzarella, and tomato sauce. Perfect for a quick dinner.',
            'ingredients' => 'Pizza dough, Tomato sauce, Fresh mozzarella cheese, Fresh basil leaves, Olive oil, Salt',
            'cuisine_type' => 'Italian',
            'dietary_preference' => 'Vegetarian',
            'difficulty' => 'Medium',
            'image' => 'resources/recipe1.jpg'
        ],
        [
            'title' => 'Spicy Ramen Bowl',
            'description' => 'A warming bowl of spicy ramen with soft-boiled eggs, green onions, and savory broth. Comfort food at its best.',
            'ingredients' => 'Ramen noodles, Chicken or vegetable broth, Soy sauce, Miso paste, Chili oil, Eggs, Green onions, Norisheets',
            'cuisine_type' => 'Japanese',
            'dietary_preference' => 'Non-Vegetarian',
            'difficulty' => 'Hard',
            'image' => 'resources/recipe2.jpg'
        ],
        [
            'title' => 'Avocado Toast Deluxe',
            'description' => 'Healthy and filling avocado toast topped with cherry tomatoes, radish, and poached eggs. Great for breakfast or brunch.',
            'ingredients' => 'Wholegrain bread, Ripe avocados, Cherry tomatoes, Radish, Eggs, Lemon juice, Chili flakes, Salt, Pepper',
            'cuisine_type' => 'American',
            'dietary_preference' => 'Vegetarian',
            'difficulty' => 'Easy',
            'image' => 'resources/recipe3.jpg'
        ]
    ];

    foreach ($recipes as $recipe) {
        // Check if recipe already exists to avoid duplicates
        $check_recipe = "SELECT id FROM recipes WHERE title = '" . $recipe['title'] . "'";
        if ($connection->query($check_recipe)->num_rows == 0) {
            $sql = "INSERT INTO recipes (title, description, ingredients, cuisine_type, dietary_preference, difficulty, image, user_id)
                    VALUES ('" . $recipe['title'] . "', '" . $recipe['description'] . "', '" . $recipe['ingredients'] . "', 
                            '" . $recipe['cuisine_type'] . "', '" . $recipe['dietary_preference'] . "', 
                            '" . $recipe['difficulty'] . "', '" . $recipe['image'] . "', $user_id)";
            
            if ($connection->query($sql)) {
                echo "Added Recipe: " . $recipe['title'] . "<br>";
            } else {
                echo "Error adding recipe: " . $connection->error . "<br>";
            }
        } else {
            // Update image if needed (Quick Fix for User's issue without re-seeding completely)
             $update_img = "UPDATE recipes SET image = '" . $recipe['image'] . "' WHERE title = '" . $recipe['title'] . "'";
             $connection->query($update_img);
             echo "Recipe exists (Image Updated): " . $recipe['title'] . "<br>";
        }
    }

    // Culinary Resources Data
    $resources = [
        [
            'title' => 'Sustainable Cooking',
            'description' => 'Learn how to cook with the environment in mind. Discover zero-waste recipes and sustainable ingredient sourcing.',
            'content' => 'Sustainable cooking is about making choices that benefit your health and the planet. It involves using local, seasonal ingredients, reducing food waste, and choosing plant-based options more often...',
            'resource_type' => 'culinary',
            'image' => 'resources/trend1.jpg'
        ],
        [
            'title' => 'The Art of Plating',
            'description' => 'Elevate your dishes with professional plating techniques. Make your food look as good as it tastes.',
            'content' => 'Plating is an art form that transforms a meal into an experience. Contrast, color, texture, and spacing are key elements...',
            'resource_type' => 'culinary',
            'image' => 'resources/trend2.jpg'
        ]
    ];

    foreach ($resources as $resource) {
         $check_res = "SELECT id FROM resources WHERE title = '" . $resource['title'] . "'";
         if ($connection->query($check_res)->num_rows == 0) {
            $sql = "INSERT INTO resources (title, description, content, file_url, resource_type, user_id)
                    VALUES ('" . $resource['title'] . "', '" . $resource['description'] . "', 
                            '" . $resource['content'] . "', '" . $resource['image'] . "', 
                            '" . $resource['resource_type'] . "', $user_id)";
            
            if ($connection->query($sql)) {
                echo "Added Resource: " . $resource['title'] . "<br>";
            } else {
                 echo "Error adding resource: " . $connection->error . "<br>";
            }
         } else {
             // Update image if needed
             $update_img = "UPDATE resources SET file_url = '" . $resource['image'] . "', resource_type = '" . $resource['resource_type'] . "' WHERE title = '" . $resource['title'] . "'";
             $connection->query($update_img);
             echo "Resource exists (Image Updated): " . $resource['title'] . "<br>";
         }
    }
}

echo "<hr>";
echo "<p>Database setup and seeding completed.</p>";

$connection->close();
?>
