<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body style="background-color:lightgrey">

<?php
session_start();

$link = mysqli_connect("127.0.0.1", "root", "", "formula1");

if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "Grand Prix";
}

$queryEvent = "SELECT DISTINCT nm_common FROM f1_events ORDER BY nm_common";
$gps= mysqli_query($link,$queryEvent);

$queryDriver = "SELECT nm_common, nationality, driver_id  FROM f1_drivers"; 
$drivers = mysqli_query($link,$queryDriver);

$queryCircuit = "SELECT DISTINCT circuit_id, circuit_nm FROM f1_circuits"; 
$circuits = mysqli_query($link,$queryCircuit);

$querySchedule = "SELECT DISTINCT SUBSTRING(event_id,1,4) AS event_id FROM f1_events"; 
$seasons = mysqli_query($link,$querySchedule);

$submittedValue = "";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset = "UTF-8">
		<title>Dropdown</title>
	</head>
	<body>
<?php
	if(isset($_POST['Event'])) 
	{
		$gpselect = $_POST['Event'];
		
		if(!isset($gpselect)) 
		{
			echo("<p>You didn't select any races!</p>\n");
		} 
		else 
		{
		
			echo("<p>You selected the $gpselect ");
			echo("</p>");
		}
	}
?>
 <div class = container>
		<form onsubmit="return mysubmit();">
			<select name ="Event"</select>
			<option value="">Choose Grand Prix</option>
			<?php
				foreach($gps as $grandprix):
			?>
				<option value="">
					<?php
						echo "<th>$grandprix[nm_common]</th>";
					?>
				</option>
			<?php
				endforeach;
			?>
			<input type = "submit" name = "gp" id="submit" value = "Submit">
		</form>

		<form action="schedulePage.php" method="get">
		<select name ="season">
			<option value="">ChooseSeason</option>
			<?php
				foreach($seasons as $years):
			?>
				<option value = "<?php echo $years['event_id'];?>">
					<?php
						echo "<th>$years[event_id]</th>";
					?>
				</option>
			<?php
				endforeach;
			?>
		</select>
		<input type = "submit" name = "submit" value = "Submit"/>
		</form>
		

		<form action="driverPage.php" method="get">
		<select name ="driver">
			<option value="">Choose A Driver</option>
			<?php
				foreach($drivers as $indiv):
			?>
				<option value = "<?php echo $indiv['driver_id'];?>">
					<?php
						echo "<th>$indiv[nm_common]</th>";
					?>	
				</option>
			<?php
				endforeach;
			?>
		</select>
		<input type = "submit" name = "submit" value = "Submit"/>
		</form>


		<form action="circuitPage.php" method="get">
		<select name ="circuit">
			<option value="">Choose A Circuit</option>
			<?php
				foreach($circuits as $track):
			?>
				<option value = "<?php echo $track['circuit_id'];?>">
					<?php
						echo "<th>$track[circuit_nm]</th>";
					?>
				</option>
			<?php
				endforeach;
			?>
		</select>
		<input type = "submit" name = "submit" value = "Submit"/>
		</form>	

</div>
	</body>
</html>




