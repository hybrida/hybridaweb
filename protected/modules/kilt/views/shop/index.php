<?foreach($categories as $c):?>
	<h2><? echo $c; ?></h2>
	<hr><br>
	<?foreach($products[$c] as $p):?>
		<? echo $p['model'] ?>
		<br>
	<? endforeach ?> 
<? endforeach ?>	
