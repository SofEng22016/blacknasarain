<?php 
	session_start();
	$username = $_SESSION['username'];
	$_SESSION['username'] = $username;
	
	if(!$_SESSION['username']){
		$msg = "Please log in as an admin first!";
		header("Location: login.php?msg=$msg");
	} else
?>
<?php

$room_name = $_POST['room_name'];
$date = $_POST['date'];
$time = $_POST['time'];

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

$roomChecker = "SELECT * FROM available_rooms_db WHERE room_name ='$room_name' AND date ='$date' AND time ='$time'";
$result = $conn->query($roomChecker);

if ($result->num_rows > 0) {
	$msg1 = "Room is already available for reservation!";
	header("Location: adminWindow.php?msg=$msg1");
} else {

	 $sql = "INSERT INTO available_rooms_db (room_name, date, time) VALUES ('$room_name', '$date', '$time')";
		if ($conn->query($sql) === TRUE) {
			$msg = "New Room Added!";
			header("Location: adminWindow.php?msg=$msg");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
}



$conn->close();
?>
