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
	echo 'Circuit&nbspInfo&nbspAND&nbspHistory&nbsp';
}
$sql3 = "SELECT DISTINCT cntry, city, flags  FROM  f1_circuits crt INNER JOIN flags where crt.circuit_id like '{$_GET['circuit']}%' 
	AND flags.country_name= crt.cntry";

echo "<div class = container>";
if($result3 = mysqli_query($link,$sql3)){
	if(mysqli_num_rows($result3)>0)
	{
		echo "<table class = table>";
			echo "<thead>";
		  		echo "<tr>";
				echo "<th>Country:\t</th>";
				echo "<th>City:\t</th>";
            			echo "</tr>";
			echo "</thead>";
        while($row = mysqli_fetch_array($result3))
	{
			echo "<tbody>";
        			echo "<tr>";
				echo "<td>".$row['cntry']."</td>";
				echo "<td>".$row['city']."</td>";
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
    echo "ERROR: Could not execute $sql3. " . mysqli_error($link);
}
echo "</div>";


$sql2 = "SELECT version_num,circuit_nm,cntry,city, CAST(length_km AS DECIMAL(6,3)) AS length_km,yr_first,yr_last FROM  f1_circuits crt  where crt.circuit_id like '{$_GET['circuit']}%'";
echo "<div class = container>";
if($result2 = mysqli_query($link,$sql2)){
	if(mysqli_num_rows($result2)>0){
		echo "<table class = table>";
		echo "<thead>";
		  echo "<tr>";
			echo "<th>Circuit Iteration: \t</th>";
                	echo "<th>Track Name:\t</th>";
			echo "<th>Country:\t</th>";
			echo "<th>City:\t</th>";
			echo "<th>Length(KM):\t</th>";
			echo "<th>First Year:\t</th>";
			echo "<th>Last Year:\t</th>";
            echo "</tr>";
		echo "</thead>";
        while($row = mysqli_fetch_array($result2)){
		echo "<tbody>";
            echo "<tr>";
		echo "<tr>";
		echo "<tr>";
		echo "<td>".$row['version_num']."</td>";
		echo "<td>".$row['circuit_nm']."</td>";
		echo "<td>".$row['cntry']."</td>";
		echo "<td>".$row['city']."</td>";
		echo "<td>".$row['length_km']."</td>";
		echo "<td>".$row['yr_first']."</td>";
		echo "<td>".$row['yr_last']."</td>";
            echo "</tr>";	
		echo "</tbody>";
        }
        echo "</table>";
        mysqli_free_result($result2);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not execute $sql2. " . mysqli_error($link);
}
echo "</div>";

$sql = "SELECT nm_formal, date, CAST((length_km*laps) AS DECIMAL(6,3)) AS ttl_dist, laps, circuit_nm, version_num FROM  f1_circuits crt INNER JOIN f1_events evnt where crt.circuit_id like '{$_GET['circuit']}%' 
	AND evnt.circuit_id = crt.circuit_version_id";
echo "<div class = container>";
if($result = mysqli_query($link,$sql)){
	if(mysqli_num_rows($result)>0){
		echo "<table class = table>";
		echo "<thead>";
		  echo "<tr>";
                	echo "<th>Official Event Name:\t</th>";
			echo "<th>Date:\t</th>";
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
		echo "<td>".$row['date']."</td>";
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