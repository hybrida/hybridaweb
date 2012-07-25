<? $this->pageTitle = "Bedpres: ".$event->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<? 
$this->beginClip('sidebar'); ?>
	<? $this->renderPartial("_attenders", array(
		'event' => $event,
	))  ?>
<? $this->endClip() ?>

<h1>Bedpres: <?=$event->title?></h1>
<? if (user()->checkAccess('admin')): ?>
        <?= CHtml::link("Rediger",array("/news/edit",'id' => $news->id), array(
			'class' => 'g-button g-buttonRightSide')); ?>
        <?= CHtml::link("Koble til bedrift",array("edit",'id' => $event->id), array(
			'class' => 'g-button g-buttonRightSide')); ?>
<? endif; ?>

<? if ($news->imageId): ?>
	<?= Image::tag($news->imageId, 'frontpage') ?><br/>
<? else: ?>
	<img src='<?=$event->logo?>' alt=""/><br/>
<? endif ?>

<?=$event->description?>

<h1> Påmeldte: </h1>
<? if (!user()->isGuest): ?>
	<? if (user()->cardHash == ''): ?>
		<p>
			For å melde deg på må du først registrere kortnummeret ditt på
			<?= Html::link('profilredigeringssiden', array('/profile/edit', 'username' => user()->name)) ?> din.
			Deretter må du logge ut og inn.
		</p>
	<? endif ?>


	<?= Html::userListByYear($event->getAttendingByYear()) ?>
<h1>På venteliste:</h1>
	<?= Html::userListByYear($event->getWaitingByYear()) ?>

	<? if($event->canAttend(user()->id)): ?>
		<?=
		Html::link(
				$event->isAttending(user()->id) ? "Meld meg av" : "Meld meg på", array(
			'toggleAttending', 'bpcId' => $event->id),  array(
			'class' => 'g-button',
		))
		?>
	<? endif; ?>
<? else: ?>
		<p>
			Du må logge inn for å se listen over påmeldte
		</p>
<? endif ?>