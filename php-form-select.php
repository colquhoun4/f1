<?php
session_start();

$link = mysqli_connect("127.0.0.1", "root", "", "formula1");

if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "2015 Season Calendar";
}

$query = "SELECT DISTINCT SUBSTRING(event_id,1,4) AS event_id FROM f1_events"; 
$seasons = mysqli_query($link,$query);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>PHP form select box example</title>
<!-- define some style elements-->
<style>
label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>	
</head>

<body>
<?php
	if(isset($_POST['formSubmit'])) 
	{
		$raceSelect = $_POST['gpselect'];
		
		echo($raceSelect . " ");
	}
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='gpselect[]'>Select the countries that you have visited:</label><br>
	<select multiple="multiple" name="gpselect[]">
			<option value="">ChooseSeason</option>
			<?php
				foreach($seasons as $years):
			?>
				<option value = "">
					<?php
						echo "<th>$years[event_id]</th>";
					?>
				</option>
			<?php
				endforeach;
			?>
	</select><br>
	<input type="submit" name="formSubmit" value="Submit" >
</form>

</body>
</html>