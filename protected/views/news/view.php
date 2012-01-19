<? $this->pageTitle = $model->title ?>

<?$this->breadcrumbs=array(
	'News',
);?>

<h1><?=$model->title?></h1>

<b>Skribent:</b> <?= CHtml::link($model->authorName, '/profile/view/'.$model->author)?>

		<? if ($model->imageId): ?>
<br><img src='php/image.php?id=<?=$model->imageId?>&size=2' />
<? endif; ?>

<p>
<?=$model->content?>
</p>


<? if (!user()->isGuest): ?>
<p><?= CHtml::link("Rediger",array("news/edit",'id' => $model->id)); ?></p>
<? endif; ?>