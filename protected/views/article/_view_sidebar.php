<div class="barTitle">Sider</div>


<div id="sidebarToBeUpdated">
	<?
	$this->widget('application.components.widgets.ArticleTree', array(
		'currentId' => ($article->id),
	));
	?>
    
</div>

<div class='barTitle'><?= Html::link('Pensumbøker', array('/booksale')) ?></div>