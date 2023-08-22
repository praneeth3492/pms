<?php
session_start();
require_once "config.php";

// Check if the user is logged in
if (!isset($_SESSION["manager_id"])) {
    header("Location: login.php");
    exit;
}

// Get the submitted data
$project_id       =  $_POST['project_id'];
$domain_access    =  $_POST['domain_access'];
$wireframe        =  $_POST['wireframe'];
$website_content  =  $_POST['website_content']; 
$web_design       =  $_POST['web_design'];
$medical_seo      =  $_POST['medical_seo'];
$technical_seo    =  $_POST['technical_seo'];
$whatsapp_setup   =  $_POST['whatsapp_setup'];
$website_testing  =  $_POST['website_testing'];
$beta_ready       =  $_POST['beta_ready'];




// Check if a record with the given client_id exists
$sql = "SELECT * FROM website WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    
    // Update the record
    $sql = "UPDATE website SET 
        domain_access = ?,
        wireframe = ?,
        website_content = ?,
        web_design = ?,
        medical_seo = ?,
        technical_seo = ?,
        whatsapp_setup = ?,
        website_testing = ?,
        beta_ready = ?
        WHERE project_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $domain_access,
        $wireframe,
        $website_content,
        $web_design,
        $medical_seo,
        $technical_seo,
        $whatsapp_setup,
        $website_testing,
        $beta_ready,
        $project_id
    );
    
    
    
    
} else {
        $sql = "INSERT INTO website (
        project_id,
        domain_access,
        wireframe,
        website_content,
        web_design,
        medical_seo,
        technical_seo,
        whatsapp_setup,
        website_testing,
        beta_ready
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssss",
        $project_id,
        $domain_access,
        $wireframe,
        $website_content,
        $web_design,
        $medical_seo,
        $technical_seo,
        $whatsapp_setup,
        $website_testing,
        $beta_ready
    );
    
    
    
}

$result = $stmt->execute();
if ($result === false) {
    echo "Error: " . $stmt->error;
} else {
        header("Location: manager_dashboard.php");
}

$stmt->close();
$conn->close();
