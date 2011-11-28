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
		<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl ?>/fonts/fonts.css" />
		<link rel='stylesheet' type='text/css' href="<?=Yii::app()->request->baseUrl ?>/style/pageContent.css" />
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

                            <div><a href='<?= Yii::app()->request->baseUrl ?>/profile/all/2016'>Personer</a></div>
                            <div><a href='<?= Yii::app()->request->baseUrl ?>/article/1'>Hybrida</a></div>

                            <div class="last">
                                <a href='<?= Yii::app()->request->baseUrl ?>/article/2'>Bedrift</a>
                            </div>
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
