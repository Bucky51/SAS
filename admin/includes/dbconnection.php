<?php 
// DB credentials.
$DB_HOST ='localhost';
$DB_NAME = 'tsasdb';
$DB_PASS ='';
$DB_USER='root';

// Create connection
$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME,3325);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set encoding to UTF-8
$conn->set_charset("utf8");
?>
