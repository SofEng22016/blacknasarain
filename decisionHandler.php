<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Insert title here</title>
</head>
    <body>
    
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
    	
    	$sql = "SELECT * FROM pending_rooms_db INNER JOIN available_rooms_db ON pending_rooms_db.id='$id' AND pending_rooms_db.room_details=available_rooms_db.id";
    	$result = $conn->query($sql);
    	
    	if($result-> num_rows > 0){
    		while($row = $result->fetch_assoc()){
    			$requester = $row['requester'];
    			$activity = $row['activity'];
    			$roomName = $row['room_name'];
    			$roomDate = $row['date'];
    			$roomTime = $row['time'];
				$email = $row['email_address'];
				$roomChecker = $row['room_details'];

    		}
    		
//     		echo "<p>".$requester."</p>";
//     		echo "<p>".$activity."</p>";
//     		echo "<p>".$roomName."</p>";
//     		echo "<p>".$roomDate."</p>";
//     		echo "<p>".$roomTime."</p>";
//     		echo "<p>".$email."</p>";
//     		echo "<p>".$roomChecker."</p>";
//     		echo "<hr>";

   			//$mailMessage ="Hello, ".$requester.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been approved!";
    		//mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
    		
    		$insertToApproved = "INSERT INTO approved_rooms_db (room_name, date, time, email_address, activity, requester) VALUES ('$roomName', '$roomDate', '$roomTime', '$email', '$activity', '$requester')";
    	
    		if ($conn->query($insertToApproved) === TRUE) {
    			$deletePending = "DELETE FROM pending_rooms_db WHERE id='$id'";
    			$deleteAvailable = "DELETE FROM available_rooms_db WHERE id ='$roomChecker'";
    			
    			if($conn->query($deletePending) === TRUE && $conn->query($deleteAvailable) === TRUE){
    				$denyOthers = "SELECT * FROM pending_rooms_db WHERE room_details='$roomChecker'";
    				$result1 = $conn->query($denyOthers);
    				
    				if($result1->num_rows > 0){
    					while($row1 = $result1->fetch_assoc()){
    						$requester1 = $row1['requester'];
    						$activity1 = $row1['activity'];
    						$email1 = $row1['email_address'];
    						$roomChecker1 = $row1['room_details'];
    						
//     						echo "<p>".$requester1."</p>";
//     						echo "<p>".$activity1."</p>";
//     						echo "<p>".$email1."</p>";
//     						echo "<p>".$roomChecker1."</p>";
//     						echo "<hr>";
   				//		$mailMessage ="Hello, ".$requester1.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been denied!";
   					//	mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
    						
    						$insertToDenied = "INSERT INTO denied_rooms_db (room_name, date, time, email_address, activity, requester) VALUES ('$roomName', '$roomDate', '$roomTime', '$email1', '$activity1', '$requester1')";
    						
    						if($conn->query($insertToDenied) === TRUE){
    							
    						} else {
    							echo "Error moving to denied rooms table";
    						}
    					}
    					
    					$deleteRestPending ="DELETE FROM pending_rooms_db WHERE room_details ='$roomChecker'";
    					
    					if($conn->query($deleteRestPending) === TRUE){
    						$msg = "Email has been sent!";
    						header("Location: adminWindow.php?msg=$msg");
    					} else {
    						echo "Error deleting the rest.";
    					}
    				} else {
    					$msg = "Email has been sent!";
    					header("Location: adminWindow.php?msg=$msg");
    				}
     			} else {
    				echo "Error on deletion.";
     			}
	
     		} else {
     			echo "Error on insert to approved rooms table";
    		}
     	} else {
     		$msg = "Error on room approval!";
     		header("Location: adminWindow.php?msg=$msg");
     	}
    			
	} else if ($choice == "Deny"){
		
		$sql = "SELECT * FROM pending_rooms_db INNER JOIN available_rooms_db ON pending_rooms_db.id='$id' AND pending_rooms_db.room_details=available_rooms_db.id";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$requester = $row['requester'];
				$activity = $row['activity'];
				$roomName = $row['room_name'];
				$roomDate = $row['date'];
				$roomTime = $row['time'];
				$email = $row['email_address'];
				
				//$mailMessage ="Hello, ".$requester.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been denied!";
				//mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
			}
			
			$insertToDenied = "INSERT INTO denied_rooms_db (room_name, date, time, email_address, activity, requester) VALUES ('$roomName', '$roomDate', '$roomTime', '$email', '$activity', '$requester')";
			if($conn->query($insertToDenied) === TRUE){
				$deletePending = "DELETE FROM pending_rooms_db WHERE id='$id'";
				
				if($conn->query($deletePending) === TRUE){
					$msg = "Email has been sent!";
					header("Location: adminWindow.php?msg=$msg");
				} else {
					echo "Error on deletion.";
				}
			} else {
				echo "Error on insert to denied rooms table";
			}
		} else {
			$msg = "Error on room denial!";
			header("Location: viewPendingRooms.php?msg=$msg");
		}
		
	}
	
	$conn->close();
	?>
    </body>

</html>