<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>TSAS : Teacher Details</title>
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php include_once('includes/sidebar.php'); ?>

    <?php include_once('includes/header.php'); ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Teacher Details</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Teacher Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Teacher Details</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $eid = $_GET['editid'];
                                    $sql = "SELECT tblcourse.ID, tblcourse.BranchName, tblcourse.CourseName, tblteacher.ID, tblteacher.EmpID, tblteacher.FirstName, tblteacher.LastName, tblteacher.MobileNumber, tblteacher.Email, tblteacher.Gender, tblteacher.Dob, tblteacher.CourseID, tblteacher.Religion, tblteacher.Address, tblteacher.Password, tblteacher.ProfilePic, tblteacher.JoiningDate FROM tblteacher JOIN tblcourse ON tblcourse.ID=tblteacher.CourseID WHERE tblteacher.ID=?";
                                    $query = $conn->prepare($sql);
                                    $query->bind_param("i", $eid);
                                    $query->execute();
                                    $result = $query->get_result();

                                    $cnt = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <div class="user-profile m-t-15">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="user-photo m-b-30">
                                                            <img class="img-responsive" src="images/<?php echo htmlentities($row['ProfilePic']); ?>" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="user-profile-name dib"><?php echo htmlentities($row['FirstName']); ?> <?php echo htmlentities($row['LastName']); ?></div>
                                                        <div class="useful-icon dib pull-right">
                                                            <span><a href="edit-teacher-info.php?editid=<?php echo htmlentities($row['ID']); ?>" title="Edit Details"><i class="ti-pencil-alt"></i></a> </span>
                                                        </div>
                                                        <div class="custom-tab user-profile-tab">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">About</a></li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="1">
                                                                    <div class="contact-information">
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">Name:</span>
                                                                            <span class="phone-number"><?php echo htmlentities($row['FirstName']); ?> <?php echo htmlentities($row['LastName']); ?></span>
                                                                        </div>
                                                                        <div class="gender-content">
                                                                            <span class="contact-title">Gender:</span>
                                                                            <span class="gender"><?php echo htmlentities($row['Gender']); ?></span>
                                                                        </div>
                                                                        <div class="birthday-content">
                                                                            <span class="contact-title">Date of Birth:</span>
                                                                            <span class="birth-date"><?php echo htmlentities($row['Dob']); ?> </span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">Religion:</span>
                                                                            <span class="phone-number"><?php echo htmlentities($row['Religion']); ?></span>
                                                                        </div>
                                                                        <div class="email-content">
                                                                            <span class="contact-title">Email:</span>
                                                                            <span class="contact-email"><?php echo htmlentities($row['Email']); ?></span>
                                                                        </div>
                                                                        <div class="email-content">
                                                                            <span class="contact-title">Course</span>
                                                                            <span class="contact-email"><?php echo htmlentities($row['CourseName']); ?> (<?php echo htmlentities($row['BranchName']); ?>)</span>
                                                                        </div>
                                                                        <div class="email-content">
                                                                            <span class="contact-title">Address</span>
                                                                            <span class="contact-email"><?php echo htmlentities($row['Address']); ?></span>
                                                                        </div>
                                                                        <div class="email-content">
                                                                            <span class="contact-title">Joining Date</span>
                                                                            <span class="contact-email"><?php echo htmlentities($row['JoiningDate']); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                            $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    </div>
    <!-- jquery vendor -->
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../assets/js/lib/menubar/sidebar.js"></script>
    <script src="../assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->


    <script src="../assets/js/scripts.js"></script>
</body>

</html>
<?php } ?>
