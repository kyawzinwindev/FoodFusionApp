<?php
include("../database/config.php");

if (isset($_POST['send_message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'] ?? 'Contact Form Submission';
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    $stmt = $connection->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
    if ($stmt->execute()) {
        header("Location: ../contact.php?msg=Message sent successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
?>
