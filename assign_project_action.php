<!-- assign_client.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['project_id']) && isset($_POST['manager_id'])) {
        $project_id = $_POST['project_id'];
        $manager_id = $_POST['manager_id'];

        $sql = "INSERT INTO project_manager (project_id, manager_id) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $project_id, $manager_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            
            // Include the SweetAlert script tag
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

            // Show SweetAlert notification
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Project assigned to manager successfully!",
                }).then(function() {
                    // Redirect to another page after SweetAlert is closed
                    window.location.href = "assign_project.php";
                });
            });
            </script>';
            // echo "Project assigned to manager successfully!";
        } else {
            echo "Error assigning client to manager: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        
    } else {
        echo "Form data is missing!";
    }
} else {
    echo "Invalid request method!";
}
?>
