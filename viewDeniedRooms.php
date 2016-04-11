<?php 
   $username = $_SESSION['userAdmin'];  
   $_SESSION['userAdmin'] = $username;
   
   if(!$_SESSION['userAdmin']){
   	header("Location: adminWindow.php");
   }
?>
<?php
echo "<h4 class='text text-info' align='center'> Total Number of Denied Room Reservations: ".$total1."</h4>";
$user = "root";
$pass = "";
$dbname = "databasePHP";
$server = "localhost";
if(isset($_GET['page1'])){
	$page1 = $_GET['page1'];
} else {
	$page1 = 1;
}
$recordsPerPage1 = 10;
$start1 = ($page1-1) * $recordsPerPage1;	
// Create connection
$conn = new mysqli($server,$user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	
$sql = "SELECT * FROM denied_rooms_db LIMIT $start1, $recordsPerPage1";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
	echo "<br><tr>";
	echo "<td><b>Room</b></td>";
	echo "<td><b>Activity</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "<td><b>Date</b></td>";
	echo "<td><b>Time Needed</b></td>";
	echo "<td><b>Reason for Reservation</b></td>";
	echo "<td><b>Denied By:</b></td>";
	echo "<td><b>Reason for Denial</b></td>";
	echo "</tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row['room_name']."</td>";
		echo "<td>".$row['activity']."</td>";
		echo "<td>".$row['requester']."</td>";
		echo "<td>".$row['date']."</td>";
		echo "<td>".$row['time']."</td>";
		echo "<td>".$row['reason']."</td>";
		echo "<td>".$row['admin']."</td>";
		echo "<td>".$row['reason_denial']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	$totalRecordsQuery1 = "SELECT * FROM denied_rooms_db";
	$totalRecordsResult1 = $conn->query($totalRecordsQuery1);
	$totalRecords1 = mysqli_num_rows($totalRecordsResult1);
	$totalPages1 = ceil($totalRecords1 / $recordsPerPage1);
	
	echo "<ul class='pagination'>";
	echo "<li><a href='roomDetails.php?page1=1'>|<</a></li>";
	
	for ($ctr1=1; $ctr1 <= $totalPages1; $ctr1++){
		if($ctr1 == $page1){
			echo "<li class='active'><a href='roomDetails.php?page1=".$ctr1."'>".$ctr1."</a></li>";
		} else {
			echo "<li><a href='roomDetails.php?page1=".$ctr1."'>".$ctr1."</a></li>";
		}
	}
	
	echo "<li><a href='roomDetails.php?page1=$totalPages1'>>|</a></li>"; // Goto last page
	echo "</ul>";
} else {

}
$conn->close();
?>