<div class="g-barTitle"><h3><?= Article::getRootTitle($article->id, $article->parentId) ?></h3></div>


<div id="sidebarToBeUpdated">
	<?
	$this->widget('application.components.widgets.ArticleTree', array(
		'currentId' => ($article->id),
	));
	?>

</div>

<div class='g-barTitle'><?= Html::link('Pensumbøker', array('/booksale')) ?></div>