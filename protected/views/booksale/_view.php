<div id="newsfeed">
    <p>
		<?= CHtml::link("Rediger",array("booksale/update",'id' => $data->id), array(
			'class' => 'g-button g-buttonRightSide'
		)); ?>
    </p>
    <div class="element">
            <div class="header-wrapper">
                <div class="header-title">
                <h1><?php echo CHtml::link($data->title, array('/booksale/'.$data->id)); ?></h1>
                <br />
                </div>
                <div class="header-date">
                <?= $data->timestamp ?>
                </div>
            </div>

            <b><?php echo CHtml::encode($data->getAttributeLabel('beskrivelse')); ?>:</b>
            <?= ($data->content); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('pris')); ?>:</b>
            <?php echo CHtml::encode($data->price); ?> Kroner
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('selger')); ?>:</b>
            <? $user = User::model()->find('id=:id', array(':id'=>$data->author)) ?>
            <?= CHtml::link($user->fullName, array(
                '/profil/'.$user->username,
            ))?>
            <br />
    </div>
</div>