<? $this->renderPartial("_menu"); ?>
<br>

<!-- Tids-tabell -->
<?= CHtml::beginForm('', 'post');?>
<?= CHtml::textField('timeid', $showTimeID, array('hidden' => true));?>
<?= CHtml::textField('userid', $showUserID, array('hidden' => true));?>

<table class="adminTable">
	<tr>
		<td colspan=4 class="adminTableTitle">
			Tider
			<hr>
		</td>
	</tr>
	<tr>
		<td class="adminTitle">Start</td>
		<td class="adminTitle">Slutt</td>
		<td class="adminTitle">Status</td>
		<td class="adminTitle">Vis</td>
	</tr>
	<? foreach($times as $t): ?>
		<? if ($t['id'] == $showTimeID): ?>
			<tr class="active">
		<? else: ?>
			<tr>
		<? endif; ?>

		<td class="adminContent"> <? echo $t['start']; ?> </td>
		<td class="adminContent"> <? echo $t['end']; ?> </td>
		<td class="adminContent">
			<? $curdate = date('Y-m-d'); ?>
			<? if ($curdate > $t['end']): ?>
				Avsluttet
			<? elseif ($curdate < $t['start']): ?>
				Ikke begynt
			<? else: ?>
				Aktiv
			<? endif; ?>
		</td>
		<td class="adminContent">
			<?= CHtml::submitButton('Vis bestillinger', array( 'name' => $t['id'], 'disabled' => $t['id'] == $showTimeID)); ?>
		</td>
	</tr>
	<? endforeach; ?>
	<tr>
		<td class="adminContent">
			<?= CHtml::TextField('start', 'yyyy-mm-dd', array( 'size' => 7)); ?>
		</td>
		<td class="adminContent">
			<?= CHtml::TextField('end', 'yyyy-mm-dd', array( 'size' => 7)); ?>
		</td>
		<td class="adminContent"> Ikke opprettet </td>
		<td class="adminContent">
			<?= CHtml::submitButton('Opprett tidsrom', array( 'name' => 'createTime')); ?>
		</td>
	</tr>
</table>

<!-- Bestillings-tabell -->
<?  if ($showTimeID == -1): ?>
	<?= "<p class=\"adminText\">Du må opprette et tidsrom først</p>";?>
<? elseif (!isset($orders[$showTimeID])): ?>
	<?= "<p class=\"adminText\">Det er ingen bestillinger i dette tidsrommet</p>";?>
<? else:
	$curdate = date('Y-m-d');
	$active = $curdate <= $times[$showTimeID]['end'];
?>
	<table class="adminTable">
		<tr>
			<td colspan=4 class="adminTableTitle">
				Bestillinger
				<hr>
			</td>
		</tr>
		<tr>
			<td class="adminTitle"> Produkt </td>
			<td class="adminTitle"> Størrelse </td>
			<td class="adminTitle"> Antall </td>
			<td class="adminTitle"> <? if (!$active): ?>Hentet<? endif; ?> </td>
		<tr>
		<? foreach($orders[$showTimeID] as $id => $size): ?>
			<? foreach($size as $s => $o): ?>
				<tr class="<? if (!$active): ?> <?= ($o['recv'] == $o['qnty']) ? "green" : "red"; ?><? endif; ?>">
					<td class="adminContent">
						 <?= $products[$id]['type'] . ": " . $products[$id]['model']; ?>
					</td>
					<td class="adminContent">
						<?= $sizes[$s]; ?>
					</td>
					<td class="adminContent">
						<?= $o['qnty']; ?>
					</td>
					<td class="adminContent">
						<? if (!$active): ?>
							 <?= $o['recv'];?>
						<? endif; ?>
					</td>
				</tr>
			<? endforeach; ?>
		<? endforeach; ?>
	</table>
<? endif; ?>

<!-- Bruker-tabell -->
<?
	$curdate = date('Y-m-d');
	$active = $showTimeID > -1 && $curdate <= $times[$showTimeID]['end'];
	$userDropDown[-1] = "None";
?>

<?
	foreach($userOrders as $id => $timeOrder)
		if (isset($timeOrder[$showTimeID]))
			if (!$active)
				$userDropDown[$id] = '('.$timeOrder['done'][$showTimeID].') ' .$userOrders[$id]['name'];
			else
				$userDropDown[$id] = $userOrders[$id]['name'];
?>

<? if (count($userDropDown) > 1): ?>
		<center>
			<br>
			<br>
			<?= CHtml::dropDownList('newuserid', 0, $userDropDown);?>
			<?= CHtml::submitButton('Vis brukers bestillinger', array( 'name' => 'showUser')); ?>
		</center>
<? endif; ?>
<? if ($showUserID != -1): ?>
	<? $curdate = date('Y-m-d');?>
	<? $active = $curdate <= $times[$showTimeID]['end']; ?>
	<table class="adminTable">
		<tr>
			<td colspan=4 class="adminTableTitle">
				<?= "Bestillinger av " . $userOrders[$showUserID]['name']; ?>
				<hr>
			</td>
		</tr>
		<tr>
			<td class="adminTitle"> Produkt </td>
			<td class="adminTitle"> Størrelse </td>
			<td class="adminTitle"> Antall </td>
			<td class="adminTitle">
				<? if (!$active): ?>
					 Hentet
				<? endif; ?>
			</td>
		<tr>
		<? foreach($userOrders[$showUserID][$showTimeID] as $id => $size): ?>
			<? foreach($size as $s => $o): ?>
				<?
					$qnty = $o['qnty'];
					$recv = $o['recv'];
					$oid = $o['id'];
				?>
				<tr class="<? if (!$active): ?><?= ($recv) ? "green" : "red"; ?><? endif; ?>">
					<td class="adminContent">
						 <?= $products[$id]['type'] . ": " . $products[$id]['model']; ?>
					</td>
					<td class="adminContent">
						<?= $sizes[$s]; ?>
					</td>
					<td class="adminContent">
						<?= $qnty; ?>
					</td>
					<td class="adminContent">
						<?  if (!$active): ?>
							<?= CHtml::hiddenField('recv['.$oid.']','0');?>
							<?= CHtml::CheckBox('recv['.$oid.']',$recv, array ( 'value'=>'1',));?>
						<? endif; ?>
					</td>
				</tr>
			<? endforeach; ?>
		<? endforeach; ?>
		<? if (!$active): ?>
		<tr>
			<td colspan=3> </td>
			<td class="adminContent">
				 <?= CHtml::submitButton('Oppdater', array( 'name' => 'updateOrder')); ?>
			</td>
		</tr>
		<? endif; ?>
	</table>
<? endif; ?>
<?= CHtml::endForm(); ?>

<!-- Kommentar-tabell -->
<? if ($showTimeID == -1): ?>
		<? return; ?>
<? elseif (count($comments) == 0): ?>
		<p class="adminText">
			Det er ingen kommentarer i dette tidsrommet
		</p>
<? else: ?>
	<table class="adminTable">
		<tr>
			<td colspan=4 class="adminTableTitle">
				Kommentarer
				<hr>
			</td>
		</tr>
		<tr>
			<td class="adminTitle"> Navn </td>
			<td class="adminTitle" colspan=3> Kommentar </td>
		<tr>
		<? foreach($comments as $name => $c): ?>
			<tr>
				<td colspan=2>
					<br>
				</td>
			</tr>
			<tr>
				<td width="25%">
					<?= $name; ?>
				</td>
				<td width=75%>
					<?= $c; ?>
				</td>
			</tr>
		<? endforeach; ?>
	</table>
<? endif; ?>
