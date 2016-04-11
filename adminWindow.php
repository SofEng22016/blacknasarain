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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Window</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/admin.css" rel="stylesheet">
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
        <?php 
			if(isset($_GET['msg'])){
		  	$msg = $_GET['msg'];
		   		if($msg !=''){
		   			echo "<div class='alert alert-warning'>".$msg."</div>";
		   		}	
		   	}	
			?>
                <!-- Portfolio -->
			    <section id="portfolio" class="portfolio">
			        <div class="container">
			            <div class="row">
			                <div class="col-lg-10 col-lg-offset-1 text-center">			                
			                    <div class="row">
			                        <div class="col-md-4">
			                            <div class="portfolio-item">
			                            <h2><font color="white">Pending Rooms</font> <span class="label label-info"><?php echo $total5?></span></h2>
						                    <a class="btn-image" href="viewPendingRooms.php">
						                        <img style="opacity: 0.7;" src="img/portfolio-1.jpg" class="img-responsive"> 
						                    </a>
			                            </div>
			                        </div>
			                        <div class="col-md-4">
			                            <div class="portfolio-item">
			                            <h2><font color="white">Pending Equipments</font> <span class="label label-info"><?php echo $total6?></span></h2>
						                    <a class="btn-image" href="viewPendingEquipments.php">
						                        <img style="opacity: 0.7;" src="img/portfolio-2.jpg" class="img-responsive"> 
						                    </a>
			                            </div>
			                        </div>
			                       <div class="col-md-4">
			                            <div class="portfolio-item">
			                            <h2><font color="white">Verify Equipment </font> <span class="label label-info"><?php echo $total7?></span></h2>
						                    <a class="btn-image" href="viewVerificationEquipment.php">
						                        <img style="opacity: 0.7;" src="img/portfolio-2.jpg" class="img-responsive"> 
						                    </a>
			                            </div>
			                        </div>
			                        <div class="col-md-4">
			                            <div class="portfolio-item">
			                            <h2><font color="white">Room Reservation History</font></h2>
						                    <a class="btn-image" href="roomDetails.php">
						                        <img style="opacity: 0.7;" src="img/portfolio-3.jpg" class="img-responsive"> 
						                    </a>
			                            </div>
			                        </div>
			                        <div class="col-md-4">
			                            <div class="portfolio-item">
			                            <h2><font color="white">Add/Restock Equipment</font></h2>
						                    <button type="button" class='btn-image' data-toggle='modal' data-target='#addEquipmentModal'>
						                        <img style="opacity: 0.7;" src="img/portfolio-4.jpg" class="img-responsive"> 
						                    </button>

			                            </div>
			                        </div>
			                        <div class="col-md-4">
			                            <div class="portfolio-item">
			                            <h2><font color="white">Borrowed Equipment History</font></h2>
						                    <a class="btn-image" href="equipmentDetails.php">
						                        <img style="opacity: 0.7;" src="img/portfolio-4.jpg" class="img-responsive"> 
						                    </a>
			                            </div>
			                        </div>
			                    </div>
			                    <!-- /.row (nested) -->
			                </div>
			                <!-- /.col-lg-10 -->
			            </div>
			            <!-- /.row -->
			        </div>
			        <!-- /.container -->
			    </section>
            <br>
        </div>
    </header>
    <!-- Add Equipment Modal -->
    <div class="modal fade" id="addEquipmentModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-body">
		<div class="loginmodal-container">
		<?php 
			include 'addEquipmentAdmin.php';
		?>
		<hr></hr>
			<form action = "equipmentHandler.php" method="post">
				<b>Equipment : </b>
				<select id = "equipment_name" name = "equipment_name" required="required">
					<option value="Speakers">Speakers</option>
					<option value="Lapel">Lavalier Microphone</option>
					<option value="Projector">Projector</option>
					<option value="Microphone">Hand-held Microphone</option>
				</select>
				<hr></hr>
				<b>Quantity : </b><input type='number' name='quantity' required='required' id='quantity' min='1' max='15'/>
				<hr></hr>
				<center><input type = "submit" class="btn btn-success" value='Submit'></center>
			</form>
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
    $('.btn-image img').hover(
            function(){$(this).css('opacity','1');},
            function(){$(this).css('opacity','.7');}
        );
    </script>

</body>

</html>
