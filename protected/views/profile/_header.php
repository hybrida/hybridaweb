<? $this->layout = "//layouts/doubleColumn"; ?>
<? $this->beginClip('sidebar'); ?>
	<?= Image::profileTag($user->imageId, 'profile') ?>
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