<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-12">
    <title>A Simple PHP File</title>
</head>
<body>
    <h1><?php
$link = mysqli_connect("127.0.0.1", "root", "", "formula1");

if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "Connected Successfully!";
}
$sql = "SELECT * FROM f1_events where event_id like '2015%'";
if($result = mysqli_query($link,$sql)){
	if(mysqli_num_rows($result)>0){
		echo "<table>";
            echo "<tr>";
                echo "<th>event_id</th>";
		echo "<th>nm_common</th>";
		echo "<th>laps</th>";
		echo "<th>start_time</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['event_id'] . "</td>";
		echo "<td>" . $row['nm_common'] . "</td>";
		echo "<td>" . $row['laps'] . "</td>";
		echo "<td>" . $row['start_time'] . "</td>";
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

mysqli_close($link);
?></h1>
</body>
</html>