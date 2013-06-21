<?php

$url= Yii::app()->createUrl('notifications/default/follow', array(
	'id' => $this->id,
	'type' => $this->type,
	'toggle' => '',
));

?>

<div class="widget-followButton">
	<a href="#" class="widget-followButton-button g-button" onclick="js:actionFollow()">
		<img src="/images/logo_mini_stroke.png" alt="griff">
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