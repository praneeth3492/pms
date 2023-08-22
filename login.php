<?php
// login.php
session_start();
require_once "config.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['userType'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];
    
    if ($userType == 'admin' || $userType == 'manager') {
        $sql = ($userType == 'admin') ? "SELECT * FROM managers WHERE manager_name = ?" : "SELECT * FROM managers WHERE manager_name = ? AND manager_id != 1";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($userType == 'admin' && $user['is_admin'] != 1) {
                echo "Invalid credentials";
            }elseif(($userType == 'manager') && ($user['is_admin'] == 1)) {
                echo "Invalid credentials";
            }else {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['manager_id'] = $user['manager_id'];
                    $_SESSION['manager_name'] = $user['manager_name'];
                    $redirect = ($userType == 'admin') ? "admin_dashboard.php" : "manager_dashboard.php";
                    header("Location: " . $redirect);
                    exit();
                } else {
                    echo "Invalid password!";
                }
            }
        } else {
            echo "Invalid username!";
        }

        $stmt->close();
    } else {
        echo "Invalid user type!";
    }

    $conn->close();
} else {
    echo "Form data is missing!";
}
?>
