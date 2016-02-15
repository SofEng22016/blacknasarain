



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">

<title>Student Window</title>

<link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
    <body>
    <div class="jumbotron">
  	<h1 align="center">EZ Room Reservation Form</h1>
	</div>
	
    <div class="container">
    
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8" ><div class="well">
    	<form method="post" action="pendingRoomsHandler.php" class="form-inline" align="center">
    	
    	<?php 
			session_start();
			$username = $_SESSION['username'];
			echo "Requested by: ".$username;
			$_SESSION['username'] = $username;
			
		?>
    	<p></p>
    	<p>Email Address:    <input type="email" name="emailAddress" id="emailAddress" class="form-control" ></p>
    	<p>List of Activities available: </p><p>
    		<input type="radio" name="activity" value="Meeting" id="activity">Meetings<br/>
    		<input type="radio" name="activity" value="Class" id="activity">Class<br/>
    		<input type="radio" name="activity" value="Event" id="activity">Events<br/>
    	</p>
    	
    	<p>Available Room Details: </p>
    		<select id="roomReserve" name="roomReserve" class="form-control">
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
                
            ?>
    		</select>
    		<p></p><p>
    		<input type="submit" value="Submit" class="btn btn-success"/>
    		<input type="reset" value="Clear" class="btn btn-danger"/>
    		</p>
    	</form></div>
    	<div class="col-md-2"></div>
    </div>
    </div>
    </div>
	</body>
</html>