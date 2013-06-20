<?php

$url= Yii::app()->createUrl('notifications/default/follow', array(
	'id' => $this->id,
	'type' => $this->type,
	'toggle' => '',
));

$linkImage = CHtml::image("/favicon.ico", "Griff", array(
	'width' => 16,
));

$linkText = ($this->isFollowing ? "Slutt å følge" : "Følg");

$linkContent = $linkImage . $linkText;

$ajaxLink = CHtml::link($linkContent, $url);


if ($this->isAjaxRequest):
	echo $ajaxLink;
else:
?>

<div class="widget-followButton">
	<a href="#" class="widget-followButton-button" onclick="js:actionFollow()">
		<img src="/favicon.ico" alt="griff">
		<span>
			<? if ($this->isFollowing): ?>
				Ikke følg
			<? else: ?>
				Følg
			<? endif ?>
		</span>
	</a>
</div>

<script>

var isFollowing = eval('<?= $this->isFollowing ? 'true' : 'false' ?>');

function getToggle() {
	if (isFollowing) {
		return "unfollow";
	} else {
		return "follow";
	}
}

function actionFollow() {
	var baseUrl = '<?= $url ?>/';
	var toggle = getToggle();
	var url = baseUrl + toggle;
	console.log(url);
	var buttonText = $(".widget-followButton-button span");
	$.ajax({
		'url': url,
		'success': function(html) {
			buttonText.text(html);
			isFollowing = !isFollowing;
		}
	});
}

</script>

<? endif ?>