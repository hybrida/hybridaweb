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
	<h1>Albums</h1>

	<? foreach($albums as $album): ?>
		<?= CHtml::link($album['title'], $album['id']) ?>
		<ul>
		<? foreach($album['images'] as $image): ?>
			<li><?= $image['title'] ?></li>
		<? endforeach; ?>
		</ul>
	<? endforeach; ?>
</div>
