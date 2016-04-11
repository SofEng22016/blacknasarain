<?php 
   $username = $_SESSION['userAdmin'];  
   $_SESSION['userAdmin'] = $username;
   
   if(!$_SESSION['userAdmin']){
   	header("Location: adminWindow.php");
   }
?>
<?php
echo "<h4 class='text text-info' align='center'> Total Number of Approved Equipment: ".$total2."</h4>";
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
	
$sql = "SELECT * FROM equipment_approved_db LIMIT $start, $recordsPerPage";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
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
	$totalRecordsQuery = "SELECT * FROM equipment_approved_db";
	$totalRecordsResult = $conn->query($totalRecordsQuery);
	$totalRecords = mysqli_num_rows($totalRecordsResult);
	$totalPages = ceil($totalRecords / $recordsPerPage);
	
	echo "<ul class='pagination'>";
	echo "<li><a href='equipmentDetails.php?page=1'>|<</a></li>";
	
	for ($ctr=1; $ctr <= $totalPages; $ctr++){
		if($ctr == $page){
			echo "<li class='active'><a href='equipmentDetails.php?page=".$ctr."'>".$ctr."</a></li>";
		} else {
			echo "<li><a href='equipmentDetails.php?page=".$ctr."'>".$ctr."</a></li>";
		}
	}
	
	echo "<li><a href='equipmentDetails.php?page=$totalPages'>>|</a></li>"; // Goto last page
	echo "</ul>";
} else {

}
$conn->close();
?>