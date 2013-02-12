<? $this->pageTitle = "Bedpres: ".$event->title ?>
<? $this->layout = "//layouts/doubleColumn" ?>
<?

function stotte() {	?>
	<br>
	<input type="checkbox" name="supportFieldtrip" value="1" />
	<strong>Støtt ekskursjonen</strong> <a href="#" id="supportFieldtripDialog">Hva er dette?</a>
	<br>
	<div id="forklaring" style="background-color: white; padding: 20px; border: 1px solid black; border-radius: 2px">

		Annethvert år reiser Hybrida på eksursjon. Hvis det er mindre enn 18
		mnd til neste eksursjon har du muligheten til å støtte
		eksursjonskassa. Dette gjør du ved å trykke på <strong>Støtt
		eksursjonen</strong>-knappen over påmeldingsknappen. Du vil da støtte
		hybrida med halvparten av inntektene Hybrida Bedriftskomité får for
		ditt oppmøte.

	</div>

	<style>
	.ui-icon-closethick {
		background-color: #185c9b;
		padding: 4px;
		border: 1px solid #888;
		border-radius: 2px;
		color: white;
		
	}
	</style>

	<script>
		var dialogLink = $("#supportFieldtripDialog");
		dialogLink.click(function(e){
			e.preventDefault();
			toggle();
		});
		var forklaring = $("#forklaring");
		forklaring.hide();
		function toggle() {
			forklaring.dialog();
		}
	</script>

<? }
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
	<form method="get" action="<?=$url?>" />
		<input type="hidden" name="supportFieldtrip" value="0" />
		<? if ($canAttend): ?>
			<? if ($canSupportFieldtrip): ?>
				<? stotte() ?>
			<? endif ?>
			<input type="submit" class='g-button' value="Meld meg på" />
		<? elseif ($canAttendWaitlist): ?>
			<? if ($canSupportFieldtrip): ?>
				<? stotte() ?>
			<? endif ?>
		    <input type="submit" class='g-button' value="Meld meg på venteliste" />
		<? elseif ($canUnAttend): ?>
			<input type="submit" class='g-button' value="Meld meg av" />
		<? endif ?>
	</form>
        
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