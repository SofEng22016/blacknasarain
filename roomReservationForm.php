<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Insert title here</title>
</head>
    <body>
<form method="post" action="pendingRoomsHandler.php" class="form-inline" align="center">
    	<br>
    	<?php 
    	echo "Requested by: ".$username;
    	?>
    	<p></p>
    	<p>Email Address:    <input type="email" name="emailAddress" id="emailAddress" class="form-control" required="required"></p>
    	<p>List of Activities available: </p><p>
    		<input type="radio" name="activity" value="Meeting" id="activity">Meetings<br/>
    		<input type="radio" name="activity" value="Class" id="activity">Class<br/>
    		<input type="radio" name="activity" value="Event" id="activity">Events<br/>
    	</p>
    	
    	<p>Available Room Details: 
    		<select id="roomReserve" name="roomReserve" class="form-control" required="required">
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

            $roomQuery="SELECT id, room_name, date, time FROM available_rooms_db";
            $result = $conn->query($roomQuery); 
            
            while ($row=$result->fetch_assoc()) {
				$id=$row['id'];
				$roomName=$row['room_name'];
				$roomDate=$row['date'];
				$roomTime=$row['time'];
				
                echo "<option value='$id'>
                    $roomName - $roomDate - $roomTime
                </option>";
                
			}
            $conn->close();   
            ?>
            </p>
    		</select>
    		<p></p><p>
    		<input type="submit" value="Submit" class="btn btn-success"/>
    		<input type="reset" value="Clear" class="btn btn-danger"/>
    		</p>
    	</form>
    </body>
</html>