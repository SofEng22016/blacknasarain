<?php
echo "<h4 class='text text-info' align='center'> Total Number of Approved Rooms: ".$total."</h4>";
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
	
$sql = "SELECT * FROM approved_rooms_db";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	echo "<table style='width:100%' class = 'table-striped table-bordered table-responsive'>";
	echo "<br><tr>";
	echo "<td><b>Room</b></td>";
	echo "<td><b>Activity</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "<td><b>Date</b></td>";
	echo "<td><b>Time Needed</b></td>";
	echo "</tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row['room_name']."</td>";
		echo "<td>".$row['activity']."</td>";
		echo "<td>".$row['requester']."</td>";
		echo "<td>".$row['date']."</td>";
		echo "<td>".$row['time']."</td>";
		echo "</tr>";
	}
	echo "</table>";
		
} else {

}
$conn->close();
?>