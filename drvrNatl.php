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
	$country = "SELECT nationality FROM f1_drivers where driver_id ='{$_SESSION['drvrid']}'";
echo "<div class = container>";
if($result5 = mysqli_query($link,$country))
{
	if(mysqli_num_rows($result5)>0)
	{
	while($row = mysqli_fetch_array($result5))
	{
		echo "<tbody>";
			echo "<td>All-Time drivers from ".$row['nationality']."</td>";
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
	echo "ERROR: Could not execute $natldrvrs.".mysqli_error($link);
}
}
$numdrvrs =	"SELECT DISTINCT COUNT(nm_common) AS numdrv, nationality FROM f1_drivers WHERE nationality=
										(SELECT nationality FROM f1_drivers where driver_id='{$_SESSION['drvrid']}')";
echo "<div class = container>";
if($result2 = mysqli_query($link,$numdrvrs))
{
	if(mysqli_num_rows($result2)>0)
	{
	while($row = mysqli_fetch_array($result2))
	{
		echo "<tbody>";
			echo "<td>There have been ".$row['numdrv']." drivers from ".$row['nationality']."</td>";
		echo "</tbody>";
	}
		echo "</table>";
	mysqli_free_result($result2);
	}
	else
	{
	echo "No records matching your query were found.";
	}
}
else
{
	echo "ERROR: Could not execute $natldrvrs.".mysqli_error($link);
}
$numdead = "SELECT DISTINCT COUNT(deathdate) as numdead FROM f1_drivers WHERE nationality = (SELECT nationality FROM f1_drivers where driver_id ='{$_SESSION['drvrid']}') AND deathdate <>''";
echo "<div class = container>";
if($result3 = mysqli_query($link,$numdead))
{
	if(mysqli_num_rows($result3)>0)
	{
	while($row = mysqli_fetch_array($result3))
	{
		echo "<tbody>";
			echo "<td>".$row['numdead']." of the drivers are dead</td>";
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
	echo "ERROR: Could not execute $natldrvrs.".mysqli_error($link);
}
echo "</div>";


$natldrvrs = "SELECT nm_common, nationality, driver_id FROM f1_drivers WHERE nationality=(SELECT nationality FROM f1_drivers where driver_id ='{$_SESSION['drvrid']}')";
echo "<div class = container>";
if($result = mysqli_query($link,$natldrvrs))
{
	if(mysqli_num_rows($result)>0)
	{
		echo "<table class = table>";
			echo "<thead>";
				echo "<th>Driver Name:</th>";
			echo "</thead>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tbody>";
			echo "<td>"."<span class=menuitem><a href=driverPage.php?driver=".$row['driver_id']."&submit=Submit>".$row['nm_common']."</a></span>"."</td>";
		echo "</tbody>";
	}
		echo "</table>";
	mysqli_free_result($result);
	}
	else
	{
	echo "No records matching your query were found.";
	}
}
else
{
	echo "ERROR: Could not execute $natldrvrs.".mysqli_error($link);
}
echo "</div>";
?>