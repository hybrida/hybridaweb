<p> Vil du også skrive blogg-innlegg her? Meld fra til WebKom! </p>

<?php 
	for ($i = 0; $i < count($data); ++$i) {
		$row = $data[$i];
		echo "<h1>" . $row["title"] . "</h1>";
		echo "<p>" . $row["content"] . "</p>";
		echo "<p> Av " . $row["uid"] . ", " . $row["time"] . "</p>";
	}
?>
