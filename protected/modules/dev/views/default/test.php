<?php
$stmt = Yii::app()->db->pdoInstance->prepare("SELECT name FROM rbac_item");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<table>
	<tr>
		<th>Navn</th>
		<th>Har tilgang</th>
	</tr>
<? foreach ($data as $accessName):
	$hasAccess = user()->checkAccess($accessName);
	?>
	<tr>
		<td><?= $accessName?></td>
		<td><?=$hasAccess ? "true" : "false" ?></td>
	</tr>

<? endforeach; ?>
</table>