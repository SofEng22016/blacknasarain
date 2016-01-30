<?php

	$username = $_POST['username'];
	$password = $_POST['password'];
	
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
	
$sql = "SELECT id, username, password, ADMINorSTUDENT FROM people";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
		
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if($row["username"] == $username){
    		if($row["ADMINorSTUDENT"]){
    			header('Location: studentWindow.php');
    		} else {
    			header('Location: adminWindow.php');
    		}
    		
    	} else {
    		echo '<script language="javascript">';
			echo 'alert("No such user exists.")';
			echo 'window.location.replace("login.php/")';
			echo '</script>';
      		
   		} 
  	}
} else {
    echo "0 results";
}



	$conn->close();
	
	?>