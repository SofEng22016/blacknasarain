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

$sql = "INSERT INTO available_rooms_db (room_name, date, time)
VALUES ('$room_name', '$date', '$time')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>