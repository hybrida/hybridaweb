<?php

if (isset($_GET['getCompanies']) && isset($_GET['letters'])) {
	$letters = $_GET['letters'];
	$letters = preg_replace("/[^a-z0-9 ]/si", "", $letters);

	$query = "SELECT companyName FROM company WHERE companyName LIKE '" . $letters . "%' ORDER BY companyName";
	$result = mysql_query($query) or die(mysql_error());

	while ($inf = mysql_fetch_array($result)) {
		echo $inf['Bedriftsnavn'] . "|";
	}
}
