<? $this->pageTitle = $news->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<? 
$this->beginWidget('CClipWidget', array('id' => 'sidebar')); ?>

<? if ($hasEvent): ?>
	<div class="barTitle">Event</div>
	<div class="barText">
		<b>Sted: </b><?= $event->location ?> <br>
		<b>Starter: </b><i><?= Html::dateToString($event->start, 'long') ?></i><br />
		<b>Slutter: </b><i><?= Html::dateToString($event->end, 'long') ?></i>
	</div>

	<? if ($hasSignup): ?>
	<div class="barTitle">Påmelding:</div>
	<div class="barText">
		<strong>Påmeldte: </strong> <i><?= $signup->attendingCount ?> av <?= $signup->spots ?></i> <br/>
		<strong>Åpner: </strong><i><?= Html::dateToString($signup->open, 'long') ?></i> <br>
		<strong>Stenger: </strong><i><?= Html::dateToString($signup->close, 'long') ?></i> <br>
	</div>
		
	<div class="barTitle">Påmeldte</div>
	<div class="barText">
		<? $this->renderPartial("_signup", array(
			'signup' => $signup,
			'isAttending' => $isAttending,
		)) ?>
	</div>
	<? endif // signup ?>


<? endif; // event?>

<?
$this->widget('application.components.widgets.ActivitiesCalendar');
$this->widget('application.components.widgets.ActivitiesFeed');
$this->endWidget()
?>

<?$this->breadcrumbs=array(
	'News',
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
<strong>Skribent:</strong> <?= CHtml::link($news->author->fullName, array(
	'/profile/view/',
	'username' => $news->author->username,
	))?>
<? endif ?>

<? if ($news->imageId):
	$imageURL = $this->createUrl('/image/view',array(
		'id' => $news->imageId,
		'size' => 1, //FIXME
	));
	?>
<br/><img src='<?=$imageURL?>' />
<? endif; ?>

<p><strong><?=$news->ingress?></strong></p>

<p>
	<?=$news->content?>
</p>

<?$this->widget('comment.components.commentWidget', array(
	'id' => $news->id,
	'type' => 'news',
)); ?>