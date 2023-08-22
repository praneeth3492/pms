<?php
session_start();
require_once "config.php";

// Check if the user is logged in
if (!isset($_SESSION["manager_id"])) {
    header("Location: login.php");
    exit;
}

// Get the submitted data
$project_id = $_POST['project_id'];
$drs = $_POST['drs'];
$name = $_POST['name'];
$qualifications = $_POST['qualifications']; 
$specialisation = $_POST['specialisation'];
$years_of_exp = $_POST['years_of_exp'];
$languages = $_POST['languages'];
$availability = $_POST['availability'];

// Check if a record with the given client_id exists
$sql = "SELECT * FROM drs_details WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $previousData = $result->fetch_assoc();

    $cvs = "uploads/".$previousData['cvs']; // Example path

    if (file_exists($cvs)) {
        unlink($cvs);
    }

    $drs_photos = "uploads/".$previousData['drs_photos']; // Example path

    if (file_exists($drs_photos)) {
        unlink($drs_photos);
    }

    $cvs = $_FILES["cvs"]["name"];
    $fileTmpName = $_FILES["cvs"]["tmp_name"];
    $folderPath = "uploads/"; // Specify the folder path where files will be stored

   // Move the uploaded file to the folder
   $cvs = $folderPath .time().$cvs;
   move_uploaded_file($fileTmpName, $cvs);

   $drs_photos = $_FILES["drs_photos"]["name"];
   $fileTmpName = $_FILES["drs_photos"]["tmp_name"];
   $folderPath = "uploads/"; // Specify the folder path where files will be stored

   // Move the uploaded file to the folder
   $drs_photos = $folderPath .time().$drs_photos;
   move_uploaded_file($fileTmpName, $drs_photos);

    // Update the record
    $sql = "UPDATE drs_details SET 
        drs = ?,
        `name` = ?,
        qualifications = ?,
        specialisation = ?,
        years_of_exp = ?,
        languages = ?,
        `availability` = ?,
        cvs = ?,
        drs_photos = ?
        WHERE project_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $drs,
        $name,
        $qualifications,
        $specialisation,
        $years_of_exp,
        $languages,
        $availability,
        $cvs,
        $drs_photos,
        $project_id
    );
    
    
    
    
} else {
    $cvs = $_FILES["cvs"]["name"];
    $fileTmpName = $_FILES["cvs"]["tmp_name"];
    $folderPath = "uploads/"; // Specify the folder path where files will be stored

    // Move the uploaded file to the folder
    $cvs = $folderPath .time().$cvs;
    move_uploaded_file($fileTmpName, $cvs);

    $drs_photos = $_FILES["drs_photos"]["name"];
    $fileTmpName = $_FILES["drs_photos"]["tmp_name"];
    $folderPath = "uploads/"; // Specify the folder path where files will be stored

    // Move the uploaded file to the folder
    $drs_photos = $folderPath .time().$drs_photos;
    move_uploaded_file($fileTmpName, $drs_photos);


    // Insert a new record
    $sql = "INSERT INTO drs_details (
        project_id,
        drs,
        `name`,
        qualifications,
        specialisation,
        years_of_exp,
        languages,
        `availability`,
        cvs,
        drs_photos
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssss",
        $project_id,
        $drs,
        $name,
        $qualifications,
        $specialisation,
        $years_of_exp,
        $languages,
        $availability,
        $cvs,
        $drs_photos
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
