<?php
session_start();
$username = $_SESSION['userAdmin'];
?>
<?php

$equipment_name = $_POST['equipment_name'];
$quantity = $_POST['quantity'];

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

if(isset($equipment_name) && isset($quantity) && isset($username)){

$equipmentChecker = "SELECT * FROM equipment_available_db WHERE equipment_name ='$equipment_name'";
$result = $conn->query($equipmentChecker);

if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()){
		$stock = $row['quantity'];
	}
	$newStock = $stock + $quantity;
	$stockUpdate = "UPDATE equipment_available_db SET quantity='$newStock' WHERE equipment_name='$equipment_name'";
	
	if($conn->query($stockUpdate) === TRUE){
		$msg1 = "Equipment is already available for lending! Updating Equipment Stock instead.";
		header("Location: adminWindow.php?msg=$msg1");
	} else {
		$msg1 = "An error has been encountered while updating the current equipment stock! Check database connection!";
		header("Location: adminWindow.php?msg=$msg1");
	}

	
} else {

	 $sql = "INSERT INTO equipment_available_db (equipment_name, quantity) VALUES ('$equipment_name', '$quantity')";
		if ($conn->query($sql) === TRUE) {
			$msg = "New Equipment Added!";
			header("Location: adminWindow.php?msg=$msg");
		} else {
			$msg = "An error has been encountered while adding the new equipment. Check database connection!";
			header("Location: adminWindow.php?msg=$msg");
		}
}
} else if(!isset($username)){
	$msg = "Please log in as an admin first!";
	header("Location: index.php?msg=$msg");
} else if(isset($username)){
	$msg="Select a proper equipment with the right quantity!";
	header("Location: adminWindow.php?msg=$msg");
}



$conn->close();
?>