<? $this->renderPartial("_menu"); ?>
<? if (count($timeOrders) == 0 && count($timeComments) == 0): ?>
	<?= "<p class=\"orderText\">Du har ingen bestillinger</p>"; ?>
	<? return; ?>
<? endif; ?>
<br>
<?= CHtml::beginForm('/kilt/shop/orders', 'post'); ?>
<? foreach($times as $t): ?>
	<? $time_id = $t['id']; ?>
	<? $curr = $time_id == $time['id']; ?>
	<table class="orderTable">
			<tr>
			<td colspan=4 class="orderTableTitle">
				<?	if ($curr): ?>
					<?= "Dine aktive bestillinger:"; ?>
				<? else: ?>
					<?= "Dine bestillinger i tidsrommet "; ?>
					<?= $times[$time_id]['start'] . " - " . $times[$time_id]['end'];?>
				<? endif; ?>
				<hr>
			</td>
		</tr>
		<tr>
			<td class="orderTitle">Produkt</td>
			<td class="orderTitle">Størrelse</td>
			<td class="orderTitle">Antall</td>
			<td class="orderTitle">
				<?= ($curr) ? "Slett" : "Hentet"; ?>
			</td>
		</tr>
		<? if (!isset($timeOrders[$time_id])) goto comments; ?>
		<? foreach($timeOrders[$time_id] as $o): ?>
		<tr class="<? if (!$curr): ?> <?= ($o['confirmed']) ? "green" : "red"; ?> <? endif; ?>">
			<td class="orderContent">
				<?	$id = $o['product_id']; ?>
				<?= $products[$id]['type'] . ": " . $products[$id]['model'];?>
			</td>
			<td class="orderContent"> 
				<?= $sizes[$o['product_size']]; ?>
			</td>
			<td class="orderContent"> 
				<?= $o['product_quantity']; ?>
			</td>
			<td class="orderContent">
			<? if ($curr): ?>
				<?= CHtml::submitButton('Fjern produkt', array( 'name' => $o['id'], 'disabled' => !$curr,));?>
			<? else: ?>
				<?= ($o['confirmed']) ? "Ja" : "Nei"; ?>
			<? endif; ?>
			</td>
		</tr>
		<? endforeach; ?>
		<? comments: ?>
		<? if (!isset($timeComments[$time_id])) continue; ?>
		<tr>
			<td colspan=4>
				<hr>
			</td>
		</tr>
		<tr>
			<td><b>Info</b></td>
			<td colspan=2>
				<?= $timeComments[$time_id]; ?>
			</td>
			<td>
			<? if ($curr): ?>
				<?= CHtml::submitButton('Fjern info', array( 'name' => $time_id, 'disabled' => !$curr,));?>
			<? endif; ?>
			</td>
		<tr>
	</table> 
<? endforeach;?>
<? echo CHtml::endForm(); ?>
<? if ($curr): ?> 
	<p class="orderText">
		<?= "Du kan endre din bestilling frem til " .  $time['end']; ?>
	</p>
<? endif; ?>
