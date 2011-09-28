<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?>, <?
if ( ! Yii::app()->user->isGuest ): echo Yii::app()->user->name ; endif; ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <i><?php echo __FILE__; ?></i></li>
	<li>Layout file: <i><?php echo $this->getLayoutFile('main'); ?></i></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<h2>Info om CWebUser-klassen</h2>
<pre><? print_r(Yii::app()->user); ?></pre>

<h2>Info om CWebUser-klassen 2</h2>
<pre><? print_r(Yii::app()->user->id) ?> 
<?= Yii::app()->user->name ?>


</pre>


