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
	$weather = "SELECT f1_events2.event_id,f1_events2.weather_id,weather_icon FROM f1_events2,weather WHERE f1_events2.weather_id = weather.weather_id";

echo "<div class = container>";
if($result5 = mysqli_query($link,$weather))
{
	if(mysqli_num_rows($result5)>0)
	{
	while($row = mysqli_fetch_array($result5))
	{
		echo "<tbody>";	
		echo "<tr>";
			echo "<td>Event: ".$row['event_id']."</td><tr>";
			echo "<td>Weather: ".$row['weather_id']."</td><tr>";
			echo '<td>'.'<img src="data:image/jpeg;base64,'.base64_encode( $row['weather_icon'] ).'" width = 40 height = 40"/>'.'</td>';
		echo "</tr>";
		echo "</tbody>";
	}
		echo "</table>";
	mysqli_free_result($result5);
	}
	else
	{
	echo "No records matching your query were found.";
	}
}
else
{
	echo "ERROR: Could not execute $weather.".mysqli_error($link);
}
}


?>