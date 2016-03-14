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
   
   $sql = "SELECT * FROM equipment_pending_db";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
   	echo "<br><form action='decisionEquipmentHandler.php' method='post' align='center'>";
	echo "<table style='width:100%' class = 'table-striped table-bordered table-responsive'>";
	echo "<tr>";
	echo "<td></td>";
	echo "<td><b>Equipment</b></td>";
	echo "<td><b>Quantity</b></td>";
	echo "<td><b>Email Address</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "</tr>";
   	// output data of each row
   	while($row = $result->fetch_assoc()) {
   		$id = $row['id'];
   		echo "<tr>";
   		echo "<td>";
   		echo "<input type='radio' name='decision' value='$id' id='decision'/>";
   		echo "</td>";
   		echo "<td>".$row['equipment_name']."</td>";
   		echo "<td>".$row['quantity']."</td>";
   		echo "<td>".$row['email_address']."</td>";
   		echo "<td>".$row['requester']."</td>";
   		echo "</tr>";
   		
   
   	}
   	echo "</table><br><input type='submit' name='choice' class='btn btn-success' value='Approve'/> <input type='submit' name='choice' class='btn btn-danger' value='Deny'/></form>";
   } else {
   	echo "<br><div class='alert alert-info'>"."<center>There are currently no pending equipments to approve/deny.</center>"."</div>"; //proper message here pls.
   }
   
   
   
   $conn->close();
   ?>

</div>
</div>
</div>
</body>
   	
</html>