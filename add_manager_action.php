<?php
// add_manager_action.php
require_once "config.php";

$managerName = $_POST['managerName'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO managers (manager_name, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $managerName, $password);

if ($stmt->execute()) {

    // Include the SweetAlert script tag
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    // Show SweetAlert notification
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Manager Added Successfully!",
        }).then(function() {
            // Redirect to another page after SweetAlert is closed
            window.location.href = "add_manager.php";
        });
    </script>';
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
