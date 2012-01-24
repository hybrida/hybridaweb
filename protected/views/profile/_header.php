<?
$this->layout = "//layouts/doubleColumn";
$this->beginWidget('CClipWidget', array('id' => 'sidebar'))?>
	<img src="/image/view/id//size/1" alt="" width="248px">
<?$this->endWidget()?>
	
<? if (user()->id == $user->id): ?>
	
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