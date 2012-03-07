<?php
$this->pageTitle = $article->title;
$this->layout = "//layouts/doubleColumn"; ?>

<? $this->breadcrumbs=array(
	'Article',
) ?>



<?
$this->beginClip('sidebar'); 
	$this->renderPartial('_view_sidebar', array(
		'article' => $article,
	));
$this->endClip()
 
?>

<? if ($hasEditAccess): ?>
	<p>
	<?= CHtml::link("Publiser barn", array("article/create", 'parentId' => $article->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
	</p>
		
	<p>
	<?= CHtml::link("Rediger",array("article/edit",'id' => $article->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
	</p>
<? endif ?>
	
<h1><?= $article->title ?> </h1>

<p><?= $article->content ?></p>
