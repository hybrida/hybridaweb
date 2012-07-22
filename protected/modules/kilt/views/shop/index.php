<? $this->renderPartial("_menu"); ?>
<? echo CHtml::beginForm('', 'post'); ?>
<table class="shopTable">
<?foreach($catProducts as $cat => $products):?>
<? $counter = 0; ?>
	<tr>
		<td colspan=3  class="shopTitle">
				<? echo $cat; ?>
		</td>
	</tr>	
	<tr>
		<?  
		foreach($products as $p):

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
		<td class="shopContent">
				<?
				echo "<b>".$p['model']."</b>";
				echo "<br>"; 
				echo "Antall "; 
				echo CHtml::TextField('qnty['.$id.']', $pqnty, array( 'size' => 2)); 

			   if (sizeof($p['sizes']) > 0)
			   {
					$sizeNames = array();
					$sizeNames[-1] = "Velg str.";
					foreach($p['sizes'] as $e)
						$sizeNames[$e] = $sizes[$e];
					echo "<br>";
					echo CHtml::dropDownList('size['.$id.']', $psize, $sizeNames); 
			   }

				if (isset($errors[$p['id']])) 
				{
					echo "<p class=\"shopError\">";
					foreach($errors[$p['id']] as $e)
						echo "<br>" . $e;
					echo "</p>";
				}
				?>
			</td>
		<? endforeach ?>
	</tr>

<? endforeach ?>	
	<tr>
		<td colspan=3  class="shopTitle">
				Annet
		</td>
	</tr>	
	<tr>
		<td colspan=3  class="shopTitle">
			<? echo CHtml::textArea('comment', $comment); ?>
		</td>
	</tr>	
	<tr>
		<td colspan=3  class="shopContent">
			<? 
				echo CHtml::submitButton('Bestill', 
					array('
						id'=>'submit', 
						'name' =>'submit', 
						'disabled' => !$isShopOpen,
						'class' => 'shopButton',
				)); 
				if (!$isShopOpen)
					echo "<br>Du kan ikke bestille nå";
			?>
		</td>
	</tr>
</table>
<? echo CHtml::endForm(); ?>
