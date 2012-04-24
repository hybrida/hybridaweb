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

<h1><?=$news->title?></h1>

<? if ($hasEditAccess): ?>
<p>
	<?= CHtml::link("Rediger",array("news/edit",'id' => $news->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
</p>
<? endif ?>

<? if ($news->author): ?>
<strong>Skribent:&nbsp;</strong> <?= CHtml::link($news->author->fullName, array(
	'/profile/view/',
	'username' => $news->author->username,
	))?>
<? endif ?>

<? if ($news->imageId):
	$imageURL = $this->createUrl('/image/view',array(
		'id' => $news->imageId,
		'size' => 'frontpage', //FIXME
	));
	?>
<br/><img src='<?=$imageURL?>' />
<? endif; ?>

<p><strong><?=$news->ingress?></strong></p>

<?=$news->content?>


<? if ($signup): ?>
	<h1> Påmeldte: </h1>
	<? $attenders = $signup->attendersFiveYearArrays ?>
	<? $i = 1; ?>
	<? foreach($attenders as $year): ?>
		<? if (!empty($year)):  ?>
			<ul class="collapsibleList">
			<li><h3> <?= $i ?>. årskurs </h3>
			<ul>
			<? foreach ($year as $user): ?>
				<li>
				<?= Image::profileTag($user->imageId, 'small') ?>
				<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
				</li>
			<? endforeach ?>
			</ul>
			</li>
			</ul>
		<? endif ?>
		<? $i++ ?>
	<? endforeach ?>
<? endif ?>
	
<? if ($signup->canAttend(user()->id)): ?>
	<?=
	Html::link(
			$isAttending ? "Meld meg av" : "Meld meg på", array(
		'toggleAttending', 'eventId' => $event->id),  array(
		'class' => 'button',
	))
	?><p></p>
<? endif; ?>

<?$this->widget('comment.components.commentWidget', array(
	'id' => $news->id,
	'type' => 'news',
)); ?>