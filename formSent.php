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
    	<div class="col-md-8" >
    		<div class="jumbotron">
    			<div class="alert alert-success">
    				<strong>Success!</strong> Your form is now pending for review.
    			</div>
    			<div class="alert alert-info">
    				<strong>Note:</strong> Please check the email you entered for the result of the review.
    			</div>
<!--     			<h2 align="center">Your form is now pending for review.</h2> -->
<!--     			<h3 align="center">Please check your email for the result of the review.</h3> -->
    			<form action="studentWindow.php" method="post" align="center">
    			<input type="submit" value="Back" class="btn btn-success btn-lg"/>
    		</form>
    		</div>
    		
    	</div>
    	<div class="col-md-2"></div>
    </div>
	</div>
    </body>
  
</html>