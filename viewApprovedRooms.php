<?php
   $username = $_SESSION['userAdmin'];  
   $_SESSION['userAdmin'] = $username;
   
   if(!$_SESSION['userAdmin']){
    header("Location: adminWindow.php");
   }
?>
<?php
echo "<h4 class='text text-info' align='center'> Total Number of Approved Room Reservations: ".$total."</h4>";
$user = "root";
$pass = "";
$dbname = "databasePHP";
$server = "localhost";
$total = null;

if(isset($_GET['page'])){
	$page = $_GET['page'];
} else {
	$page = 1;
}
$recordsPerPage = 10;
$start = ($page-1) * $recordsPerPage;
// Create connection
$conn = new mysqli($server,$user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	
$sql = "SELECT * FROM approved_rooms_db LIMIT $start, $recordsPerPage";
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
	echo "<td><b>Approved By:</b></td>";
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
		echo "</tr>";
	}
	echo "</table>";
	
	$totalRecordsQuery = "SELECT * FROM approved_rooms_db";
	$totalRecordsResult = $conn->query($totalRecordsQuery);
	$totalRecords = mysqli_num_rows($totalRecordsResult);
	$totalPages = ceil($totalRecords / $recordsPerPage);
	
	echo "<ul class='pagination'>";
	echo "<li><a href='roomDetails.php?page=1'>|<</a></li>";
	
	for ($ctr=1; $ctr <= $totalPages; $ctr++){
		if($ctr == $page){
			echo "<li class='active'><a href='roomDetails.php?page=".$ctr."'>".$ctr."</a></li>";
		} else {
			echo "<li><a href='roomDetails.php?page=".$ctr."'>".$ctr."</a></li>";
		}
	}
	
	echo "<li><a href='roomDetails.php?page=$totalPages'>>|</a></li>"; // Goto last page
	echo "</ul>";
	
} else {

}
$conn->close();
?>