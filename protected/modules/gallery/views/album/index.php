<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Opprett album', 'create') ?>
		</li>
	</ul>
</div>

<? $this->endClip(); ?>

<div class="albumIndex">
	<h1>Galleri</h1>

	<? foreach($albums as $album): ?>
			<h2>
				<?= CHtml::link($album->title, $album->id) ?>
			</h2>
			<div style="width: 100%;">
				<div style="width: 33%; float: left;">
					<? if (count($album->images) > 1): ?>
						<?= CHtml::link(Image::tag($album->images[1]->id, "gallery_thumb"), $album->id . "/" . $album->images[1]->id); ?>
					<? endif; ?>
				</div>
				<div style="width: 33%; float: left;">
					<? if (count($album->images) > 0): ?>
						<?= CHtml::link(Image::tag($album->images[0]->id, "gallery_thumb"), $album->id . "/" . $album->images[0]->id); ?>
					<? endif; ?>
				</div>
				<div style="width: 33%; float: left;">
					<? if (count($album->images) > 2): ?>
						<?= CHtml::link(Image::tag($album->images[2]->id, "gallery_thumb"), $album->id . "/" . $album->images[2]->id); ?>
					<? endif; ?>
				</div>
			</div>
	<? endforeach; ?>
</div>
