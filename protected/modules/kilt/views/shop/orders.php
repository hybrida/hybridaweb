<?
$this->renderPartial("_menu");
?>
<br>
<center>

<?
if (count($prevOrders) == 0 && count($curOrders) == 0)
	echo "Du har ingen bestillinger"; 
if (count($prevOrders) > 0)
{
?>
<b> Dine tidligere bestillinger: </b> <br> <br>
<table width="100%">
	<tr>
			<td width="25%"> <b> Produkt </b> </td>
			<td width="25%"> <b> Størrelse </b> </td>
			<td width="25%"> <b> Antall </b> </td>
			<td width="25%"> <b> Slett </b> </td>
	<tr>
	<? foreach($prevOrders as $o): ?>
	<tr>
		<td>
			<?
			$id = $o['product_id'];
			echo $products[$id]['type'] . ": " . $products[$id]['model'];
			?>
		</td>
		<td>
			<? echo $sizes[$o['product_size']]; ?>
		</td>
		<td>
			<? echo $o['product_quantity']; ?>
		</td>
		<td>
			<? echo CHtml::submitButton('X', 
					array(
						'name' => $o['id'],
						'disabled' => true,
					)); ?>
		</td>
	</tr>
	<? endforeach; ?>
</table>
<? 
}
?>

<?
if (count($curOrders) > 0)
{
?>
<br><br><b> Dine nåværende bestillinger: </b> <br> <br>
<? echo CHtml::beginForm('/kilt/shop/orders', 'post'); ?>
<table width="100%">
	<tr>
			<td width="25%"> <b> Produkt </b> </td>
			<td width="25%"> <b> Størrelse </b> </td>
			<td width="25%"> <b> Antall </b> </td>
			<td width="25%"> <b> Slett </b> </td>
	<tr>
	<? foreach($curOrders as $o): ?>
	<tr>
		<td>
			<?
			$id = $o['product_id'];
			echo $products[$id]['type'] . ": " . $products[$id]['model'];
			?>
		</td>
		<td>
			<? echo $sizes[$o['product_size']]; ?>
		</td>
		<td>
			<? echo $o['product_quantity']; ?>
		</td>
		<td>
			<? echo CHtml::submitButton('X', 
					array(
						'name' => $o['id'],
						'disabled' => false,
					)); ?>
		</td>
	</tr>
	<? endforeach; ?>
</table>
<? 
	echo CHtml::endForm();
	echo "Du kan endre din bestilling frem til " . $time['end'];
}
?>
</center>
