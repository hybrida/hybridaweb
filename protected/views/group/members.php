<h1><?= $group->title ?></h1>

<? $this->renderPartial("_menu", array(
	'group' => $group,
)) ?>

<? if (user()->checkAccess('updateGroup', array('id' => $group->id))) {
	echo CHtml::link("Rediger medlemsliste", array(
		'editMembers',
		'url' => $group->url,
	), array(
		//'class' => 'button',
	));
}
?>
<div class="memberlists">

	<table id="membertable">
		<tr>
			<th></th>
			<th>Navn</th>
			<th>Medlemskap</th>
			<th>Stilling</th>
		</tr>
		<? $odd = false ?>
		<? foreach ($members as $membership) : 
			$user = $membership->user?>
			<? $odd = !$odd ?>
			<div class="<?= $odd ? "odd" : "like" ?>" >
				<tr>
					<td class="imageCell">
						<?= Image::profileTag($user->imageId, 'mini') ?>
					</td>
					<td class="nameCell"><?= CHtml::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?></a></td>

					<td class="isMemberCell">
						<? if ($user->member): ?>
							Medlem
						<? else: ?>
							Ikke medlem
						<? endif; ?>
					</td>
					<td><?=$membership->comission?></td>

				</tr>
			</div>
		<? endforeach; ?>
	</table>
</div>