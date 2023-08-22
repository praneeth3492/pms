<?php
// add_client_action.php
require_once "config.php";

$projectName = $_POST['projectName'];
$sql = "INSERT INTO project (project_name) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $projectName);

if ($stmt->execute()) {
    echo "Project added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
