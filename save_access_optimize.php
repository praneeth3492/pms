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
$gmb_accounts     =  $_POST['gmb_accounts'];
$gmb_briefcase    =  $_POST['gmb_briefcase'];
$gmb_access         =  $_POST['gmb_access']; 
$kw_tags      =  $_POST['kw_tags'];
$kw_replies  =  $_POST['kw_replies'];
$kw_qa    =  $_POST['kw_qa'];
$kw_reviews       =  $_POST['kw_reviews'];
$kw_tracking    =  $_POST['kw_tracking']; 
$oviond_setup    =  $_POST['oviond_setup'];
$fb_page_access      =  $_POST['fb_page_access'];
$instagram_access    =  $_POST['instagram_access'];
$youTube_access    =  $_POST['youTube_access'];
$gmb_optimise    =  $_POST['gmb_optimise'];


// Check if a record with the given client_id exists
$sql = "SELECT * FROM access_optimise WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    
    // Update the record
    $sql = "UPDATE access_optimise SET 
    gmb_accounts = ?,
    gmb_briefcase = ?,
    gmb_access = ?,
    kw_tags = ?,
    kw_reviews = ?,
    kw_replies = ?,
    kw_qa = ?,
    kw_tracking = ?,
    oviond_setup = ?,
    fb_page_access = ?,        
    instagram_access = ?,        
    youTube_access = ?,   
    gmb_optimise = ?   
    WHERE project_id = ?";
 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssi",
        $gmb_accounts,
        $gmb_briefcase,
        $gmb_access,
        $kw_tags,
        $kw_reviews,
        $kw_replies,
        $kw_qa,
        $kw_tracking,
        $oviond_setup,
        $fb_page_access,        
        $instagram_access,      
        $youTube_access,       
        $gmb_optimise,        
        $project_id
    );
    
    
    
    
} else {
    $sql = "INSERT INTO access_optimise (
        project_id,
        gmb_accounts,
        gmb_briefcase,
        gmb_access,
        kw_tags,
        kw_reviews,
        kw_replies,
        kw_qa,
        kw_tracking,
        oviond_setup,
        fb_page_access,        
        instagram_access,        
        youTube_access,        
        gmb_optimise
       
      
        
     
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssssssss",
        $project_id,
        $gmb_accounts,
        $gmb_briefcase,
        $gmb_access,
        $kw_tags,
        $kw_reviews,
        $kw_replies,
        $kw_qa,
        $kw_tracking,
        $oviond_setup,
        $fb_page_access,
        $instagram_access,        
        $youTube_access,       
        $gmb_optimise
        
             
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
