<!-- manager_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
$project_id = $_GET['project_id'];


$sql = "SELECT * FROM project_details WHERE project_id = ?";
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
    <title>Project Details</title>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>

    <div class="sidebar sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li class="sidebar-menu-item"><a href="manager_dashboard.php"><i class="ti-home"></i>
                            Dashboard </a></li>
                    <li class="active sidebar-menu-item"><a href="project_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project Details
                        </a></li>
                    <li class="sidebar-menu-item"><a href="project_insights.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Project
                            Insights </a></li>
                    <li class="sidebar-menu-item"><a href="drs_details.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Dr/s Details </a>
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
        <div class="main">
            <div class="container-fluid col-md-8" style="left: 350px; margin-top:30px;">
            <h2><?php echo isset($project['project_name']) ? $project['project_name'].'/' : ''; ?>Project Details</h2>
               
            <form method="POST" action="save_project_details.php" enctype="multipart/form-data" id="project_details_form">
            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id; ?>">
                <div class="card">
                        <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Project Name</label>
                                        <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Project Name" value="<?php echo isset($project_data['project_name']) ? $project_data['project_name'] : ''; ?>">
                                    </div>
                                </div>

                            <div class="col-md-6">
    <div class="form-group">
        <label for="">Project Logo</label>
        <input type="file" name="project_logo" id="project_logo" class="form-control" placeholder="Project Logo" value="<?php echo isset($project_data['project_logo']) ? $project_data['project_logo'] : ''; ?>" aria-describedby="helpId">

        <?php
        if (isset($project_data['project_logo'])) {
            $filePath = "http://pms.praneethkumar.co.in/uploads/" . $project_data['project_logo'];
            $fileName = basename($project_data['project_logo']);
            echo '<a href="' . $filePath . '" download>Download ' . $fileName . '</a>';
        }
        ?>
    </div>
</div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="">Project Type</label>
                                        <select class="form-control" name="project_type">
                                                <option value="">Select</option>
                                                <option value="Consultant" <?php echo isset($project_data['project_type']) ? (($project_data['project_type'] == 'Consultant') ? 'selected' : '') : ''; ?>>Consultant</option>
                                                <option value="Clinic"  <?php echo isset($project_data['project_type']) ? (($project_data['project_type'] == 'Clinic') ? 'selected' : '') : ''; ?>>Clinic</option>
                                                <option value="Hospital"  <?php echo isset($project_data['project_type']) ? (($project_data['project_type'] == 'Hospital') ? 'selected' : '') : ''; ?>>Hospital</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Domain Name/s</label>
                                        <input type="text" name="domain_names" id="domain_names" class="form-control" placeholder="Domain Name/s"  value="<?php echo isset($project_data['domain_names']) ? $project_data['domain_names'] : ''; ?>" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Specialisation/s</label>
                                        <input type="text" name="specialisations" id="specialisations" class="form-control" placeholder="Specialisation/s"  value="<?php echo isset($project_data['specialisations']) ? $project_data['specialisations'] : ''; ?>" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Working Hrs/s</label>
                                        <input type="text" name="working_hrs" id="working_hrs" class="form-control" placeholder="Working Hrs"  value="<?php echo isset($project_data['working_hrs']) ? $project_data['working_hrs'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Coordinator</label>
                                        <input type="text" name="co_ordinator" id="co_ordinator" class="form-control" placeholder="Coordinator"  value="<?php echo isset($project_data['co_ordinator']) ? $project_data['co_ordinator'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Mobile No</label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No"  value="<?php echo isset($project_data['mobile_no']) ? $project_data['mobile_no'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Location/s</label>
                                        <input type="text" name="locations" id="locations" class="form-control" placeholder="Location/s"  value="<?php echo isset($project_data['locations']) ? $project_data['locations'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">WhatsApp No</label>
                                        <input type="text" name="whatsapp_no" id="whatsapp_no" class="form-control" placeholder="WhatsApp No"  value="<?php echo isset($project_data['whatsapp_no']) ? $project_data['whatsapp_no'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Address/es</label>
                                        <input type="text" name="addresses" id="addresses" class="form-control" placeholder="Address/es"  value="<?php echo isset($project_data['addresses']) ? $project_data['addresses'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">ExtInt Photos</label>
                                        <input type="file" name="extinct_photos[]" id="extinct_photos" class="form-control" placeholder="ExtInt Photos"  value="<?php echo isset($project_data['extinct_photos']) ? $project_data['extinct_photos'] : ''; ?>" aria-describedby="helpId" multiple>

                                        <?php
                                        if(isset($project_data['extinct_photos'])) {
                                            $extinct_photos_array = explode(",", $project_data['extinct_photos']);
                                            // print_r($extinct_photos_array);
                                            echo '<div>';
                                            foreach ($extinct_photos_array as $item) {
                                                if ($item != '') {
                                                    echo '<img src="' . dirname($_SERVER["SCRIPT_FILENAME"]) . "/" . $item . '" style="width:200px;">';
                                                }
                                            }
                                            echo '</div>';
                                            
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Team Size</label>
                                        <input type="text" name="team_size" id="team_size" class="form-control" placeholder="Team Size"  value="<?php echo isset($project_data['team_size']) ? $project_data['team_size'] : ''; ?>" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Equip Photos</label>
                                        <input type="file" name="equip_photos[]" id="equip_photos" class="form-control" placeholder="Equip Photos" value="<?php echo isset($project_data['equip_photos']) ? $project_data['equip_photos'] : ''; ?>" aria-describedby="helpId" multiple>

                                        <?php
                                        if(isset($project_data['equip_photos'])) {
                                            $equip_photos_array = explode(",", $project_data['equip_photos']);

                                        
                                            
                                            echo '<div>';
                                            foreach ($equip_photos_array as $item) {
                                                if ($item != '') {
                                                    echo '<img src="' . dirname($_SERVER["SCRIPT_FILENAME"]) . "/" . $item . '" style="width:200px;">';
                                                }
                                            }
                                            echo '</div>';
                                            
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Start Date"  value="<?php echo isset($project_data['start_date']) ? $project_data['start_date'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Credentials</label>
                                        <input type="text" name="credentials" id="credentials" class="form-control" placeholder="Credentials"  value="<?php echo isset($project_data['credentials']) ? $project_data['credentials'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Launch Date</label>
                                        <input type="text" name="launch_date" id="launch_date" class="form-control" placeholder="Launch Date"  value="<?php echo isset($project_data['launch_date']) ? $project_data['launch_date'] : ''; ?>"aria-describedby="helpId">
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">List of Services</label>
                                        <input type="text" name="list_of_services" id="list_of_services" class="form-control" placeholder="List of Services"  value="<?php echo isset($project_data['list_of_services']) ? $project_data['list_of_services'] : ''; ?>"aria-describedby="helpId">
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#start_date, #launch_date").datepicker();
        });

            // $(document).ready(function() {
            //     // Autosave interval (in milliseconds)
            //     var autosaveInterval = 5000; // Every 5 seconds

            //     var autosaveTimer; // Holds the interval timer

            //     // Function to autosave form data
            //     function autosaveForm() {
            //         var formData = $('#project_details_form').serialize();
            //         $.ajax({
            //             url: 'save_project_details.php', // 
            //             method: 'POST',
            //             data: formData,
            //             success: function(response) {
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
            //     $('.sidebar-menu-item').click(function() {
            //         stopAutosave();
            //     });
            // });
    </script>
</body>

</html>