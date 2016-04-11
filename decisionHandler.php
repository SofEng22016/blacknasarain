<?php
session_start();
$username = $_SESSION['userAdmin'];
?>
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
    $reason = $_POST['reason'];
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
    
    if(isset($id) && isset($choice)){
    
    if($choice == "Approve"){
    	
    	$sql = "SELECT * FROM pending_rooms_db WHERE id='$id'";
    	$result = $conn->query($sql);
    	
    	if($result-> num_rows > 0){
    		while($row = $result->fetch_assoc()){
    			$requester = $row['requester'];
    			$activity = $row['activity'];
    			$roomName = $row['room'];
    			$roomDate = $row['date'];
    			$roomTime = $row['time'];
				$email = $row['email_address'];
				$reasonReservation = $row['reason'];
			
    		}
    		
    		$reasonReservation = mysql_real_escape_string($reasonReservation);
   			$mailMessage ="Hello, ".$requester.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been approved!";
    		mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
    		
    		$insertToApproved = "INSERT INTO approved_rooms_db (room_name, date, time, email_address, activity, requester, admin, reason) VALUES ('$roomName', '$roomDate', '$roomTime', '$email', '$activity', '$requester', '$username', '$reasonReservation')";
    	
    		if ($conn->query($insertToApproved) === TRUE) {
    			$deletePending = "DELETE FROM pending_rooms_db WHERE id='$id'";
    			
    			
    			if($conn->query($deletePending) === TRUE){
    				$denyOthers = "SELECT * FROM pending_rooms_db WHERE room='$roomName' AND date='$roomDate' AND time='$roomTime'";
    				$result1 = $conn->query($denyOthers);
    				
    				if($result1->num_rows > 0){
    					while($row1 = $result1->fetch_assoc()){
    						$requester1 = $row1['requester'];
    						$activity1 = $row1['activity'];
    						$email1 = $row1['email_address'];
    						$reasonReservation1 = $row1['reason'];
    						
   						$mailMessage ="Hello, ".$requester1.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been denied because a different reservation for this room was accepted.";
   						$mailMessage = wordwrap($mailMessage, 70,"\n");
   						mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
    						$reasonReservation1 = mysql_real_escape_string($reasonReservation1);
    						
    						$insertToDenied = "INSERT INTO denied_rooms_db (room_name, date, time, email_address, activity, requester, reason, admin, reason_denial) VALUES ('$roomName', '$roomDate', '$roomTime', '$email1', '$activity1', '$requester1', '$reasonReservation1', '$username', 'A similar room has been accepted')";
    						
    						if($conn->query($insertToDenied) === TRUE){
    							
    						} else {
    							$msg = "An error has been encountered with moving data to a denied rooms table. Check database connection!";
    							header("Location: viewPendingRooms.php?msg=$msg");
    						}
    					}
    					
    					$deleteRestPending ="DELETE FROM pending_rooms_db WHERE room='$roomName' AND date='$roomDate' AND time='$roomTime'";
    					
    					if($conn->query($deleteRestPending) === TRUE){
    						$msg = "Email has been sent!";
    						header("Location: viewPendingRooms.php?msg=$msg");
    					} else {
    						$msg = "An error has been encountered with deleting identitical room reservations. Check database connection!";
    						header("Location: viewPendingRooms.php?msg=$msg");
    					}
    				} else {
    					$msg = "Email has been sent!";
    					header("Location: viewPendingRooms.php?msg=$msg");
    				}
     			} else {
    				$msg = "An error has been encountered on deleting the approved room from the pending rooms table. Check database connection!";
    				header("Location: viewPendingRooms.php?msg=$msg");
     			}
	
     		} else {
     			$msg = "An error has been encountered on inserting the approved room to the approved rooms table. Check database connection!";
     			header("Location: viewPendingRooms.php?msg=$msg");
    		}
     	} else {
     		$msg = "An error has been encountered, the room you're trying to approve does not exist!";
     		header("Location: viewPendingRooms.php?msg=$msg");
     	}
    			
	} else if ($choice == "Deny"){

		$sql = "SELECT * FROM pending_rooms_db WHERE id='$id'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$requester = $row['requester'];
				$activity = $row['activity'];
				$roomName = $row['room'];
				$roomDate = $row['date'];
				$roomTime = $row['time'];
				$email = $row['email_address'];
				$reasonReservation = $row['reason'];
								
			}
			
			if($reason != null){
				$mailMessage ="Hello, ".$requester.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been denied because of: ".$reason;
				$mailMessage = wordwrap($mailMessage, 70,"\n");
				mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
				$reasonReservation = mysql_real_escape_string($reasonReservation);
				$reason = mysql_real_escape_string($reason);
					
				$insertToDenied = "INSERT INTO denied_rooms_db (room_name, date, time, email_address, activity, requester, reason, admin, reason_denial) VALUES ('$roomName', '$roomDate', '$roomTime', '$email', '$activity', '$requester', '$reasonReservation', '$username', '$reason')";
				if($conn->query($insertToDenied) === TRUE){
					$deletePending = "DELETE FROM pending_rooms_db WHERE id='$id'";
				
					if($conn->query($deletePending) === TRUE){
						$msg = "Email has been sent!";
						header("Location: viewPendingRooms.php?msg=$msg");
					} else {
						$msg = "An error has been encountered on deleting the approved room from the pending rooms table. Check database connection!";
						header("Location: viewPendingRooms.php?msg=$msg");
					}
				} else {
					$msg = "An error has been encountered with moving data to a denied rooms table. Check database connection!";
					header("Location: viewPendingRooms.php?msg=$msg");
				}
			} else {
				$mailMessage ="Hello, ".$requester.". Your reservation for the room: ".$roomName." on ".$roomDate." at ".$roomTime." has been denied! There was no reason specified. Contact management for further details.";
				$mailMessage = wordwrap($mailMessage, 70,"\n");
				mail($email, "Room Reservation Status", $mailMessage,"From: iACADEMY <janumali701@gmail.com>");
				$insertToDenied = "INSERT INTO denied_rooms_db (room_name, date, time, email_address, activity, requester, reason, admin, reason_denial) VALUES ('$roomName', '$roomDate', '$roomTime', '$email', '$activity', '$requester', '$reasonReservation', '$username', 'No reason was specified.')";
				if($conn->query($insertToDenied) === TRUE){
					$deletePending = "DELETE FROM pending_rooms_db WHERE id='$id'";
				
					if($conn->query($deletePending) === TRUE){
						$msg = "Email has been sent!";
						header("Location: viewPendingRooms.php?msg=$msg");
					} else {
						$msg = "An error has been encountered on deleting the approved room from the pending rooms table. Check database connection!";
						header("Location: viewPendingRooms.php?msg=$msg");
					}
				} else {
					$msg = "An error has been encountered with moving data to a denied rooms table. Check database connection!";
					header("Location: viewPendingRooms.php?msg=$msg");
				}
			}
			
			
		} else {
			$msg = "An error has been encountered, the room you're trying to deny does not exist!";
			header("Location: viewPendingRooms.php?msg=$msg");
		}
		
	}
    } else if (!isset($username)){
		$msg = "Please log in as an admin first!";
		header("Location: index.php?msg=$msg");
	} else if(isset($username)){
		$msg="Please select a room and decision first!";
		header("Location: viewPendingRooms.php?msg=$msg");
	}
	
	$conn->close();
	?>

    </body>
</html>