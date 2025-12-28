<?php
include("../../database/config.php");

if (isset($_POST['delete_comment'])) {
    session_start();
    // Basic Admin Check (Should rely on a more robust middleware in real app, but following pattern)
    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../../admin/login.php");
        exit;
    }

    $id = $_POST['id'];
    $sql = "DELETE FROM comments WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        header("Location: ../../admin/comments.php?msg=Comment deleted successfully");
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}
?>
