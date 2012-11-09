<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Opprett album', '/gallery/create') ?>
		</li>
	</ul>
</div>

<? $this->endClip(); ?>

<div class="albumIndex">
	<h1>Galleri</h1>

	<? foreach($albums as $album): ?>
			<h2>
				<?= CHtml::link($album->title, "/gallery/" . $album->id) ?>
			</h2>
			<? if(count($album->images) == 0): ?>
				<div style="width: 100%;">
					Tomt, <?= CHtml::link('legg til bilder', '/gallery/update/'.$album->id) ?> 
				</div>
				<? continue; ?>
			<? endif; ?>
			<div style="width: 100%;">
				<div style="width: 33%; float: left;">
					<? if (count($album->images) > 1): ?>
						<?= CHtml::link(Image::tag($album->images[1]->id, "gallery_thumb"), "/gallery/".$album->id . "/" . $album->images[1]->id); ?>
					<? endif; ?>
				</div>
				<div style="width: 33%; float: left;">
					<? if (count($album->images) > 0): ?>
						<?= CHtml::link(Image::tag($album->images[0]->id, "gallery_thumb"), "/gallery/".$album->id . "/" . $album->images[0]->id); ?>
					<? endif; ?>
				</div>
				<div style="width: 33%; float: left;">
					<? if (count($album->images) > 2): ?>
						<?= CHtml::link(Image::tag($album->images[2]->id, "gallery_thumb"), "/gallery/".$album->id . "/" . $album->images[2]->id); ?>
					<? endif; ?>
				</div>
			</div>
			<br style="clear: both;">
	<? endforeach; ?>
</div>
