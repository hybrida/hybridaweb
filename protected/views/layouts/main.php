<!DOCTYPE HTML>
<html>

<head>
	<title><?=CHtml::encode(Yii::app()->name)?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<script type = 'text/javascript' src = '<?=Yii::app()->request->baseUrl?>/eScript2.js'></script>

	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/style.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/layout.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/destroy.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/pageContent.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/classList.css" />
</head>

<body>
	<div class="headerStripe">
		<div class="header">
			<img src="<?=Yii::app()->request->baseUrl?>/images/mastHeadLogo.png" align="left"></img>
			<h1><?= CHtml::encode(Yii::app()->name) ?></h1>
			<div class="searchWrap">
				<form method='post' action='?site=search' id='searchForm'>
				<div class="searchBox">
					<input type='text' id='activeSearchBox' />
					<ul id="searchList"> 
						<!-- Search Suggestions -->
					</ul>
				</div>
				<div class="searchImg"><input type='image' src='<?=Yii::app()->request->baseUrl?>/images/Search.png' /></div>
				</form>
			</div>
		</div>
		<div class="headerBottomStripe">
			<div class="menu">
	<nav>
	<menu>
		<div>
			<? $this->widget("TabNavigation") ?>
		</div>
	</menu> 
	</nav>

<div class="loggedIn"><? $this->widget("UserOptions") ?></div>

			</div>
		</div>
	</div>
	
	<div class="mainWrap">
		<div class="content">
<?=$content?>
			<b>Lastetid: </b><?=Yii::getLogger()->getExecutionTime()?>
			<br><pre><? print_r(Yii::app()); ?></pre>
		</div>
	
		<div class="rightBar">
			<? $this->widget("RightBarContent"); ?>
		</div>
	</div>
	
	
	
</body>

</html>
