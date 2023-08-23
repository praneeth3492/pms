<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
?>
<!-- add_manager.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Managers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/mystyle.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="">

    <div class="sidebar1">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li><a href="admin_dashboard.php" class="sidebar-sub-toggle"><i class="ti-home"></i> Dashboard </a></li>
                    <li ><a href="add_manager.php" class=""><i class="ti-home"></i> Add Manager </a></li>
                    <li ><a href="add_project.php" class=""><i class="ti-home"></i> Add Project </a></li>
                    <li class="active"><a href="view_managers.php" class=""><i class="ti-home"></i> View Managers </a></li>
                    <li><a href="assign_project.php" class=""><i class="ti-home"></i> Assign Project </a></li>

                    <li><a href="logout.php"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="pull-left">
            <div class="logo"><a href="index.html"><!-- <img src="assets/images/logo.png" alt="" /> --><span>DrSmart</span></a></div>
            <!-- <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div> -->
        </div>
        
    </div>

    <div class="content-wrap">
    <div class="main-content">
        <div class="container-fluid form-container">
                <!-- /# row -->
                <div id="main-content">
                <h1 class="text-center mt-5">View Managers</h1>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-12">
                    <div class="table-container">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Manager ID</th>
                                    <th scope="col">Manager Name</th>
                                </tr>
                            </thead>
                            <tbody id="managers-list">
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
   

    <script>
        function fetchManagers() {
            $.ajax({
                type: "GET",
                url: "fetch_managers.php",
                success: function(response) {
                    $("#managers-list").html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $(document).ready(function() {
            fetchManagers();
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
