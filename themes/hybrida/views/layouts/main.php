<!DOCTYPE HTML>
<html>
	<head <?= $this->clips['head-tag'] ?> >
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?= $this->getPageTitle() ?> - <?= CHtml::encode(Yii::app()->name) ?></title>
		<meta name="description" content="Hybrida er linjeforeningen for 
			  studieprogrammet Ingeniørvitenskap og IKT ved NTNU i Trondheim." />

		<?= $this->clips['head-facebook'] ?>

		<script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/scripts/animations.js"></script>
		<script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/scripts/collapsible_lists.js'></script>
		<script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/scripts/e.js'></script>
		<script type ="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/scripts/galleria/galleria-1.2.8.min.js"></script>
		

		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/fonts/fonts.css" />

		<? if (YII_DEBUG): ?>
			<? CssIncluder::registerDirectory("style") ?>
			<?= CssIncluder::printCssTags() ?>
		<? else: ?>
			<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/min.css" />
		<? endif ?>
			
		<? if (isset($_GET['matrix']) && $_GET['matrix'] == "true") {
			$_SESSION['matrix'] = true;
		} elseif (isset($_GET['matrix'])) {
			$_SESSION['matrix'] = false;
		} ?>
			
		<? if (isset($_SESSION['matrix']) && $_SESSION['matrix'] == true): ?>
			<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/hidden/matrix.css" />
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
				<br clear="all" />
				<div class="layout-headBottom">
					<div class="layout-menu">
						<nav>
							<? $this->widget("application.components.widgets.TabNavigation"); ?>
						</nav>
						<br/>
					</div>
				</div>
			</div>

			<div class="layout-mainWrap g-clearfix">
				<?= $content ?>
			</div>
			
			<div id="layout-marginMaker"></div>
		</div>

	</body>
</html>
