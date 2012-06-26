<?
$this->renderPartial("_menu");
echo "<br>";
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
<? echo CHtml::beginForm('', 'post'); ?>
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
			<td>
			<b>
				Slett
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
			<? echo $sizes[$o['product_size']]; ?>
		</td>
		<td>
			<? echo $o['product_quantity']; ?>
		</td>
		<td>
			<? echo CHtml::submitButton('X', 
					array(
						'name' => $o['id'],
						'disabled' => $afterDeadline,
					)); ?>
		</td>
	</tr>
	<? endforeach; ?>
<? echo CHtml::endForm(); ?>
</table>
<? 
}
?>
