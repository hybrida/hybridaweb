
<div class='g-barTitle'>Arrangementer</div>
<div class="g-sidebarNav">
	<ul>
		<? foreach ($models as $model): ?>
			<li>
				<?
					$date = new DateTime($model->event->start);
					$now = new DateTime('NOW');
					$days = $now->diff($date)->days;
				?>
				<?= CHtml::link($model->title, $model->viewUrl)?>
                <div id="g-activityFeedCounter">
                    <?= $days . " dager igjen! " ?>
                </div>
			</li>
		<? endforeach ?>

		<? if (empty($models)): ?>
			<li>Det finnes ingen kommende arrangementer</li>
		<? endif ?>
	</ul>
</div>
