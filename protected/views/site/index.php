<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?>, <?
if ( ! Yii::app()->user->isGuest ): echo Yii::app()->user->name ; endif; ?></i></h1>

<h2>Info</h2>
<p><strong>UserName:</strong> <?= ( ! Yii::app()->user->isGuest) ? Yii::app()->user->name : "IKKE DEFINERT" ?>
<p><strong>UserID:</strong> <?= ! Yii::app()->user->isGuest ? Yii::app()->user->id : "IKKE DEFINERT" ?>

<h2>Gammel side</h2>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <i><?php echo __FILE__; ?></i></li>
	<li>Layout file: <i><?php echo $this->getLayoutFile('main'); ?></i></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>



