<?
$this->breadcrumbs = array(
	'Galleri' => ''
);
?>

<? if ($isLoggedIn): ?>
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
<? endif; ?>

<div class="albumIndex">
	<h1>Galleri</h1>

	<? if (count($albums) == 0): ?>
		Tomt, <?= CHtml::link('lag et album', '/gallery/create/') ?> 
	<? endif; ?>
	<? foreach($albums as $album): ?>
			<? $num = count($album->images); ?>
			<h2>
				<?= CHtml::link($album->title, "/gallery/" . $album->id) ?>
			</h2>
			<? if(count($album->images) == 0): ?>
				<div class="container">
					Tomt, <?= CHtml::link('legg til bilder', '/gallery/update/'.$album->id) ?> 
				</div>
				<? continue; ?>
			<? endif; ?>
				<div class="container">
				<? for ($i = 0; $i < min($num, 3); $i++): ?>
				<div class="smallContainer">
					<?= CHtml::link(Image::tag($album->images[$i]->id, "gallery_thumb"), "/gallery/".$album->id . "/" . $album->images[$i]->id); ?>
					</div>
				<? endfor; ?>



			</div>
			<br id="clearer">
	<? endforeach; ?>
</div>
