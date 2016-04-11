<?php 
	$username = $_SESSION['userStudent'];			
	$_SESSION['userStudent'] = $username;
			
	if(!$_SESSION['userStudent']){
		$msg = "Please log in as a student first!";
		header("Location: index.php?msg=$msg");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">
<title>Admin Window</title>
</head>
<body>
   <?php   
   $user = "root";
   $pass = "";
   $dbname = "databasePHP";
   $server = "localhost";
   $dateToday = date("Y-m-d");
   // Create connection
   $conn = new mysqli($server,$user, $pass, $dbname);
   // Check connection
   if ($conn->connect_error) {
   	die("Connection failed: " . $conn->connect_error);
   }
   
   $sql = "SELECT * FROM approved_rooms_db WHERE requester = '$username' AND date > '$dateToday'";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
   	echo "<br><form action='cancelReservationHandler.php' method='post' align='center'>";
	echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
	echo "<tr>";
	echo "<td></td>";
	echo "<td><b>Room</b></td>";
	echo "<td><b>Time</b></td>";
	echo "<td><b>Date of Reservation</b></td>";
	echo "<td><b>Activity</b></td>";
	echo "<td><b>Reason for Reservation</b></td>";
	echo "</tr>";
   	// output data of each row
   	while($row = $result->fetch_assoc()) {
	   		$id = $row['id'];
			echo "<tr>";
			echo "<td>";
			echo "<center><input type='radio' name='decision' value='$id' id='decision'/></center>";
			echo "</td>";
			echo "<td>".$row['room_name']."</td>";
			echo "<td>".$row['time']."</td>";
			echo "<td>".$row['date']."</td>";
			echo "<td>".$row['activity']."</td>";
			echo "<td>".$row['reason']."</td>";
   			echo "</tr>";
   
   	}
   	echo "</table><br><input type='submit' name='choice' class='btn btn-info' value='Cancel Reservation'/></form>";
   } else {
   	echo "<br><div class='alert alert-info'>"."<center>You have no reservations to cancel at the moment.</center>"."</div>"; //proper message here pls.
   }
   
   
   
   $conn->close();
   ?>
</body>
   	
</html>