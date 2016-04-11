<?php
	$user = "root";
	$pass = "";
	$dbname = "databasePHP";
	$server = "localhost";
	$total = null;
	$total1 = null;
	$total2 = null;
	$total3 = null;
	$total4 = null;
	$total5 = null;
	$total6 = null;
	$total7 = null;
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
		$sql4 = "SELECT * FROM cancel_rooms_db";
		$result4 = $conn->query($sql4);
		$sql5 = "SELECT * FROM pending_rooms_db";
		$result5 = $conn->query($sql5);
		$sql6 = "SELECT * FROM equipment_pending_db";
		$result6 = $conn->query($sql6);
		$sql7 = "SELECT * FROM equipment_approved_db WHERE return_status='For Verification'";
		$result7 = $conn->query($sql7);
					 
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
		if ($result4->num_rows > 0) {
			while($row4 = $result4->fetch_assoc()) {
				$total4++;
			}
		}
		if ($result5->num_rows > 0) {
			while($row5 = $result5->fetch_assoc()) {
				$total5++;
			}
		}
		if ($result6->num_rows > 0) {
			while($row6 = $result6->fetch_assoc()) {
				$total6++;
			}
		}
		if ($result7->num_rows > 0) {
			while($row7 = $result7->fetch_assoc()) {
				$total7++;
			}
		}
		
		
 		$conn->close();
?>