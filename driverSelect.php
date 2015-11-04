<?php
session_start();
$link = mysqli_connect("127.0.0.1", "root", "", "formula1");
if($link === false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
else{
	echo "Driver Bios";
	
}
$queryDriver = "SELECT nm_common, nationality  FROM f1_drivers"; 
$drivers = mysqli_query($link,$queryDriver);

?>
<html>
<head>
</head>
<body>

<form action="driverPage.php" method="get">
<select name ="driver">
			<option value="">Choose A Driver</option>
			<?php
				foreach($drivers as $indiv):
			?>
				<option value = "<?php echo $indiv['nm_common'];?>">
					<?php
						echo "<th>$indiv[nm_common]</th>";
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



