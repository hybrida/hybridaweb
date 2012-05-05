<?php
$stmt = Yii::app()->db->pdoInstance->prepare("SELECT name FROM rbac_item");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
$ja = "<span style='color: #0f0; font-weight: bold'>Ja</span>";
$nei = "<span style='color: #f00; font-weight: bold'>Nei</span>";
?>
<table border="1">
	<tr>
		<th>Navn</th>
		<th>Har tilgang</th>
	</tr>
<? foreach ($data as $accessName):
	$hasAccess = user()->checkAccess($accessName);
	?>
	<tr>
		<td><?= $accessName?></td>
		<td><?=$hasAccess ? $ja : $nei ?></td>
	</tr>

<? endforeach; ?>
</table>