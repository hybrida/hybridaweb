<? $this->pageTitle = "Adminpanel artikler" ?>

<div class="adminView">
	<table>
		<tr>
			<th>Title</th>
			<th>Id</th>
			<th>Foreldre-id</th>
			<th>Forfatter</th>
			<th>Dato</th>
			<th>Rediger</th>
		</tr>
		<? foreach ($articles as $article): ?>
			<tr>
				<td><?= CHtml::link($article->title, $article->viewUrl) ?></td>
				<td><?= $article->id ?></td>
				<td><?= $article->parentId ?></td>
				<td>
					<? if ($article->author): ?>
						<? $author = User::model()->findByPk($article->author); ?>
						<?= CHtml::link($author->fullName, $author->viewUrl) ?>
					<? endif ?>
				</td>
				<td><?= $article->timestamp ?></td>
				<td>
					<? if (user()->checkAccess('updateArticle', array('id' => $article->id))): ?>
						<?=
						CHtml::link("Rediger", array("article/edit", 'id' => $article->id), array(
							'class' => 'g-button'
						));
						?>
					<? endif ?>
				</td>
			</tr>
		<? endforeach ?>
	</table>
</div>
