<h1>Komiteer og grupper</h1>
<div class='menuPage'>
	<a href='<?= Yii::app()->baseURL ?>/group/add'>Opprett ny</a>
	<!--//Dette burde lage et popupvindu med muligheten til � fylle inn navn og egenskaper osv. -->
</div>

<!-- //Lister alle mulige grupper hvis ikke gruppeId er oppgitt. -->
<h2>Komiteer</h2>
<ul>
	
	
<? foreach ($committee as $group): ?>

<li><?= CHtml::link($group['title'], array("view", 'url' => $group['url'])) ?></li>
<? endforeach ?>

</ul>

<h2>Grupper</h2>

<? foreach ($groups as $group): ?>

<li><a href='<?= Yii::app()->baseURL ?>/group/view/<?=$group['id']?>/<?= $group['menuTitle'] ?>' ><?=$group['title']?></a> </li>

<? endforeach ?>
