<?php
session_start();
include("../../database/config.php");

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
    $base_dir = realpath(__DIR__ . "/../../"); 
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

// Create Recipe
if (isset($_POST['create_recipe'])) {
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit;
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $cuisine_type = $_POST['cuisine_type'];
    $difficulty = $_POST['difficulty'];
    $dietary_preference = $_POST['dietary_preference'];
    $user_id = $_SESSION['id'];
    $recipe_type = 'official';

    $image_path = uploadImage($_FILES['image']);

    $stmt = $connection->prepare("INSERT INTO recipes (title, description, ingredients, cuisine_type, difficulty, dietary_preference, user_id, recipe_type, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    $stmt->bind_param("ssssssiss", $title, $description, $ingredients, $cuisine_type, $difficulty, $dietary_preference, $user_id, $recipe_type, $image_path);

    if ($stmt->execute()) {
        header("Location: ../../recipes.php?msg=Recipe Created");
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Update Recipe
if (isset($_POST['update_recipe'])) {
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit;
    }

    $id = (int)$_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $cuisine_type = $_POST['cuisine_type'];
    $difficulty = $_POST['difficulty'];
    $dietary_preference = $_POST['dietary_preference'];

    // Verify ownership
    $check = $connection->prepare("SELECT user_id FROM recipes WHERE id=?");
    if (!$check) {
        die("Prepare failed (Ownership Check): " . $connection->error);
    }
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['user_id'] != $_SESSION['id']) {
            die("Unauthorized Access");
        }
    } else {
        die("Recipe not found");
    }

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
        header("Location: ../../recipes.php?msg=Recipe Updated");
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Delete Recipe
if (isset($_POST['delete_recipe'])) {
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit;
    }
    $id = (int)$_POST['id'];

    // Verify Ownership
    $check = $connection->prepare("SELECT user_id FROM recipes WHERE id=?");
    if (!$check) {
        die("Prepare failed (Delete Check): " . $connection->error);
    }
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['user_id'] != $_SESSION['id']) {
            die("Unauthorized Access");
        }
    } else {
        die("Recipe not found");
    }

    $del = $connection->prepare("DELETE FROM recipes WHERE id=?");
    if (!$del) {
        die("Prepare failed (Delete): " . $connection->error);
    }
    $del->bind_param("i", $id);

    if ($del->execute()) {
        header("Location: ../../recipes.php?msg=Recipe Deleted");
    } else {
        echo "Error: " . $del->error;
    }
}
