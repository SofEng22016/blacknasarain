<?php 
$username = $_SESSION['userAdmin'];
$_SESSION['userAdmin'] = $username;
 
if(!$_SESSION['userAdmin']){
	$msg = "Please log in as an admin first!";
	header("Location: index.php?msg=$msg");
}
?>
<?php
			
            $server="localhost";
            $user="root";
            $pass="";
            $dbname = 'databasePHP';
            
			// Create connection
			$conn = new mysqli($server,$user, $pass, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

            $roomQuery="SELECT * FROM equipment_available_db";
            $result = $conn->query($roomQuery); 
            if ($result->num_rows > 0){
				echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
				echo "<br><tr>";
				echo "<td><b>Equipment</b></td>";
				echo "<td><b>Current Stock</b></td>";
				echo "</tr>";
	            while ($row=$result->fetch_assoc()) {
	       			echo "<tr>";
					echo "<td>".$row['equipment_name']."</td>";
					echo "<td>".$row['quantity']."</td>";
					echo "</tr>";
					
				}
				echo "</table>";
			}
            $conn->close();   
?>
