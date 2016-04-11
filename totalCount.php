<?php
	$user = "root";
	$pass = "";
	$dbname = "databasePHP";
	$server = "localhost";
	$total = null;
	$total1 = null;
	$total2 = null;
	$total3 = null;
	
// Create connection
	$conn = new mysqli($server,$user, $pass, $dbname);
// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM approved_rooms_db";
		$result = $conn->query($sql);
		$sql1 = "SELECT * FROM denied_rooms_db";
		$result1 = $conn->query($sql1);
		$sql2 = "SELECT * FROM equipment_approved_db";
		$result2 = $conn->query($sql2);
		$sql3 = "SELECT * FROM equipment_denied_db";
		$result3 = $conn->query($sql3);
					 
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$total++;
			}	 	
		}
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				$total1++;
			}
		}
		if ($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()) {
				$total2++;
			}
		}
		if ($result3->num_rows > 0) {
			while($row3 = $result3->fetch_assoc()) {
				$total3++;
			}
		}
		
		
 		$conn->close();
?>