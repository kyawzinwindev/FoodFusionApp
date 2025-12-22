<?php
include("../../database/config.php");

// Handle Delete
if (isset($_POST['delete_community_recipe'])) {
    $id = $_POST['id'];
    $redirect = $_POST['redirect'] ?? '../../admin/community_cookbook.php';

    $sql = "DELETE FROM community_cookbook WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: $redirect?msg=Item deleted successfully");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

// Handle Create
if (isset($_POST['create_community_recipe'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'] ?? 'recipe'; // recipe, tip, experience
    $user_id = $_POST['user_id'] ?? 1; 
    $redirect = $_POST['redirect'] ?? '../../admin/community_cookbook.php';

    // Optional fields based on category
    $ingredients = $_POST['ingredients'] ?? '';
    $content = $_POST['content'] ?? '';
    $difficulty = $_POST['difficulty'] ?? '';  

    // Image Upload
    $image = "";
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $target_dir = "../../uploads/community/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $filename = time() . "_" . basename($_FILES["image"]["name"]);
        $image_path = "uploads/community/" . $filename;
        
        if(move_uploaded_file($_FILES["image"]["tmp_name"], "../../" . $image_path)) {
            $image = $image_path;
        }
    }

    $sql = "INSERT INTO community_cookbook (title, description, category, ingredients, content, image, user_id) 
            VALUES ('$title', '$description', '$category', '$ingredients', '$content', '$image', '$user_id')";
    
    if (mysqli_query($connection, $sql)) {
        header("Location: $redirect?msg=Item added successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Handle Update
if (isset($_POST['update_community_recipe'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'] ?? '';
    $content = $_POST['content'] ?? '';
    $category = $_POST['category']; 
    $redirect = $_POST['redirect'] ?? '../../admin/community_cookbook.php';

    $sql = "UPDATE community_cookbook SET title='$title', description='$description', ingredients='$ingredients', content='$content', category='$category' WHERE id=$id";

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $target_dir = "../../uploads/community/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $filename = time() . "_" . basename($_FILES["image"]["name"]);
        $image_path = "uploads/community/" . $filename;
        
        if(move_uploaded_file($_FILES["image"]["tmp_name"], "../../" . $image_path)) {
             $sql = "UPDATE community_cookbook SET title='$title', description='$description', ingredients='$ingredients', content='$content', category='$category', image='$image_path' WHERE id=$id";
        }
    }

    if (mysqli_query($connection, $sql)) {
        header("Location: $redirect?msg=Item updated successfully");
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>
