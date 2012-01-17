<div>
	<? foreach ($groups as $groupName => $group): ?>
		<h3><?= $groupName ?></h3>
		<div>
			<? foreach ($group as $accessName => $access): ?>
				<input 
					type="checkbox" 
					value="<?=$access?>" 
					name="<?= $this->getName($access) ?>" 
					<?= $this->getChecked($access); ?>
					/> <?= $accessName ?>
			<? endforeach ?>
		</div>
	<? endforeach ?>
</div>