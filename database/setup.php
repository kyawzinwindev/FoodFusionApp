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

// Create Demo User (John Doe)
$demo_email = 'johndoe@gmail.com';
$demo_id = 0;

$check_demo = "SELECT * FROM users WHERE email = '$demo_email'";
$res_demo = $connection->query($check_demo);

if ($res_demo && $res_demo->num_rows == 0) {
    $first_name = 'John';
    $last_name = 'Doe';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $type = 'user';

    $insert_demo = "INSERT INTO users (first_name, last_name, email, password, type) 
                     VALUES ('$first_name', '$last_name', '$demo_email', '$password', '$type')";
    
    if ($connection->query($insert_demo)) {
        $demo_id = $connection->insert_id;
        echo "Demo User created ($demo_email / password).<br>";
    } else {
        echo "Error creating Demo User: " . $connection->error . "<br>";
    }
} else {
    $row = $res_demo->fetch_assoc();
    $demo_id = $row['id'];
    echo "Demo User already exists.<br>";
}

// --- SEED DATA ---
echo "<h3>Seeding Data...</h3>";

if ($demo_id == 0) {
    echo "Skipping seeding: No Demo User ID found.<br>";
} else {
    $user_id = $demo_id; // USE DEMO ID FOR SEEDING
    echo "Using Demo ID ($user_id) for seeding content.<br>";

    // Recipes Data
    $recipes = [
        [
            'title' => 'Classic Margherita Pizza',
            'description' => 'A simple yet delicious classic pizza with fresh basil, mozzarella, and tomato sauce. Perfect for a quick dinner.',
            'ingredients' => 'Pizza dough, Tomato sauce, Fresh mozzarella cheese, Fresh basil leaves, Olive oil, Salt',
            'cuisine_type' => 'Italian',
            'dietary_preference' => 'Vegetarian',
            'difficulty' => 'Medium',
            'image' => 'uploads/recipes/recipe1.jpg'
        ],
        [
            'title' => 'Spicy Ramen Bowl',
            'description' => 'A warming bowl of spicy ramen with soft-boiled eggs, green onions, and savory broth. Comfort food at its best.',
            'ingredients' => 'Ramen noodles, Chicken or vegetable broth, Soy sauce, Miso paste, Chili oil, Eggs, Green onions, Norisheets',
            'cuisine_type' => 'Japanese',
            'dietary_preference' => 'Non-Vegetarian',
            'difficulty' => 'Hard',
            'image' => 'uploads/recipes/recipe2.jpg'
        ],
        [
            'title' => 'Avocado Toast Deluxe',
            'description' => 'Healthy and filling avocado toast topped with cherry tomatoes, radish, and poached eggs. Great for breakfast or brunch.',
            'ingredients' => 'Wholegrain bread, Ripe avocados, Cherry tomatoes, Radish, Eggs, Lemon juice, Chili flakes, Salt, Pepper',
            'cuisine_type' => 'American',
            'dietary_preference' => 'Vegetarian',
            'difficulty' => 'Easy',
            'image' => 'uploads/recipes/recipe3.jpg'
        ]
    ];

    foreach ($recipes as $recipe) {
        $title = addslashes($recipe['title']);
        $description = addslashes($recipe['description']);
        $ingredients = addslashes($recipe['ingredients']);
        $image = $recipe['image'];

        // Check if recipe already exists to avoid duplicates
        $check_recipe = "SELECT id FROM recipes WHERE title = '$title'";
        if ($connection->query($check_recipe)->num_rows == 0) {
            $sql = "INSERT INTO recipes (title, description, ingredients, cuisine_type, dietary_preference, difficulty, image, user_id)
                    VALUES ('$title', '$description', '$ingredients', 
                            '" . $recipe['cuisine_type'] . "', '" . $recipe['dietary_preference'] . "', 
                            '" . $recipe['difficulty'] . "', '$image', $user_id)";
            
            if ($connection->query($sql)) {
                echo "Added Recipe: " . $recipe['title'] . "<br>";
            } else {
                echo "Error adding recipe: " . $connection->error . "<br>";
            }
        } else {
            // Update image if needed 
             $update_img = "UPDATE recipes SET image = '$image', user_id = $user_id WHERE title = '$title'";
             $connection->query($update_img);
             echo "Recipe exists (Image/User Updated): " . $recipe['title'] . "<br>";
        }
    }

    // Community Cookbook Data (New Seeding)
    $community_posts = [
        [
            'title' => 'Grandma\'s Secret Apple Pie',
            'description' => 'This is the pie that has won 3 county fairs! The secret is in the crust.',
            'category' => 'recipe',
            'ingredients' => 'Apples, Flour, Butter, Sugar, Cinnamon, Nutmeg',
            'content' => 'Mix the flour and butter until crumbly. Peel and slice apples...',
            'image' => 'uploads/community/community1.jpg'
        ],
        [
            'title' => 'How to Keep Herbs Fresh',
            'description' => 'Stopped throwing away wilted herbs. Here is a life-changing tip.',
            'category' => 'tip',
            'content' => 'Wash them, dry them thoroughly, and wrap them in a damp paper towel before storing in a container in the fridge.',
            'image' => 'uploads/community/community2.jpg'
        ]
    ];

    foreach ($community_posts as $post) {
        $title = addslashes($post['title']);
        $description = addslashes($post['description']);
        $content = addslashes($post['content']);
        $ingredients = isset($post['ingredients']) ? addslashes($post['ingredients']) : '';
        $image = $post['image'];

        $check_comm = "SELECT id FROM community_cookbook WHERE title = '$title'";
        if ($connection->query($check_comm)->num_rows == 0) {
             $sql = "INSERT INTO community_cookbook (title, description, category, ingredients, content, image, user_id)
                     VALUES ('$title', '$description', '" . $post['category'] . "', 
                             '$ingredients', '$content', '$image', $user_id)";
            if ($connection->query($sql)) {
                echo "Added Community Post: " . $post['title'] . "<br>";
            } else {
                echo "Error adding community post: " . $connection->error . "<br>";
            }
        } else {
             $update_comm = "UPDATE community_cookbook SET image = '$image', user_id = $user_id WHERE title = '$title'";
             $connection->query($update_comm);
             echo "Community Post exists (Image/User Updated): " . $post['title'] . "<br>";
        }
    }

    // Resources Data (Educational & Culinary)
    $resources = [
        [
            'title' => 'Sustainable Cooking',
            'description' => 'Learn how to cook with the environment in mind.',
            'content' => 'Sustainable cooking is not just a trend; it is a necessary shift towards a healthier planet and a more mindful lifestyle. It involves sourcing ingredients locally to reduce carbon footprints, choosing seasonal produce to support local farmers, and minimizing food waste through creative cooking techniques. By embracing plant-based meals and energy-efficient cooking methods, we can significantly lower our environmental impact while enjoying fresh, nutritious, and delicious food. It is about making conscious choices in the kitchen that resonate with the rhythm of nature.',
            'resource_type' => 'culinary',
            'image' => 'uploads/resources/culinary1.jpg'
        ],
        [
            'title' => 'The Art of Plating',
            'description' => 'Elevate your dishes with professional plating techniques.',
            'content' => 'The art of plating is where culinary skills meet visual artistry. A well-plated dish engages the diner\'s senses before they even take the first bite. It relies on the balance of colors, textures, and negative space to create a visually appealing composition. Techniques such as the rule of thirds, using contrasting colors, and garnishing with precision can transform a simple meal into a gourmet experience. Whether it is a rustic arrangement or a minimalistic design, plating tells a story and sets the tone for the dining experience.',
            'resource_type' => 'culinary',
            'image' => 'uploads/resources/culinary2.jpg'
        ],
        [
             'title' => 'The Science of Baking',
             'description' => 'Understanding gluten, yeast, and fermentation.',
             'content' => 'Baking is chemistry. Understanding the role of each ingredient...',
             'resource_type' => 'educational',
             'image' => 'uploads/resources/edu1.jpg'
        ],
        [
            'title' => 'History of Street Food',
            'description' => 'A journey through the origins of popular street foods.',
            'content' => 'Street food is the heart of many cultures...',
            'resource_type' => 'educational',
            'image' => 'uploads/resources/edu2.jpg'
        ]
    ];

    foreach ($resources as $resource) {
         $title = addslashes($resource['title']);
         $description = addslashes($resource['description']);
         $content = addslashes($resource['content']);
         $image = $resource['image'];
         
         $check_res = "SELECT id FROM resources WHERE title = '$title'";
         if ($connection->query($check_res)->num_rows == 0) {
            $sql = "INSERT INTO resources (title, description, content, file_url, resource_type, user_id)
                    VALUES ('$title', '$description', 
                            '$content', '$image', 
                            '" . $resource['resource_type'] . "', $user_id)";
            
            if ($connection->query($sql)) {
                echo "Added Resource: " . $resource['title'] . "<br>";
            } else {
                 echo "Error adding resource: " . $connection->error . "<br>";
            }
         } else {
             // Update image if needed
             $update_img = "UPDATE resources SET file_url = '$image', user_id = $user_id WHERE title = '$title'";
             $connection->query($update_img);
             echo "Resource exists (Image/User Updated): " . $resource['title'] . "<br>";
         }
    }
}

echo "<hr>";
echo "<p>Database setup and seeding completed.</p>";

$connection->close();
?>
