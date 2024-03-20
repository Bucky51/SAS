<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $cid = $_POST['cid'];
        $sfname = $_POST['sfname'];
        $ssname = $_POST['ssname'];
        $subcode = $_POST['subcode'];
        $eid = $_GET['editid'];

        $sql = "UPDATE tblsubject SET CourseID=?, SubjectFullname=?, SubjectShortname=?, SubjectCode=? WHERE ID=?";
        $stmt = $dbh->prepare($sql);
        $stmt->bind_param("isssi", $cid, $sfname, $ssname, $subcode, $eid);
        $stmt->execute();
        echo '<script>alert("Subject has been updated")</script>';
        echo "<script>window.location.href ='subject.php'</script>";
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
                                <h1>Subject</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Subject</li>
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
                                    <h4>Update Subject</h4>
                                    <form method="post" name="hjhgh">
                                        <?php
                                        $eid = $_GET['editid'];
                                        $sql = "SELECT tblcourse.CourseName, tblcourse.BranchName, tblcourse.ID as cid, tblsubject.SubjectFullname, tblsubject.SubjectShortname, tblsubject.SubjectCode, tblsubject.ID as sid FROM tblsubject JOIN tblcourse ON tblcourse.ID=tblsubject.CourseID WHERE tblsubject.ID=?";
                                        $stmt = $dbh->prepare($sql);
                                        $stmt->bind_param("i", $eid);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        ?>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Course Name</label>
                                                <select class="form-control border-none input-flat bg-ash" name="cid">
                                                    <option value="<?php echo htmlentities($row['cid']); ?>"><?php echo htmlentities($row['CourseName']); ?>(<?php echo htmlentities($row['BranchName']); ?>)</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tblcourse";
                                                    $result = $dbh->query($sql);
                                                    while ($row1 = $result->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?php echo htmlentities($row1['ID']); ?>"><?php echo htmlentities($row1['CourseName']); ?>(<?php echo htmlentities($row1['BranchName']); ?>)</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Subject Full Name</label>
                                                <input type="text" class="form-control border-none input-flat bg-ash" name="sfname" required="true" value="<?php echo htmlentities($row['SubjectFullname']); ?>">
                                            </div>
                                        </div>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Subject Short Name</label>
                                                <input type="text" class="form-control border-none input-flat bg-ash" name="ssname" required="true" value="<?php echo htmlentities($row['SubjectShortname']); ?>">
                                            </div>
                                        </div>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Subject Code</label>
                                                <input type="text" class="form-control border-none input-flat bg-ash" name="subcode" required="true" value="<?php echo htmlentities($row['SubjectCode']); ?>">
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
