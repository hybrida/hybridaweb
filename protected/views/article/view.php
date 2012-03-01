<? $this->pageTitle = $article->title ?>

<?php $this->renderPartial("menu"); ?>

<?$this->breadcrumbs=array(
	'Article feed' => array("/article/feed"),
	'Article',
);?>

<h1><?= $article->title ?> </h1>

<p><?= $article->content ?></p>

<? if ($hasEditAccess): ?>
	<p>
	<?= CHtml::link("Rediger",array("article/edit",'id' => $article->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
	</p>
<? endif ?>

<? if ($article->author): ?>
	<strong>Skribent:</strong>
	<?= CHtml::link($article->AuthorName, array($article->AuthorUrl)) ?>
<? endif ?>