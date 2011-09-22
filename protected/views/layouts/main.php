<!DOCTYPE HTML>
<html>

<head>
	<title><?=CHtml::encode(Yii::app()->name)?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<script type = 'text/javascript' src = '<?=Yii::app()->request->baseUrl?>/eScript2.js'></script>

	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/style.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl?>/style/layout.css" />
	<link rel = 'stylesheet' type = 'text/css' href = '<?=Yii::app()->request->baseUrl?>/style/destroy.css'/>

	
	<style type = 'text/css'>
		menu items div {
			width: 148px;
			align: center;
			border: 1px solid;
			background: #BBF;
			float: left;
		}
		menu slider div {
			clear: both;
			overflow: hidden;
			width: 450px;
			position: relative;
		}
		menu slider div div {
			width: 1350px;
			float: left;
			background: #EEE;
		}
		menu slider div div div {
			left: 0px;
			clear: none;
			width: 450px;
			text-align: justify;
		}
		menu slider div div div div {
			width: auto;
		}
	</style>

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
			<? $this->widget("widgets/TabNavigation") ?>
		</div>
	</menu> 
	</nav>

<div class="loggedIn"><? $this->widget("widgets/UserOptions") ?></div>

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
