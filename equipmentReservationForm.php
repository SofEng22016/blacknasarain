<?php 
	$username = $_SESSION['userStudent'];			
	$_SESSION['userStudent'] = $username;
			
	if(!$_SESSION['userStudent']){
		$msg = "Please log in as a student first!";
		header("Location: index.php?msg=$msg");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Insert title here</title>
</head>
    <body>
<form action='pendingEquipmentHandler.php' method='post' class='form-inline' align='left'>
    	<br>
    	<?php 
    		echo "Requested by: ".$username;
    	?>
    	<p></p>
    	<p>Email Address:    <input type="email" name="emailAddress" id="emailAddress" class="form-control" required="required"></p>
    	<p>Available Equipment: 
    		<select id='equipmentReserve' name='equipmentReserve' class='form-control' required='required'>
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

            $equipmentQuery="SELECT id, equipment_name, quantity FROM equipment_available_db";
            $result = $conn->query($equipmentQuery); 
            
            while ($row=$result->fetch_assoc()) {
				$id=$row['id'];
				$equipmentName = $row['equipment_name'];
				$stock = $row['quantity'];
				
                echo "<option value='$equipmentName'>
                    $equipmentName - Stock left: $stock
                </option>";
                
			}
			$conn->close();
            ?>
            </p>
    		</select>
    	<p>Amount to Borrow: <input type='number' min='1' name='borrowAmount' id='borrowAmount' required='required' class='form-control'></p>
    	<p></p><p>
    		<input type="submit" value="Submit" class="btn btn-success"/>
    		<input type="reset" value="Clear" class="btn btn-danger"/>
    	</p>
    	</form>
    </body>
</html>