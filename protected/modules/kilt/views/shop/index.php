<? $this->renderPartial("_menu"); ?>
<? echo CHtml::beginForm('', 'post'); ?>
<table width=100%>
<?foreach($categories as $c):?>
<? $counter = 0; ?>
	<tr>
		<td colspan=3>
			<center>
				<h2><? echo $c; ?></h2>
			</center>
		</td>
	</tr>	
	<tr>
		<?  
		foreach($products[$c] as $p):

			if ($counter % 3 == 0 && $counter != 0) 
				echo "</tr><tr>";
			$counter++; 

			$id = $p['id'];
			$pqnty = "0";
			$psize = "none";
			if (isset($qnty[$id]))
				$pqnty = $qnty[$id];
			if (isset($size[$id]))
				$psize= $size[$id];
		?>
		<td width=33%>
			<center>
				<?
				echo "<b>".$p['model']."</b>";
				echo "<br>"; 
				echo "Antall "; 
				echo CHtml::TextField('qnty['.$id.']', $pqnty, array( 'size' => 2)); 
//*
			   if (sizeof($p['sizes']) > 0)
			   {
					$sizeNames = array();
					$sizeNames[-1] = "Velg str.";
				   	foreach($p['sizes'] as $e)
				   		$sizeNames[$e] = $sizes[$e];
				   	echo "<br>";
				   	echo CHtml::dropDownList('size['.$id.']', $psize, $sizeNames); 
			   }
/**/
				if (isset($errors[$p['id']])) 
				{
					echo "<font color='red'>";
					foreach($errors[$p['id']] as $e)
						echo "<br>" . $e;
					echo "</font>";
				}
				?>
			</center>
			<br>
			</td>
		<? endforeach ?>
	</tr>
<? endforeach ?>	
</table>
<center>
<? echo CHtml::submitButton('Bestill', 
			array('id'=>'submit', 'name' =>'submit', 'disabled' => !$isShopOpen)
		); 
	if (!$isShopOpen)
		echo "<br>Du kan ikke bestille nå";
?>
</center>
<? echo CHtml::endForm(); ?>
