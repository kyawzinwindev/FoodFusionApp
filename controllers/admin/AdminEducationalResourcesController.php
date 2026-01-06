<?php
include("../../database/config.php");

// Handle Delete
if (isset($_POST['delete_resource'])) {
    $id = $_POST['id'];
    $redirect = $_POST['redirect'] ?? '../../admin/educational_resources.php';

    $sql = "DELETE FROM resources WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: $redirect?msg=Resource deleted successfully");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

// Handle Create
if (isset($_POST['create_resource'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'] ?? '';
    $resource_type = 'educational';
    $file_type = $_POST['file_type'] ?? 'image';
    $redirect = $_POST['redirect'] ?? '../../admin/educational_resources.php';

    // File Upload (PDF/Image/Etc)
    $user_id = $_SESSION['id'];

    $file_url = uploadFile($_FILES['file']);

    // Use prepared statement for security
    $stmt = $connection->prepare("INSERT INTO resources (title, description, content, resource_type, file_type, file_url, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    $stmt->bind_param("ssssssi", $title, $description, $content, $resource_type, $file_type, $file_url, $user_id);

    if ($stmt->execute()) {
        header("Location: $redirect?msg=Resource created successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Handle Update
if (isset($_POST['update_resource'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'] ?? '';
    $redirect = $_POST['redirect'] ?? '../../admin/educational_resources.php';

    $file_type = $_POST['file_type'] ?? 'image';

    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $path = uploadFile($_FILES['file']);
        $stmt = $connection->prepare("UPDATE resources SET title=?, description=?, content=?, file_type=?, file_url=? WHERE id=?");
        if (!$stmt) die("Prepare failed (Update with file): " . $connection->error);
        $stmt->bind_param("sssssi", $title, $description, $content, $file_type, $path, $id);
    } else {
        $stmt = $connection->prepare("UPDATE resources SET title=?, description=?, content=?, file_type=? WHERE id=?");
        if (!$stmt) die("Prepare failed (Update): " . $connection->error);
        $stmt->bind_param("ssssi", $title, $description, $content, $file_type, $id);
    }

    if ($stmt->execute()) {
        header("Location: $redirect?msg=Resource updated successfully");
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}


function uploadFile($file)
{
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
