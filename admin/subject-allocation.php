<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $tsasaid = $_SESSION['tsasaid'];
        $cid = $_POST['cid'];
        $teachereid = $_POST['teachereid'];
        $subject = $_POST['subject'];

        $sql = "INSERT INTO tblsuballocation (CourseID, Teacherempid, Subid) VALUES (?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sss", $cid, $teachereid, $subject);
        if ($query->execute()) {
            echo '<script>alert("Subject allocation has been done.")</script>';
            echo "<script>window.location.href ='subject-allocation.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
    // Code for deleting product from cart
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "DELETE FROM tblsuballocation WHERE ID=?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $rid);
        if ($query->execute()) {
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href = 'subject-allocation.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TSAS : Subject Allocation</title>
    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script>
        function getteacher(val) {
            $.ajax({
                type: "POST",
                url: "get_teacher.php",
                data: 'courseid=' + val,
                success: function(data) {
                    $("#teachereid").html(data);
                }
            });

            $.ajax({
                type: "POST",
                url: "get_teacher.php",
                data: 'cid=' + val,
                success: function(data) {
                    $("#subject").html(data);
                }
            });
        }
    </script>
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
                                <h1>Subject Allocation</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Subject Allocation</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Subject Allocation</h4>
                                    <form method="post" name="hjhgh">
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Course</label>
                                                <select class="form-control border-none input-flat bg-ash" name="cid" id="cid" onChange="getteacher(this.value);" required="true">
                                                    <option value="">Select Course</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tblcourse";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo htmlentities($row['ID']); ?>"><?php echo htmlentities($row['CourseName']); ?>(<?php echo htmlentities($row['BranchName']); ?>)</option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Teacher</label>
                                                <select class="form-control border-none input-flat bg-ash" name="teachereid" id="teachereid" required="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <select class="form-control border-none input-flat bg-ash" name="subject" id="subject" required="true">
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                                        <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Subject Allocation Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Employee Name</th>
                                                    <th>Course Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Allocation Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT tblsuballocation.ID as suballid,tblsuballocation.CourseID,tblsuballocation.Teacherempid,tblsuballocation.Subid,tblsuballocation.AllocationDate,tblteacher.EmpID,tblteacher.FirstName,tblteacher.LastName,tblcourse.BranchName,tblcourse.CourseName,tblsubject.ID,tblsubject.CourseID,tblsubject.SubjectFullname,tblsubject.SubjectShortname,tblsubject.SubjectCode FROM tblsuballocation JOIN tblteacher ON tblteacher.EmpID=tblsuballocation.Teacherempid JOIN tblcourse ON tblcourse.ID=tblsuballocation.CourseID JOIN tblsubject ON tblsubject.ID=tblsuballocation.Subid";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    $cnt = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td>
                                                                <?php echo htmlentities($row['FirstName']); ?> <?php echo htmlentities($row['LastName']); ?>(<?php echo htmlentities($row['Teacherempid']); ?>)
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($row['BranchName']); ?>(<?php echo htmlentities($row['CourseName']); ?>)
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($row['SubjectFullname']); ?>(<?php echo htmlentities($row['SubjectCode']); ?>)
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($row['AllocationDate']); ?>
                                                            </td>
                                                            <td>
                                                                <span><a href="subject-allocation.php?delid=<?php echo ($row['suballid']); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger">DELETE </a></span>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        $cnt = $cnt + 1;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
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
    <!-- scripit init-->
</body>

</html>
<?php } ?>
