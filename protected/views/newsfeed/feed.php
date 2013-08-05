<?php
$this->pageTitle = "Nyhetsstrøm";
$this->layout = "//layouts/newsfeed";

$this->beginClip('sidebar'); ?>
	<? if ($hasPublishAccess): ?>
		<fieldset class="g-adminSet">
			<legend>Admin</legend>

			<?= CHtml::link("Publiser", array("news/create"), array(
				'class' => 'g-button',
			)) ?>

			<?= CHtml::link("Nyheter", array("admin/news"), array(
				'class' => 'g-button',
			)) ?>

			<?= CHtml::link("Artikler", array("admin/articles"), array(
				'class' => 'g-button'
			)) ?>

			<?= CHtml::link("Statistikk", array("admin/stats"), array(
				'class' => 'g-button'
			)) ?>

		</fieldset>
	<? endif ?>
	<?
	$this->widget('application.components.widgets.ActivitiesFeed');
	Yii::import('jobAnnouncement.widgets.JobAnnouncementFeed');
	$this->widget('JobAnnouncementFeed');
$this->endClip();
?>
<div class="newsfeedIndex">
<div class="feeds"></div>

<?=CHtml::button('Vis flere', array(
	'class' => 'g-button',
	'style' => 'display: block; width: 100%;',
	'id' => 'fetchNews',
))?>

<!--
 -->
<script language="text/html" id="newsfeed-template">
	<div class="element">
		<div class="header-wrapper">
			<div class="header-title">
				<h1><a href="<%- url %>"><%-title %></a></h1>
			</div>
			<div class="header-date">

			</div>
		</div>
		<div class="text-content">

			<% if (image) { %>
				<a href="<%- url %>">
					<%= image %>
				</a>
			<% } %>
			<%= ingress %>
			<% if (author) { %>
				<div class="author">
					<%= authorLink%>
					den
					<span class="date">
						<%- date %>
					</span>
				</div>
			<% } else { %>
				<div class="author">
					Hybrida
					den
					<span class="date">
						<%- date %>
					</span>
				</div>
			<% } %>

		</div>
	</div>
</script>

<?php

$ajaxFeedUrl = $this->createUrl("feedAjax", array(
	'offset' => ''
));

?>

<script language="javascript">
	require(['newsfeed'], function(newsfeed) {

		var templateString = $("#newsfeed-template").html();
		var template = _.template(templateString);


		var view = new newsfeed.NewsFeedView({
			'template': template,
			'feedContent': $('.feeds'),
			'limit': <?= $limit ?>,
			'ajaxButton': $("#fetchNews")
		});

		view.load();
	});
</script>
</div>