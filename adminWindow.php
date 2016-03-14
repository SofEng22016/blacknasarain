<?php 
   session_start();
   $username = $_SESSION['username'];
   
   $_SESSION['username'] = $username;
   
   if(!$_SESSION['username']){
   	$msg = "Please log in as an admin first!";
   	header("Location: login.php?msg=$msg");
   }
   
   include 'totalCount.php';
  ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Admin Window</title>
<link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</nav>
<div class="container">
	<div class = "jumbotron">
   		<?php 
    		echo "<h1 align='center'><div class='text text-success'>Welcome Admin ".$username."</div></h1>";
    	?>
    </div>
    <div class="row">
    	<div class="col-md-1"></div>
    	<div class="col-md-10">
    	<?php 
    	if(isset($_GET['msg'])){
    		 
    		$msg = $_GET['msg'];
    		if($msg !=''){
    			echo "<div class='alert alert-warning'><center>".$msg."</center></div>";
    		}
    	}
    	?>
    	<div class="well">
    		<ul class="nav nav-tabs">
 				<li class='active'><a href="#addRooms" data-toggle='tab'>Add Available Rooms</a></li>
  				<li><a href="#viewPending" data-toggle='tab'>View Pending Rooms</a></li>
  				<li><a href="#addEquipment" data-toggle='tab'>Add Available Equipment</a></li>
	  			<li><a href="#viewEquipment" data-toggle='tab'>View Pending Equipment</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="addRooms">
					<?php 
						include 'addRoomsAdmin.php';
					?>
				</div>
				<div class="tab-pane fade" id="viewPending">
					<?php 
						include 'viewPendingRooms.php';
					?>
				</div>
				<div class="tab-pane fade" id="addEquipment">
					<?php 
						include 'addEquipmentAdmin.php';
					?>
				</div>
				<div class="tab-pane fade" id="viewEquipment">
					<?php 
						include 'viewPendingEquipments.php';
					?>
				</div>
			</div>
    	</div></div>
    	<div class="col-md-1"></div>
    </div>
    
</div>
<div class="container">
	<div class="row">
    	<div class="col-md-1"></div>
    	<div class="col-md-10"><div class="well">
	    	<ul class="nav nav-tabs">
	 			<li class='active'><a href="#details" data-toggle='tab'>Approved Room Details</a></li>
	  			<li><a href="#roomDenied" data-toggle='tab'>Denied Room Details</a></li>
	  			<li><a href="#equipDetails" data-toggle='tab'>Approved Equipment Details</a></li>
	  			<li><a href="#equipDenied" data-toggle='tab'>Denied Equipment Details</a></li>
			</ul>
			<div class="tab-content">
				<div id='details' class='tab-pane fade in active'>
				<h2 class='alert alert-warning' align='center'>Room Details</h2>
					<?php
					if($total != null){ 
						include 'viewApprovedRooms.php';
					} else {
						echo "<h4 class='text text-info' align='center'>Database is empty!</h4>";
					}
					?>
				</div>
				<div id='roomDenied' class='tab-pane fade'>
				<h2 class='alert alert-warning' align='center'>Room Details</h2>
					<?php 
					if($total1 != null){
						include 'viewDeniedRooms.php';
						} else {
							echo "<h4 class='text text-info' align='center'>Database is empty!</h4>";
						}
					?>
				</div>
				<div id='equipDetails' class='tab-pane fade'>
				<h2 class='alert alert-warning' align='center'>Equipment Details</h2>
					<?php
					if($total2 != null){ 
						include 'viewApprovedEquipment.php';
					} else {
						echo "<h4 class='text text-info' align='center'>Database is empty!</h4>";
					}
					?>
				</div>
				<div id='equipDenied' class='tab-pane fade'>
				<h2 class='alert alert-warning' align='center'>Equipment Details</h2>
					<?php 
					if($total3 != null){ 
						include 'viewDeniedEquipment.php';
					} else {
						echo "<h4 class='text text-info' align='center'>Database is empty!</h4>";
					}
					?>
				</div>
			</div>
    	</div></div>
    	<div class="col-md-1"></div>
    </div>
</div>
</body>
</html>