<?php 
session_start();
$username = $_SESSION['userAdmin'];
$_SESSION['userAdmin'] = $username;
 
if(!$_SESSION['userAdmin']){
	$msg = "Please log in as an admin first!";
   	header("Location: index.php?msg=$msg");
}
include 'totalCount.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Admin Window</title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Window</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link href="css/admin.css" rel="stylesheet">
    <link href="css/login-form.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


</head>
    <body>
    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="adminWindow.php"  onclick = $("#menu-close").click(); ><?php echo $username?></a>
            </li>
            <li>
                <a href="viewPendingRooms.php" onclick = $("#menu-close").click(); >Pending Rooms</a>
            </li>
            <li>
                <a href="viewPendingEquipments.php" onclick = $("#menu-close").click(); >Pending Equipments</a>
            </li>
            <li>
                <a href="viewVerificationEquipment.php" onclick = $("#menu-close").click(); >Equipment Verification</a>
            </li>
            <li>
                <a href="roomDetails.php" onclick = $("#menu-close").click(); >Room Reservation History</a>
            </li>
            <li>
                <a href="equipmentDetails.php" onclick = $("#menu-close").click(); >Borrowed Equipment History</a>
            </li>
            <li>
                <a href="logout.php" >Logout</a>
            </li>
        </ul>
    </nav>
     <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
        <div class="row">
        	<div class="col-md-2"></div>
        	<div class="col-md-8">
        	<div class="well">
        	<?php 
			if(isset($_GET['msg'])){
		  	$msg = $_GET['msg'];
		   		if($msg !=''){
		   			echo "<div class='alert alert-warning'>".$msg."</div>";
		   		}	
		   	}	
			?>
			<ul class="nav nav-tabs nav-justified">
			<?php 
				if(isset($_GET['page'])){
					echo "<li class='active'><a data-toggle='tab' href='#approved'>Approved Room Reservations</a></li>";
					echo "<li><a data-toggle='tab' href='#denied'>Denied Room Reservations</a></li>";
					echo "<div class='tab-content'>";
					echo "<div id='approved' class='tab-pane fade in active'>";
					if($total2 != null){
						include 'viewApprovedEquipment.php';
					} else {
						echo "<h4 class='alert alert-info' align='center'>There are no approved equipment reservations at the moment.</h4>";
					}
					echo "</div>";
					echo "<div id='denied' class='tab-pane fade'>";
					if($total3 != null){
						include 'viewDeniedEquipment.php';
					} else {
						echo "<h4 class='alert alert-info' align='center'>There are no denied equipment reservations at the moment.</h4>";
					}
					echo "</div>";
					echo "</div>";
				} else if (isset($_GET['page1'])){
					echo "<li><a data-toggle='tab' href='#approved'>Approved Room Reservations</a></li>";
					echo "<li class='active'><a data-toggle='tab' href='#denied'>Denied Room Reservations</a></li>";
					echo "<div class='tab-content'>";
					echo "<div id='approved' class='tab-pane fade'>";
					if($total2 != null){
						include 'viewApprovedEquipment.php';
					} else {
						echo "<h4 class='alert alert-info' align='center'>There are no approved equipment reservations at the moment.</h4>";
					}
					echo "</div>";
					echo "<div id='denied' class='tab-pane fade in active'>";
					if($total3 != null){
						include 'viewDeniedEquipment.php';
					} else {
						echo "<h4 class='alert alert-info' align='center'>There are no denied equipment reservations at the moment.</h4>";
					}
					echo "</div>";
					echo "</div>";
				} else {
					echo "<li><a data-toggle='tab' href='#approved'>Approved Room Reservations</a></li>";
					echo "<li><a data-toggle='tab' href='#denied'>Denied Room Reservations</a></li>";
					echo "<div class='tab-content'>";
					echo "<div id='approved' class='tab-pane fade in active'>";
					if($total2 != null){
						include 'viewApprovedEquipment.php';
					} else {
						echo "<h4 class='alert alert-info' align='center'>There are no approved equipment reservations at the moment.</h4>";
					}
					echo "</div>";
					echo "<div id='denied' class='tab-pane fade'>";
					if($total3 != null){
						include 'viewDeniedEquipment.php';
					} else {
						echo "<h4 class='alert alert-info' align='center'>There are no denied equipment reservations at the moment.</h4>";
					}
					echo "</div>";
					echo "</div>";
					
				}
			?>
			</ul>
			</div>
        	<div class="col-md-2"></div>
        </div>
        </div>     
        </div>
    </header>
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