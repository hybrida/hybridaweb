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
							echo "Dine bestillinger:";
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
				<td class="orderTitle"><? if ($curr) echo "Slett"; else echo "Hentet"; ?> </td>
			<tr>
			<? foreach($orders as $o): if(empty($o)) break; ?>
			<tr class="<? if (!$curr) echo ($o['confirmed']) ? "green" : "red"; ?>">
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
							echo CHtml::submitButton('Fjern produkt', 
							array( 'name' => $o['id'], 'disabled' => !$curr,));
						else
							echo ($o['confirmed']) ? "Ja" : "Nei"; ?>
				</td>
			</tr>
			<? endforeach; ?>
			<? if (isset($comments[$time_id])){ ?>
			<tr>
				<td colspan=4>
					<hr>
				</td>
			<tr>
			<tr>
				<td><b>Info</b></td>
				<td colspan=2>
					<? echo $comments[$time_id]; ?>
				</td>
				<td>
					<? if ($curr) 
							echo CHtml::submitButton('Fjern info', 
							array( 'name' => $time_id, 'disabled' => !$curr,));
					?>
				</td>
			<tr>
			<? } ?>
		</table> 
	<? endforeach;?>
<?  echo CHtml::endForm(); ?>
<?  if ($curr) echo "<p class=\"orderText\">" .
					"Du kan endre din bestilling frem til " . 
					$time['end'] .
					"</p>";
?>
<? } ?>
