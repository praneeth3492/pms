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
    <title>Admin Dashboard</title>
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
                    <li class="label">Main</li>
                    <li class="active"><a href="#" class="sidebar-sub-toggle"><i class="ti-home"></i> Dashboard </a></li>
                    <li><a href="add_manager.php" class=""><i class="ti-home"></i> Add Manager </a></li>
                    <li><a href="add_project.php" class=""><i class="ti-home"></i> Add Project </a></li>
                    <li><a href="view_managers.php" class=""><i class="ti-home"></i> View Managers </a></li>
                    <li><a href="assign_project.php" class=""><i class="ti-home"></i> Assign Project </a></li>

                    <li><a href="logout.php"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="pull-left">
            <div class="logo"><a href="index.html"><!-- <img src="assets/images/logo.png" alt="" /> --><span>DrSmart</span></a></div>
        </div>
        <div class="pull-right p-r-15">
            <ul>
                <li class="header-icon dib"><a href="#search"><i class="ti-search"></i></a></li>
                <li class="header-icon dib"><i class="ti-bell"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Recent Notifications</span>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">5 members joined today </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">likes a photo of you</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="#" class="more-link">See All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib"><i class="ti-email"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">2 New Messages</span>
                            <a href="email.html"><i class="ti-pencil-alt pull-right"></i></a>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-unread">
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr.  Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="#" class="more-link">See All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib"><img class="avatar-img" src="assets/images/avatar/1.jpg" alt="" /> <span class="user-avatar"><?php echo $_SESSION['manager_name'] ?>  </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="content-wrap">
    <div class="main-content">
        <div class="container-fluid form-container">
            <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="manager_dashboard.php">Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo isset($project['project_name']) ? $project['project_name'].'/' : ''; ?></li> <!-- Replace with the variable containing the project name -->
    </ol>
</nav>
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome Here</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <?php
            $manager_id = $_SESSION['manager_id'];
            $sql = "SELECT project.project_id, project.project_name FROM project
                    JOIN project_manager ON project.project_id = project_manager.project_id
                    WHERE project_manager.manager_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $manager_id);
            $stmt->execute();
            $result1 = $stmt->get_result();

            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {

                    $totalCount1 = 18;
                    $totalCount2 = 9;
                    $totalCount3 = 9;
                    $totalCount4 = 16;
                    $totalCount5 = 9;
                    $totalCount6 = 9; 

                    $countNonNull1 = 0;
                    $countNonNull2 = 0;
                    $countNonNull3 = 0;
                    $countNonNull4 = 0;
                    $countNonNull5 = 0;
                    $countNonNull6 = 0;

                    $project_details_percentage = 0;
                    $sql = "SELECT * FROM project_details WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['project_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                       

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null) {
                                $countNonNull1++;
                            }
                        }

                        if($countNonNull1 >2) {
                            $countNonNull1 = $countNonNull1 -2;
                        }
                    }

                    $project_insight_percentage = 0;
                    $sql = "SELECT * FROM project_insights WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['project_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null) {
                                $countNonNull2++;
                            }
                        }

                        if($countNonNull2 >2) {
                            $countNonNull2 = $countNonNull2 -2;
                        }
                    }

                    $drs_detail_percentage = 0;
                    $sql = "SELECT * FROM drs_details WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['project_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                       

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null) {
                                $countNonNull3++;
                            }
                        }

                        
                        if($countNonNull3 >2) {
                            $countNonNull3 = $countNonNull3 -2;
                        }
                        $totalCount3 = 9;
                        // $drs_detail_percentage = (($countNonNull-2)/$totalCount)*100;
                    }

                    $access_optimise_percentage = 0;
                    $sql = "SELECT * FROM access_optimise WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['project_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                       

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null) {
                                $countNonNull4++;
                            }
                        }

                        if($countNonNull4 >2) {
                            $countNonNull4 = $countNonNull4 -2;
                        }

                        $totalCount4 = 16;
                        // $access_optimise_percentage = (($countNonNull-2)/$totalCount)*100;
                    }

                    $website_percentage = 0;
                    $sql = "SELECT * FROM website WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['project_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull5 = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null) {
                                $countNonNull5++;
                            }
                        }

                        if($countNonNull5 >2) {
                            $countNonNull5 = $countNonNull5 -2;
                        }

                        $totalCount5 = 9;
                        // $website_percentage = (($countNonNull-2)/$totalCount)*100;
                    }


                    $project_launch_percentage = 0;
                    $sql = "SELECT * FROM project_launch WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['project_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull6 = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null) {
                                $countNonNull6++;
                            }
                        }
                        if($countNonNull6 >2) {
                            $countNonNull6 = $countNonNull6 -2;
                        }
                        $totalCount6 = 9;
                    }

                    $totalRowsCount = $totalCount1 + $totalCount2 + $totalCount3 + $totalCount4 + $totalCount5 + $totalCount6;
                    $totalNonNull   = $countNonNull1 + $countNonNull2 + $countNonNull3 + $countNonNull4 + $countNonNull5 + $countNonNull6;
                    $total_percentage = round(($totalNonNull/$totalRowsCount)*100,2);

                    echo '<div class="col-md-4">';
                    echo '<div class="card justify-content-center align-items-center" >';
                    echo '<a href="view_project.php?project_id=' . $row['project_id'] . '" class="project-link">'.$row["project_name"].'</a>
                    ';
                    echo '<p class="text-center">'.$total_percentage.'%</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="row mt-2"><div class="col-md-12">No Projects assigned.</div></div>';
            }

            $stmt->close();
            ?>
              
           
        </div>
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
    <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/lib/weather/weather-init.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/chartist/chartist-init.js"></script>
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
