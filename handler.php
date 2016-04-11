<?php

	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	
	

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
	
$sql = "SELECT * FROM people WHERE username ='$username' AND password=sha('$password')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
		
    // output data of each row
	while($row = $result->fetch_assoc()){
		if($row["username"] == $username){
		if($row["ADMINorSTUDENT"]){
       session_start();
       $_SESSION['userStudent'] = $username;
       header('Location: studentWindow.php');
      } else {
      session_start();
      $_SESSION['userAdmin'] = $username;
       header('Location: adminWindow.php');
       
      }
	}
	} 
} else {
      $msg = "No such user exists! Your username or password may be incorrect!";
      header("Location: index.php?msg=$msg");
   		
}
	$conn->close();
	
	?>