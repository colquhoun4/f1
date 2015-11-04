<?php
session_start();
$link = mysqli_connect("127.0.0.1", "root", "", "formula1");
if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "Circuits";
	
}
$queryCircuit = "SELECT DISTINCT circuit_id, circuit_nm FROM f1_circuits"; 
$circuits = mysqli_query($link,$queryCircuit);

?>
<html>
<head>
</head>
<body>

<form action="circuitPage.php" method="get">
<select name ="circuit">
			<option value="">Choose A Circuit</option>
			<?php
				foreach($circuits as $track):
			?>
				<option value = "<?php echo $track['circuit_id'];?>">
					<?php
						echo "<th>$track[circuit_nm]</th>";
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



