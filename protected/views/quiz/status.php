<h1>Status for Quiz</h1>

<ul>
<? foreach ($quizTeams as $team): ?>
	<li><?=$team->name?>: <?=$team->foundedDate?></li>
	
	<ul>
		<? /* foreach ($team->quizTeamScores as $score):?>
		<li><? debug($team->quizTeamScores) ?></li>~
		<? endforeach; */ ?>
	</ul>
<? endforeach; ?>
</ul>

<p>
	<? $utr = QuizTeam::model()->findByPk('1'); ?>
	Laget <?=$utr->name?> ble starta <?=$utr->foundedDate?>.
	<? foreach($utr->quizTeamMembers as $member): ?>
	<p><? print_r($member) ?></p>
	<? endforeach; ?>
</p>
