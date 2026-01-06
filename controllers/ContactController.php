<?php
include("../database/config.php");

if (isset($_POST['send_message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'] ?? 'Contact Form Submission';
    $message = $_POST['message'];
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

    $stmt = $connection->prepare("INSERT INTO contact_messages (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    $stmt->bind_param("issss", $user_id, $name, $email, $subject, $message);
    
    if ($stmt->execute()) {
        header("Location: ../contact.php?msg=Message sent successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
?>
