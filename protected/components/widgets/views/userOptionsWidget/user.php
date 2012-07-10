<? Yii::import('notifications.models.*') ?>

<div style="color: #fff; display: inline; background-color: #f00">
	<? $url = app()->createUrl('notifications/default/index') ?>
	<a href="<?=$url?>"><?= count( Notifications::getUnread(user()->id)) ?></a>
</div>
<? echo CHtml::link("Logg ut", param('logoutUrl'));
/*

<a href='<?= Yii::app()->baseURL ?>/site/logout'>
        
        <?= $firstName ?><!-- Lange navn forskøv rightbarcontent. <?= $middleName ?> <?= $lastName ?>--></a>
 * 
 */