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
$beta_launch    =  $_POST['beta_launch'];
$client_checklist        =  $_POST['client_checklist'];
$sm_calendar  =  $_POST['sm_calendar']; 
$sm_posts       =  $_POST['sm_posts'];
$scheduling      =  $_POST['scheduling'];
$client_sign_off    =  $_POST['client_sign_off'];
$welcome_kit   =  $_POST['welcome_kit'];
$project_launch  =  $_POST['project_launch'];
$citations_list       =  $_POST['citations_list'];




// Check if a record with the given client_id exists
$sql = "SELECT * FROM project_launch WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    
    // Update the record
    $sql = "UPDATE project_launch SET 
        beta_launch = ?,
        client_checklist = ?,
        sm_calendar = ?,
        sm_posts = ?,
        scheduling = ?,
        client_sign_off = ?,
        welcome_kit = ?,
        project_launch = ?,
        citations_list = ?
        WHERE project_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $beta_launch,
        $client_checklist,
        $sm_calendar,
        $sm_posts,
        $scheduling,
        $client_sign_off,
        $welcome_kit,
        $project_launch,
        $citations_list,
        $project_id
    );
    
    
    
    
} else {
        $sql = "INSERT INTO project_launch (
        project_id,
        beta_launch,
        client_checklist,
        sm_calendar,
        sm_posts,
        scheduling,
        client_sign_off,
        welcome_kit,
        project_launch,
        citations_list
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
