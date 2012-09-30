<?php
$this->pageTitle = $news->title;
$this->layout = "//layouts/doubleColumn";

$this->beginClip('sidebar');
?>
<? if ($hasEditAccess): ?>
	<fieldset class="g-adminSet">
		<legend>Admin</legend>
		<?=
		CHtml::link("Rediger", array("news/edit", 'id' => $news->id), array(
			'class' => 'g-button'
		));
		?>
	</fieldset>
<? endif ?>

<?
$this->renderPartial('_signup_sidebar', array(
	'signup' => $signup,
	'event' => $event,
	'isAttending' => $isAttending,
));

$this->widget('application.components.widgets.ActivitiesFeed');
$this->endClip();

if ($event): ?>
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


<?
$this->breadcrumbs = array(
	$news->title => $news->viewUrl,
);
?>

<div class="newsView">

	<h1><?= $news->title ?></h1>

	<? if ($news->author): ?>
		<div class="author">
			<?= Image::profileTag($news->author->imageId, "mini") ?>
			<div class="name">
				<strong>Skribent: </strong>
				<?= CHtml::link($news->author->fullName, $news->author->viewUrl) ?>
			</div>
			<div class="date">
				<strong>Publisert: </strong>
				<?= Html::dateToString($news->timestamp, 'mediumlong') ?>
			</div>
		</div>
	<? endif ?>

	<? if ($news->imageId): ?>
		<div class="headerImage">
			<?= Image::tag($news->imageId, "frontpage") ?>
		</div>
	<? endif; ?>

	<article>
		<div class="ingress">
			<?= $news->ingress ?>
		</div>

		<div class="content">
			<?= $news->content ?>
		</div>
	</article>

	<? if ($signup): ?>
		<?
		$this->renderPartial('_signup', array(
			'signup' => $signup,
			'isAttending' => $isAttending,
		))
		?>
	<? endif ?>

	<?
	$this->widget('comment.components.commentWidget', array(
		'id' => $news->id,
		'type' => 'news',
	));
	?>
</div>
