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

<link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

    <body>
   <div class="container">
  <div class="jumbotron">
    <h1 class = "text-center">Pending Rooms</h1>
    </div>
  <div class="row">
   <div class = "col-md-12">
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
   	
	echo "<table style='width:100%' class = 'table-striped table-bordered table-responsive'>";
	echo "<tr>";
	echo "<td><b>Room Name</b></td>";
	echo "<td><b>Email Address</b></td>";
	echo "<td><b>Activity</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "<td><b>Date:</b></td>";
	echo "<td><b>Time Needed</b></td>";
	echo "</tr>";
   	// output data of each row
   	while($row = $result->fetch_assoc()) {
   
   		
   		
   		echo "<tr>";
   		echo "<td>".$row['room_name']."</td>";
   		echo "<td>".$row['email_address']."</td>";
   		echo "<td>".$row['activity']."</td>";
   		echo "<td>".$row['requester']."</td>";
   		echo "<td>".$row['date']."</td>";
   		echo "<td>".$row['time']."</td>";
   		echo "</tr>";
   		
   
   	}
   	echo "</table>";
   } else {
   	echo "0 results";
   }
   
   
   
   $conn->close();
   ?>
   <br>
   <p align='center'>
   <input type ="button" class="btn btn-success" onClick="window.location='adminWindow.php'" value ="Admin Main Menu"/>
   <input type ="button" class="btn btn-success" onClick="window.location='logout.php'" value ="Logout"/></p>
   </div>
    </div>
   
  </div>
</body>
   	
</html>