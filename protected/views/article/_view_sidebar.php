<div class="barTitle">Artikkeltre</div>

<div id="sidebarToBeUpdated">
	<?
	$this->widget('application.components.widgets.ArticleTree', array(
		'currentId' => ($article->id),
	));
	?>
</div>