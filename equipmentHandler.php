<?php
session_start();
$username = $_SESSION['username'];
$_SESSION['username'] = $username;

if(!$_SESSION['username']){
	$msg = "Please log in as an admin first!";
	header("Location: login.php?msg=$msg");
} else

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
		echo "Error on updating";
	}

	
} else {

	 $sql = "INSERT INTO equipment_available_db (equipment_name, quantity) VALUES ('$equipment_name', '$quantity')";
		if ($conn->query($sql) === TRUE) {
			$msg = "New Equipment Added!";
			header("Location: adminWindow.php?msg=$msg");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
}



$conn->close();
?>