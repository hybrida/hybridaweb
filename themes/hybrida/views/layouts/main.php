<!DOCTYPE HTML>
<html>

    <head>
        <title><?= $this->getPageTitle() ?> - <?= CHtml::encode(Yii::app()->name) ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        
        <script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/scripts/e.js'></script>
        <script type = 'text/javascript' src = '<?= Yii::app()->request->baseUrl ?>/scripts/animations.js'></script>

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/style.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/hintList.css" />

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/style/layout.css" />
        <link rel='stylesheet' type='text/css' href='<?= Yii::app()->request->baseUrl ?>/style/destroy.css'/>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/fonts/fonts.css" />
        <link rel='stylesheet' type='text/css' href="<?= Yii::app()->request->baseUrl ?>/style/pageContent.css" />
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
					<? $this->widget('search.components.SearchWidget') ?>
                </div>
            </div>
            <div class="headerBottomStripe">
                <div class="menu">
                    <nav>
                        <? $this->widget("application.components.widgets.TabNavigation"); ?>
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
            </div>

            <div class="rightBar">
                <?
                if (isset($this->imageId)) {

                    $this->widget("application.components.widgets.RightBarContent", array(
                        'imageId' => $this->imageId,
                    ));
                } else {
                    $this->widget("application.components.widgets.RightBarContent");
                }
                ?>
            </div>
        </div>

    </body>

</html>
