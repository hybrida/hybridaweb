		<? if (YII_DEBUG): ?>
			<? CssIncluder::registerDirectory("style") ?>
			<?= CssIncluder::printCssTags() ?>
		<? else: ?>
			<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/min.css" />
		<? endif ?>