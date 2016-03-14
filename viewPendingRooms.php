<?php 
// 	session_start();
// 	$username = $_SESSION['username'];
// 	$_SESSION['username'] = $username;
	
// 	if(!$_SESSION['username']){
// 		$msg = "Please log in as an admin first!";
// 		header("Location: login.php?msg=$msg");
// 	} else
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">

<title>Admin Window</title>

<!-- <link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
</head>
<body>
<!-- <nav class="navbar navbar-inverse"> -->
<!-- <div class="container-fluid"> -->
<!-- <div class="navbar-header"> -->
<!-- <a class="navbar-brand" href="adminWindow.php">EZ Room Reservation</a> -->
<!-- </div> -->
<!-- <ul class="nav navbar-nav"> -->
<!-- <li><a href="adminWindow.php">Admin Homepage</a></li> -->
<!-- <li><a href="addRoomsAdmin.php">Add Available Rooms</a></li> -->
<!-- <li class="active"><a href="viewPendingRooms.php">View Pending Rooms</a></li>  -->
<!-- </ul> -->
<!-- <ul class="nav navbar-nav navbar-right"> -->
<!-- <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->
<!-- </ul> -->
<!-- </div> -->
<!-- </nav> -->
<!-- <div class="container"> -->
<!-- <div class="jumbotron"> -->
<!-- <h1 class = "text-center">Pending Rooms</h1> -->
<!-- </div> -->
<!-- <div class="row"> -->
<!-- <div class = "col-md-12"> -->
   <?php    
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
   
   $sql = "SELECT pending_rooms_db.id, pending_rooms_db.email_address, pending_rooms_db.activity, pending_rooms_db.requester, available_rooms_db.room_name, available_rooms_db.date, available_rooms_db.time FROM pending_rooms_db INNER JOIN available_rooms_db ON pending_rooms_db.room_details=available_rooms_db.id";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
   	echo "<br><form action='decisionHandler.php' method='post' align='center'>";
	echo "<table style='width:100%' class = 'table-striped table-bordered table-responsive'>";
	echo "<tr>";
	echo "<td></td>";
	echo "<td><b>Room Name</b></td>";
	echo "<td><b>Email Address</b></td>";
	echo "<td><b>Activity</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "<td><b>Date:</b></td>";
	echo "<td><b>Time Needed</b></td>";
	echo "</tr>";
   	// output data of each row
   	while($row = $result->fetch_assoc()) {
   		$id = $row['id'];
   		echo "<tr>";
   		echo "<td>";
   		echo "<input type='radio' name='decision' value='$id' id='decision'/>";
   		echo "</td>";
   		echo "<td>".$row['room_name']."</td>";
   		echo "<td>".$row['email_address']."</td>";
   		echo "<td>".$row['activity']."</td>";
   		echo "<td>".$row['requester']."</td>";
   		echo "<td>".$row['date']."</td>";
   		echo "<td>".$row['time']."</td>";	
   		echo "</tr>";
   		
   
   	}
   	echo "</table><br><input type='submit' name='choice' class='btn btn-success' value='Approve'/> <input type='submit' name='choice' class='btn btn-danger' value='Deny'/></form>";
   } else {
   	echo "<br><div class='alert alert-info'>"."<center>There are currently no pending room reservations to approve/deny.</center>"."</div>"; //proper message here pls.
   }
   
   
   
   $conn->close();
   ?>

<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
</body>
   	
</html>