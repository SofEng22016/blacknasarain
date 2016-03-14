<?php
	$id = $_POST['decision'];
    $choice = $_POST['choice'];
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
    
   
    if($choice == "Approve"){

    	$sql = "SELECT * FROM equipment_pending_db WHERE id='$id'";
    	$result = $conn->query($sql);
    	
    	
    	if($result->num_rows > 0){
    		while($row = $result->fetch_assoc()){
    			$equipment = $row['equipment_name'];
    			$quantityNeeded = $row['quantity'];
    			$email = $row['email_address'];
    			$requester = $row['requester'];
    		}
    		
    		$stockChecker = "SELECT quantity FROM equipment_available_db WHERE equipment_name='$equipment'";
    		$result1 = $conn->query($stockChecker);
    		
    		if($result1->num_rows > 0){
    			while($row1 = $result1->fetch_assoc()){
    				$currentStock = $row1['quantity'];
    			}
    			
    			if($quantityNeeded > $currentStock){
    				
    				$insertToDenied = "INSERT INTO equipment_denied_db (equipment_name, quantity, email_address, requester) VALUES ('$equipment', '$quantityNeeded', '$email', '$requester')";
    				
    				if($conn->query($insertToDenied) === TRUE){
    					
    					$deletePending = "DELETE FROM equipment_pending_db WHERE id='$id'";
    					
    					if($conn->query($deletePending) === TRUE){
    						$msg = "Sorry, We do not have enough equipments to fulfill your request!";
    						header("Location: adminWindow.php?msg=$msg");
    						
    					} else {
    						
    						$msg="Error on deleting denied equipment request. [Approve choice]";
    						header("Location: adminWindow.php?msg=$msg");
    					}
    				} else {
    					$msg = "Error on connection to denied table!";
    					header("Location: adminWindow.php?msg=$msg");
    				}
    				
    			} else {
	    			$newStock = $currentStock - $quantityNeeded;
	    			$insertToApproved = "INSERT INTO equipment_approved_db (equipment_name, quantity, email_address, requester, return_status) VALUES ('$equipment', '$quantityNeeded', '$email', '$requester', '?')";
	    			
	    			if($conn->query($insertToApproved) === TRUE){
	    				$deletePending = "DELETE FROM equipment_pending_db WHERE id='$id'";
	    				$updateStock = "UPDATE equipment_available_db SET quantity='$newStock' WHERE equipment_name='$equipment'";
	    				
	    				if($conn->query($deletePending) === TRUE && $conn->query($updateStock) === TRUE){
	    					$msg = "Stock has been updated!";
	    					header("Location: adminWindow.php?msg=$msg");
	    				} else {
	    					$msg = "Error on deleting the pending request and updating stock!";
	    					header("Location: adminWindow.php?msg=$msg");
	    				}
	    			} else {
						$msg = "Error on connection to approved table!";
						header("Location: adminWindow.php?msg=$msg");
					}
    			}
    		} else {
    			$msg = "Equipment is not even available!";
    			header("Location: adminWindow.php?msg=$msg");
    		}
    		
    		
    	} else {
    		$msg = "What are you trying to approve?";
    		header("Location: adminWindow.php?msg=$msg");
    	}
    	
	} else if ($choice == "Deny"){
		
		$sql = "SELECT * FROM equipment_pending_db WHERE id='$id'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$equipment = $row['equipment_name'];
				$quantityNeeded = $row['quantity'];
				$email = $row['email_address'];
				$requester = $row['requester'];
			}
			
			$insertToDenied = "INSERT INTO equipment_denied_db (equipment_name, quantity, email_address, requester) VALUES ('$equipment', '$quantityNeeded', '$email', '$requester')";
			
			if($conn->query($insertToDenied) === TRUE){
				$deletePending = "DELETE FROM equipment_pending_db WHERE id='$id'";
				
				if($conn->query($deletePending) === TRUE){
					$msg = "Equipment Request has been declined!";
					header("Location: adminWindow.php?msg=$msg");
				} else {
					$msg = "Error on deleting the pending request!";
					header("Location: adminWindow.php?msg=$msg");
				}
			} else {
				$msg = "Error on connection to denied table!";
				header("Location: adminWindow.php?msg=$msg");
			}
		} else {
			$msg = "What are you trying to deny?";
			header("Location: adminWindow.php?msg=$msg");
		}
		
	}
	
	$conn->close();
?>