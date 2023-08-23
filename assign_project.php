<!-- admin_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Project</title>
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
</head>

<body class="">

    <div class="sidebar1">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li><a href="admin_dashboard.php" class="sidebar-sub-toggle"><i class="ti-home"></i> Dashboard </a></li>
                    <li><a href="add_manager.php" class=""><i class="ti-home"></i> Add Manager </a></li>
                    <li><a href="add_client.php" class=""><i class="ti-home"></i> Add Client </a></li>
                    <li><a href="view_managers.php" class=""><i class="ti-home"></i> View Managers </a></li>
                    <li class="active"><a href="assign_project.php" class=""><i class="ti-home"></i> Assign Project </a>
                    </li>

                    <li><a href="logout.php"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="pull-left">
            <div class="logo"><a href="index.html">
                    <!-- <img src="assets/images/logo.png" alt="" /> --><span>DrSmart</span></a></div>
            <!-- <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div> -->
        </div>
        <div class="pull-right p-r-15">
         
        </div>
    </div>

    <div class="content-wrap">
    <div class="main-content">
        <div class="container-fluid form-container">

                <div id="main-content">
                    <div class="row">
                        <form action="assign_project_action.php" method="post" id="assign-client-form" style="margin-top: 20px;">
                            <div class="form-group">
                                <label for="manager_id">Manager:</label>
                                <select class="form-control" id="manager_id" name="manager_id" required>
                                    <?php
                $sql = "SELECT manager_id, manager_name FROM managers";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['manager_id'] . "\">" . $row['manager_name'] . "</option>";
                    }
                }
                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="client_id">Project:</label>
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <?php
                $sql = "SELECT project_id, project_name FROM project";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['project_id'] . "\">" . $row['project_name'] . "</option>";
                    }
                }
                ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign Project</button>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
    <script src="assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <!-- <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/lib/weather/weather-init.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/chartist/chartist-init.js"></script>
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="assets/js/scripts.js"></script> -->
</body>

</html>