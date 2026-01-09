<?php
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

require("config.php");

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
    user_id INT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) DEFAULT 'General Inquiry',
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
)";

if ($connection->query($messages)) {
    echo "Table 'contact_messages': Checked/Created.<br>";
} else {
    echo "Table 'contact_messages' Error: " . $connection->error . "<br>";
}

// Setup Comments Table
$comments = "CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    community_recipe_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (community_recipe_id) REFERENCES community_cookbook(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($connection->query($comments)) {
    echo "Table 'comments': Checked/Created.<br>";
} else {
    echo "Table 'comments' Error: " . $connection->error . "<br>";
}

// Create Default Admin User
$admin_email = 'admin@gmail.com';
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
        echo "Default Admin User created ($admin_email / password).<br>";
    } else {
        echo "Error creating Admin User: " . $connection->error . "<br>";
    }
} else {
    $row = $res_admin->fetch_assoc();
    $admin_id = $row['id'];
    echo "Admin User already exists.<br>";
}

echo "<p>Database setup and seeding completed.</p>";

$connection->close();
?>
