<?php
session_start();
include("../../database/config.php");

function uploadFile($file) {
    if (!isset($file['name']) || $file['name'] == "") return "";

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code: " . $file['error']);
    }

    // Resolve absolute path
    $base_dir = realpath(__DIR__ . "/../../");
    $target_dir_abs = $base_dir . "/uploads/resources/";
    
    // Create directory if missing
    if (!file_exists($target_dir_abs)) {
        if (!mkdir($target_dir_abs, 0777, true)) {
             die("Failed to create directory: " . $target_dir_abs);
        }
    }
    
    $filename = time() . "_" . basename($file["name"]);
    $target_file_abs = $target_dir_abs . $filename;
    
    if (move_uploaded_file($file["tmp_name"], $target_file_abs)) {
        return "uploads/resources/" . $filename;
    }
    die("Upload failed to " . $target_file_abs . " (Check permissions)");
}

if (isset($_POST['create_resource'])) {
    if(!isset($_SESSION['id'])) { header("Location: ../../index.php"); exit; }
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'] ?? '';
    $resource_type = 'culinary';
    $file_type = $_POST['file_type'] ?? 'image';

    $user_id = $_SESSION['id'];

    $file_url = uploadFile($_FILES['file']);

    // Use prepared statement for security
    $stmt = $connection->prepare("INSERT INTO resources (title, description, content, resource_type, file_type, file_url, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    $stmt->bind_param("ssssssi", $title, $description, $content, $resource_type, $file_type, $file_url, $user_id);

    if ($stmt->execute()) {
        header("Location: ../../culinary_resources.php?msg=Resource Added");
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_POST['update_resource'])) {
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit;
    }
    $id = (int)$_POST['id'];

    // Check Ownership
    $check = $connection->prepare("SELECT user_id FROM resources WHERE id=?");
    if (!$check) {
        die("Prepare failed (Ownership Check): " . $connection->error);
    }
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $r = $result->fetch_assoc();
        if ($r['user_id'] != $_SESSION['id']) die("Unauthorized");
    } else {
        die("Resource not found");
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    // File handling
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $path = uploadFile($_FILES['file']);
        
        $stmt = $connection->prepare("UPDATE resources SET title=?, description=?, content=?, file_url=? WHERE id=?");
        if (!$stmt) die("Prepare failed (Update with file): " . $connection->error);
        $stmt->bind_param("ssssi", $title, $description, $content, $path, $id);
    } else {
        $stmt = $connection->prepare("UPDATE resources SET title=?, description=?, content=? WHERE id=?");
        if (!$stmt) die("Prepare failed (Update): " . $connection->error);
        $stmt->bind_param("sssi", $title, $description, $content, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../../culinary_resources.php?msg=Updated");
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_POST['delete_resource'])) {
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
        exit;
    }
    $id = (int)$_POST['id'];

    // Check Ownership
    $check = $connection->prepare("SELECT user_id FROM resources WHERE id=?");
    if (!$check) {
        die("Prepare failed (Ownership Check): " . $connection->error);
    }
    $check->bind_param("i", $id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $r = $result->fetch_assoc();
        if ($r['user_id'] != $_SESSION['id']) die("Unauthorized");
    } else {
        die("Resource not found");
    }

    $del = $connection->prepare("DELETE FROM resources WHERE id=?");
    if (!$del) die("Prepare failed (Delete): " . $connection->error);
    $del->bind_param("i", $id);

    if ($del->execute()) {
        header("Location: ../../culinary_resources.php?msg=Deleted");
    } else {
        echo "Error: " . $del->error;
    }
}
?>
