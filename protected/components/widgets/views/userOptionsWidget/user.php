<? Yii::import('notifications.models.*') ?>

<div style="color: #fff; display: block;float: left; background-color: #000; border-radius: 5px; font-weight: bold; width: 30px; text-align: center;">
	<? $url = app()->createUrl('notifications/default/index') ?>
	<a href="<?=$url?>" style="padding: 5px"><?= count( Notifications::getUnread(user()->id)) ?></a>
</div>
<? echo CHtml::link("Logg ut", param('logoutUrl'));
/*

<a href='<?= Yii::app()->baseURL ?>/site/logout'>
        
        <?= $firstName ?><!-- Lange navn forskøv rightbarcontent. <?= $middleName ?> <?= $lastName ?>--></a>
 * 
 */