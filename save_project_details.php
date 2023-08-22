<?php
session_start();
require_once "config.php";

// Check if the user is logged in
if (!isset($_SESSION["manager_id"])) {
    header("Location: login.php");
    exit;
}
// print_r($_POST);
// Get the submitted data
$project_id = $_POST['project_id'];
$project_name = (isset($_POST['project_name'])) ? $_POST['project_name'] : NULL;
$project_type = $_POST['project_type'];
$domain_names = $_POST['domain_names']; 
// echo $project_id;
// echo $project_name;
// die($project_name);
$specialisations = $_POST['specialisations'];
$working_hrs = $_POST['working_hrs'];
$co_ordinator = $_POST['co_ordinator'];
$mobile_no = $_POST['mobile_no'];
$locations = $_POST['locations'];
$whatsapp_no = $_POST['whatsapp_no'];
$addresses = $_POST['addresses'];
$team_size = $_POST['team_size'];
$start_date = $_POST['start_date'];
$credentials = $_POST['credentials'];
$launch_date = $_POST['launch_date'];
$list_of_services = $_POST['list_of_services'];

// Check if a record with the given client_id exists
$sql = "SELECT * FROM project_details WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $previousData = $result->fetch_assoc();

    $project_logo = $previousData['project_logo']; // Example path

    if (file_exists($project_logo)) {
        unlink($project_logo);
    }


    $project_logo = $_FILES["project_logo"]["name"];
    $fileTmpName = $_FILES["project_logo"]["tmp_name"];
    $folderPath = "uploads/"; // Specify the folder path where files will be stored

    // // Move the uploaded file to the folder
    // $project_logo = $folderPath .time().$project_logo;
    // move_uploaded_file($fileTmpName, $project_logo);

    // Create a unique file name using the current timestamp
    $uniqueFileName = time() . '_' . $project_logo;
    $project_logo = $folderPath . $uniqueFileName;

    move_uploaded_file($fileTmpName, $project_logo);

    $extinctPhotosData = $_FILES['extinct_photos'];
    $extinctPhotosCount = count($extinctPhotosData['name']);

    $extinct_photos = '';

    for ($i = 0; $i < $extinctPhotosCount; $i++) {
        $filename = basename($extinctPhotosData['name'][$i]);
        $filepath = "uploads/" . time().$filename;
        
        if (move_uploaded_file($extinctPhotosData['tmp_name'][$i], $filepath)) {
           $extinct_photos = $extinct_photos.','. $filepath;
        }
    }
    
    
    $equipPhotosData = $_FILES['equip_photos'];
    $equipPhotosCount = count($equipPhotosData['name']);

    $equip_photos = '';

    for ($i = 0; $i < $equipPhotosCount; $i++) {
        $filename = basename($equipPhotosData['name'][$i]);
        $filepath = "uploads/" . time().$filename;
        
        if (move_uploaded_file($equipPhotosData['tmp_name'][$i], $filepath)) {
           $equip_photos = $equip_photos.','. $filepath;
        }
    }

    // Update the record
    $sql = "UPDATE project_details SET 
        project_name = ?,
        project_logo = ?,
        project_type = ?,
        domain_names = ?,
        specialisations = ?,
        working_hrs = ?,
        co_ordinator = ?,
        mobile_no = ?,
        locations = ?,
        whatsapp_no = ?,
        addresses = ?,
        extinct_photos = ?,
        team_size = ?,
        equip_photos = ?,
        start_date = ?,
        credentials = ?,
        launch_date = ?,
        list_of_services = ?
        WHERE project_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssssssssi",
        $project_name,
        $project_logo,
        $project_type,
        $domain_names,
        $specialisations,
        $working_hrs,
        $co_ordinator,
        $mobile_no,
        $locations,
        $whatsapp_no,
        $addresses,
        $extinct_photos,
        $team_size,
        $equip_photos,
        $start_date,
        $credentials,
        $launch_date,
        $list_of_services,
        $project_id,
    );
    
    
    
    
} else {
    $project_logo = $_FILES["project_logo"]["name"];
    $fileTmpName = $_FILES["project_logo"]["tmp_name"];
    $folderPath = "uploads/"; // Specify the folder path where files will be stored

    // Move the uploaded file to the folder
    $project_logo = $folderPath .time().$project_logo;
    move_uploaded_file($fileTmpName, $project_logo);

    $extinctPhotosData = $_FILES['extinct_photos'];
    $extinctPhotosCount = count($extinctPhotosData['name']);

    $extinct_photos = '';

    for ($i = 0; $i < $extinctPhotosCount; $i++) {
        $filename = basename($extinctPhotosData['name'][$i]);
        $filepath = "uploads/" . time().$filename;
        
        if (move_uploaded_file($extinctPhotosData['tmp_name'][$i], $filepath)) {
           $extinct_photos = $extinct_photos.','. $filepath;
        }
    }
    
    
    $equipPhotosData = $_FILES['equip_photos'];
    $equipPhotosCount = count($equipPhotosData['name']);

    $equip_photos = '';

    for ($i = 0; $i < $equipPhotosCount; $i++) {
        $filename = basename($equipPhotosData['name'][$i]);
        $filepath = "uploads/" . time().$filename;
        
        if (move_uploaded_file($equipPhotosData['tmp_name'][$i], $filepath)) {
           $equip_photos = $equip_photos.','. $filepath;
        }
    }

    // Insert a new record
    $sql = "INSERT INTO project_details (
        project_id,
        project_name,
        project_logo,
        project_type,
        domain_names,
        specialisations,
        working_hrs,
        co_ordinator,
        mobile_no,
        locations,
        whatsapp_no,
        addresses,
        extinct_photos,
        team_size,
        equip_photos,
        start_date,
        credentials,
        launch_date,
        list_of_services
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "issssssssssssssssss",
        $project_id,
        $project_name,
        $project_logo,
        $project_type,
        $domain_names,
        $specialisations,
        $working_hrs,
        $co_ordinator,
        $mobile_no,
        $locations,
        $whatsapp_no,
        $addresses,
        $extinct_photos,
        $team_size,
        $equip_photos,
        $start_date,
        $credentials,
        $launch_date,
        $list_of_services
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
