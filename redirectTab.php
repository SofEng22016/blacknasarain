<?php 
	session_start();
	$username = $_SESSION['username'];
	$_SESSION['username'] = $username;
	
	if(!$_SESSION['username']){
		$msg = "Please log in as an admin first!";
		header("Location: login.php?msg=$msg");
	} else
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">

<title>Admin Window</title>

<link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="#">EZ Room Reservation</a>
</div>
<ul class="nav navbar-nav">
<li><a href="adminWindow.php">Admin Homepage</a></li>
<li class="active"><a href="addRoomsAdmin.php">Add Available Rooms</a></li>
<li><a href="viewPendingRooms.php">View Pending Rooms</a></li> 
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
</ul>
</div>
</nav>
<div class="container">
<div class="jumbotron">
			<?php 
    			echo "<h1 align='center'><div class='text text-success'>Welcome Admin ".$username."</div></h1>";
    		?>
</div>
<div class="row">
<div class = "col-md-4"></div>

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
	$msg1 = "Room is already available!";
	header("Location: adminWindow.php?msg1=$msg1");
} else {

	 $sql = "INSERT INTO available_rooms_db (room_name, date, time) VALUES ('$room_name', '$date', '$time')";
		if ($conn->query($sql) === TRUE) {

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
}



$conn->close();
?>
<div class='col-md-4'>
<div class='alert alert-success'><p align ='center'>New Room Added!</p></div>
<p align='center'>
<input type ="button" class="btn btn-success" onClick="window.location='adminWindow.php'" value ="Admin Main Menu"/>
<input type ="button" class="btn btn-success" onClick="window.location='logout.php'" value ="Logout"/></p>
</div>
<div class='col-md-4'></div>
</div>
</div>
</body>
</html>