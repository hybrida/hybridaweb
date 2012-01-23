<? $this->pageTitle = $news->title ?>
<? $this->layout = "//layouts/column2" ?>
<? 
$this->beginWidget('CClipWidget', array('id' => 'sidebar')); ?>

<? if ($event): ?>
	<div class="barTitle">Event</div>
	<div class="barText">
		<b>Starter: </b><i><?= $event->start ?></i><br />
		<b>Slutter: </b><i><?= $event->end ?></i>
	</div>

	<? if ($signup): ?>
	<div class="barTitle">Påmelding:</div>
	<div class="barText">
		<strong>Påmeldte: </strong> <i><?= $signup->attendingCount ?> av <?= $signup->spots ?></i> <br/>
		<strong>Åpner: </strong><i><?= $signup->open ?></i> <br>
		<strong>Stenger: </strong><i><?= $signup->close ?></i> <br>
	</div>
		
	<div class="barTitle">Påmeldte</div>
	<div class="barText">
		<div class="signup" data-id='<?= $signup->eventId ?>'></div>
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

<? if (!user()->isGuest): ?>
<p>
	<?= CHtml::link("Rediger",array("news/edit",'id' => $news->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
</p>
<? endif ?>

<strong>Skribent:</strong> <?= CHtml::link($news->author->fullName, array(
	'/profile/view/',
	'username' => $news->author->username,
	))?>

<? if ($news->imageId):
	$imageURL = $this->createUrl('/image/view',array(
		'id' => $news->imageId,
		'size' => 1, //FIXME
	));
	?>
<br/><img src='<?=$imageURL?>' />
<? endif; ?>

<p>
	<?=$news->content?>
</p>