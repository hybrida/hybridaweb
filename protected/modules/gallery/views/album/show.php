<?
$this->breadcrumbs = array(
	'Galleri' => array('/gallery'),
);
?>

<style>
    #galleria{ width: 700px; height: 600px; background: #000 }
</style>

<?
$album->getImages();
?>

<div id="galleria">
	<? foreach ($album->images as $image): ?>
		<?= CHtml::image($image->getViewUrl($image->id, 'gallery_big'), $image->title) ?>
	<? endforeach ?>
</div>

<script>
	Galleria.loadTheme('/scripts/galleria/themes/classic/galleria.classic.min.js');
	Galleria.run('#galleria');
	
	Galleria.on('image', function(e) {
		/**
		 * Denne funksjonen blir kalt hver gang bildet bytter. 
		 */
		console.log(e);
	});
</script>

