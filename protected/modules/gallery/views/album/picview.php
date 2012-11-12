<?
$this->breadcrumbs = array(
	'Galleri' => array('/gallery'),
	$album->title => array('/gallery/'.$album->id),
);
?>

<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<script>
$(document).ready(function(){
	window.imageID = <?= $image->id ?>;
	window.albumID = <?= $album->id ?>;
	window.nextID = <?= $nextID >= 0 ? $album->images[$nextID]->id : "false" ?>;
	window.prevID = <?= $prevID >= 0 ? $album->images[$prevID]->id : "false" ?>;
});
</script>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Full oppløsning', Image::getRelativeFilePath($image->id, "original"), array('target' => '_blank', 'id' => 'fullLink')) ?>

			<? if (Yii::app()->user->id == $image->userId): ?>
				<?= CHtml::link('Slett bilde', '#', array( 'id' => 'delLink'))?>
			<? else: ?>
				<?= CHtml::link('Slett bilde', '#', array( 'id' => 'delLink',
					'style' => 'display: none;'))?>
			<? endif; ?>
		</li>
	</ul>
</div>


<? $this->endClip(); ?>
<p id="data"></p>
<div class="albumPicview">
	<h1><?= $album->title ?></h1>

	<div style="width: 100%">
		<div style="width: 33%; float: left;">
		<? if ($prevID >= 0): ?>
			<?= CHtml::link('< forrige', '/gallery/'.$album->id.'/'.$album->images[$prevID]->id, array('id' => 'prev')) ?>
			<div id="noPrev" style="display: none;">første</div>
		<? else: ?>
			<?= CHtml::link('< forrige', '', array('id' => 'prev', 'style' => 'display: none;')) ?>
			<div id="noPrev">første</div>
		<? endif; ?>
		</div>
		<div style="width: 33%; float: left; text-align: center;" id="counter">
			Bilde <?= $index+1 ?> av <?= $num ?>
		</div>
		<div style="width: 33%; float: left; text-align: right;">
		<? if ($nextID >= 0): ?>
			<?= CHtml::link('neste >', '/gallery/'.$album->id.'/'.$album->images[$nextID]->id, array('id' => 'next')) ?>
			<div id="noNext" style="display:none;">siste</div>
		<? else: ?>
			<?= CHtml::link('neste >', '', array('id' => 'next', 'style' => 'display: none;')) ?>
			<div id="noNext">siste</div>
		<? endif; ?>
		</div>
	</div>

	<?= Image::tag($image->id, "gallery_big", array('id' => 'image')) ?>

		<div style="float: left;" id="userName">
			<?= $user; ?>
		</div>
		<div style="float: right; text-align: right;" id="timestamp">
			<?= $image->timestamp ?>
		</div>
		<div style="padding-bottom: 200px;"></div>
</div>
