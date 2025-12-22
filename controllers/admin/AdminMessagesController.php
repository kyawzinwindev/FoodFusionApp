<?php
include("../../database/config.php");

// Handle Delete
if (isset($_POST['delete_message'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM contact_messages WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: ../../admin/messages.php?msg=Message deleted successfully");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}
?>
