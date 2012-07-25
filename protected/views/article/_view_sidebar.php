<div class="g-barTitle">Sider</div>


<div id="sidebarToBeUpdated">
	<?
	$this->widget('application.components.widgets.ArticleTree', array(
		'currentId' => ($article->id),
	));
	?>
    
</div>

<div class='g-barTitle'><?= Html::link('Pensumbøker', array('/booksale')) ?></div>