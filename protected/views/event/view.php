<div class='left'>
	<h1><?= $title ?></h1>
</div>

<div class='container'>
	<img src='php/image.php?id=<?= $imageId ?>&size=2' />
</div>

<div class='right'>
	<b>Starter: </b><i><?= $start ?></i>
</div>

<div class='right'>
	<b>Slutter: </b><i><?= $end ?></i>
</div>

<div class='clear'>
	<?= $content ?>
</div>

<? if ($hasSignup): ?>

	<signup data-id='<?=$id?>'></signup>
	
<?	endif; ?>