<h1>Komiteer og grupper</h1>
<div class='menuPage'>
	<a href='?site=group&type=add'>create new</a>
	<!--//Dette burde lage et popupvindu med muligheten til � fylle inn navn og egenskaper osv. -->
</div>

<!-- //Lister alle mulige grupper hvis ikke gruppeId er oppgitt. -->
<h2>Komiteer</h2>
<ul>
	
	
<? foreach ($committee as $group): ?>

<li><a href='?site=group&id=<?=$group['id']?>' ><?=$group['title']?></a> </li>

<? endforeach ?>

</ul>

<h2>Grupper</h2>

<? foreach ($groups as $group): ?>

<li><a href='?site=group&id=<?=$group['id']?>' ><?=$group['title']?></a> </li>

<? endforeach ?>
