<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Add Available Rooms</title>
<link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
	form select
	{		 
   		padding:8px;
    	margin:5px 0;
    	background: none;
    	border: 1px solid #fff !important;
		}
	form option:not(:checked)
	{
		color:green;
		}
	form option:checked
	{
		color: #0AD;
		}
	input
	{
		color:#ffffff;
		padding:8px;
    	margin:5px 0;
    	background: none;
    	border: 1px solid #fff !important;
		}
</style>
</head>
<body>
 <div class = "container">
 <h1> Add Available Rooms</h1>
<form action = "redirectTab.php" method="post">
<b>Room Name : </b>
<select id = "room_name" name = "room_name" required="required">
  <option value="CL1">Computer Lab 1</option>
  <option value="CL2">Computer Lab 2</option>
  <option value="MMA1">MMA 01</option>
  <option value="MMA2">MMA 02</option>
  <option value="FD1">FD01</option>
  <option value="FD2">FD02</option>
  <option value="401">Room 401</option>
  <option value="404">Room 404</option>
  <option value="405">Room 405</option>
  <option value="406">Room 406</option>
  <option value="407">Room 407</option>
  <option value="408">Room 408</option>
  <option value="409">Room 409</option>
  <option value="501">Room 501</option>
  <option value="502">Room 502</option>
  <option value="503">Room 503</option>
  <option value="504">Room 504</option>
  <option value="505">Room 505</option>
  <option value="506">Room 506</option>
  <option value="507">Room 507</option>
  <option value="508">Room 508</option>
  <option value="509">Room 509</option>
  <option value="Audi">Auditorium</option>
  <option value="Music Room">Music Room</option>
</select>
<hr></hr>
<b>Date : <input id="date" name="date" type = "date" required="required"></b>
<b>Time : <select id = "time" name = "time" required="required">
  <option value="8:00AM-11:00AM">8:00AM-11:00AM</option>
  <option value="11:30AM-2:30PM">11:30AM-2:30PM</option>
  <option value="2:45PM-5:45PM">2:45PM-5:45PM</option>
  <option value="6:00PM-9:00PM">6:00PM-9:00PM</option>
  </select></b>

 <input type = "submit">

</form>









</div>
</body>


</html>