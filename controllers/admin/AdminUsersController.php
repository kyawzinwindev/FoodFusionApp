<?php
include("../../database/config.php");

// Handle Delete
if (isset($_POST['delete_user'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: ../../admin/users.php?msg=User deleted successfully");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

// Handle Create
if (isset($_POST['create_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $type = $_POST['type'];

    $sql = "INSERT INTO users (first_name, last_name, email, password, type) VALUES ('$first_name', '$last_name', '$email', '$password', '$type')";
    
    if (mysqli_query($connection, $sql)) {
        header("Location: ../../admin/users.php?msg=User created successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Handle Update
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $type = $_POST['type'];

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', type='$type' WHERE id=$id";

    // If password provided, update it too
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', type='$type', password='$password' WHERE id=$id";
    }

    if (mysqli_query($connection, $sql)) {
        header("Location: ../../admin/users.php?msg=User updated successfully");
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>
