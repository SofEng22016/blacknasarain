<?php 
			session_start();
			$username = $_SESSION['username'];
			
			$_SESSION['username'] = $username;
			
			if(!$_SESSION['username']){
				$msg = "Please log in as a student first!";
				header("Location: login.php?msg=$msg");
			} else
		?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">

<title>Student Window</title>

<link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css">
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
    	<div class="col-md-8" >
    	<?php 
			if(isset($_GET['msg1'])){
  	
  				$msg1 = $_GET['msg1'];
   					if($msg1 !=''){
   						echo "<div class='alert alert-warning'>".$msg1."</div>";
   					}	
   			}
   			if(isset($_GET['msg2'])){
   				 
   				$msg2 = $_GET['msg2'];
   				if($msg2 !=''){
   					echo "<div class='alert alert-warning'>".$msg2."</div>";
   				}
   			}
    	?>
    	<div class="well">
    	<ul class="nav nav-tabs">
 			<li class='active'><a href="#roomReserve" data-toggle='tab'>Room Reservation</a></li>
  			<li><a href="#equipmentBorrow" data-toggle='tab'>Equipment Borrower's Form</a></li>
  			<li><a href="#equipmentReturn" data-toggle='tab'>Return Equipment</a></li>
		</ul>
		<div class='tab-content'>
		<div class='tab-pane fade in active' id='roomReserve'>
    		<?php 
    			include 'roomReservationForm.php';
    		?>
    	</div>
    	<div class='tab-pane fade' id='equipmentBorrow'>
    		<?php 
    			include 'equipmentReservationForm.php';
    		?>
    	</div>
    	<div class='tab-pane fade' id='equipmentReturn'>
    		<?php 
    			include 'returnEquipment.php';
    		?>
    	</div>
    	</div>
    	<p align ='center'>
    	<input type ="button" class="btn btn-success" onClick="window.location='logout.php'" value ="Logout"/></p>
    	</div>
    	<div class="col-md-2"></div>
    </div>
    </div>
    </div>
	</body>
</html>