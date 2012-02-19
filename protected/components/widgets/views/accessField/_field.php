<div class="accessSub">
	<br clear="all">
	<?= CHtml::button('X',array(
		'class' => 'button buttonRightSide',
		'onclick' => "js:$(this).closest('div').remove()",
	)) ?>
	<h2>Eller</h2>

	<? foreach ($this->getAccessGroups() as $groupName => $group): ?>
		<div class="accessGroup" id="<?= $groupName ?>">
			<h3><?= $groupName ?></h3>
			<? foreach ($group as $accessName => $access): ?>
				<div class="accessItem">
					<input class="accessInput"	type="checkbox" value="<?= $access ?>" name="<?= $this->getName($access, $sub) ?>" <?= $this->getChecked($access, $sub); ?>	/>
					<div class="accessName" ><?= $accessName ?></div>
				</div>
			<? endforeach ?>
		</div>
	<? endforeach ?>
</div>