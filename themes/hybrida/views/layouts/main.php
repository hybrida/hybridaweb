<!DOCTYPE HTML>
<html>

	<head>
		<title><?= CHtml::encode(Yii::app()->name) ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/scripts/e.js'></script>

		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/style.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/hintList.css" />

		<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl ?>/style/layout.css" />
		<link rel='stylesheet' type='text/css' href='<?=Yii::app()->request->baseUrl ?>/style/destroy.css'/>
		<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl ?>/css/form.css" />
		<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl ?>/fonts/fonts.css" />
		<link rel='stylesheet' type='text/css' href="<?=Yii::app()->request->baseUrl ?>/style/pageContent.css" />
	</head>

	<body>
		<div class="headerStripe">
			<div class="header">
				<img src="<?= Yii::app()->request->baseUrl ?>/images/mastHeadLogo.png" align="left" alt="" />
				<h1><?= CHtml::encode(Yii::app()->name) ?></h1>
				<div class="searchWrap">
                    <div class='search'><input type='text' />
                        <div class="searchImg"><input type='image' src='<?= Yii::app()->request->baseUrl ?>/images/Search.png' /></div>
                        <ul id="hintList">

                        </ul>
                    </div>
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
                            <div><a href='<?= Yii::app()->request->baseUrl ?>/article/1'>Hybrida</a></div>

                            <div class="last">Bedrift</div>
                        </items>
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
