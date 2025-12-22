<?php
include("../../database/config.php");

// Set default recipe type if not coming from a specific form (e.g. general admin add)
$default_type = 'official'; 

// Handle Delete
if (isset($_POST['delete_recipe'])) {
    $id = $_POST['id'];
    $redirect = $_POST['redirect'] ?? '../../admin/recipes.php';
    
    $sql = "DELETE FROM recipes WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: $redirect?msg=Recipe deleted successfully");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

// Handle Create
if (isset($_POST['create_recipe'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $cuisine_type = $_POST['cuisine_type'];
    $dietary_preference = $_POST['dietary_preference'];
    $difficulty = $_POST['difficulty'];
    $recipe_type = $_POST['recipe_type'] ?? 'official';
    $user_id = $_POST['user_id'] ?? 1; // Default admin user ID if not logged in context
    $redirect = $_POST['redirect'] ?? '../../admin/recipes.php';

    // Image Upload
    $image_path = uploadImage($_FILES['image']);

    $stmt = $connection->prepare("INSERT INTO recipes (title, description, ingredients, cuisine_type, difficulty, dietary_preference, user_id, recipe_type, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    $stmt->bind_param("ssssssiss", $title, $description, $ingredients, $cuisine_type, $difficulty, $dietary_preference, $user_id, $recipe_type, $image_path);

    if ($stmt->execute()) {
        header("Location: $redirect?msg=Recipe created successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Handle Update
if (isset($_POST['update_recipe'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $cuisine_type = $_POST['cuisine_type'];
    $dietary_preference = $_POST['dietary_preference'];
    $difficulty = $_POST['difficulty'];
    $redirect = $_POST['redirect'] ?? '../../admin/recipes.php';

    // Image handling
    if (!empty($_FILES['image']['name'])) {

        $image = uploadImage($_FILES['image']);

        $stmt = $connection->prepare(
            "UPDATE recipes
             SET title=?, description=?, ingredients=?, cuisine_type=?, difficulty=?, dietary_preference=?, image=?
             WHERE id=?"
        );
        if (!$stmt) {
            die("Prepare failed (Update with Image): " . $connection->error);
        }

        $stmt->bind_param(
            "sssssssi",
            $title,
            $description,
            $ingredients,
            $cuisine_type,
            $difficulty,
            $dietary_preference,
            $image,
            $id
        );
    } else {

        $stmt = $connection->prepare(
            "UPDATE recipes
             SET title=?, description=?, ingredients=?, cuisine_type=?, difficulty=?, dietary_preference=?
             WHERE id=?"
        );
        if (!$stmt) {
            die("Prepare failed (Update without Image): " . $connection->error);
        }

        $stmt->bind_param(
            "ssssssi",
            $title,
            $description,
            $ingredients,
            $cuisine_type,
            $difficulty,
            $dietary_preference,
            $id
        );
    }

    if ($stmt->execute()) {
        header("Location: $redirect?msg=Recipe updated successfully");
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}

// Helper function for secure upload
function uploadImage($file)
{
    if (!isset($file['name']) || $file['name'] == "") {
        return "";
    }

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code: " . $file['error']);
    }

    // Resolve absolute path
    $base_dir = realpath(__DIR__ . "/../../"); // Resolves to /.../FoodFusion
    $target_dir_abs = $base_dir . "/uploads/";

    // Create directory if missing
    if (!file_exists($target_dir_abs)) {
        if (!mkdir($target_dir_abs, 0777, true)) {
            die("Failed to create absolute upload directory: " . $target_dir_abs);
        }
    }

    $filename = time() . "_" . basename($file["name"]);
    $target_file_abs = $target_dir_abs . $filename;

    if (move_uploaded_file($file["tmp_name"], $target_file_abs)) {
        return "uploads/" . $filename;
    } else {
        die("Error uploading file to destination: " . $target_file_abs . " (Check permissions)");
    }
}


?>
