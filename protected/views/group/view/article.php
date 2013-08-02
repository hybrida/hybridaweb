<?php $this->renderPartial("menu", $menu); ?>

<h1>
	<?= $title ?>
</h1>

<p><?= $content['content'] ?></p>
<p><i>skrevet av <?= $content['firstName'] ?> <?= $content['middleName'] ?> <?= $content['lastName'] ?> den <?= $content['timestamp'] ?></i></p>