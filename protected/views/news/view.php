<?$this->breadcrumbs=array(
	'News',
);?>

<h1><?=$title?></h1>

<b>Skribent:</b> <?=$firstName." ".$middleName." ".$lastName?>

		<? if ($imageId): ?>
<br><img src='php/image.php?id=<?=$imageId?>&size=2' />
<? endif; ?>

<p>
<?=$content?>
</p>


<? if (!user()->isGuest): ?>
<p><?= CHtml::link("Rediger",array("news/edit",'id' => $id)); ?></p>
<? endif; ?>