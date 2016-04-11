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
		
		$stockChecker = "SELECT quantity FROM equipment_available_db WHERE equipment_name='$equipment'";
		$result1 = $conn->query($stockChecker);
		
		if($result1->num_rows > 0){
			while($row1 = $result1->fetch_assoc()){
				$currentStock = $row1['quantity'];
			}
			
			$newStock = $currentStock + $quantityToBeReturned;
			$updateStock = "UPDATE equipment_available_db SET quantity='$newStock' WHERE equipment_name='$equipment'";
			$updateReturnStatus = "UPDATE equipment_approved_db SET return_status ='Returned' WHERE equipment_name='$equipment' AND requester='$requester' AND id='$id'";
			
			if($conn->query($updateStock) === TRUE && $conn->query($updateReturnStatus) === TRUE){
				$msg = "Equipment return has been verified and stock has been updated!";
				header("Location: viewVerificationEquipment.php?msg=$msg");
			} else {
 				$msg = "Error on updating stock and return status!";
 				header("Location: viewVerificationEquipment.php?msg=$msg");
			}
			
		} else {
			$msg ="Equipment is not even available!";
			header("Location: viewVerificationEquipment.php?msg=$msg");
		}	
		
		
	} else {
		$msg="What are you trying to verify?";
		header("Location: viewVerificationEquipment.php?msg=$msg");
	}

?>

