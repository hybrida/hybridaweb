<style type="text/css">
	.gossipEntry{
		padding-bottom: 0.5em;
	}
	.dateEntry{
		font-style: italic;
		font-size: 0.9em;
	}
	
</style>

<h1>Sladder til Update^k</h1>

<ol>
<? foreach ($gossipText as $gossip): ?>
	<li class="gossipEntry">
		<div><?=$gossip->gossipText?></div>
		<div class="dateEntry">Sendt inn: <?=$gossip->submitDate?></div>
	</li>
<? endforeach; ?>
</ol>