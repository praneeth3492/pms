<!-- manager_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
$project_id = $_GET['project_id'];

// Fetch the client's data from the database if necessary
$sql = "SELECT * FROM drs_details WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$project_data = [];

if ($result->num_rows > 0) {
    $project_data = $result->fetch_assoc();
}

$stmt->close();


// Fetch the client's data from the database if necessary
$sql1 = "SELECT * FROM project WHERE project_id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $project_id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$project = [];

if ($result1->num_rows > 0) {
    $project = $result1->fetch_assoc();
}
$stmt1->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
                    <li class="sidebar-menu-item"><a href="manager_dashboard.php"><i class="ti-home"></i>
                            Dashboard </a></li>
                    <li class="sidebar-menu-item"><a href="project_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project Details
                        </a></li>
                    <li class="sidebar-menu-item"><a href="project_insights.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project
                            Insights </a></li>
                    <li class="active sidebar-menu-item"><a href="drs_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Dr/s Details </a>
                    </li>
                    <li class="sidebar-menu-item"><a href="access_optimize.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Access &
                            Optimize </a></li>
                    <li class="sidebar-menu-item"><a href="website.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Website </a></li>
                    <li class="sidebar-menu-item"><a href="project_launch.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project launch
                        </a></li>

                    <li class="sidebar-menu-item"><a href="logout.php"><i class="ti-close"></i> Logout</a></li>
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
        <li class="breadcrumb-item active" aria-current="page"> <?php echo isset($project['project_name']) ? $project['project_name'].'/' : ''; ?></li> <!-- Replace with the variable containing the project name -->
    </ol>
</nav>
    
               
            <form method="post" action="save_drs_details.php" enctype="multipart/form-data" id="drs_details">
            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id; ?>">
                <div class="card">
                        <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Dr Name </label>
                                        <input type="text" name="drs" id="drs" class="form-control" value="<?php echo isset($project_data['drs']) ? $project_data['drs'] : ''; ?>"placeholder="Dr Name" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expertise</label>
                                        <input type="text" name="name" id="name" class="form-control"  value="<?php echo isset($project_data['name']) ? $project_data['name'] : ''; ?>" placeholder="Expertise" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Qualifications</label>
                                        <input type="text" name="qualifications" id="qualifications" value="<?php echo isset($project_data['qualifications']) ? $project_data['qualifications'] : ''; ?>"class="form-control" placeholder="Qualifications" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Specialisation</label>
                                        <input type="text" name="specialisation" id="specialisation" value="<?php echo isset($project_data['specialisation']) ? $project_data['specialisation'] : ''; ?>"class="form-control" placeholder="Specialisation" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Years of Exp</label>
                                        <input type="text" name="years_of_exp" id="years_of_exp" value="<?php echo isset($project_data['years_of_exp']) ? $project_data['years_of_exp'] : ''; ?>"class="form-control" placeholder="Years of Exp" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Languages</label>
                                        <input type="text" name="languages" id="languages" value="<?php echo isset($project_data['languages']) ? $project_data['languages'] : ''; ?>"class="form-control" placeholder="Languages" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Availability</label>
                                        <input type="text" name="availability" id="availability" value="<?php echo isset($project_data['availability']) ? $project_data['availability'] : ''; ?>"class="form-control" placeholder="Availability" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> CV</label>
                                        <input type="file" name="cvs" id="cvs" class="form-control" value="<?php echo isset($project_data['cvs']) ? $project_data['cvs'] : ''; ?>"placeholder="CV" aria-describedby="helpId">


  <?php
if (isset($project_data['cvs'])) {
    $filePath = "http://pms.praneethkumar.co.in/" . $project_data['cvs'];
    $fileName = basename($project_data['cvs']); // Extracts the file name from the path
    echo '<a href="' . $filePath . '" download>Download ' . $fileName . '</a>';
}
?>



                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Doctor  Photos</label>
                                        <input type="file" name="drs_photos" id="drs_photos" value="<?php echo isset($project_data['drs_photos']) ? $project_data['drs_photos'] : ''; ?>"class="form-control" placeholder="Dr/s  Photos" aria-describedby="helpId">

                                     <?php
if (isset($project_data['drs_photos'])) {
    $imagePath = "http://pms.praneethkumar.co.in/" . $project_data['drs_photos'];
    echo '<img src="' . $imagePath . '" style="width: 200px;">';
}
?>
                                    </div>
                                </div>

                        </div>



            </div>
               
            <div class="row justify-content-end align-items-end">
                    <button type="submit" class="btn btn-success" style="margin-top: 10px; margin-right:5px;margin-bottom:10px;width: 200px;">Save</button>
            </div>
            </form>
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

    <script>
        //  $(document).ready(function () {
        //     // Autosave interval (in milliseconds)
        //     var autosaveInterval = 5000; // Every 5 seconds

        //     var autosaveTimer; // Holds the interval timer

        //     // Function to autosave form data
        //     function autosaveForm() {
        //         var formData = $('#drs_details').serialize();
        //         $.ajax({
        //             url: 'save_drs_details.php', // 
        //             method: 'POST',
        //             data: formData,
        //             success: function (response) {
        //                 console.log('Form autosaved:', response);
        //             }
        //         });
        //     }

        //     // Start autosaving
        //     function startAutosave() {
        //         autosaveTimer = setInterval(autosaveForm, autosaveInterval);
        //     }

        //     // Stop autosaving
        //     function stopAutosave() {
        //         clearInterval(autosaveTimer);
        //     }

        //     // Start autosaving when the form page is loaded
        //     startAutosave();

        //     // Stop autosaving when navigating to another sidebar menu
        //     $('.sidebar-menu-item').click(function () {
        //         stopAutosave();
        //     });
        // });
    </script>
</body>

</html>