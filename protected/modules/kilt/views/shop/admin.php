<?
$this->renderPartial("_menu");
?>
<center>
<!-- Tids-tabell -->
<b>
Tider:
</b>
<br>
<br>
<? echo CHtml::beginForm('', 'post'); ?>
<table width="100%">
	<tr>
			<td> <b> Start </b> </td>
			<td> <b> Slutt </b> </td>
			<td> <b> Status </b> </td>
			<td> <b> Vis </b> </td>
	<tr>
	<? foreach($times as $t): ?>
			<tr>
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
						array( 'name' => 'create')); 
					?>
				</td>
			</tr>
</table>
<? echo CHtml::endForm(); ?>

<!-- Bestillings-tabell -->
<br>
<br>
<?
if ($showTimeID == -1)
	echo "Du må opprette et tidsrom først";
elseif (count($orders) == 0)
	echo "Det er ingen bestillinger i dette tidsrommet";
else
{
?>
<b>
<?
	echo "Bestillinger i tidsrommet " . $times[$showTimeID]['start'] . " - ";
	echo $times[$showTimeID]['end'];
?>
</b>
<br>
<br>
<table width="100%">
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
					<? echo $sizes[$s]; ?>
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
</center>
