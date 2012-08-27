<? $this->pageTitle = "Bedpres: ".$event->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<? 
$this->beginClip('sidebar'); ?>
	<? $this->renderPartial("_attenders", array(
		'event' => $event,
	))  ?>
<? $this->endClip() ?>


<div class="bedpresView">

<h1>Bedpres: <?=$event->title?></h1>
<? if (user()->checkAccess('admin')): ?>
        <?= CHtml::link("Rediger",array("/news/edit",'id' => $news->id), array(
			'class' => 'g-button g-buttonRightSide')); ?>
        <?= CHtml::link("Koble til bedrift",array("edit",'id' => $event->id), array(
			'class' => 'g-button g-buttonRightSide')); ?>
<? endif; ?>

<div class="headerImage">
	<? if ($news->imageId): ?>
		<?= Image::tag($news->imageId, 'frontpage') ?><br/>
	<? else: ?>
		<img src='<?=$event->logo?>' alt=""/><br/>
	<? endif ?>
</div>

<article>
	<?=$event->description?>
</article>

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

	<? $url = $this->createUrl('toggleAttending', array('bpcId' => $event->id)) ?>
	<? if (!$isAttending && $event->canAttend(user()->id)): ?>
		<a href="<?=$url?>" class='g-button'>Meld meg på</a>
	<? elseif ($isAttending && $event->canUnattend()): ?>
		<a href="<?=$url?>" class='g-button'>Meld meg av</a>
	<? endif ?>

<? else: ?>
		<p>
			Du må logge inn for å se listen over påmeldte
		</p>
<? endif ?>

</div>