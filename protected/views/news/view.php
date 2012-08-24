<?php 
$this->pageTitle = $news->title ;
$this->layout = "//layouts/doubleColumn" ;
 
$this->beginClip('sidebar'); 
	$this->renderPartial('_view_sidebar', array(
		'signup' => $signup,
		'event' => $event,
		'isAttending' => $isAttending,
	));
	?>
	<?
	$this->widget('application.components.widgets.ActivitiesFeed');
$this->endClip()
?>
<? if ($event): ?>
	<? $this->beginClip('head-tag') ?>
prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# lfhybrida: http://ogp.me/ns/fb/lfhybrida#"
	<? $this->endClip() ?>

	<? $this->beginClip('head-facebook') ?>
		<meta property="fb:app_id"      content="202808609747231" />
		<meta property="og:type"        content="lfhybrida:event" />
		<meta property="og:url"         content="<?= Yii::app()->createAbsoluteUrl("/") . $news->viewUrl ?>" />
		<meta property="og:title"       content="<?= $news->title ?>" />
		<meta property="og:image"       content="<?= Yii::app()->createAbsoluteUrl("/") ?>/images/mastHeadLogo.png" />
	<? $this->endClip() ?>
<? endif; ?>
<?$this->breadcrumbs=array(
	$news->title => $news->viewUrl,
);?>

<div class="newsIndex">

<h1><?=$news->title?></h1>

<? if ($hasEditAccess): ?>
	<p>
		<?= CHtml::link("Rediger",array("news/edit",'id' => $news->id), array(
			'class' => 'g-button g-buttonRightSide'
		)); ?>
	</p>
<? endif ?>

<? if ($news->author): ?>
<strong>Skribent:</strong> <?= CHtml::link($news->author->fullName, array(
	'/profile/view/',
	'username' => $news->author->username,
	))?>
<? endif ?>

<? if ($news->imageId): ?>
<div class="headerImage">
	<br/><?= Image::tag($news->imageId, "frontpage") ?>
</div>
<? endif; ?>

<p><strong><?=$news->ingress?></strong></p>

<?=$news->content?>


<? if ($signup): ?>
	<h1> Påmeldte: </h1>
	<?= Html::userListByYear($signup->attendersFiveYearArrays) ?>
	
	
	<? $url = $this->createUrl('toggleAttending', array('eventId' => $event->id)) ?>
	<? if (!$isAttending && $signup->canAttend(user()->id)): ?>
		<a href="<?=$url?>" class='g-button'>Meld meg på</a>
		<p></p>
	<? elseif ($isAttending && $signup->canUnattend()): ?>
		<a href="<?=$url?>" class='g-button'>Meld meg av</a>
		<p></p>	
	<? endif ?>
<? endif ?>

<?$this->widget('comment.components.commentWidget', array(
	'id' => $news->id,
	'type' => 'news',
)); ?>
</div>