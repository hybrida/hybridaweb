<?php function printList($node) {?>

	<li>
		<? if ($node->hasBizRule()): ?>
			<div class="g-infoBox">
				<span style="color: red"><?= $node->name ?></span>
				<div class="g-infoBoxContent" style="width: 600px">
					<?
					$source =  highlight_string("<?php " . $node->bizRule . " ?>", true);
					$pattern = "/&nbsp;/";
					$out = preg_replace($pattern, " ", $source);
					?>
					<?= $out ?>
				</div>
			</div>
		<? else:  ?>
			<span><?= $node->name ?></span>
		<? endif ?>

		<? if (count($node->children) > 0): ?>
			<?php foreach ($node->children as $child): ?>
				<ul>
					<? printList($child)  ?>
				</ul>
			<?php endforeach ?>
		<? endif ?>
	</li>

<? }  ?>


<h1>RbacTree: <?= $parent ?></h1>



<div class="right">
	<ul>
		<? printList($tree) ?>
	</ul>
</div>


<div class="left">
	<ul>
		<?php foreach ($all as $parent => $dummy): ?>
			<li><?= CHtml::link($parent, array("/dev/rbactree", 'parent' => $parent)) ?></li>
		<?php endforeach ?>
	</ul>
</div>