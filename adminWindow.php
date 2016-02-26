<?php 
   session_start();
   $username = $_SESSION['username'];
   
   $_SESSION['username'] = $username;
   
   if(!$_SESSION['username']){
   	$msg = "Please log in as an admin first!";
   	header("Location: login.php?msg=$msg");
   } else 
  ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Admin Window</title>
<link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
    <body>
    <div class="container">
    	<div class = "jumbotron">
   			<?php 
    			echo "<h1 align='center'><div class='text text-success'>Welcome Admin ".$username."</div></h1>";
    		?>
    	</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<?php 
						if(isset($_GET['msg1'])){
  	
  						$msg1 = $_GET['msg1'];
   							if($msg1 !=''){
   								echo "<div class='alert alert-warning'>".$msg1."</div>";
   							}	
   						}
    ?>
					<a href="addRoomsAdmin.php" class="btn btn-success btn-block" role="button">Add Available Rooms</a>
					<a href="viewPendingRooms.php" class="btn btn-success btn-block" role="button">View Pending Rooms</a><br>
					<p align ='center'><input type ="button" class="btn btn-success" onClick="window.location='logout.php'" value ="Logout"/></p></div>
				<div class="col-md-4"></div>
			</div>
	</div> 
	</body>
</html>