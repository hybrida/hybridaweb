<div class="newsEmail">

	<h1>Epostadresser til de påmeldte på: <?= $news->title ?></h1>
	<textarea class="emails"><? foreach ($attenders as $attender) {
			echo $attender->studmail . ", ";
		} ?></textarea>

</div>

