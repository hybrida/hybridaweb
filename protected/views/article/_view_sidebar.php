<div id="sidebarToBeUpdated">
	<div class="barTitle">Generelt</div>
	<h6>Barn:</h6>
	<?
	$children = $article->getChildren();
	foreach ($children as $child): ?>
		<?= CHtml::link($child->title, $child->viewUrl) ?>
		<br/>
	<? endforeach ?>
		
	<h6>Alle artikler:</h6>
	<?
	$this->widget('application.components.widgets.ArticleTree', array(
		'currentId' => ($article->id),
	));
	
	?>
	
	
	<? /*foreach ($articleTree as $article): ?>
		<li><?= CHtml::link($article[1], array(
			'/article/view',
			'id' => $article[0],
			'title' => $article[1]
			)) ?> </li>
		<ul>
		
		<? foreach($article[2] as $child): ?>
				<li><?= CHtml::link($child[1], array(
				'/article/view',
				'id' => $child[0],
				'title' => $child[1]
			)) ?></li>
				<ul>
				<? foreach($child[2] as $childOfChild): ?>
					<li>
						<?= CHtml::link($childOfChild[1], array(
							'/article/view',
							'id' =>  $childOfChild[0],
							'title' => $childOfChild[1]
						)) ?>
					</li>
				<? endforeach ?>
				</ul>
		<? endforeach ?>
		</ul>
	<? endforeach*/ ?>
</div>