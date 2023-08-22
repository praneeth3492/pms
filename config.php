<?php
// config.php
$host = "localhost";
$user = "root"; // Correct variable name
$password = "";
$dbname = "pms";

$conn = new mysqli($host, $user, $password, $dbname); // Use $user instead of $username

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
