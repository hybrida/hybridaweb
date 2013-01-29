<? $this->pageTitle = "Bedpres: ".$event->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<? 
$this->beginClip('sidebar'); ?>

<? if (user()->checkAccess('updateBedpres')): ?>
	<fieldset class="g-adminSet">
		<legend>Admin</legend>
		<?= CHtml::link("Rediger",array("/news/edit",'id' => $news->id), array(
			'class' => 'g-button')); ?>
        <?= CHtml::link("Koble til bedrift",array("edit",'id' => $event->id), array(
			'class' => 'g-button')); ?>
	</fieldset>
<? endif; ?>

	<? $this->renderPartial("_attenders", array(
		'event' => $event,
	))  ?>
<? $this->endClip() ?>


<div class="bedpresView">

<h1>Bedpres: <?=$event->title?></h1>

<div class="headerImage">
	<a href="<?=$event->web_page?>">
		<? if ($news->imageId): ?>
			<?= Image::tag($news->imageId, 'frontpage') ?><br/>
		<? else: ?>
			<img src='<?=$event->logo?>' alt=""/><br/>
		<? endif ?>
	</a>
</div>

<article>
	<?=$event->description?>
</article>

	<? $url = $this->createUrl('toggleAttending', array('bpcId' => $event->id)) ?>
	<? if ($canAttend): ?>
		<a href="<?=$url?>" class='g-button'>Meld meg på</a>
    <? elseif ($canAttendWaitlist): ?>
        <a href="<?=$url?>" class='g-button'>Meld meg på venteliste</a>
	<? elseif ($canUnAttend): ?>
		<a href="<?=$url?>" class='g-button'>Meld meg av</a>
	<? endif ?>
        
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

<p></p>
<? else: ?>
		<p>
			Du må logge inn for å se listen over påmeldte
		</p>
<? endif ?>
		
		
	<? $this->widget('comment.components.CommentWidget', array(
		'type' => 'bedpres',
		'id'=> $event->id,
	)) ?>

</div>