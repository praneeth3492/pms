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
$website_score    =  $_POST['website_score'];
$category_rank    =  $_POST['category_rank'];
$keywords         =  $_POST['20_keywords']; 
$kw_rankings      =  $_POST['kw_rankings'];
$gmb_reviews      =  $_POST['gmb_reviews'];
$gmb_rating       =  $_POST['gmb_rating'];
$fb_page_likes    =  $_POST['fb_page_likes'];
$insta_followers  =  $_POST['insta_followers'];
$youtube_views    =  $_POST['youtube_views'];




// Check if a record with the given client_id exists
$sql = "SELECT * FROM project_insights WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    
    // Update the record
    $sql = "UPDATE project_insights SET 
        website_score = ?,
        category_rank = ?,
        keywords_20 = ?,
        kw_rankings = ?,
        gmb_reviews = ?,
        gmb_rating = ?,
        fb_page_likes = ?,
        insta_followers = ?,
        youtube_views = ?
        WHERE project_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $website_score,
        $category_rank,
        $keywords,
        $kw_rankings,
        $gmb_reviews,
        $gmb_rating,
        $fb_page_likes,
        $insta_followers,
        $youtube_views,
        $project_id
    );
    
    
    
    
} else {
   


    // Insert a new record
    $sql = "INSERT INTO project_insights (
        project_id,
        website_score,
        category_rank,
        keywords_20,
        kw_rankings,
        gmb_reviews,
        gmb_rating,
        fb_page_likes,
        insta_followers,
        youtube_views
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssss",
        $project_id,
        $website_score,
        $category_rank,
        $keywords,
        $kw_rankings,
        $gmb_reviews,
        $gmb_rating,
        $fb_page_likes,
        $insta_followers,
        $youtube_views
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
