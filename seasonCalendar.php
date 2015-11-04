<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="style.css"/></head><body>
<table border=0 width=100%>
<table border=5 cellpadding=5 cellspacing=0><tr><td>
</tr>
<td valign=top halign=center>
<header>Formula&nbsp1&nbspSeasons</header>
<td valign=top><span class="raceevent">
<span class="seasonCalendar">
	<a href="http://localhost/MyPhp/test.php">2015</a><br>
	<a href="http://localhost/MyPhp/test.php">2014</a><br>
	2013<br>
	2012<br>
	2011<br>
	2010<br>
</span></table>
<?php
$_SESSION['year']='2014';
echo "Session variables are set.";
?>				
</html>
</body>				



