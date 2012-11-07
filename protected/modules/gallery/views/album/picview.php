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
			<?= CHtml::link('Delete', '')?>
		</li>
	</ul>
</div>

<? $this->endClip(); ?>

<div class="albumPicview">
	<h1>Picture</h1>

	<?= $image['title'] ?>
</div>
