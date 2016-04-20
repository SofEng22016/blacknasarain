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
<title>Student Reservation Form</title>
<style>
textarea{
resize: none;
}
</style>
</head>
    <body>
<form method="post" action="pendingRoomsHandler.php" class="form-inline" align="left>
    	<br>
    	<?php 
    	echo "Requested by: ".$username;
    	?>
    	<p></p>
    	<b align = "left">Email Address :   	 <input type="email" name="emailAddress" id="emailAddress" class="form-control" required="required"></b>
    	<hr></hr>
    	<b>List of Activities available : </p><p>
    		<input type="radio" name="activity" value="Meeting" id="activity" checked="checked">Meetings<br/>
    		<input type="radio" name="activity" value="Class" id="activity">Class<br/>
    		<input type="radio" name="activity" value="Event" id="activity">Events<br/>
    	</b>
    	<hr></hr>
    	<b>Room : 
    	<select id = "room_name" name = "room_name" required="required">
		  <option value="CL1">Computer Lab 1</option>
		  <option value="CL2">Computer Lab 2</option>
		  <option value="MMA1">MMA 01</option>
		  <option value="MMA2">MMA 02</option>
		  <option value="FD1">FD01</option>
		  <option value="FD2">FD02</option>
		  <option value="401">Room 401</option>
		  <option value="404">Room 404</option>
		  <option value="405">Room 405</option>
		  <option value="406">Room 406</option>
		  <option value="407">Room 407</option>
		  <option value="408">Room 408</option>
		  <option value="409">Room 409</option>
		  <option value="501">Room 501</option>
		  <option value="502">Room 502</option>
		  <option value="503">Room 503</option>
		  <option value="504">Room 504</option>
		  <option value="505">Room 505</option>
		  <option value="506">Room 506</option>
		  <option value="507">Room 507</option>
		  <option value="508">Room 508</option>
		  <option value="509">Room 509</option>
		  <option value="Audi">Auditorium</option>
		  <option value="Music Room">Music Room</option>
		</select></b>
		<hr></hr>
		<b>Date : <input id="date" name="date" type = "date" min =<?php echo date("Y-m-d");?> required="required"></b><hr></hr>
		<b>Time : <select id = "time" name = "time" required="required">
		  <option value="8:00AM-11:00AM">8:00AM-11:00AM</option>
		  <option value="11:30AM-2:30PM">11:30AM-2:30PM</option>
		  <option value="2:45PM-5:45PM">2:45PM-5:45PM</option>
		  <option value="6:00PM-9:00PM">6:00PM-9:00PM</option>
		  </select></b>
		<hr></hr>
		<p><textarea name='reason' class='form-control' rows='5' cols='35' placeholder="Reason for reservation..." required='required'></textarea></p>
		<hr></hr>
			<p>
    		<input type="submit" value="Submit" class="btn btn-success"/>
    		<input type="reset" value="Clear" class="btn btn-danger"/>
    		</p>
    	</form>
    	<script type="text/javascript">

    	</script>
    </body>
</html>