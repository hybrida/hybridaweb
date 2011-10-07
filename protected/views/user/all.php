<?php


// FIXME
// Quick and ugly way to add mysql_query to the project

MySQL::connect();

function displayMembers($year) {

	$query = "SELECT ui.userId, ui.firstName, ui.middleName, ui.sirName, ui.imageId
                        FROM user_info AS ui WHERE graduationYear = " . $year;
	$result = mysql_query($query) or die(mysql_error());

	while ($row = mysql_fetch_array($result)) {
		echo ("<li><img src='php/image.php?id=$row[imageId]&size=3 '><a href='?site=profile&id=$row[userId]'>$row[firstName] $row[middleName] $row[sirName]</a></li>");
	}
}

$class = (isset($_GET['class']) ? ($_GET['class']) : "");
$nowYear = date("Y");

echo "<h1>Klasselister</h1>";
echo "<div class='menuPage'>";
echo " <a href='?class=1'>1.Klasse</a> ";
echo " <a href='?class=2'>2.Klasse</a> ";
echo " <a href='?class=3'>3.Klasse</a> ";
echo " <a href='?class=4'>4.Klasse</a> ";
echo " <a href='?class=5'>5.Klasse</a> ";

echo "</div>";

switch ($class) {
	case 1:
		echo "<h2> 1.Klasse</h2>";
		displayMembers($nowYear + 4);
		break;
	case 2:
		echo "<h2> 2.Klasse</h2>";
		displayMembers($nowYear + 3);
		break;
	case 3:
		echo "<h2> 3.Klasse</h2>";
		displayMembers($nowYear + 2);
		break;
	case 4:
		echo "<h2> 4.Klasse</h2>";
		displayMembers($nowYear + 1);
		break;
	case 5:
		echo "<h2> 5.Klasse</h2>";
		displayMembers($nowYear);
		break;
	default:
}
?>