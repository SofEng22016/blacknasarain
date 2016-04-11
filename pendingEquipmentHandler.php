<?php
session_start();
$email = $_POST['emailAddress'];
$equipment = $_POST['equipmentReserve'];
$username = $_SESSION['username'];
$quantity = $_POST['borrowAmount'];

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

$stockChecker = "SELECT * FROM equipment_available_db WHERE equipment_name ='$equipment'";
$result = $conn->query($stockChecker);

if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()){
		$stock = $row['quantity'];
	}
	
	if($quantity > $stock){
		
		$msg="You're asking for too much! Check the number of stocks we have left.";
		header("Location: studentWindow.php?msg1=$msg");
		
	} else {
		
		$sql = "INSERT INTO equipment_pending_db (equipment_name, quantity, email_address, requester)
		VALUES ('$equipment', '$quantity', '$email','$username')";
		
		if ($conn->query($sql) === TRUE) {
			$msg="Your form is now pending for review.";
			$msg2="Please check the email you entered for the result of the review.";
			header("Location: studentWindow.php?msg1=$msg&msg2=$msg2");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

} else {
	$msg="That equipment is not even available!";
	header("Location: studentWindow.php?msg1=$msg");
}



$conn->close();



?>