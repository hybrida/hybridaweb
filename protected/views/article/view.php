<?php
$this->pageTitle = $article->title;
$this->layout = "//layouts/doubleColumn"; ?>

<? $this->breadcrumbs=$article->getCrumbsList() ?>
<? $this->breadcrumbOptions = array(
	'firstCrumb' => false,
) ?>



<?$this->beginClip('sidebar'); ?>
	<? if ($hasEditAccess): ?>
	<fieldset class="g-adminSet">
		<legend>Admin</legend>
		<?= CHtml::link("Lag underside", array("article/create", 'parentId' => $article->id), array(
			'class' => 'g-button'
		)); ?>
		<?= CHtml::link("Rediger siden",array("article/edit",'id' => $article->id), array(
			'class' => 'g-button'
		)); ?>
	</fieldset>
	<? endif ?>
	<? $this->renderPartial('_view_sidebar', array(
		'article' => $article,
	));
$this->endClip()
 
?>
<div class="articleIndex">
	<div id="article">
		<div id="article-title">
			<h1><?= $article->title ?></h1>
		</div>
		<div id="article-content">
            <? ArticleTemplateRenderer::render($article) ?>
		</div>
	</div>
</div>
