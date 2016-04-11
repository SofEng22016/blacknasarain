<?php 
	session_start();
	$username = $_SESSION['userStudent'];			
	$_SESSION['userStudent'] = $username;
			
	if(!$_SESSION['userStudent']){
		$msg = "Please log in as a student first!";
		header("Location: index.php?msg=$msg");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Window</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/student.css" rel="stylesheet">
	<link href="css/login-form.css" rel="stylesheet">
	<link href="css/calendar-design.css" rel="stylesheet">
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

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); ><?php echo $username?></a>
            </li>
            <li>
                <a href="logout.php" >Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
			<div class="container">
			 <?php 
			if(isset($_GET['msg1'])){
		  	$msg = $_GET['msg1'];
		   		if($msg !=''){
		   			echo "<div class='alert alert-warning'>".$msg."</div>";
		   		}	
		   	}	
		   	if(isset($_GET['msg2'])){
		   		$msg = $_GET['msg2'];
		   		if($msg !=''){
		   			echo "<div class='alert alert-warning'>".$msg."</div>";
		   		}
		   	}
			?>
			</div>
			<br>
			<br>
			<button type="button" class='btn btn-dark btn-lg' data-toggle='modal' data-target='#reserveModal'>Reserve a Room</button>
			<button type="button" class='btn btn-dark btn-lg' data-toggle='modal' data-target='#cancelModal'>Cancel a Reservation</button>
			<button type="button" class='btn btn-dark btn-lg' data-toggle='modal' data-target='#eqReserveModal'>Borrow an Equipment</button>
			<button type="button" class='btn btn-dark btn-lg' data-toggle='modal' data-target='#eqReturnModal'>Return an Equipment</button>
			<button type="button" class='btn btn-dark btn-lg' data-toggle='modal' data-target='#eqHistoryModal'>Borrowed Equipment History</button>
        </div>
    </header>



    <!-- Room Reservation Form Modal -->
    
    <div class="modal fade" id="reserveModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
        <div class="loginmodal-container">
          <?php 
          	include 'roomReservationForm.php';
          ?>
		</div>   
        </div>
    </div>
	</div>
	
	 <!-- Cancel Reservation Form Modal -->
    
    <div class="modal fade" id="cancelModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
		<div class="well">
          <?php 
          	include 'cancelReservation.php';
          ?>
		 </div>
        </div>
    </div>
	</div>
	
	<!-- Equipment Reservation Form Modal -->
    
    <div class="modal fade" id="eqReserveModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
        <div class="loginmodal-container">
          <?php 
          	include 'equipmentReservationForm.php';
          ?>
		</div>   
        </div>
    </div>
	</div>
	
	
	<!-- Return Equipment Form Modal -->
    
    <div class="modal fade" id="eqReturnModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
        <div class="loginmodal-container">
          <?php 
          	include 'returnEquipment.php';
          ?>
		</div>   
        </div>
    </div>
	</div>
	
	<!-- Equipment History Form Modal -->
    
    <div class="modal fade" id="eqHistoryModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
        <div class="loginmodal-container">
          <?php 
          	include 'equipmentHistory.php';
          ?>
		</div>   
        </div>
    </div>
	</div>
 

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>

