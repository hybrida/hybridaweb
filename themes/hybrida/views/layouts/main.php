<!DOCTYPE HTML>
<html>

	<head>
		<title><?= CHtml::encode(Yii::app()->name) ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/eScript2.js'></script>

		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/style.css" />
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/layout.css" />
		<link rel = 'stylesheet' type = 'text/css' href = '<?= Yii::app()->request->baseUrl ?>/style/destroy.css'/>


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

			.portlet
			{
				float: right;
				display:block;

			}

			.portlet-decoration
			{
				padding: 3px 8px;
				background: #B7D6E7;
				border-left: 5px solid #6FACCF;
			}

			.portlet-title
			{
				font-size: 12px;
				font-weight: bold;
				padding: 0;
				margin: 0;
				color: #298dcd;
			}

			.portlet-content
			{
				font-size:0.9em;
				margin: 0 0 15px 0;
				padding: 5px 8px;
				background:#EFFDFF;
			}

			.portlet-content ul
			{
				list-style-image:none;
				list-style-position:outside;
				list-style-type:none;
				margin: 0;
				padding: 0;
			}

			.portlet-content li
			{
				padding: 2px 0 4px 0px;
			}

			.operations
			{
				list-style-type: none;
				margin: 0;
				padding: 0;
			}

			.operations li
			{
				padding-bottom: 2px;
			}

			.operations li a
			{
				font: bold 12px Arial;
				color: #0066A4;
				display: block;
				padding: 2px 0 2px 8px;
				line-height: 15px;
				text-decoration: none;
			}

			.operations li a:visited
			{
				color: #0066A4;
			}

			.operations li a:hover
			{
				background: #80CFFF;
			}

			#sidebar
			{
				padding: 20px 20px 20px 0;
			}
		</style>

	</head>

	<body>
		<div class="headerStripe">
			<div class="header">
				<img src="<?= Yii::app()->request->baseUrl ?>/images/mastHeadLogo.png" align="left" alt="" />
				<h1><?= CHtml::encode(Yii::app()->name) ?></h1>
				<div class="searchWrap">
					<form method='post' action='?site=search' id='searchForm'>
						<div class="searchBox">
							<input type='text' id='activeSearchBox' />
							<ul id="searchList"> 
								<!-- Search Suggestions -->
							</ul>
						</div>
						<div class="searchImg"><input type='image' src='<?= Yii::app()->request->baseUrl ?>/images/Search.png' /></div>
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

					<div class="loggedIn"><? //$this->widget("UserOptions") ?></div>

				</div>
			</div>
		</div>

		<div class="mainWrap">
			<div class="content">	
				<?php if (isset($this->breadcrumbs)): ?>
					<?php
					$this->widget('zii.widgets.CBreadcrumbs', array(
							'links' => $this->breadcrumbs,
					));
					?><!-- breadcrumbs -->
				<?php endif ?>
				<?= $content ?>
				<b>Lastetid: </b><?= Yii::getLogger()->getExecutionTime() ?>
			</div>

			<div class="rightBar">
				<? $this->widget("RightBarContent"); ?>
			</div>
		</div>



	</body>

</html>
