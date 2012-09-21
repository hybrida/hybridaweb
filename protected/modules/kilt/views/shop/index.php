<? 
   if (!function_exists("preprint")) { 
	   function preprint($s, $return=false) { 
		   $x = "<pre>"; 
		   $x .= print_r($s, 1); 
		   $x .= "</pre>"; 
		   if ($return) return $x; 
		   else print $x; 
	   } 
   }
   $this->renderPartial("_menu");
   echo CHtml::beginForm('', 'post');
   $scaleArray = array('height' => '130px', 'style' => 'max-width: 130px');
   if (!$isShopOpen) 
		 echo '<br><center><font class="shopError">Du kan ikke bestille enda</font></center>';
?>
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
			   if (isset($p['link']))
				   $name = CHtml::link($p['model'], 'http://www.sportkilt.com/product/' . $p['link'], array('class' => 'shopLink'));
				else
					$name = $p['model'];

				if (isset($p['image_id']))
				   $image = CHtml::image('https://secure.sportkilt.com/images/uploads/'.$p['image_id'], '', $scaleArray);
				else
				   $image = CHtml::image("https://secure.sportkilt.com/images/uploads/20090401113747.jpg", '', $scaleArray);

				if (isset($p['image_id']) && isset($p['link']))
					$image = CHtml::link($image, 'http://www.sportkilt.com/product/' . $p['link']);

				if ($cat == "Kilt" || $cat == "Sporran" || $p['model'] == "Flashes")
				   $chooser = CHtml::CheckBox('qnty['.$id.']', $pqnty > 0);
				else
				   $chooser = "Antall ". CHtml::TextField('qnty['.$id.']', $pqnty, array( 'size' => 2)); 

				echo "<b>".$name."</b>";
				echo "<br>";
				echo $image;
				echo "<br>"; 
				echo $chooser;

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
					echo "<font class=\"shopError\">";
					foreach($errors[$p['id']] as $e)
						echo "<br>" . $e;
					echo "</font>";
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
