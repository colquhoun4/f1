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
<body>
<?php
session_start();

$link = mysqli_connect("127.0.0.1", "root", "", "formula1");

if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo 'Driver&nbspBio&nbspPage';	
}

$sql = "SELECT flags FROM flags where country_name = 'Australia'";


echo "<div class = container>";
if($result = mysqli_query($link,$sql)){
	if(mysqli_num_rows($result)>0){
		echo "<table class = table>";
	
        while($row = mysqli_fetch_array($result)){
		echo "<tbody>";
            echo "<tr>";
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['flags'] ).'" width = 400 height = 240"/>';
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

mysqli_close($link);
?>
<form action="Menu.php" method="get">
	<input type = "submit" name = "submit" value = "Main Menu"/>
</form>	