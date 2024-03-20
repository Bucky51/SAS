<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// For teacher
if(!empty($_POST["courseid"])) {
    $courseid = $_POST["courseid"];
    $sql = "SELECT * FROM tblteacher WHERE CourseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseid);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<option value="">Select Teacher</option>
<?php
    while ($row = $result->fetch_assoc()) {
?>
<option value="<?php echo htmlentities($row['EmpID']); ?>"><?php echo htmlentities($row['FirstName']); ?> <?php echo htmlentities($row['LastName']); ?>(<?php echo htmlentities($row['EmpID']); ?>)</option>
<?php
    }
}

// For Subject
if(!empty($_POST["cid"])) {
    $cid = $_POST["cid"];
    $query = "SELECT * FROM tblsubject WHERE CourseID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $cid);
    $stmt->execute();
    $result = $stmt->get_result();

?>
<option value="">Select Subject</option>
<?php
    while ($rows = $result->fetch_assoc()) {
?>
<option value="<?php echo htmlentities($rows['ID']); ?>"><?php echo htmlentities($rows['SubjectFullname']); ?>(<?php echo htmlentities($rows['SubjectShortname']); ?>)</option>
<?php
    }
}
