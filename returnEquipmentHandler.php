<?php
	$id = $_POST['decision'];
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
	
	$sql = "SELECT * FROM equipment_approved_db WHERE id = '$id'";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$quantityToBeReturned = $row['quantity'];
			$equipment = $row['equipment_name'];
			$requester = $row['requester'];
		}
		
			$updateReturnStatus = "UPDATE equipment_approved_db SET return_status ='For Verification' WHERE equipment_name='$equipment' AND requester='$requester' AND id='$id'";
			
			if($conn->query($updateReturnStatus) === TRUE){
				$msg = "Equipment has been returned!";
				header("Location: studentWindow.php?msg1=$msg");
			} else {
 				$msg = "Error on updating stock and return status!";
 				header("Location: studentWindow.php?msg1=$msg");
			}
					
	} else {
		$msg="What are you trying to return?";
		header("Location: studentWindow.php?msg1=$msg");
	}

?>

