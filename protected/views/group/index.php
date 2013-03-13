<h1>Komiteer og grupper</h1>

<ul>
<? foreach ($groups as $group): ?>
	<li><?= CHtml::link($group->title, $group->viewUrl) ?></li>
<? endforeach ?>
</ul>
