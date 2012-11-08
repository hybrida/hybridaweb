<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Galleri', '/gallery/') ?>
			<?= CHtml::link('Album', '/gallery/'.$album->id) ?>
		<br>
		<li>
			<?= CHtml::link('Slett', '')?>
		</li>
	</ul>
</div>

<? $this->endClip(); ?>

<div class="albumPicview">
	<h1>Picture</h1>

	<?= Image::tag($image->id, "gallery_big") ?>
</div>
