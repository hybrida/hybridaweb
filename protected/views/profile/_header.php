<? $this->layout = "//layouts/doubleColumn"; ?>
<? $this->beginClip('sidebar'); ?>
	<? if ($user->image == null): ?>
		<img src="/images/unknown_malefemale_profile.jpg" alt="" width="248px">
	<? else: ?>
		<?= Image::tag($user->imageId, 'profile') ?>
	<? endif; ?>
<?$this->endClip()?>
	
<? if (user()->checkAccess('updateProfile', array('username' => $user->username))): ?>
	
	<?= CHtml::link('Edit', array('edit', 'username' => $user->username), array(
		'class' => 'button buttonRightSide',
	));?>
<? endif ?>

<h1><?=$user->getFullName()?></h1>

<div id='groupNavigation'>
	<?=CHtml::link('Vegg', array('/profile/comment', 'username' => $user->username), array(
		'class' => 'groupNavigationItem',
	))?>
	<?=CHtml::link('Info', array('/profile/info', 'username' => $user->username), array(
		'class' => 'groupNavigationItem',
	))?>
</div>