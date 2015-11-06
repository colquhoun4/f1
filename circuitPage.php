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
<body style="background-color:#B8B8B8 ">
<style>
	.panel-heading {
			background-color:black;
			color:#ffffff;
		 	font-size: 25px;
			font-family: "Arial Black", Gadget, sans-serif
			}	
	.panel-body 	{
			background-color:grey;
			color:black; 
			font-size: 18px;
			
			}	

	.panel-footer 	{
			background-color:white;
			color:black; 
			}	
</style>

<?php
session_start();
$link = mysqli_connect("127.0.0.1", "root", "", "formula1");
if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo 'Circuit&nbspInfo&nbspAND&nbspHistory&nbsp';
}
$gen_circuit_info = "	SELECT DISTINCT cntry, city, CONCAT(city,', ', cntry) as location, flags, count(nm_formal) AS cnt_events,
			MIN(yr_first) as first_yr, MAX(yr_last) as last_yr
			FROM  f1_circuits crt INNER JOIN flags, f1_events2 
			WHERE 
				crt.circuit_id like '{$_GET['circuit']}%' 
				AND 
				flags.country_name= crt.cntry
				AND
				f1_events2.circuit_id = crt.circuit_version_id";


echo "<div class = container>";
echo "<div class = table-responsivness>";
if($result3 = mysqli_query($link,$gen_circuit_info)){
	if(mysqli_num_rows($result3)>0)
	{
		echo "<table class = table>";
			echo "<thead>";
				echo "<th><p class = text-center>Location:\t</p></th>";
				echo "<th><p class = text-center>Number of races held:\t</p></th>";
				echo "<th><p class = text-center>First Year held:\t</p></th>";
				echo "<th><p class = text-center>Last Year held:\t</p></th>";
			echo "</thead>";
        while($row = mysqli_fetch_array($result3))
	{
			echo "<tbody>";
        			echo "<tr>";
				echo "<td><p class = text-center>".$row['location']."</p></td>";
				echo "<td><p class = text-center>".$row['cnt_events']."</p></td>";
				echo "<td><p class = text-center>".$row['first_yr']."</p></td>";
				echo "<td><p class = text-center>".$row['last_yr']."</p></td>";
	        		echo '<p class = "text-center">'.'<img src="data:image/jpeg;base64,'.base64_encode( $row['flags'] ).'" width = 400 height = 240"/>'.'</p>';
     	 			echo "</tr>";	
			echo "</tbody>";
        }
        	echo "</table>";
        mysqli_free_result($result3);
    	} 
	else
	{
        echo "No records matching your query were found.";
    	}
} 
else
{
    echo "ERROR: Could not execute $gen_circuit_info. " . mysqli_error($link);
}
echo "</div>";
echo "</div>";

$circuit_history = 	"SELECT version_num,circuit_nm,cntry,city, CAST(length_km AS DECIMAL(6,3)) AS length_km,yr_first,yr_last,circuit_image,count(evnt.event_id) AS num_races
			FROM  f1_circuits crt INNER JOIN  f1_events2 evnt 
			WHERE 
				crt.circuit_id like '{$_GET['circuit']}%' 
				AND 
				evnt.circuit_id = crt.circuit_version_id
			GROUP BY crt.circuit_version_id";

echo "<div class = col-xs-3>";
echo "</div>";
echo "<div class = col-xs-6>";
echo "<div class = table-responsive>";
if($result2 = mysqli_query($link,$circuit_history)){
	if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_array($result2)){
		echo "<div class = panel panel-primary>
			<div class = panel-heading><p class = text-center>Iteration ".$row['version_num']."</p></div>
			<div class = panel-body>
				<p class = text-center>".$row['circuit_nm']."</p>
				<p class = text-center>Length (KM): ".$row['length_km']."</p>
				<p class = text-center>".$row['num_races']." grands prix held from ".$row['yr_first']." to ".$row['yr_last']."</p>
			</div>
			<div class = panel-footer>
				<p class = text-center><img src=data:image/jpeg;base64,".base64_encode( $row['circuit_image'] )." class=img-rounded width = 350 height = 225>
			</div>
		</div>";
        }
        mysqli_free_result($result2);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not execute $circuit_history. " . mysqli_error($link);
}
echo "</div>";
echo "</div>";
echo "<div class = col-xs-3>";
echo "</div>";
$sql = "SELECT nm_formal, date, CAST((length_km*laps) AS DECIMAL(6,3)) AS ttl_dist, laps, circuit_nm, version_num FROM  f1_circuits crt INNER JOIN f1_events2 evnt where crt.circuit_id like '{$_GET['circuit']}%' 
	AND evnt.circuit_id = crt.circuit_version_id";
echo "<div class = container>";
if($result = mysqli_query($link,$sql)){
	if(mysqli_num_rows($result)>0){
		echo "<table class = table>";
		echo "<thead>";
		  echo "<tr>";
                	echo "<th>Official Event Name:\t</th>";
			echo "<th>Date:</th>";
			echo "<th>Distance:\t</th>";
			echo "<th>Laps:\t</th>";
			echo "<th>Circuit Name:\t</th>";
			echo "<th>Version:\t</th>";
            echo "</tr>";
echo "</thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
		echo "<tr>";
		echo "<tr>";
		echo "<td>".$row['nm_formal']."</td>";
		echo "<td><p class = text-right>".$row['date']."<p></td>";
		echo "<td>" . $row['ttl_dist'] . "</td>";
		echo "<td>" . $row['laps'] . "</td>";
		echo "<td>" . $row['circuit_nm'] . "</td>";
		echo "<td>" . $row['version_num']."</td>";
            echo "</tr>";
echo "</tbody>";
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

mysqli_close($link);
?>
<form action="Menu.php" method="get">
	<input type = "submit" name = "submit" value = "Main Menu"/>
</form>	