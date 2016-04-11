<?php 
session_start();
$username = $_SESSION['userAdmin'];
$_SESSION['userAdmin'] = $username;
 
if(!$_SESSION['userAdmin']){
	$msg = "Please log in as an admin first!";
   	header("Location: index.php?msg=$msg");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html">

<title>Admin Window</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
        	<div class="col-md-8"><div class="well">
        	<?php 
			if(isset($_GET['msg'])){
		  	$msg = $_GET['msg'];
		   		if($msg !=''){
		   			echo "<div class='alert alert-warning'>".$msg."</div>";
		   		}	
		   	}	
			?>      
        	<form action='decisionHandler.php' method='post' align='center'>
			   <?php    
			   $user = "root";
			   $pass = "";
			   $dbname = "databasePHP";
			   $server = "localhost";
			   
			   // Create connection
			   $conn = new mysqli($server,$user, $pass, $dbname);
			   // Check connection
			   if ($conn->connect_error) {
			   	die("Connection failed: " . $conn->connect_error);
			   }
			   
			   $sql = "SELECT * FROM pending_rooms_db";
			   $result = $conn->query($sql);
			   
			   if ($result->num_rows > 0) {
			   	echo "<br>";
				echo "<table style='width:100%' class = 'table table-striped table-bordered table-responsive'>";
				echo "<tr>";
				echo "<th></th>";
				echo "<th><b>Room Name</b></th>";
				echo "<th><b>Email Address</b></th>";
				echo "<th><b>Activity</b></th>";
				echo "<th><b>Requester's Name</b></th>";
				echo "<th><b>Date:</b></th>";
				echo "<th><b>Time Needed</b></th>";
				echo "<th><b>Reason for reservation</b></th>";
				echo "</tr>";
			   	// output data of each row
			   	while($row = $result->fetch_assoc()) {
			   		$id = $row['id'];
			   		echo "<tr>";
			   		echo "<td>";
			   		echo "<input type='radio' name='decision' value='$id' id='decision' required='required'/>";
			   		echo "</td>";
			   		echo "<td>".$row['room']."</td>";
			   		echo "<td>".$row['email_address']."</td>";
			   		echo "<td>".$row['activity']."</td>";
			   		echo "<td>".$row['requester']."</td>";
			   		echo "<td>".$row['date']."</td>";
			   		echo "<td>".$row['time']."</td>";	
			   		echo "<td>".$row['reason']."</td>";
			   		echo "</tr>";
			   		
			   
			   	}
			   	echo "</table><br>";
			   	echo "<input type='button' class='btn btn-success' data-toggle='modal' data-target='#confirmationModalA' value='Approve'/><input type='button' class='btn btn-danger' data-toggle='modal' data-target='#confirmationModal' value='Deny'/>";
			   } else {
			   	echo "<br><div class='alert alert-info'>"."<center>There are currently no pending room reservations to approve/deny.</center>"."</div>"; //proper message here pls.
			   }
			   
			   
			   
			   $conn->close();
			   ?>
			   <!-- Confirmation Modal [Approve Version] -->
			   <div class="modal fade" id="confirmationModalA" role="dialog">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-body">
			          <h2>Are you sure?</h2>
			        </div>
			        <div class="modal-footer">
			           <input type='submit' name='choice' class='btn btn-success' value='Approve'/><button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			        </div>
			      </div>
			    </div>
			  </div>
			   <!-- Confirmation Modal [Denied Version]-->
			   <div class="modal fade" id="confirmationModal" role="dialog">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-body">
			          <h2>Are you sure?</h2>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reasonModal">Yes</button><button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			        </div>
			      </div>
			    </div>
			  </div>
			  <!-- Reason Form Modal -->
			   <div class="modal fade" id="reasonModal" role="dialog">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Enter a reason for denying the room reservation</h4>
			        </div>
			        <div class="modal-body">
			          <textarea name='reason' class='form-control' rows='5' placeholder="Enter details on why a room is denied here: "></textarea>
			        </div>
			        <div class="modal-footer">
			          <input type='submit' name='choice' class='btn btn-danger' value='Deny'/>
			        </div>
			      </div>
			    </div>
			  </div>
			  </form>
			</div></div>
        	<div class="col-md-2"></div>
        </div>

            <br>
        </div>
    </header>



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
    $('.btn-image img').hover(
            function(){$(this).css('opacity','1');},
            function(){$(this).css('opacity','.7');}
        );
    </script>
</body>
</html>