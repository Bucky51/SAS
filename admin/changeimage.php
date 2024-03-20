<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $propic = $_FILES["propic"]["name"];
        $extension = substr($propic, strlen($propic) - 4, strlen($propic));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $propic = md5($propic) . time() . $extension;
            move_uploaded_file($_FILES["propic"]["tmp_name"], "images/" . $propic);
            $query = "UPDATE tblteacher SET ProfilePic=? WHERE ID=?";
            $stmt = $dbh->prepare($query);
            $stmt->bind_param('si', $propic, $eid);
            $stmt->execute();
            echo '<script>alert("Profile pic has been updated")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>TSAS : Update Teacher Profile Pic </title>

    <link href="../assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
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
                            <h1>Update Teacher</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li class="active">Teacher Information</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <div id="main-content">
                <div class="card alert">
                    <div class="card-body">
                        <form name="" method="post" action="" enctype="multipart/form-data">
                            <?php
                            $eid = $_GET['editid'];
                            $sql = "SELECT tblcourse.ID as cid,tblcourse.BranchName,tblcourse.CourseName,tblteacher.ID,tblteacher.EmpID,tblteacher.FirstName,tblteacher.LastName,tblteacher.MobileNumber,tblteacher.Email,tblteacher.Gender,tblteacher.Dob,tblteacher.CourseID,tblteacher.Religion,tblteacher.Address,tblteacher.Password,tblteacher.ProfilePic,tblteacher.JoiningDate from tblteacher join tblcourse on tblcourse.ID=tblteacher.CourseID where tblteacher.ID=$eid";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->get_result();

                            $cnt = 1;
                            while ($row = $results->fetch_assoc()) {
                            ?>
                                <div class="card-header m-b-20">
                                    <h4>Profile Pic</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="basic-form">
                                            <div class="form-group image-type">
                                                <label>Old Teacher Photo</label>
                                                <img src="images/<?php echo $row['ProfilePic']; ?>" width="100" height="100" value="<?php echo $row['ProfilePic']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="basic-form">
                                            <div class="form-group image-type">
                                                <label>New Teacher Photo</label>
                                                <input type="file" name="propic" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $cnt++;
                            } ?>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Update</button>
                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                        </form>
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
<script src="../assets/js/lib/calendar-2/moment.latest.min.js"></script>
<!-- scripit init-->
<script src="../assets/js/lib/calendar-2/semantic.ui.min.js"></script>
<!-- scripit init-->
<script src="../assets/js/lib/calendar-2/prism.min.js"></script>
<!-- scripit init-->
<script src="../assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
<!-- scripit init-->
<script src="../assets/js/lib/calendar-2/pignose.init.js"></script>
<!-- scripit init-->
<script src="../assets/js/scripts.js"></script>
</body>

</html>
<?php }
 ?>
