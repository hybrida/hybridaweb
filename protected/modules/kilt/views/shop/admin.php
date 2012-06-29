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
				<td>
					<? echo CHtml::submitButton('Vis bestillinger',
						array( 'name' => $t['id'],
								'disabled' => $t['id'] == $showTimeID)); 
					?>
				</td>
			</tr>
	<? endforeach; ?>
			<tr>
				<td> 
				<? echo CHtml::TextField('start', 'yyyy-mm-dd', 
						array( 'size' => 7)); ?>
				</td>
				<td> 
				<? echo CHtml::TextField('end', 'yyyy-mm-dd', 
						array( 'size' => 7)); ?>
				</td>
				<td> Ikke opprettet </td>
				<td>
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
?>
<table class="adminTable">
	<tr>
		<td colspan=3 class="adminTableTitle">
			<?  echo "Bestillinger"; ?>
			<hr>
		</td>
	</tr>
	<tr>
			<td class="adminTitle"> Produkt </td>
			<td class="adminTitle"> Størrelse </td>
			<td class="adminTitle"> Antall </td>
	<tr>
	<? foreach($orders[$showTimeID] as $id => $size): ?>
		<? foreach($size as $s => $q): ?>
			<tr>
				<td class="adminContent">
					<?
					echo $products[$id]['type'] . ": " . $products[$id]['model'];
					?>
				</td>
				
				<td class="adminContent"> <? echo $sizes[$s]; ?> </td>
				<td class="adminContent"> <? echo $q; ?> </td>
			</tr>
		<? endforeach; ?>
	<? endforeach; ?>
</table>
<? 
}
?>

<!-- Bruker-tabell -->
<?
	$userDropDown[-1] = "None";
	foreach($userOrders as $id => $timeOrder)
		if (isset($timeOrder[$showTimeID]))
			$userDropDown[$id] = $userOrders[$id]['name'];
	if ($showUserID != -1)
	{
?>
		<table class="adminTable">
			<tr>
				<td colspan=3 class="adminTableTitle">
					<?  echo "Bestillinger av " . $userOrders[$showUserID]['name']; ?>
					<hr>
				</td>
			</tr>
			<tr>
					<td class="adminTitle"> Produkt </td>
					<td class="adminTitle"> Størrelse </td>
					<td class="adminTitle"> Antall </td>
			<tr>
			<? foreach($userOrders[$showUserID][$showTimeID] as $id => $size): ?>
				<? foreach($size as $s => $q): ?>
					<tr>
						<td class="adminContent">
							<?
							echo $products[$id]['type'] . ": " . $products[$id]['model'];
							?>
						</td>
						
						<td class="adminContent"> <? echo $sizes[$s]; ?> </td>
						<td class="adminContent"> <? echo $q; ?> </td>
						<td class="adminTitle">  </td>
					</tr>
				<? endforeach; ?>
			<? endforeach; ?>
		</table>
	<? }
		if (count($userDropDown) > 1)
		{	
			echo "<center>";
			echo "<br>";
			echo CHtml::dropDownList('newuserid', 0, $userDropDown);
			echo CHtml::submitButton('Vis brukerens bestillinger', 
								array( 'name' => 'showUser')); 
			echo "</center>";
		}
		 ?>
<? echo CHtml::endForm(); ?>
