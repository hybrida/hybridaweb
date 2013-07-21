<!DOCTYPE HTML>
<html>
	<head <?= $this->clips['head-tag'] ?> >
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?= $this->getPageTitle() ?> - <?= CHtml::encode(Yii::app()->name) ?></title>

		<meta name="description" content="Hybrida er linjeforeningen for
			studieprogrammet Ingeniørvitenskap og IKT ved NTNU i Trondheim." />

		<?= $this->clips['head-facebook'] ?>


		<? $this->renderPartial('//layouts/_css') ?>
		<? $this->renderPartial('//layouts/_matrix') ?>
		<? $this->renderPartial('//layouts/_google_analytics') ?>

		<script data-main="/scripts/main.js" src="/scripts/require.js"></script>
	</head>

	<body>
		<div class="layout-wrap">
			<div class="layout-head">
				<div class="layout-banner">
					<a href="<?= Yii::app()->request->baseUrl ?>/">
						<img
							class="layout-headerBanner"
							src="<?= Yii::app()->request->baseUrl ?>/images/logo_head.png"
							alt="" />
					</a>
				</div>
				<div class="layout-search">
					<div class="layout-search">
						<input type="text" id="searchField" placeholder="Søk"/>
					</div>
				</div>
				<div style="clear: both"></div>
				<div class="layout-headBottom">
					<? $this->widget("application.components.widgets.TabNavigation"); ?>
				</div>
			</div>

			<div class="layout-mainWrap g-clearfix">
				<?= $content ?>
			</div>

			<div id="layout-marginMaker"></div>
		</div>
	</body>
</html>
