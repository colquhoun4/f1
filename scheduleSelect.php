<?php
session_start();
$link = mysqli_connect("127.0.0.1", "root", "", "formula1");
if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "2015 Season Calendar";
	
}
$querySchedule = "SELECT DISTINCT SUBSTRING(event_id,1,4) AS event_id FROM f1_events"; 
$seasons = mysqli_query($link,$querySchedule);

?>
<html>
<head>
</head>
<body>

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
</body>
</html>



