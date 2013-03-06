<?php
$this->pageTitle = $news->title;
$this->layout = "//layouts/doubleColumn";

$this->beginClip('sidebar');
?>

<?
$this->renderPartial('_signup_sidebar', array(
	'signup' => $signup,
	'event' => $event,
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

	<? if ($signup->isOpen() && $signup->hasFreeSpots()): ?>
		<? $this->renderPartial('edit_anonymous_membership', array(
			'model' => new SignupMembershipAnonymous
		)) ?>
	<? else: ?>
		<? $text = "" ?>
		<? if (!$signup->isOpen()) $text .= "Påmeldingen er ikke åpen <br/>\n"; ?>
		<? if (!$signup->hasFreeSpots()) $text .= "Ikke flere plasser igjen\n"; ?>
		<p class="g-errorText"><?= $text ?></p>
	<? endif ?>

	<? if ($alumniSignup !== null && $alumniSignup->isNewRecord === false): ?>
		<p class="g-successText">
			<?= $alumniSignup->fullName ?> er nå påmeldte dette arrangementet
		</p>
	<? endif ?>

	<h2>Påmeldte</h2>
	<div class="manualAttenders">
		<? foreach ($signup->getAnonymousAttenders() as $attender): ?>
			<ul class="attender">
				<li class="name"><?= $attender->fullName ?></li>
			</ul>
		<? endforeach ?>
	</div>
</div>