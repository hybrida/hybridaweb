<div class="calendarWrap">
<div class="calendarData">
	<table class="big-calendar">
		<thead>
			<tr class="navigation">
				<th class="prev-month" colspan="2">
					<?= CHtml::link($calendar->prev_month(), "#", array(
							'class' => 'calendar-previous-month-button g-button'
						)) ?>
					</th>
				<th colspan="5" class="current-month"><?= $calendar->month()?> <?=$calendar->year()?></th>
				<th class="next-month">
					<?= CHtml::link($calendar->next_month(), "#", array(
							'class' => 'calendar-next-month-button g-button'
						)) ?></th>
			</tr>
			<tr class="weekdays">
				<th></th>
				<?php foreach ($calendar->days() as $day): ?>
					<th><?php echo $day ?></th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<? $weekCounter = 0 ?>
			<?php foreach ($calendar->weeks() as $week): ?>
				<tr>
					<th class="week-number"><?=$calendar->getWeekNumber($weekCounter++)?></th>
					<?php foreach ($week as $day): ?>
						<?php
						list($number, $current, $data) = $day;

						$classes = array();
						$output = '';

						if (is_array($data)) {
							$classes = $data['classes'];
							$title = $data['title'];
							$output = $data['output'];
						}
						?>
						<td class="day <?php echo implode(' ', $classes) ?>">
                            <? $span_class = $current ? "" : "notThisMonth"?>
							<span class="date <?= $span_class ?>"
                                  title="<?php echo implode(' / ', $title) ?>">
                                <?= $calendar->getOutputFor($current, $number); ?>
                            </span>
							<div class="day-content">
							<? if (!empty($output)): ?>
								<ul class="output">
								<? for ($i = 0; $i < count($title); $i++): ?>
									<? if ($output[$i] == "#"): ?>
										<li><?= $title[$i] ?></li>
									<? else: ?>
										<li><a href="<?=$output[$i]?>"><?= $title[$i] ?></a></li>
									<? endif ?>
								<? endfor ?>
								</ul>
							<? endif ?>
							</div>
						</td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script language="javascript">
	$(function() {
		var nextMonthButton = $(".calendar-next-month-button");
		var prevMonthButton = $(".calendar-previous-month-button");
		
		var nextMonthButtonUrl = "<?=$this->createUrl('/calendar/default/ajax', array(
				'year' => $this->getNextMonthsYear(),
				'month' => $this->getNextMonth()))?>";
		var prevMonthButtonUrl = "<?=$this->createUrl('/calendar/default/ajax', array(
				'year' => $this->getPrevMonthsYear(),
				'month' => $this->getPrevMonth()))?>";
		var content = $(".calendarWrap");
				
				

		function update(url) {
			content.load(url)
		}
		
		nextMonthButton.click(function () {
			update(nextMonthButtonUrl)
		});
		prevMonthButton.click(function() {
			update(prevMonthButtonUrl)
		});
	});
</script>
</div>