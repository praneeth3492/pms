<?php
// config.php
$host = "localhost";
$user = "drsmart"; // Correct variable name
$password = "Godaddy@3492";
$dbname = "pms";

$conn = new mysqli($host, $user, $password, $dbname); // Use $user instead of $username

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
