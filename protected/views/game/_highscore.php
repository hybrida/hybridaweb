<div class="g-barTitle">Highscore</div>
<div class="g-barText">
<? foreach ($highscorelist as $hs): ?>
	<div class="userScore">
		<span class="score"> <?= $hs->score ?></span>
		<span class="name"><?= $hs->user->fullName ?></span>
	</div>
<? endforeach ?>
</div>