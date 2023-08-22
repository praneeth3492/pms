<!-- manager_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
$project_id = $_GET['project_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
.footer {
    background-color: #000;
    color: #fff;
    padding: 10px;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
    font-size: 14px;
}

.footer a {
    color: #fff;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

.project-box {
    background-color: #f5f5f5;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    min-height: 200px; /* Adjust as needed */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.project-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
    text-align: center;
}

.circular-progress {
    position: relative;
    width: 80px; /* Adjust the size as needed */
    height: 80px;
    margin-bottom: 10px;
}

.circular-chart {
    width: 100%;
    height: 100%;
}

.circle-bg {
    fill: none;
    stroke: #e6e6e6;
    stroke-width: 2;
}

.circle {
    fill: none;
    stroke: #4caf50; /* You can choose a different color if you prefer */
    stroke-width: 2;
    stroke-linecap: round;
    transition: stroke-dasharray 0.3s ease;
}

.project-description {
    font-size: 14px;
    color: #666;
    margin-top: 10px;
}

/* Additional styles for different card types */
.project-box.project-details { background-color: #AEBDCA; }
.project-box.project-insights { background-color: #F0EBE3; }
.project-box.drs-details  { background-color: #AEBDCA; }
.project-box.access-optimize { background-color: #F0EBE3; }
.project-box.website { background-color: #AEBDCA; }
.project-box.project-launch { background-color: #F0EBE3; }


.percentage-bar {
    background-color: #f0e5d8;
    height: 10px;
    width: 100%;
    position: relative;
    border-radius: 5px;
}

.percentage-fill {
    background-color: #000000;
    height: 100%;
    position: absolute;
    border-radius: 5px;
}

 
 


/* Style the cards */
.card {
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.card h4 {
    font-weight: bold;
    margin-bottom: 10px;
}

.card p.text-center {
    color: #777;
}

 

 
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

<body>

    <div class="sidebar1">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li class="label">Main</li>
                    <li class="active"><a href="manager_dashboard.php"><i class="ti-home"></i>
                            Dashboard </a></li>

                    <?php 
                    $project_details_percentage = 0;
                    $sql = "SELECT * FROM project_details WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                           if (!isset($value) or ($value != null)) {
                                $countNonNull++;
                            }
                        }

                        $totalCount = 18;
                        $project_details_percentage = round((($countNonNull-2)/$totalCount)*100,2);
                    }

                    $project_insight_percentage = 0;
                    $sql = "SELECT * FROM project_insights WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if (!isset($value) or ($value != null)) {
                                $countNonNull++;
                            }
                        }

                        $totalCount = 9;
                        $project_insight_percentage = round((($countNonNull-2)/$totalCount)*100,2);
                    }

                    $drs_detail_percentage = 0;
                    $sql = "SELECT * FROM drs_details WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if (!isset($value) or ($value != null)) {
                                $countNonNull++;
                            }
                        }

                        $totalCount = 9;
                        $drs_detail_percentage = round((($countNonNull-2)/$totalCount)*100,2);
                    }
                    $access_optimise_percentage = 0;
                    $sql = "SELECT * FROM access_optimise WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        // Initialize count
                        $countNonNull = 0;
                    
                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                            if ($value !== null && $value !== '') {
                                $countNonNull++;
                            }
                        }
                    
                        $totalCount = 13; // Total number of fields (9 toggle fields + 4 input fields)
                        $access_optimise_percentage = round(($countNonNull / $totalCount) * 100, 2);
                    }
                    
                    
                    

                    $website_percentage = 0;
                    $sql = "SELECT * FROM website WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                           if (!isset($value) or ($value != null)) {
                                $countNonNull++;
                            }
                        }

                        $totalCount = 9;
                        $website_percentage = round((($countNonNull-2)/$totalCount)*100,2);
                    }


                    $project_launch_percentage = 0;
                    $sql = "SELECT * FROM project_launch WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {

                        // Initialize count
                        $countNonNull = 0;

                        // Loop through the row's values
                        foreach ($result->fetch_assoc() as $value) {
                            // Check if the value is not null
                           if (!isset($value) or ($value != null)) {
                                $countNonNull++;
                            }
                        }

                        $totalCount = 9;
                        $project_launch_percentage = round((($countNonNull-2)/$totalCount)*100,2);
                    }
                    

                    
                    ?>

                    <li><a href="project_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project Details
                        </a></li>
                    <li><a href="project_insights.php?project_id=<?php echo $project_id; ?>"><i class="ti-home"></i> Project
                            Insights </a></li>
                    <li><a href="drs_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Dr/s Details </a>
                    </li>
                    <li><a href="access_optimize.php?project_id=<?php echo $project_id; ?>"><i class="ti-home"></i> Access &
                            Optimize </a></li>
                    <li><a href="website.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Website </a></li>
                    <li><a href="project_launch.php?project_id=<?php echo $project_id; ?>"><i class="ti-home"></i> Project launch
                        </a></li>

                    <li><a href="logout.php"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="pull-left">
            <div class="logo"><a href="index.html">
                    <!-- <img src="assets/images/logo.png" alt="" /> --><span>DrSm@rt</span></a></div>
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
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
                                            <div class="notification-text">5 members joined today </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
                                            <div class="notification-text">likes a photo of you</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
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
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-unread">
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg"
                                            alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Ajay</div>
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
                <li class="header-icon dib"><img class="avatar-img" src="assets/images/avatar/1.jpg" alt="" /> <span
                        class="user-avatar"> <?php echo $_SESSION['manager_name'] ?> <i
                            class="ti-angle-down f-s-10"></i></span>
                    <div class="drop-down dropdown-profile">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Upgrade Now</span>
                            <p class="trial-day">30 Days Trail</p>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="#"><i class="ti-user"></i> <span>Profile</span></a></li>
                                <li><a href="#"><i class="ti-wallet"></i> <span>My Balance</span></a></li>
                                <li><a href="#"><i class="ti-write"></i> <span>My Task</span></a></li>
                                <li><a href="#"><i class="ti-calendar"></i> <span>My Calender</span></a></li>
                                <li><a href="#"><i class="ti-email"></i> <span>Inbox</span></a></li>
                                <li><a href="#"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                <li><a href="#"><i class="ti-help-alt"></i> <span>Help</span></a></li>
                                <li><a href="#"><i class="ti-lock"></i> <span>Lock Screen</span></a></li>
                                <li><a href="#"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
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
        <li class="breadcrumb-item active" aria-current="page"><?php echo $project_id; ?>/ Harin- Neuro</li> <!-- Replace with the variable containing the project name -->
    </ol>
</nav>
            <div class="card-container">

        

<!-- Cards go here -->

                <div class="row">

                <div class="col-md-4">
    <div class="project-box project-details justify-content-center align-items-center">
        <a href="project_details.php?project_id=<?php echo $project_id; ?>">
            <h3 class="project-title">Project Details</h3>
        </a>
        <div class="percentage-bar">
            <div class="percentage-fill" style="width: <?php echo $project_details_percentage; ?>%;"></div>
        </div>
        <p class="project-description"><?php echo $project_details_percentage . '%'; ?></p>
    </div>
</div>


<div class="col-md-4">
    <div class="project-box project-insights justify-content-center align-items-center">
        <a href="project_insights.php?project_id=<?php echo $project_id; ?>">
            <h3 class="project-title">Project Insights</h3>
        </a>
        <div class="percentage-bar">
            <div class="percentage-fill" style="width: <?php echo $project_insight_percentage; ?>%;"></div>
        </div>
        <p class="project-description"><?php echo $project_insight_percentage . '%'; ?></p>
    </div>
</div>



<div class="col-md-4">
    <div class="project-box drs-details justify-content-center align-items-center">
        <a href="drs_details.php?project_id=<?php echo $project_id; ?>">
            <h3 class="project-title">Dr/s Details</h3>
        </a>
        <div class="percentage-bar">
            <div class="percentage-fill" style="width: <?php echo $drs_detail_percentage; ?>%;"></div>
        </div>
        <p class="project-description"><?php echo $drs_detail_percentage . '%'; ?></p>
    </div>
</div>

<div class="col-md-4">
    <div class="project-box access-optimize justify-content-center align-items-center">
        <a href="access_optimize.php?project_id=<?php echo $project_id; ?>">
            <h3 class="project-title">Access & Optimize</h3>
        </a>
        <div class="percentage-bar">
            <div class="percentage-fill" style="width: <?php echo $access_optimise_percentage; ?>%;"></div>
        </div>
        <p class="project-description"><?php echo $access_optimise_percentage . '%'; ?></p>
    </div>
</div>


<div class="col-md-4">
    <div class="project-box website justify-content-center align-items-center">
        <a href="website.php?project_id=<?php echo $project_id; ?>">
            <h3 class="project-title">Website</h3>
        </a>
        <div class="percentage-bar">
            <div class="percentage-fill" style="width: <?php echo $website_percentage; ?>%;"></div>
        </div>
        <p class="project-description"><?php echo $website_percentage . '%'; ?></p>
    </div>
</div>

<div class="col-md-4">
    <div class="project-box project-launch justify-content-center align-items-center">
        <a href="project_launch.php?project_id=<?php echo $project_id; ?>">
            <h3 class="project-title">Project Launch</h3>
        </a>
        <div class="percentage-bar">
            <div class="percentage-fill" style="width: <?php echo $project_launch_percentage; ?>%;"></div>
        </div>
        <p class="project-description"><?php echo $project_launch_percentage . '%'; ?></p>
    </div>
</div>


                </div>
            </div>
        </div>  <footer class="footer">
    Powered by <a href="https://www.drsmart.com" target="_blank">DrSmart</a>
</footer>
    </div>
  

    <?php $conn->close(); ?>
    <script>
        document.querySelectorAll('.circular-progress').forEach(function(progress) {
    var percentage = progress.getAttribute('data-percentage');
    var circle = progress.querySelector('.circle');
    circle.style.strokeDasharray = percentage + ', 100';
});

    </script>
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