<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">
<title>Login Page</title>
<link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron">
  	<h1 align="center">Room Reservation System</h1>
</div>
<div class="container">
 
  <div class="row">
 	<div class="col-md-4"></div>
  	<div class="col-md-4">
  	<?php 
	if(isset($_GET['msg'])){
  	
  	$msg = $_GET['msg'];
   		if($msg !=''){
   			echo "<div class='alert alert-warning'>".$msg."</div>";
   		}	
   	}
    ?>
  	</div>
  	<div class="col-md-4"></div>
 </div>
 
  <form action = "handler.php" method="post"> 
 	 <div class="row">
 	 <div class="col-md-4"></div>
     <div class="col-md-4">
     	<h1 align ="center">Log in</h1> 
     <p> 
          Username:
          <input id="username" name="username" required="required" type="text" placeholder = "Username" class="form-control"/>
     </p>
     <p> 
          Password:
          <input id="password" name="password" required="required" type="password" placeholder = "Password" class="form-control"/> 
     </p>
     <p align ="center"> 
          <input type="submit" value="Login" class="btn btn-success"/> 
     </p>
  </div>
  <div class="col-md-4"></div>
  </div>
  </form>
</div>
</body>

</html>