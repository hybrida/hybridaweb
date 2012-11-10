<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); 
?>

<div class="g-barTitle">Handlinger</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Legg til bilder', 'update/'.$album->id) ?>
		</li>
		<? if (Yii::app()->user->id == $album->user_id): ?>
			<li>
				<?= CHtml::link('Slett album', '#', 
					array(
						'submit'=>array('delete','id'=>$album->id),
						'confirm'=>'Er du sikker på at du vil slette dette albumet?'))?>
			</li>
		<? endif; ?>
	</ul>
</div>

<div class="g-barTitle">Navigasjon</div>
<div class="g-sidebarNav">
	<ul>
		<li>
			<?= CHtml::link('Til galleri', '/gallery/') ?>
		</li>
	</ul>
</div>
<? $this->endClip(); ?>

<div class="albumView">
	<h1><?= $album->title ?></h1>
		<div style="width: 100%; height: 229px;">
			<? $c = 0; ?>
			<? foreach($album->images as $image): ?>
				<? if ($c % 3 == 0 && $c > 0): ?>
				<? endif; ?>
				<div style="width: 33%; float: left;">
					<?= CHtml::link(Image::tag($image->id, "gallery_thumb"), $album->id."/".$image->id) ?>
				</div>
				<? $c++; ?>
			<? endforeach; ?>
			</div>
		</tr>
	</table>
</div>
