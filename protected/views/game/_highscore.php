<div class="g-barTitle">Highscore</div>
<div class="g-barText">
<? $i = 1 ?>
<? foreach ($highscorelist as $hs): ?>
	<div class="userScore">
		<span class="position"><?= $i ?>:</span>
		<span class="score"> <?= $hs->score/1000 ?></span>
		<span class="name"><?= $hs->user->fullName ?></span>
	</div>
	<? $i++ ?>
<? endforeach ?>
</div>