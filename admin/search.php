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
   
    <title>TSAS Search</title>

    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/datatable/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/lib/datatable/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php include_once('includes/sidebar.php');?>
   
<?php include_once('includes/header.php');?>
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li class="active">Search</li>
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
                            <div class="card-body">
                                <form name="" method="post" enctype="multipart/form-data">
                                    <div class="card-header m-b-20">
                                        <h4>Search Subject Allocation</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Search by Teacher Name or EmpID or Subject</label>
                                                    <input class="form-control border-none input-flat bg-ash" name="searchdata" type="text" required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="search">Submit</button>
                                </form>
                            </div>
                            <?php
                            if(isset($_POST['search']))
                            { 
                                $sdata=$_POST['searchdata'];
                            ?>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>
                                        <table  class="table table-striped table-bordered">
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
                                            $sql = "SELECT tblsuballocation.ID as suballid, tblsuballocation.CourseID, tblsuballocation.Teacherempid, tblsuballocation.Subid, tblsuballocation.AllocationDate, tblteacher.EmpID, tblteacher.FirstName, tblteacher.LastName, tblcourse.BranchName, tblcourse.CourseName, tblsubject.ID, tblsubject.CourseID, tblsubject.SubjectFullname, tblsubject.SubjectShortname, tblsubject.SubjectCode 
                                                FROM tblsuballocation 
                                                JOIN tblteacher ON tblteacher.EmpID = tblsuballocation.Teacherempid 
                                                JOIN tblcourse ON tblcourse.ID = tblsuballocation.CourseID 
                                                JOIN tblsubject ON tblsubject.ID = tblsuballocation.Subid 
                                                WHERE tblteacher.EmpID LIKE '%$sdata%' OR tblteacher.FirstName LIKE '%$sdata%' OR tblteacher.LastName LIKE '%$sdata%' OR tblsubject.SubjectFullname LIKE '%$sdata%'";
                                            $result = $conn->query($sql);
                                            $cnt = 1;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td>
                                                        <?php echo htmlentities($row['FirstName']);?> <?php echo htmlentities($row['LastName']);?>(<?php echo htmlentities($row['Teacherempid']);?>)
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($row['BranchName']);?>(<?php echo htmlentities($row['CourseName']);?>)
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($row['SubjectFullname']);?>(<?php echo htmlentities($row['SubjectCode']);?>)
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($row['AllocationDate']);?>
                                                    </td>
                                                    <td>
                                                        <span><a href="subject-allocation.php?delid=<?php echo $row['suballid'];?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger">DELETE </a></span>
                                                    </td>
                                                </tr>
                                            <?php 
                                                $cnt=$cnt+1;
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="9"> No record found against this date</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jquery vendor -->
<script src="../assets/js/lib/bootstrap.min.js"></script>
<!-- bootstrap -->
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
<!-- nano scroller -->
<script src="../assets/js/lib/menubar/sidebar.js"></script>
<script src="../assets/js/lib/preloader/pace.min.js"></script>
<!-- sidebar -->
<script src="../assets/js/lib/data-table/datatables.min.js"></script>
<script src="../assets/js/lib/data-table/datatables-init.js"></script>
<script src="../assets/js/scripts.js"></script>
<!-- scripit init-->
<?php }  ?>
</body>
</html>
