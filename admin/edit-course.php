<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $tsasaid = $_SESSION['tsasaid'];
        $bname = $_POST['branchname'];
        $cname = $_POST['coursename'];
        $eid = $_GET['editid'];

        $sql = "UPDATE tblcourse SET BranchName=?, CourseName=? WHERE ID=?";
        $stmt = $dbh->prepare($sql);
        $stmt->bind_param("ssi", $bname, $cname, $eid);
        $stmt->execute();
        echo '<script>alert("Course has been updated")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>TSAS : Course Update</title>

    <!-- Styles -->
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
                                <h1>Course</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Course</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Update Course</h4>
                                    <form method="post" name="hjhgh">
                                        <?php
                                        $eid = $_GET['editid'];
                                        $sql = "SELECT * FROM tblcourse WHERE ID=?";
                                        $stmt = $dbh->prepare($sql);
                                        $stmt->bind_param("i", $eid);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        ?>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Course Name</label>
                                                <input type="text" class="form-control border-none input-flat bg-ash" value="<?php echo htmlentities($row['CourseName']); ?>" name="coursename" required="true">
                                            </div>
                                        </div>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Branch Name</label>
                                                <input type="text" class="form-control border-none input-flat bg-ash" name="branchname" required="true" value="<?php echo htmlentities($row['BranchName']); ?>">
                                            </div>
                                        </div>
                                </div>
                                <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Update</button>
                                <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../assets/js/lib/menubar/sidebar.js"></script>
    <script src="../assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="../assets/js/scripts.js"></script>
    <!-- scripit init-->
</body>

</html>
