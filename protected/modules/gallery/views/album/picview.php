<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 

$index = array_search($image, $album->images);
$num = count($album->images);
?>
<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Full oppløsning', Image::getRelativeFilePath($image->id, "original"), array('target' => '_blank')) ?>

			<? if (Yii::app()->user->id == $image->userId): ?>
				<?= CHtml::link('Slett bilde', '#', 
					array(
						'submit'=>array('picdelete','id'=>$album->id, 'pid' => $image->id),
						'confirm'=>'Er du sikker på at du vil slette dette bildet?'))?>
			<? endif; ?>
		</li>
	</ul>
</div>

<div class="g-barTitle">Navigasjon</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Til galleri', '/gallery/') ?>
			<?= CHtml::link('Til album', '/gallery/'.$album->id) ?>
		</li>
	</ul>
</div>
<? $this->endClip(); ?>

<div class="albumPicview">
	<h1><?= $album->title ?></h1>

	<div style="width: 100%">
		<div style="width: 33%; float: left;">
		<? if ($index > 0): ?>
			<?= CHtml::link('< forrige', '/gallery/'.$album->id.'/'.$album->images[$index-1]->id, array('id' => 'prev')) ?>
		<? else: ?>
			første
		<? endif; ?>
		</div>
		<div style="width: 33%; float: left; text-align: center;">
			Bilde <?= $index+1 ?> av <?= $num ?>
		</div>
		<div style="width: 33%; float: left; text-align: right;">
		<? if ($index < $num - 1): ?>
			<?= CHtml::link('neste >', '/gallery/'.$album->id.'/'.$album->images[$index+1]->id, array('id' => 'next')) ?>
		<? else: ?>
			siste
		<? endif; ?>
		</div>
	</div>

	<?= Image::tag($image->id, "gallery_big") ?>

		<div style="float: left;">
			<?= $user; ?>
		</div>
		<div style="float: right; text-align: right;">
			<?= $image->timestamp ?>
		</div>
</div>
