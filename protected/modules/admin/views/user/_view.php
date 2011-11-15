<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
	<?php echo CHtml::encode($data->firstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middleName')); ?>:</b>
	<?php echo CHtml::encode($data->middleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastName')); ?>:</b>
	<?php echo CHtml::encode($data->lastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specialization')); ?>:</b>
	<?php echo CHtml::encode($data->specialization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('graduationYear')); ?>:</b>
	<?php echo CHtml::encode($data->graduationYear); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('member')); ?>:</b>
	<?php echo CHtml::encode($data->member); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imageId')); ?>:</b>
	<?php echo CHtml::encode($data->imageId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phoneNumber')); ?>:</b>
	<?php echo CHtml::encode($data->phoneNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastLogin')); ?>:</b>
	<?php echo CHtml::encode($data->lastLogin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cardinfo')); ?>:</b>
	<?php echo CHtml::encode($data->cardinfo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthdate')); ?>:</b>
	<?php echo CHtml::encode($data->birthdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altEmail')); ?>:</b>
	<?php echo CHtml::encode($data->altEmail); ?>
	<br />

	*/ ?>

</div>
