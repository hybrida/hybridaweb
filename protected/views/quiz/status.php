<h1>Quiz: Lagoversikt</h1>

<ul>
<? foreach ($quizTeams as $team): ?>
	<li><?=$team->name?>: founded <?=$team->foundedDate?>, total score: <?=$totalScore[$team->id]?></li>
	
	<ul>
		<? /* foreach ($team->quizTeamScores as $score):?>
		<li><? debug($team->quizTeamScores) ?></li>~
		<? endforeach; */ ?>
	</ul>
<? endforeach; ?>
</ul>