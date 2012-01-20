<? $this->pageTitle = $news->title ?>

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

<? if ($event): ?>
<h2>Event</h2>
	<div class='right'>
		<b>Starter: </b><i><?= $event->start ?></i>
	</div>

	<div class='right'>
		<b>Slutter: </b><i><?= $event->end ?></i>
	</div>


	<? if ($signup): ?>

<h2>Påmelding:</h2>
		<div class='clear'>
			<p>
				<strong>Påmeldte: </strong> <i><?=$signup->attendingCount?> av <?=$signup->spots?></i> <br/>
			</p>

			<p>
				<strong>Åpner: </strong><i><?= $signup->open ?></i> <br/>
			<p>
			</p>
				<strong>Stenger: </strong><i><?= $signup->close ?></i> <br/>
			</p>
		</div>
		
		<h2>Påmeldte</h2>
		<div class="signup" data-id='<?= $signup->eventId ?>'></div>
	<? endif // signup ?>


<? endif; // event?>
		
