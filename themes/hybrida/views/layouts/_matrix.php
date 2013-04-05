<?php

if (isset($_GET['matrix']) && $_GET['matrix'] == "true") {
	$_SESSION['matrix'] = true;
} elseif (isset($_GET['matrix'])) {
	$_SESSION['matrix'] = false;
}

if (isset($_SESSION['matrix']) && $_SESSION['matrix'] == true): ?>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/hidden/matrix.css" />
<? endif ?>