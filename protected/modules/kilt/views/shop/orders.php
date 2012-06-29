<?  $this->renderPartial("_menu"); ?>
<br>
<?
if (count($timeOrders) == 0)
	echo "<p class=\"orderText\">Du har ingen bestillinger</p>"; 
else
{
	echo CHtml::beginForm('/kilt/shop/orders', 'post');
	foreach($timeOrders as $time_id => $orders):
		$curr = $time_id == $time['id'];
?>
		<table class="orderTable">
			<tr>
				<td colspan=4 class="orderTableTitle">
					<?
						if ($curr)
							echo "Dine nåværende bestillinger:";
						else
						{
							echo "Dine bestillinger i tidsrommet ";
							echo $times[$time_id]['start'];
							echo " - ";
							echo $times[$time_id]['end'];
						}
					?>
					<hr>
				</td>
			<tr>
				<td class="orderTitle">Produkt</td>
				<td class="orderTitle">Størrelse</td>
				<td class="orderTitle">Antall</td>
				<td class="orderTitle"><? if ($curr) echo "Slett"; ?> </td>
			<tr>
			<? foreach($orders as $o): ?>
			<tr>
				<td class="orderContent">
					<?
					$id = $o['product_id'];
					echo $products[$id]['type'] . ": " . $products[$id]['model'];
					?>
				</td>
				<td class="orderContent"> <? echo $sizes[$o['product_size']]; ?> </td>
				<td class="orderContent"> <? echo $o['product_quantity']; ?> </td>
				<td class="orderContent">
					<? if ($curr) 
							echo CHtml::submitButton('X', 
							array( 'name' => $o['id'], 'disabled' => !$curr,)); ?>
				</td>
			</tr>
			<? endforeach; ?>
		</table> 
	<? endforeach;?>
<?  echo CHtml::endForm(); ?>
<?  if ($curr) echo "<p class=\"orderText\">" .
					"Du kan endre din bestilling frem til " . 
					$time['end'] .
					"</p>";
?>
<? } ?>
