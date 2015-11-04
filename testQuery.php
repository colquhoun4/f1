<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "formula1";

$link = mysqli_connect("127.0.0.1", "root", "", "formula1");
$sql = "SELECT event_id,nm_formal FROM formula1.f1_events where event_id like '%1990%'";
$result = $link->query($sql);
echo"
while (result.next())
{

	System.out.println(result.getString(1)+ result.getString(2));
}";
$link->close();
?>