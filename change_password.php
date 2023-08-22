<?php

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager_id = $_POST['manager_id'];
    $new_password = $_POST['new_password'];

    // // Connect to the database
    // $conn = new mysqli('localhost', 'username', 'password', 'pms');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Update the password for the given manager ID
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE `pms`.`managers` SET `password` = ? WHERE `manager_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $new_password_hashed, $manager_id);
    
    if ($stmt->execute()) {
        echo "Password changed successfully!";
    } else {
        echo "Error changing password: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
