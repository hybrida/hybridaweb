<?php

$url= Yii::app()->createUrl('notifications/default/follow', array(
	'id' => $this->id,
	'type' => $this->type,
	'toggle' => '',
));

?>

<div class="widget-followButton">
	<a href="#" class="widget-followButton-button">
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
	require(['comments/follow'], function(follow) {
		follow.init({
			baseUrl: '<?= $url ?>/',
			isFollowing: eval("<?= $this->isFollowing ? 'true' : 'false' ?>")
		});

		follow.run();
	});
</script>