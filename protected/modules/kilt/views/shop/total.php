<?
$this->renderPartial("_menu");
if (count($orders) == 0)
	echo "Det er ingen bestillinger";
else
{
?>
<b>
Bestillinger:
</b>
<table>
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
					<? echo $s; ?>
				</td>
				<td>
					<? echo $q; ?>
				</td>
			</tr>
		<? endforeach; ?>
	<? endforeach; ?>
</table>
<? 
}
?>
