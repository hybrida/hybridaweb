<style>
	.left {
		float: left;
		width: 40%;
	}

	.right {
		float: right;
		width: 40%;
	}
</style>

<h1>RbacTree: <?= $parent ?></h1>



<div class="right">
	<ul>
		<? foreach ($tree as $child): ?>
			<li><?= $child ?></li>
		<? endforeach ?>
	</ul>
</div>


<div class="left">
	<ul>
		<?php foreach ($all as $parent => $dummy): ?>
			<li><?= CHtml::link($parent, array("/dev/rbactree", 'parent' => $parent)) ?></li>
		<?php endforeach ?>
	</ul>
</div>