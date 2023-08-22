<!-- manager_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
$project_id = $_GET['project_id'];

$sql = "SELECT * FROM access_optimise WHERE project_id = ?";
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
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 0;
}
.yes-no-toggle .toggle-buttons {
    display: flex;
}

.yes-no-toggle .toggle-input {
    display: none;
}

.yes-no-toggle .toggle-label {
    padding: 5px 10px;
    border: 1px solid #ccc;
    cursor: pointer;
    color: #333;
}

.yes-no-toggle .toggle-input.null:checked + .toggle-label {
    background-color: grey;
}

.yes-no-toggle .toggle-input.yes:checked + .toggle-label {
    background-color: green;
    color: #fff;
}

.yes-no-toggle .toggle-input.no:checked + .toggle-label {
    background-color: red;
    color: #fff;
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
                    <li class="sidebar-menu-item"><a href="manager_dashboard.php"><i class="ti-home"></i>
                            Dashboard </a></li>
                    <li class="sidebar-menu-item"><a href="project_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project Details
                        </a></li>
                    <li class="sidebar-menu-item"><a href="project_insights.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project
                            Insights </a></li>
                    <li class="sidebar-menu-item"><a href="drs_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Dr/s Details </a>
                    </li>
                    <li class="active sidebar-menu-item"><a href="access_optimize.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Access &
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
      
               
            <form method="post" action="save_access_optimize.php" id="access_optimize">
            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id; ?>">
                <div class="card">
                        <div class="row"> 


                        <div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="gmb-accounts">GMB Accounts</label>
        <div class="toggle-buttons">
            <input type="radio" id="gmb-accounts-yes" name="gmb_accounts" value="yes" class="toggle-input yes" <?php echo isset($project_data['gmb_accounts']) && $project_data['gmb_accounts'] == 'yes' ? 'checked' : ''; ?>>
            <label for="gmb-accounts-yes" class="toggle-label">Yes</label>
            <input type="radio" id="gmb-accounts-no" name="gmb_accounts" value="no" class="toggle-input no" <?php echo !isset($project_data['gmb_accounts']) || $project_data['gmb_accounts'] != 'yes' ? 'checked' : ''; ?>>
            <label for="gmb-accounts-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="gmb-briefcase">GMB Briefcase</label>
        <div class="toggle-buttons">
            <input type="radio" id="gmb-briefcase-yes" name="gmb_briefcase" value="yes" class="toggle-input yes" <?php echo isset($project_data['gmb_briefcase']) && $project_data['gmb_briefcase'] == 'yes' ? 'checked' : ''; ?>>
            <label for="gmb-briefcase-yes" class="toggle-label">Yes</label>
            <input type="radio" id="gmb-briefcase-no" name="gmb_briefcase" value="no" class="toggle-input no" <?php echo isset($project_data['gmb_briefcase']) && $project_data['gmb_briefcase'] == 'no' ? 'checked' : ''; ?>>
            <label for="gmb-briefcase-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="gmb-access">GMB Access</label>
        <div class="toggle-buttons">
            <input type="radio" id="gmb-access-yes" name="gmb_access" value="yes" class="toggle-input yes" <?php echo isset($project_data['gmb_access']) && $project_data['gmb_access'] == 'yes' ? 'checked' : ''; ?>>
            <label for="gmb-access-yes" class="toggle-label">Yes</label>
            <input type="radio" id="gmb-access-no" name="gmb_access" value="no" class="toggle-input no" <?php echo isset($project_data['gmb_access']) && $project_data['gmb_access'] == 'no' ? 'checked' : ''; ?>>
            <label for="gmb-access-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="kw-tags">KW #tags</label>
        <div class="toggle-buttons">
            <input type="radio" id="kw-tags-yes" name="kw_tags" value="yes" class="toggle-input yes" <?php echo isset($project_data['kw_tags']) && $project_data['kw_tags'] == 'yes' ? 'checked' : ''; ?>>
            <label for="kw-tags-yes" class="toggle-label">Yes</label>
            <input type="radio" id="kw-tags-no" name="kw_tags" value="no" class="toggle-input no" <?php echo isset($project_data['kw_tags']) && $project_data['kw_tags'] == 'no' ? 'checked' : ''; ?>>
            <label for="kw-tags-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="kw-reviews">KW Reviews</label>
        <div class="toggle-buttons">
            <input type="radio" id="kw-reviews-yes" name="kw_reviews" value="yes" class="toggle-input yes" <?php echo isset($project_data['kw_reviews']) && $project_data['kw_reviews'] == 'yes' ? 'checked' : ''; ?>>
            <label for="kw-reviews-yes" class="toggle-label">Yes</label>
            <input type="radio" id="kw-reviews-no" name="kw_reviews" value="no" class="toggle-input no" <?php echo isset($project_data['kw_reviews']) && $project_data['kw_reviews'] == 'no' ? 'checked' : ''; ?>>
            <label for="kw-reviews-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="kw-replies">KW Replies</label>
        <div class="toggle-buttons">
            <input type="radio" id="kw-replies-yes" name="kw_replies" value="yes" class="toggle-input yes" <?php echo isset($project_data['kw_replies']) && $project_data['kw_replies'] == 'yes' ? 'checked' : ''; ?>>
            <label for="kw-replies-yes" class="toggle-label">Yes</label>
            <input type="radio" id="kw-replies-no" name="kw_replies" value="no" class="toggle-input no" <?php echo isset($project_data['kw_replies']) && $project_data['kw_replies'] == 'no' ? 'checked' : ''; ?>>
            <label for="kw-replies-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="kw-qa">KW Q&A</label>
        <div class="toggle-buttons">
            <input type="radio" id="kw-qa-yes" name="kw_qa" value="yes" class="toggle-input yes" <?php echo isset($project_data['kw_qa']) && $project_data['kw_qa'] == 'yes' ? 'checked' : ''; ?>>
            <label for="kw-qa-yes" class="toggle-label">Yes</label>
            <input type="radio" id="kw-qa-no" name="kw_qa" value="no" class="toggle-input no" <?php echo isset($project_data['kw_qa']) && $project_data['kw_qa'] == 'no' ? 'checked' : ''; ?>>
            <label for="kw-qa-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="kw-tracking">KW Tracking</label>
        <div class="toggle-buttons">
            <input type="radio" id="kw-tracking-yes" name="kw_tracking" value="yes" class="toggle-input yes" <?php echo isset($project_data['kw_tracking']) && $project_data['kw_tracking'] == 'yes' ? 'checked' : ''; ?>>
            <label for="kw-tracking-yes" class="toggle-label">Yes</label>
            <input type="radio" id="kw-tracking-no" name="kw_tracking" value="no" class="toggle-input no" <?php echo isset($project_data['kw_tracking']) && $project_data['kw_tracking'] == 'no' ? 'checked' : ''; ?>>
            <label for="kw-tracking-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group yes-no-toggle">
        <label for="oviond-setup">Oviond Setup</label>
        <div class="toggle-buttons">
            <input type="radio" id="oviond-setup-yes" name="oviond_setup" value="yes" class="toggle-input yes" <?php echo isset($project_data['oviond_setup']) && $project_data['oviond_setup'] == 'yes' ? 'checked' : ''; ?>>
            <label for="oviond-setup-yes" class="toggle-label">Yes</label>
            <input type="radio" id="oviond-setup-no" name="oviond_setup" value="no" class="toggle-input no" <?php echo isset($project_data['oviond_setup']) && $project_data['oviond_setup'] == 'no' ? 'checked' : ''; ?>>
            <label for="oviond-setup-no" class="toggle-label">No</label>
        </div>
    </div>
</div>
 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">FB Page Access</label>
                                        <input type="text" name="fb_page_access" id="fb_page_access" class="form-control" placeholder="Provide FB Link"  value="<?php echo isset($project_data['fb_page_access']) ? $project_data['fb_page_access'] : ''; ?>"  aria-describedby="helpId">
                                    </div>
                                </div>

                               

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Instagram Access</label>
                                        <input type="text" name="instagram_access" id="instagram_access" class="form-control" placeholder="Provide Instagram Link"  value="<?php echo isset($project_data['instagram_access']) ? $project_data['instagram_access'] : ''; ?>" aria-describedby="helpId">
                                    </div>
                                </div>

                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">YouTube Access</label>
                                        <input type="text" name="youTube_access" id="youTube_access" class="form-control" placeholder="Provide YouTube Link" value="<?php echo isset($project_data['youTube_access']) ? $project_data['youTube_access'] : ''; ?>" aria-describedby="helpId">
                                    </div>
                                </div>

                             

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">GMB Optimise</label>
                                        <input type="text" name="gmb_optimise" id="gmb_optimise" class="form-control" placeholder="Provide GMB Link" value="<?php echo isset($project_data['gmb_optimise']) ? $project_data['gmb_optimise'] : ''; ?>"  aria-describedby="helpId">
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
    
    <!-- <script>
        $(document).ready(function () {
            // Autosave interval (in milliseconds)
            var autosaveInterval = 5000; // Every 5 seconds

            var autosaveTimer; // Holds the interval timer

            // Function to autosave form data
            function autosaveForm() {
                var formData = $('#access_optimize').serialize();
                $.ajax({
                    url: 'save_access_optimize.php', // 
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log('Form autosaved:', response);
                    }
                });
            }

            // Start autosaving
            function startAutosave() {
                autosaveTimer = setInterval(autosaveForm, autosaveInterval);
            }

            // Stop autosaving
            function stopAutosave() {
                clearInterval(autosaveTimer);
            }

            // Start autosaving when the form page is loaded
            startAutosave();

            // Stop autosaving when navigating to another sidebar menu
            $('.sidebar-menu-item').click(function () {
                stopAutosave();
            });
        });
    </script> -->
</body>

</html>