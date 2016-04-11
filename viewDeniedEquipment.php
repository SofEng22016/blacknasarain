<?php 
   $username = $_SESSION['userAdmin'];  
   $_SESSION['userAdmin'] = $username;
   
   if(!$_SESSION['userAdmin']){
   	header("Location: adminWindow.php");
   }
?>
<?php
echo "<h4 class='text text-info' align='center'> Total Number of Denied Equipment: ".$total3."</h4>";
$user = "root";
$pass = "";
$dbname = "databasePHP";
$server = "localhost";
$total = null;
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
	
$sql = "SELECT * FROM equipment_denied_db LIMIT $start1, $recordsPerPage1";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
	echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
	echo "<br><tr>";
	echo "<td><b>Equipment</b></td>";
	echo "<td><b>Quantity</b></td>";
	echo "<td><b>Requester's Name</b></td>";
	echo "<td><b>Email Address</b></td>";
	echo "</tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row['equipment_name']."</td>";
		echo "<td>".$row['quantity']."</td>";
		echo "<td>".$row['requester']."</td>";
		echo "<td>".$row['email_address']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	$totalRecordsQuery1 = "SELECT * FROM equipment_denied_db";
	$totalRecordsResult1 = $conn->query($totalRecordsQuery1);
	$totalRecords1 = mysqli_num_rows($totalRecordsResult1);
	$totalPages1 = ceil($totalRecords1 / $recordsPerPage1);
	
	echo "<ul class='pagination'>";
	echo "<li><a href='equipmentDetails.php?page1=1'>|<</a></li>";
	
	for ($ctr1=1; $ctr1 <= $totalPages1; $ctr1++){
		if($ctr1 == $page1){
			echo "<li class='active'><a href='equipmentDetails.php?page1=".$ctr1."'>".$ctr1."</a></li>";
		} else {
			echo "<li><a href='equipmentDetails.php?page1=".$ctr1."'>".$ctr1."</a></li>";
		}
	}
	
	echo "<li><a href='equipmentDetails.php?page1=$totalPages1'>>|</a></li>"; // Goto last page
	echo "</ul>";
} else {

}
$conn->close();
?>