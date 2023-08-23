<!-- manager_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['manager_id']) || !isset($_SESSION['manager_name'])) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
$project_id = $_GET['project_id'];

$sql = "SELECT * FROM website WHERE project_id = ?";
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


/* You may need to add other CSS styles to make it look exactly as you want */

.domain-access-buttons .btn {
    background-color: #ccc;
    color: #fff;
    border: none;
    padding: 10px 20px;
    margin: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.domain-access-buttons .on.active {
    background-color: #28a745; /* Green color for "On" */
}

.domain-access-buttons .off.active {
    background-color: #dc3545; /* Red color for "Off" */
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
                    <li class="sidebar-menu-item"><a href="access_optimize.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Access &
                            Optimize </a></li>
                    <li  class="active sidebar-menu-item"><a href="website.php?project_id=<?php echo $project_id; ?>" ><i class="ti-home"></i> Website </a></li>
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
               
            <form method="post" action="save_website_details.php" id="website">
            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id; ?>">
                <div class="card">
                        <div class="row">


                        

                        <div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="domain-access">Domain Access</label>
        <div class="toggle-buttons">
            <input type="radio" id="domain-access-yes" name="domain_access" value="yes" class="toggle-input yes" <?php echo isset($project_data['domain_access']) && $project_data['domain_access'] == 'yes' ? 'checked' : ''; ?>>
            <label for="domain-access-yes" class="toggle-label">Yes</label>
            <input type="radio" id="domain-access-no" name="domain_access" value="no" class="toggle-input no" <?php echo isset($project_data['domain_access']) && $project_data['domain_access'] == 'no' ? 'checked' : ''; ?>>
            <label for="domain-access-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="wireframe">Wireframe</label>
        <div class="toggle-buttons">
            <input type="radio" id="wireframe-yes" name="wireframe" value="yes" class="toggle-input yes" <?php echo isset($project_data['wireframe']) && $project_data['wireframe'] == 'yes' ? 'checked' : ''; ?>>
            <label for="wireframe-yes" class="toggle-label">Yes</label>
            <input type="radio" id="wireframe-no" name="wireframe" value="no" class="toggle-input no" <?php echo isset($project_data['wireframe']) && $project_data['wireframe'] == 'no' ? 'checked' : ''; ?>>
            <label for="wireframe-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

 

<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="website_content">Website Content</label>
        <div class="toggle-buttons">
            <input type="radio" id="website_content-yes" name="website_content" value="yes" class="toggle-input yes" <?php echo isset($project_data['website_content']) && $project_data['website_content'] == 'yes' ? 'checked' : ''; ?>>
            <label for="website_content-yes" class="toggle-label">Yes</label>
            <input type="radio" id="website_content-no" name="website_content" value="no" class="toggle-input no" <?php echo isset($project_data['website_content']) && $project_data['website_content'] == 'no' ? 'checked' : ''; ?>>
            <label for="website_content-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<!-- Web Design -->
<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="web_design">Web Design</label>
        <div class="toggle-buttons">
            <input type="radio" id="web_design-yes" name="web_design" value="yes" class="toggle-input yes" <?php echo isset($project_data['web_design']) && $project_data['web_design'] == 'yes' ? 'checked' : ''; ?>>
            <label for="web_design-yes" class="toggle-label">Yes</label>
            <input type="radio" id="web_design-no" name="web_design" value="no" class="toggle-input no" <?php echo isset($project_data['web_design']) && $project_data['web_design'] == 'no' ? 'checked' : ''; ?>>
            <label for="web_design-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<!-- Medical SEO -->
<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="medical_seo">Medical SEO</label>
        <div class="toggle-buttons">
            <input type="radio" id="medical_seo-yes" name="medical_seo" value="yes" class="toggle-input yes" <?php echo isset($project_data['medical_seo']) && $project_data['medical_seo'] == 'yes' ? 'checked' : ''; ?>>
            <label for="medical_seo-yes" class="toggle-label">Yes</label>
            <input type="radio" id="medical_seo-no" name="medical_seo" value="no" class="toggle-input no" <?php echo isset($project_data['medical_seo']) && $project_data['medical_seo'] == 'no' ? 'checked' : ''; ?>>
            <label for="medical_seo-no" class="toggle-label">No</label>
        </div>
    </div>
</div>

<!-- Technical SEO -->
<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="technical_seo">Technical SEO</label>
        <div class="toggle-buttons">
            <input type="radio" id="technical_seo-yes" name="technical_seo" value="yes" class="toggle-input yes" <?php echo isset($project_data['technical_seo']) && $project_data['technical_seo'] == 'yes' ? 'checked' : ''; ?>>
            <label for="technical_seo-yes" class="toggle-label">Yes</label>
            <input type="radio" id="technical_seo-no" name="technical_seo" value="no" class="toggle-input no" <?php echo isset($project_data['technical_seo']) && $project_data['technical_seo'] == 'no' ? 'checked' : ''; ?>>
            <label for="technical_seo-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<!-- Whatsapp Setup -->
<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="whatsapp_setup">WhatsApp Setup</label>
        <div class="toggle-buttons">
            <input type="radio" id="whatsapp_setup-yes" name="whatsapp_setup" value="yes" class="toggle-input yes" <?php echo isset($project_data['whatsapp_setup']) && $project_data['whatsapp_setup'] == 'yes' ? 'checked' : ''; ?>>
            <label for="whatsapp_setup-yes" class="toggle-label">Yes</label>
            <input type="radio" id="whatsapp_setup-no" name="whatsapp_setup" value="no" class="toggle-input no" <?php echo isset($project_data['whatsapp_setup']) && $project_data['whatsapp_setup'] == 'no' ? 'checked' : ''; ?>>
            <label for="whatsapp_setup-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<!-- Website Testing -->
<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="website_testing">Website Testing</label>
        <div class="toggle-buttons">
            <input type="radio" id="website_testing-yes" name="website_testing" value="yes" class="toggle-input yes" <?php echo isset($project_data['website_testing']) && $project_data['website_testing'] == 'yes' ? 'checked' : ''; ?>>
            <label for="website_testing-yes" class="toggle-label">Yes</label>
            <input type="radio" id="website_testing-no" name="website_testing" value="no" class="toggle-input no" <?php echo isset($project_data['website_testing']) && $project_data['website_testing'] == 'no' ? 'checked' : ''; ?>>
            <label for="website_testing-no" class="toggle-label">No</label>
        </div>
    </div>
</div>


<!-- Beta Ready -->
<div class="col-md-3">
    <div class="form-group yes-no-toggle">
        <label for="beta_ready">Beta Ready</label>
        <div class="toggle-buttons">
            <input type="radio" id="beta_ready-yes" name="beta_ready" value="yes" class="toggle-input yes" <?php echo isset($project_data['beta_ready']) && $project_data['beta_ready'] == 'yes' ? 'checked' : ''; ?>>
            <label for="beta_ready-yes" class="toggle-label">Yes</label>
            <input type="radio" id="beta_ready-no" name="beta_ready" value="no" class="toggle-input no" <?php echo isset($project_data['beta_ready']) && $project_data['beta_ready'] == 'no' ? 'checked' : ''; ?>>
            <label for="beta_ready-no" class="toggle-label">No</label>
        </div>
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
 $('.btn-group .btn').click(function(){
    var value = $(this).data('value');
    $(this).siblings().removeClass('selected');
    $(this).addClass('selected');
    $(this).parent().find('input').val(value);
});


</script>

    <!-- <script>
        $(document).ready(function () {
            // Autosave interval (in milliseconds)
            var autosaveInterval = 5000; // Every 5 seconds

            var autosaveTimer; // Holds the interval timer

            // Function to autosave form data
            function autosaveForm() {
                var formData = $('#website').serialize();
                $.ajax({
                    url: 'save_website_details.php', // 
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