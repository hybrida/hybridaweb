<!DOCTYPE HTML>
<html>
	<head <?= $this->clips['head-tag'] ?> >
		<title><?= $this->getPageTitle() ?> - <?= CHtml::encode(Yii::app()->name) ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Hybrida er linjeforeningen for 
				studieprogrammet Ingeniørvitenskap & IKT ved NTNU i Trondheim." />

		<?= $this->clips['head-facebook'] ?>

		<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/scripts/animations.js"></script>
		<script type = 'text/javascript' src = '<?=Yii::app()->request->baseUrl?>/scripts/collapsible_lists.js'></script>
		<script type = 'text/javascript' src = '<?=Yii::app()->request->baseUrl?>/scripts/e.js'></script>

		<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/fonts/fonts.css" />
		
		<? if (YII_DEBUG):?>
			<? CssIncluder::registerDirectory("style") ?>
			<?= CssIncluder::printCssTags() ?>
		<? else: ?>
			<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/all-TIMESTAMP.css" />
		<?endif ?>
		
		<!-- google analytics -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-27346572-1']);
			_gaq.push(['_setDomainName', 'hybrida.no']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</head>

	<body>
		<div class="layout-headerStripe">
			<div class="layout-header">
				<a href="<?=Yii::app()->request->baseUrl?>/" 
						><img class="layout-headerBanner" src="<?= Yii::app()->request->baseUrl ?>/images/BannerLarge.png" alt="" /></a>
				<div class="searchWrap">
					<? $this->widget('search.components.SearchWidget') ?>
				</div>
			</div>

			<div class="layout-headerBottomStripe">
				<div class="layout-menu">
					<nav>
						<? $this->widget("application.components.widgets.TabNavigation"); ?>
					</nav>
					<div class="layout-loggedIn">
						<? $this->widget("application.components.widgets.UserOptions") ?>
					</div>
				</div>
			</div>
		</div>

		<div class="layout-mainWrap">
			<?= $content ?>
		</div>

	</body>
</html>
