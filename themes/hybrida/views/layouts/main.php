<!DOCTYPE HTML>
<html>

	<head>
		<title><?= CHtml::encode(Yii::app()->name) ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/scripts/e.js'></script>

		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/style.css" />
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/layout.css" />
		<link rel = 'stylesheet' type = 'text/css' href = '<?= Yii::app()->request->baseUrl ?>/style/destroy.css'/>
		<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl ?>/css/form.css" />



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
				<img src="<?= Yii::app()->request->baseUrl ?>/images/mastHeadLogo.png" align="left" alt="" />
				<h1><?= CHtml::encode(Yii::app()->name) ?></h1>
				<div class="searchWrap">
                    <div class='search'><input type='text' />
                        <div class="searchImg"><input type='image' src='<?= Yii::app()->request->baseUrl ?>/images/Search.png' /></div>
                        <ul>
                            
                        </ul>
                    </div>
                    
                    <!--Gamle versjonen:-->
					<!--<form method='post' action='?site=search' id='searchForm'>
						<div class="searchBox">
							<input type='text' id='activeSearchBox' />
							<ul id="searchList"> 
								<!-- Search Suggestions 
							</ul>
						</div>
						<div class="searchImg"><input type='image' src='<?= Yii::app()->request->baseUrl ?>/images/Search.png' /></div>
					</form>!-->
				</div>
			</div>
			<div class="headerBottomStripe">
				<div class="menu">
					<nav>
                        <!--Hardkodet meny for visning på genfors -->
                        <items>
                            <div><a href='<?= Yii::app()->request->baseUrl ?>/news/'>Hjem</a></div> 
                            <div><a href='<?= Yii::app()->request->baseUrl ?>/profile/'>Profil</a></div> 
                            <div><a href='<?= Yii::app()->request->baseUrl ?>/group/'>Grupper</a></div>
                            <div>Personer</div>
                            <div>Om oss</div>
                            <div class="last">Bedrift</div>
                        </items>
                        
                        <!-- PHP generert GAMMEL meny: -->
						<!--<menu>
							<div>
								<? $this->widget("application.components.widgets.TabNavigation") ?>
							</div>
						</menu> -->
                        
					</nav>

					<div class="loggedIn"> <? $this->widget("application.components.widgets.UserOptions") ?> 
                    </div>

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
				<? if(isset($this->imageId)) {
                    
                    $this->widget("application.components.widgets.RightBarContent", array(
                            'imageId' => $this->imageId,
                    ));
                }
                else {
                    $this->widget("application.components.widgets.RightBarContent");
                }?>
			</div>
		</div>



	</body>

</html>
