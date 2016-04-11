<?php
session_start();
$email = $_POST['emailAddress'];
$activity = $_POST['activity'];
$room = $_POST['room_name'];
$date = $_POST['date'];
$time = $_POST['time'];
$username = $_SESSION['userStudent'];
$reason = $_POST['reason'];

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

$reason = mysql_real_escape_string($reason);

$roomChecker = "SELECT * FROM approved_rooms_db WHERE room_name = '$room' AND date='$date' AND time='$time'";
$result = $conn->query($roomChecker);

if($result->num_rows > 0){

	$msg="The room is currently unavailable for reservation!";
	$msg2="Try asking for a different room instead.";
	header("Location: studentWindow.php?msg1=$msg&msg2=$msg2");
		
	
} else {
	
	$sql = "INSERT INTO pending_rooms_db (email_address, activity, requester, room, date, time, reason)
	VALUES ('$email', '$activity', '$username', '$room', '$date', '$time', '$reason')";
	if ($conn->query($sql) === TRUE) {
		$msg="Your form is now pending for review.";
		$msg2="Please check the email you entered for the result of the review.";
		header("Location: studentWindow.php?msg1=$msg&msg2=$msg2");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}



$conn->close();



?>