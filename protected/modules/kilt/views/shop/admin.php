<?
$this->renderPartial("_menu");
echo "<br>";
if (!function_exists("preprint")) { 
    function preprint($s, $return=false) { 
        $x = "<pre>"; 
        $x .= print_r($s, 1); 
        $x .= "</pre>"; 
        if ($return) return $x; 
        else print $x; 
    } 
}

//preprint($post);
//preprint($userOrders);
?>
<!-- Tids-tabell -->
<? 
	echo CHtml::beginForm('', 'post');
	echo CHtml::textField('timeid', $showTimeID,
			array('hidden' => true));
	echo CHtml::textField('userid', $showUserID,
			array('hidden' => true));
?>
<table class="adminTable">
	<tr>
		<td colspan=4 class="adminTableTitle">
			Tider
			<hr>
		</td>
	</tr>
	<tr>
			<td class="adminTitle">Start  </td>
			<td class="adminTitle">Slutt  </td>
			<td class="adminTitle">Status  </td>
			<td class="adminTitle">Vis  </td>
	<tr>
	<? foreach($times as $t):
		if ($t['id'] == $showTimeID)
			echo "<tr class=\"active\">";
		else
			echo "<tr>";
	?>
				<td class="adminContent"> <?  echo $t['start']; ?> </td>
				<td class="adminContent"> <?  echo $t['end']; ?> </td>
				<td class="adminContent">
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
				<td class="adminContent">
					<? echo CHtml::submitButton('Vis bestillinger',
						array( 'name' => $t['id'],
								'disabled' => $t['id'] == $showTimeID)); 
					?>
				</td>
			</tr>
	<? endforeach; ?>
			<tr>
				<td class="adminContent"> 
				<? echo CHtml::TextField('start', 'yyyy-mm-dd', 
						array( 'size' => 7)); ?>
				</td>
				<td class="adminContent"> 
				<? echo CHtml::TextField('end', 'yyyy-mm-dd', 
						array( 'size' => 7)); ?>
				</td>
				<td class="adminContent"> Ikke opprettet </td>
				<td class="adminContent">
					<? echo CHtml::submitButton('Opprett tidsrom', 
						array( 'name' => 'createTime')); 
					?>
				</td>
			</tr>
</table>

<!-- Bestillings-tabell -->
<?
if ($showTimeID == -1)
	echo "<p class=\"adminText\">Du må opprette et tidsrom først</p>";
elseif (!isset($orders[$showTimeID]))
	echo "<p class=\"adminText\">Det er ingen bestillinger i dette tidsrommet</p>";
else
{
	$curdate = date('Y-m-d');
	$active = $curdate <= $times[$showTimeID]['end'];
?>
<table class="adminTable">
	<tr>
		<td colspan=4 class="adminTableTitle">
			<?  echo "Bestillinger"; ?>
			<hr>
		</td>
	</tr>
	<tr>
			<td class="adminTitle"> Produkt </td>
			<td class="adminTitle"> Størrelse </td>
			<td class="adminTitle"> Antall </td>
			<td class="adminTitle"> <? if (!$active) echo "Hentet"; ?> </td>
	<tr>
	<? foreach($orders[$showTimeID] as $id => $size): ?>
		<? foreach($size as $s => $o): ?>
			<tr class="<? if (!$active) echo ($o['recv'] == $o['qnty']) ? "green" : "red"; ?>">
				<td class="adminContent">
					<?
					echo $products[$id]['type'] . ": " . $products[$id]['model'];
					?>
				</td>
				
				<td class="adminContent"> <? echo $sizes[$s]; ?> </td>
				<td class="adminContent"> <? echo $o['qnty']; ?> </td>
				<td class="adminContent"> <? if (!$active) echo $o['recv']; ?> </td>
			</tr>
		<? endforeach; ?>
	<? endforeach; ?>
</table>
<? 
}
?>

<!-- Bruker-tabell -->
<?
	$curdate = date('Y-m-d');
	$active = $showTimeID > -1 && $curdate <= $times[$showTimeID]['end'];
	$userDropDown[-1] = "None";
	foreach($userOrders as $id => $timeOrder)
		if (isset($timeOrder[$showTimeID]))
			if (!$active)
				$userDropDown[$id] = '('.$timeOrder['done'][$showTimeID].') ' 
									.$userOrders[$id]['name'];
			else
				$userDropDown[$id] = $userOrders[$id]['name'];
	if (count($userDropDown) > 1)
	{	
		echo "<center>";
		echo "<br>";
		echo "<br>";
		echo CHtml::dropDownList('newuserid', 0, $userDropDown);
		echo CHtml::submitButton('Vis brukers bestillinger', 
							array( 'name' => 'showUser')); 
		echo "</center>";
	}
	if ($showUserID != -1)
	{
		$curdate = date('Y-m-d');
		$active = $curdate <= $times[$showTimeID]['end'];
?>
		<table class="adminTable">
			<tr>
				<td colspan=4 class="adminTableTitle">
					<?  echo "Bestillinger av " . $userOrders[$showUserID]['name']; ?>
					<hr>
				</td>
			</tr>
			<tr>
					<td class="adminTitle"> Produkt </td>
					<td class="adminTitle"> Størrelse </td>
					<td class="adminTitle"> Antall </td>
					<td class="adminTitle"> <? if (!$active) echo "Hentet"; ?> </td>
			<tr>
			<? foreach($userOrders[$showUserID][$showTimeID] as $id => $size): ?>
				<? foreach($size as $s => $o): ?>
				<?
					$qnty = $o['qnty'];
					$recv = $o['recv']; 
					$oid = $o['id']; 
				?>
			<tr class="<? if (!$active) echo ($recv) ? "green" : "red"; ?>">
						<td class="adminContent">
							<?
							echo $products[$id]['type'] . ": " . $products[$id]['model'];
							?>
						</td>
						
						<td class="adminContent"> <? echo $sizes[$s]; ?> </td>
						<td class="adminContent"> <? echo $qnty; ?> </td>
						<td class="adminContent"> 
							<? 
								if (!$active)
								{
									echo CHtml::hiddenField('recv['.$oid.']','0');
									echo CHtml::CheckBox('recv['.$oid.']',$recv, array (
											'value'=>'1',
											));
								}
							?> 
						</td>
					</tr>
				<? endforeach; ?>
			<? endforeach; ?>
			<? if (!$active) {?>
			<tr>
				<td colspan=3>
				</td>
				<td class="adminContent">
					<?
					echo CHtml::submitButton('Oppdater', 
							array( 'name' => 'updateOrder')); 
					?>
				</td>
			</tr>
			<? } ?>
		</table>
	<? 
		}
	 ?>
<? echo CHtml::endForm(); ?>
