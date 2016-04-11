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
	
	$sql = "SELECT * FROM approved_rooms_db WHERE id = '$id'";
	$result = $conn->query($sql);
	
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$room = $row['room_name'];
			$time = $row['time'];
			$date = $row['date'];
			$emailAddress = $row['email_address'];
			$cancelActivity = $row['activity'];
			$cancelRequester = $row['requester'];
			$cancelReason = $row['reason'];
			
			$insertToCancel = "INSERT INTO cancel_rooms_db (room_name, date, time, email_address, activity, requester, reason) VALUES ('$room', '$date', '$time', '$emailAddress', '$cancelActivity', '$cancelRequester', '$cancelReason')";
			
			if($conn->query($insertToCancel) === TRUE){
				
			} else {
				$msg="An error has been encountered on inserting data to a table! Check database connection!";
				header("Location: studentWindow.php?msg1=$msg");
			}
		}
		
		$deniedChecker = "SELECT * FROM denied_rooms_db WHERE room_name='$room' AND time='$time' AND date='$date'";
		$result1 = $conn->query($deniedChecker);
		
		if($result1->num_rows > 0){
			while($row1 = $result1->fetch_assoc()){
				$idDenied = $row1['id'];
				$email = $row1['email_address'];
				$activity = $row1['activity'];
				$requester = $row1['requester'];
				$room1 = $row1['room_name'];
				$date1 = $row1['date'];
				$time1 = $row1['time'];
				$reason = $row1['reason'];
				
				$insertToPending = "INSERT INTO pending_rooms_db (email_address, activity, requester, room, date, time, reason) VALUES ('$email', '$activity', '$requester', '$room1', '$date1', '$time1','$reason')";
				
				if($conn->query($insertToPending) === TRUE){
					
					$deleteOldDenied = "DELETE FROM denied_rooms_db where id='$idDenied'";
					$deleteCancelledRoom = "DELETE FROM approved_rooms_db where id='$id'";
					
					if(($conn->query($deleteOldDenied) === TRUE) && ($conn->query($deleteCancelledRoom) === TRUE)){
						$msg = "Your reservation has been cancelled!";
						header("Location: studentWindow.php?msg1=$msg");
					} else {
						$msg = "An error has been encountered when trying to delete certain data! Check database connection!";
						header("Location: studentWindow.php?msg1=$msg");
					}
				} else {
					$msg="An error has been encountered on inserting a certain data! Check database connection!";
					header("Location: studentWindow.php?msg1=$msg");
				}
			}
			
		} else {
			
				$deleteCancelledRoom = "DELETE FROM approved_rooms_db where id='$id'";
				if($conn->query($deleteCancelledRoom)=== TRUE){
					$msg = "Your reservation has been cancelled!";
					header("Location: studentWindow.php?msg1=$msg");
				} else {
					$msg = "An error has been encountered on removing your reservation! Check database connection!";
					header("Location: studentWindow.php?msg1=$msg");
				}
			} 

	} else {
		$msg="What are you trying to cancel?";
		header("Location: studentWindow.php?msg1=$msg");
	}

?>

