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
		
	</body>
</html>




