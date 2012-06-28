<?
$this->renderPartial("_menu");
?>
<br>
<center>
<?
if (count($orders) == 0)
	echo "Det er ingen bestillinger";
else
{
?>
<b>
Bestillinger:
</b>
<br>
<br>
<table width="100%">
	<tr>
			<td>
			<b>
				Produkt
			</b>
			</td>
			<td>
			<b>
				Størrelse
			</b>
			</td>
			<td>
			<b>
				Antall
			</b>
			</td>
	<tr>
	<? foreach($orders as $id => $size): ?>
		<? foreach($size as $s => $q): ?>
			<tr>
				<td>
					<?
					echo $products[$id]['type'] . ": " . $products[$id]['model'];
					?>
				</td>
				<td>
					<? echo $sizes[$s]; ?>
				</td>
				<td>
					<? echo $q; ?>
				</td>
			</tr>
		<? endforeach; ?>
	<? endforeach; ?>
</table>
<? echo CHtml::beginForm('', 'post'); ?>
<? echo CHtml::submitButton('Slett alle bestillinger', array( 'name' => 'del')); ?>
<? echo CHtml::endForm(); ?>
<? 
}
?>
<br>
<br>
<b>
Tider:
</b>
<br>
<br>
<table width="100%">
	<tr>
			<td> <b> Start </b> </td>
			<td> <b> Slutt </b> </td>
			<td> <b> Status </b> </td>
	<tr>
	<? foreach($times as $t): ?>
			<tr>
				<td> <?  echo $t['start']; ?> </td>
				<td> <?  echo $t['end']; ?> </td>
				<td>
					<?
					$curdate = date('Y-m-d');
					if ($curdate > $t['end'])
						echo "Avsluttet";
					elseif ($curdate < $t['start'])
						echo "Ikke begynt";
					else
						echo "Aktiv";
					  ?>
				</td>
			</tr>
	<? endforeach; ?>
</table>
</center>
