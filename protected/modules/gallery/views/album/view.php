<?
$this->breadcrumbs = array(
	'Galleri' => array('/galleri'),
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
			<?= CHtml::link('Legg til bilder', 'update/'.$album->id) ?>
		</li>
		<? if ($canDelete): ?>
			<li>
				<?= CHtml::link('Slett album', '#',
					array(
						'submit'=>array('delete','id'=>$album->id),
						'confirm'=>'Er du sikker på at du vil slette dette albumet?'))?>
			</li>
		<? endif; ?>
	</ul>
</div>

<? $this->endClip(); ?>
<? endif; ?>

<div class="albumView">
	<h1><?= $album->title ?></h1>
		<div class="container">
			<? $c = 0; ?>
			<? foreach($album->images as $image): ?>
				<? if ($c % 3 == 0 && $c > 0): ?>
				<? endif; ?>
				<div class="smallContainer">
					<?= CHtml::link(Image::tag($image->id, "gallery_thumb"), $album->id."/".$image->id) ?>
				</div>
				<? $c++; ?>
			<? endforeach; ?>
			</div>
		</tr>
	</table>
</div>
