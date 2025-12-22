<?php
session_start();
include("../../database/config.php");

function uploadImage($file) {
    if (!isset($file['name']) || $file['name'] == "") return "";

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code: " . $file['error']);
    }

    // Resolve absolute path
    $base_dir = realpath(__DIR__ . "/../../");
    $target_dir_abs = $base_dir . "/uploads/community/";
    
    if (!file_exists($target_dir_abs)) {
        if (!mkdir($target_dir_abs, 0777, true)) {
            die("Failed to create directory: " . $target_dir_abs);
        }
    }
    
    $filename = time() . "_" . basename($file["name"]);
    $target_file_abs = $target_dir_abs . $filename;
    
    if (move_uploaded_file($file["tmp_name"], $target_file_abs)) {
        return "uploads/community/" . $filename;
    } else {
        die("Failed to move uploaded file. Check permissions for: " . $target_dir_abs);
    }
}

if (isset($_POST['create_community_recipe'])) {
    if(!isset($_SESSION['id'])) { header("Location: ../../index.php"); exit; }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $ingredients = $_POST['ingredients'] ?? '';
    $content = $_POST['content'] ?? '';
    $user_id = $_SESSION['id'];
    
    $image_path = uploadImage($_FILES['image']);

    $stmt = $connection->prepare("INSERT INTO community_cookbook (title, description, category, ingredients, content, user_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $title, $description, $category, $ingredients, $content, $user_id, $image_path);

    if ($stmt->execute()) {
        header("Location: ../../community_cookbook.php?msg=Post Shared");
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_POST['update_community_recipe'])) {

    $id = (int)$_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $ingredients = $_POST['ingredients'] ?? '';
    $content = $_POST['content'] ?? '';

    // Ownership check
    $check = $connection->prepare("SELECT user_id FROM community_cookbook WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();

    if (!$res || $res['user_id'] != $_SESSION['id']) {
        die("Unauthorized");
    }

    // Image handling
    if (!empty($_FILES['image']['name'])) {
        $image = uploadImage($_FILES['image']);
        $stmt = $connection->prepare(
            "UPDATE community_cookbook 
             SET title=?, description=?, category=?, ingredients=?, content=?, image=? 
             WHERE id=?"
        );
        $stmt->bind_param(
            "ssssssi",
            $title, $description, $category, $ingredients, $content, $image, $id
        );
    } else {
        $stmt = $connection->prepare(
            "UPDATE community_cookbook 
             SET title=?, description=?, category=?, ingredients=?, content=? 
             WHERE id=?"
        );
        $stmt->bind_param(
            "sssssi",
            $title, $description, $category, $ingredients, $content, $id
        );
    }

    if ($stmt->execute()) {
        header("Location: ../../community_cookbook.php?msg=Updated");
        exit;
    } else {
        die("Update failed: " . $stmt->error);
    }
}


if (isset($_POST['delete_community_recipe'])) {
    if(!isset($_SESSION['id'])) { header("Location: ../../index.php"); exit; }
    
    $id = $_POST['id'];
    // Verify Ownership
    $check = $connection->query("SELECT user_id FROM community_cookbook WHERE id=$id");
    if($check->num_rows > 0) {
        $r = $check->fetch_assoc();
        if($r['user_id'] != $_SESSION['id']) die("Unauthorized");
    }

    $connection->query("DELETE FROM community_cookbook WHERE id=$id");
    header("Location: ../../community_cookbook.php?msg=Deleted");
}
?>
