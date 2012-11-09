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
			<? $num = count($album->images); ?>
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
				<? for ($i = 0; $i < min($num, 3); $i++): ?>
				<div style="width: 33%; float: left;">
					<?= CHtml::link(Image::tag($album->images[$i]->id, "gallery_thumb"), "/gallery/".$album->id . "/" . $album->images[$i]->id); ?>
					</div>
				<? endfor; ?>



			</div>
			<br style="clear: both;">
	<? endforeach; ?>
</div>
