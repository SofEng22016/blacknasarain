<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EZ Reservation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/login.css" rel="stylesheet">
     <link href="css/login-form.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<!-- Error Message -->
	
	
   
    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1><font color="white">EZ Reservation</font></h1>
            <br>
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
            <br>
            <button type="button" class='btn btn-dark btn-lg' data-toggle='modal' data-target='#loginModal'>Login</button>
        </div>
    </header>

	<!-- Login Form Modal -->
    
    <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
        <div class="loginmodal-container">
          <form action = "handler.php" method="post"> 
		     	<h1 align ="center">Account Login</h1> 
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
		   </form>
		</div>   
        </div>
    </div>
	</div>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
