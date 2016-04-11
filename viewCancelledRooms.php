<?php 
   $username = $_SESSION['userAdmin'];  
   $_SESSION['userAdmin'] = $username;
   
   if(!$_SESSION['userAdmin']){
   	header("Location: adminWindow.php");
   }
?>
<?php
echo "<h4 class='text text-info' align='center'> Total Number of Cancelled Room Reservations: ".$total4."</h4>";
$user = "root";
$pass = "";
$dbname = "databasePHP";
$server = "localhost";
$total = null;
if(isset($_GET['page2'])){
	$page2 = $_GET['page2'];
} else {
	$page2 = 1;
}
$recordsPerPage2 = 10;
$start2 = ($page2-1) * $recordsPerPage2;	
// Create connection
$conn = new mysqli($server,$user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	
$sql = "SELECT * FROM cancel_rooms_db LIMIT $start2, $recordsPerPage2";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
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
	$totalRecordsQuery2 = "SELECT * FROM cancel_rooms_db";
	$totalRecordsResult2 = $conn->query($totalRecordsQuery2);
	$totalRecords2 = mysqli_num_rows($totalRecordsResult2);
	$totalPages2 = ceil($totalRecords2 / $recordsPerPage2);
	
	echo "<ul class='pagination'>";
	echo "<li><a href='roomDetails.php?page2=1'>|<</a></li>";
	
	for ($ctr2=1; $ctr2 <= $totalPages2; $ctr2++){
		if($ctr2 == $page2){
			echo "<li class='active'><a href='roomDetails.php?page2=".$ctr2."'>".$ctr2."</a></li>";
		} else {
			echo "<li><a href='roomDetails.php?page2=".$ctr2."'>".$ctr2."</a></li>";
		}
	}
	
	echo "<li><a href='roomDetails.php?page2=$totalPages2'>>|</a></li>"; // Goto last page
	echo "</ul>";
} else {

}
$conn->close();
?>