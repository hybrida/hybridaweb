<?php 
$this->pageTitle = $news->title ;
$this->layout = "//layouts/doubleColumn" ;
 
$this->beginClip('sidebar'); 
	$this->renderPartial('_view_sidebar', array(
		'signup' => $signup,
		'event' => $event,
		'isAttending' => $isAttending,
	));
	?>
	<?
	$this->widget('application.components.widgets.ActivitiesFeed');
$this->endClip()
?>
<? if ($event): ?>
	<? $this->beginClip('head-tag') ?>
prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# lfhybrida: http://ogp.me/ns/fb/lfhybrida#"
	<? $this->endClip() ?>

	<? $this->beginClip('head-facebook') ?>
		<meta property="fb:app_id"      content="202808609747231" />
		<meta property="og:type"        content="lfhybrida:event" />
		<meta property="og:url"         content="<?= Yii::app()->createAbsoluteUrl("/") . $news->viewUrl ?>" />
		<meta property="og:title"       content="<?= $news->title ?>" />
                <meta property="og:image"       content="<?= Yii::app()->createAbsoluteUrl("/") ?>/images/mastHeadLogo.png" />
	<? $this->endClip() ?>
<? endif; ?>
<?$this->breadcrumbs=array(
	$news->title => $news->viewUrl,
);?>

<h1><?=$news->title?></h1>

<? if ($hasEditAccess): ?>
<p>
	<?= CHtml::link("Rediger",array("news/edit",'id' => $news->id), array(
		'class' => 'button buttonRightSide'
	)); ?>
</p>
<? endif ?>

<? if ($news->author): ?>
<strong>Skribent:&nbsp;</strong> <?= CHtml::link($news->author->fullName, array(
	'/profile/view/',
	'username' => $news->author->username,
	))?>
<? endif ?>

<? if ($news->imageId):
	$imageURL = $this->createUrl('/image/view',array(
		'id' => $news->imageId,
		'size' => 1, //FIXME
	));
	?>
<br/><img src='<?=$imageURL?>' />
<? endif; ?>

<p><strong><?=$news->ingress?></strong></p>

<?=$news->content?>


<? if ($signup): ?>
	<h1> Påmeldte: </h1>
	<table>
	<tr><td>1. årskurs</td><td>2. årskurs</td><td>3. årskurs</td><td>4. årskurs</td><td>5. årskurs</td>
	<? $fiveYear = $signup->attendersFiveYearArrays ?>
	<? $i = 0 ?>
	<? while (!empty($fiveYear)): ?>
		</tr>
		<? for ($j = 0; $j < 5; $j++): ?>
			<td>
			<? if (!empty($fiveYear[$j][$i])): ?>
				<? $user = $fiveYear[$j][$i] ?>
				<?= Image::profileTag($user->imageId, 'small') ?>
				<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
				<? unset($user) ?>
			<? else: ?>
				<? unset($fiveYear[$j]) ?>
			<? endif ?>
			</td>
		<? endfor ?>
		<? $i++ ?>
		<tr>
	<? endwhile ?>
	</tr>
	</table>
<? endif ?>

<?$this->widget('comment.components.commentWidget', array(
	'id' => $news->id,
	'type' => 'news',
)); ?>