<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $empid = $_POST['empid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobnum = $_POST['mobnum'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $cid = $_POST['cid'];
        $religion = $_POST['religion'];
        $address = $_POST['address'];
        $propic = $_FILES["propic"]["name"];
        $extension = pathinfo($propic, PATHINFO_EXTENSION);
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $propic = md5($propic) . time() . ".$extension";
            move_uploaded_file($_FILES["propic"]["tmp_name"], "images/$propic");

            $sql = "SELECT Email FROM tblteacher WHERE Email=? OR MobileNumber=? OR EmpID=?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $email, $mobnum, $empid);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                echo "<script>alert('Email-id,Employee Id or Mobile Number already exist. Please try again');</script>";
            } else {
                $sql = "INSERT INTO tblteacher (EmpID, FirstName, LastName, MobileNumber, Email, Gender, Dob, CourseID, Religion, Address, ProfilePic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("sssssssssss", $empid, $fname, $lname, $mobnum, $email, $gender, $dob, $cid, $religion, $address, $propic);
                if ($stmt->execute()) {
                    echo '<script>alert("Teacher detail has been added.")</script>';
                    echo "<script>window.location.href ='add-teacher.php'</script>";
                } else {
                    echo '<script>alert("Something Went Wrong. Please try again")</script>';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TSAS : Add Teacher Information </title>
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
                            <h1>Add Teacher</h1>
                        </div>
                    </div>
                </div>
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
            </div>
            <div id="main-content">
                <div class="card alert">
                    <div class="card-body">
                        <form name="" method="post" action="" enctype="multipart/form-data">
                            <div class="card-header m-b-20">
                                <h4>Teacher Information</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="fname" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="lname" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="mobnum" maxlength="10" pattern="[0-9]+" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control border-none input-flat bg-ash" name="email" required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Gender*</label>
                                            <select class="form-control bg-ash border-none" name="gender" required="true">
                                                <option>Please Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control calendar bg-ash"  name="dob" required="true">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Emp ID</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="empid" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="basic-form">
    <div class="form-group">
        <label>Course</label>
        <select class="form-control border-none input-flat bg-ash" name="cid" required="true">
            <option value="">Select Course</option>
            <?php
            // Establish a MySQLi connection
            $mysqli = new mysqli("localhost", "username", "password", "database");

            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Prepare and execute the query to fetch courses
            $sql = "SELECT * FROM tblcourse";
            $result = $mysqli->query($sql);

            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ID'] . "'>" . $row['CourseName'] . "(" . $row['BranchName'] . ")</option>";
                }
            } else {
                echo "<option value=''>No courses available</option>";
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </select>
    </div>
</div>

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="religion" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text"  class="form-control border-none input-flat bg-ash" rows="4" cols="4" required="true" name="address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="basic-form">
                                        <div class="form-group image-type">
                                            <label>Upload Teacher Photo <span>(150 X 150)</span></label>
                                            <input type="file" name="propic" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                        </form>
                    </div>
                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
<script src="../assets/js/lib/menubar/sidebar.js"></script>
<script src="../assets/js/lib/preloader/pace.min.js"></script>
<script src="../assets/js/lib/bootstrap.min.js"></script>
<script src="../assets/js/lib/calendar-2/moment.latest.min.js"></script>
<script src="../assets/js/lib/calendar-2/semantic.ui.min.js"></script>
<script src="../assets/js/lib/calendar-2/prism.min.js"></script>
<script src="../assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
<script src="../assets/js/lib/calendar-2/pignose.init.js"></script>
<script src="../assets/js/scripts.js"></script>
</body>
</html>
