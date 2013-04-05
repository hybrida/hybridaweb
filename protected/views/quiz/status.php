<h1>Status for Quiz</h1>

<ul>
<? foreach ($quizTeams as $team): ?>
	<li><?=$team->name?>: <?=$team->foundedDate?></li>
	
	<ul>
		<? foreach ($team->quizTeamScores as $score):?>
		<li><? debug($team->quizTeamScores) ?></li>
		<? endforeach; ?>
	</ul>
	
<? endforeach; ?>
</ul>