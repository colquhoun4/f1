<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body style="background-color:white">
<?php
session_start();

$link = mysqli_connect("127.0.0.1", "root", "", "formula1");

if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "{$_GET['season']} Season Calendar";
}

$sql = "SELECT DISTINCT event_id, substr(event_id,5,2) as Round, nm_common,laps,start_time, circuit_nm, CAST((length_km*laps) AS DECIMAL(6,3)) AS ttl_dist,
			crts.circuit_id AS cirid, flags,weather_icon
	FROM f1_events2 evnts, f1_circuits crts, flags, weather wthr
	WHERE event_id like'{$_GET['season']}%' 
		AND evnts.circuit_id = crts.circuit_version_id
		AND crts.cntry = flags.country_name
		AND evnts.weather_id = wthr.weather_id
	ORDER BY Round";


echo "<div class = container>";
echo "<div class = table-responsivness>";
if($result = mysqli_query($link,$sql)){
	if(mysqli_num_rows($result)>0){
	echo "<table>";
	echo "<div class = row>";
            	echo "<tr>";
                echo "<th>Round</th>";
		echo "<th>Grand Prix</th>";
		echo "<th>Country</th>";
		echo "<th>Laps</th>";
		echo "<th>Race Distance (KM)</th>";
		echo "<th>Start Time</th>";
		echo "<th>Weather</th>";
		echo "<th>Circuit</th>";
            	echo "</tr>";
	echo "</div>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['Round'] . "</td>";
		echo "<td>" . $row['nm_common'] . "</td>";
	        echo '<td>'.'<img src="data:image/jpeg;base64,'.base64_encode( $row['flags'] ).'" width = 40 height = 24"/>'.'</td>';
		echo "<td>" . $row['laps'] . "</td>";
		echo "<td>" . $row['ttl_dist']. "</td>";
		echo "<td>" . $row['start_time'] . "</td>";
		echo '<td>'.'<img src="data:image/jpeg;base64,'.base64_encode( $row['weather_icon'] ).'" width = 40 height = 24"/>'.'</td>';	
		echo "<td>"."<span class=menuitem><a href=circuitPage.php?circuit=".$row['cirid']."&submit=Submit>".$row['circuit_nm']."</a></span>"."</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}
echo "</div>";
echo "</div>";	
mysqli_close($link);
?>
<form action="Menu.php" method="get">
	<input type = "submit" name = "submit" value = "Main Menu"/>
</form>	