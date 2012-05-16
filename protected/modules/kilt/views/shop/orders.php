<?
$this->renderPartial("_menu");
if (count($orders) == 0)
	echo "Du har ingen bestillinger";
else
{
?>
<b>
Dine Bestillinger:
</b>
<br>
<br>
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
	<? foreach($orders as $o): ?>
	<tr>
		<td>
			<?
			$id = $o['product_id'];
			echo $products[$id]['type'] . ": " . $products[$id]['model'];
			?>
		</td>
		<td>
			<? echo $o['product_size']; ?>
		</td>
		<td>
			<? echo $o['product_quantity']; ?>
		</td>
	</tr>
	<? endforeach; ?>
</table>
<? 
}
?>
