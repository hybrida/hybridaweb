<? $this->renderPartial("_menu"); ?>

<? if (!$isShopOpen): ?>
   <br>
   <center>
	  <font class="shopError">Du kan ikke bestille enda</font>
   </center>
<? endif; ?>

<?= CHtml::beginForm('', 'post'); ?>
<table class="shopTable">
<?foreach($catProducts as $cat => $products):?>
   <? $counter = 0; ?>
   <tr>
	  <td colspan=4  class="shopTitle">
		 <?= $cat; ?>
	  </td>
   </tr>
   <tr>
   <?  foreach($products as $p): ?>
	  <? if ($counter % 4 == 0 && $counter != 0): ?>
		 </tr><tr>
	  <? endif; ?>
	  <? $counter++;
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
			$urlPrefix = "http://www.sportkilt.com/product/";
			$name = CHtml::link($p['model'], $urlPrefix . $p['link'], array('class' => 'shopLink'));
			$image = CHtml::image($imagePrefix . $p['image_id'], '', array('height' => '130px', 'style' => 'max-width: 130px'));
			$imageLink = CHtml::link($image, $urlPrefix . $p['link']);
			$chooser = CHtml::CheckBox('qnty['.$id.']', $pqnty > 0);
		 ?>

		 <b> <?= $name ?> </b>
		 <br>
		 <?= $imageLink; ?>
		 <br>
		 <?= $chooser; ?>

		 <? if (sizeof($p['sizes']) > 0):
			$sizeNames = array();
			$sizeNames[-1] = "Velg str.";
			foreach($p['sizes'] as $e)
			   $sizeNames[$e] = $sizes[$e];
			?>
			<br>
			<?= CHtml::dropDownList('size['.$id.']', $psize, $sizeNames); ?>
		 <? endif; ?>

		 <? if (isset($errors[$p['id']])): ?>
			<font class="shopError">
			<? foreach($errors[$p['id']] as $e): ?>
			   <br>
			   <?= $e ?>
			<? endforeach; ?>
			</font>
		 <? endif; ?>
	  </td>
   <? endforeach ?>
   </tr>
<? endforeach ?>
   <tr>
	  <td colspan=4  class="shopTitle">
		 Annet
	  </td>
   </tr>
   <tr>
	  <td colspan=4  class="shopTitle">
		 <?= CHtml::textArea('comment', $comment); ?>
	  </td>
   </tr>
   <tr>
	  <td colspan=4  class="shopContent">
		 <?= CHtml::submitButton('Bestill', array(' id'=>'submit', 'name' =>'submit', 'disabled' => !$isShopOpen, 'class' => 'shopButton',)); ?>
		 <? if (!$isShopOpen): ?>
			<br> Du kan ikke bestille nå
		 <? endif; ?>
	  </td>
   </tr>
</table>
<?= CHtml::endForm(); ?>
