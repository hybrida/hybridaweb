<div class="accessField">
	<? foreach ($groups as $groupName => $group): ?>
		<div>
		<h3><?= $groupName ?></h3>
			<? foreach ($group as $accessName => $access): ?>
				<input 	type="checkbox" value="<?=$access?>" name="<?= $this->getName($access) ?>" <?= $this->getChecked($access); ?>	/> <?= $accessName ?> <br/>
			<? endforeach ?>
		</div>
	<? endforeach ?>
</div>