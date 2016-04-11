<?php
echo "<h4 class='text text-info' align='center'> Total Number of Approved Equipment: ".$total2."</h4>";
$user = "root";
$pass = "";
$dbname = "databasePHP";
$server = "localhost";
$total = null;
	
// Create connection
$conn = new mysqli($server,$user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	
$sql = "SELECT * FROM equipment_approved_db";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	echo "<table style='width:100%' class = 'table-striped table-bordered table-responsive'>";
	echo "<br><tr>";
	echo "<td><b>Equipment</b></td>";
	echo "<td><b>Quantity</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "<td><b>Email Address</b></td>";
	echo "<td><b>Return Status</b></td>";
	echo "</tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row['equipment_name']."</td>";
		echo "<td>".$row['quantity']."</td>";
		echo "<td>".$row['requester']."</td>";
		echo "<td>".$row['email_address']."</td>";
		echo "<td>".$row['return_status']."</td>";
		echo "</tr>";
	}
	echo "</table>";
		
} else {

}
$conn->close();
?>