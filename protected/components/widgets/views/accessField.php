<div class="accessField">
	<? foreach ($groups as $groupName => $group): ?>
		<div class="accessGroup" id="<?=$groupName?>">
			<h3><?= $groupName ?></h3>
			<? foreach ($group as $accessName => $access): ?>
				<div class="accessItem">
					<input class="accessInput"	type="checkbox" value="<?= $access ?>" name="<?= $this->getName($access) ?>" <?= $this->getChecked($access); ?>	/>
					<div class="accessName" ><?= $accessName ?></div>
				</div>
			<? endforeach ?>
		</div>
	<? endforeach ?>
</div>