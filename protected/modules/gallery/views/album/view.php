<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Create', '') ?>
			<?= CHtml::link('Manage', '') ?>
			<?= CHtml::link('Update', '') ?>
			<?= CHtml::link('List', '') ?>
			<?= CHtml::link('Delete', '#', 
				array(
					'submit'=>array('delete','id'=>$album->id),
					'confirm'=>'Are you sure you want to delete this item?'))?>
		</li>
	</ul>
</div>

<? $this->endClip(); ?>

<div class="albumView">
	<h1>Album</h1>

	<?= $album->title ?>
	<ul>
	<? foreach($album->images as $image): ?>
		<li><?= CHtml::link($image->title, $album->id."/".$image->id) ?></li>
	<? endforeach; ?>
	</ul>
</div>
