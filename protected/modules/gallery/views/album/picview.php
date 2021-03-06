<?
$this->breadcrumbs = array(
	'Galleri' => array('/galleri'),
	$album->title => array('/galleri/'.$album->id),
);
?>

<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Full oppløsning', 
							Image::getRelativeFilePath($image->id, "original"), 
							array(
								'target' => '_blank', 
								'id' => 'fullLink'
								)
							) ?>
		</li>
		<li>

			<? if ($canDelete): ?>
				<?= CHtml::link('Slett bilde', '#', array( 'id' => 'delLink'))?>
			<? else: ?>
				<?= CHtml::link('Slett bilde', '#', array( 'id' => 'delLink',
					'style' => 'display: none;'))?>
			<? endif; ?>

		</li>
	</ul>
</div>
<? $this->endClip(); ?>

<div class="albumPicview">
	<h1><?= $album->title ?></h1>

	<div class="container">
		<div class="smallContainer">

		<? if ($prevID >= 0): ?>
				<?= CHtml::link('< forrige', 
								'/galleri/'.$album->id.'/'.$album->images[$prevID]->id, 
								array( 'id' => 'prev')
								) ?>
				<div id="noPrev" style="display: none;">første</div>
		<? else: ?>
			<?= CHtml::link('< forrige', 
							'', 
							array(
								'id' => 'prev', 
								'style' => 'display: none;'
								)
							) ?>
			<div id="noPrev">første</div>
		<? endif; ?>

		</div>
		<div class="smallContainer" id="counter">
			Bilde <?= $index+1 ?> av <?= $num ?>
		</div>
		<div class="smallContainer" id="nextDiv">

		<? if ($nextID >= 0): ?>
			<?= CHtml::link('neste >', 
							'/galleri/'.$album->id.'/'.$album->images[$nextID]->id, 
							 array('id' => 'next')
							 ) ?>
			<div id="noNext" style="display:none;">siste</div>
		<? else: ?>
			<?= CHtml::link('neste >', 
							'', 
							array(
								'id' => 'next', 
								'style' => 'display: none;'
								)
							) ?>
			<div id="noNext">siste</div>
		<? endif; ?>
		</div>
	</div>

		<?= Image::tag($image->id, "gallery_big", array('id' => 'image')) ?>

	<div id="userName">
		<?= $user; ?>
	</div>
	<div  id="timestamp">
		<?= $image->timestamp ?>
	</div>
	<div style="width: 100%; clear: both; margin-top: 60px;"></div>
	<div id="comments">
		<?
		$this->widget('comment.components.CommentWidget', array(
			'id' => $image->id,
			'type' => 'gallery',
		));
		?>
	</div>
</div>
