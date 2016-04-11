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
   
   // Create connection
   $conn = new mysqli($server,$user, $pass, $dbname);
   // Check connection
   if ($conn->connect_error) {
   	die("Connection failed: " . $conn->connect_error);
   }
   
   $sql = "SELECT * FROM equipment_approved_db WHERE requester = '$username' AND return_status='Returned'";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
	echo "<br><table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
	echo "<tr>";
	echo "<td><b>Equipment</b></td>";
	echo "<td><b>Quantity</b></td>";
	echo "</tr>";
   	// output data of each row
   	while($row = $result->fetch_assoc()) {
   		$id = $row['id'];
   		echo "<tr>";
   		echo "<td>".$row['equipment_name']."</td>";
   		echo "<td>".$row['quantity']."</td>";
   		echo "</tr>";
   		
   
   	}
   	echo "</table><br>";
   } else {
   	echo "<br><div class='alert alert-info'>"."<center>You have not borrowed a single equipment from us.</center>"."</div>"; //proper message here pls.
   }
   
   
   
   $conn->close();
   ?>

</body>
   	
</html>