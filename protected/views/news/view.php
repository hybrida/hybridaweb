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
		<? if ($signup): ?>
		<?= CHtml::link("Hent epostadresser", array(
			"/news/email",
			"id" => $news->id), array(
				'class' => 'g-button',
			)) ?>
		<?= CHtml::link("Legg til manuelt", array(
			'news/manualSignup', 'id' => $signup->eventId,
		), array(
			'class' => 'g-button',
		)) ?>
		<?= CHtml::link("Endre registrerte påmeldinger", array(
			'news/editSignup', 'id' => $news->id,
		), array(
			'class' => 'g-button',
		)) ?>
		<? endif ?>
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

    <? if ($news->status == Status::DRAFT): ?>
        <h1><?= $news->title ?> <span style="color:red">[UTKAST!]</span> </h1>
    <? else: ?>
        <h1><?= $news->title ?></h1>
    <? endif ?>

	<? if ($news->imageId): ?>
		<div class="headerImage">
			<?= Image::tag($news->imageId, "frontpage") ?>
		</div>
	<? endif; ?>

	<div class="author">
		<? if ($news->author): ?>
			<?= Image::profileTag($news->author->imageId, "mini") ?>
			<div class="name">
				<strong>Skribent: </strong>
				<?= CHtml::link($news->author->fullName, $news->author->viewUrl) ?>
			</div>
		<? else: ?>
			<?= Html::image("/images/logo_mini.png", "Profilbilde") ?>
			<div class="name">
				<strong>Skribent: </strong>
				Hybrida
			</div>
		<? endif ?>
		<div class="date">
			<strong>Publisert: </strong>
			<?= Html::dateToString($news->timestamp, 'mediumlong') ?>
		</div>
	</div>

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
	$this->widget('comment.components.CommentWidget', array(
		'id' => $news->id,
		'type' => 'news',
	));
	?>
</div>
