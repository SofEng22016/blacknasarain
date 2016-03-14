<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Add Available Rooms</title>

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
		padding:8px;
    	margin:5px 0;
    	background: none;
    	border: 1px solid #fff !important;
		}
</style>
</head>
<body>
<h1 class='text text-info'>Add Available Equipments</h1>
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
<center><input type = "submit" value='Submit'></center>
</form>
</body>


</html>