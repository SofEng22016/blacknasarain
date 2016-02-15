<?php
session_start();
$email = $_POST['emailAddress'];
$activity = $_POST['activity'];
$room_details = $_POST['roomReserve'];
$username = $_SESSION['username'];

$user = "root";
$pass = "";
$dbname = "databasePHP";
$server = "localhost";

// Create connection
$conn = new mysqli($server,$user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO pending_rooms_db (email_address, activity, room_details, requester)
VALUES ('$email', '$activity', '$room_details','$username')";
if ($conn->query($sql) === TRUE) {
	
	header("Location: formSent.php");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>