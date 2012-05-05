<?php
$this->pageTitle = $article->title;
$this->layout = "//layouts/doubleColumn"; ?>

<? $this->breadcrumbs=$article->getCrumbsList() ?>
<? $this->breadcrumbOptions = array(
	'firstCrumb' => false,
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
	<?= CHtml::link("Lag underside", array("article/create", 'parentId' => $article->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
	</p>
		
	<p>
	<?= CHtml::link("Rediger siden",array("article/edit",'id' => $article->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
	</p>
<? endif ?>
<div id="article">	
	<div id="article-title">
		<h1><?= $article->title ?> </h1>
	</div>
	<div id="article-content">
		<?= $article->content ?>
	</div>
</div>