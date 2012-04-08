<div class="calendarWrap">
<div class="calendarData">
	<table class="big-calendar">
		<thead>
			<tr class="navigation">
				<th class="prev-month">
					<?= CHtml::link($calendar->prev_month(), "#", array(
							'class' => 'calendar-previous-month-button'
						)) ?>
					</th>
				<th colspan="5" class="current-month"><?php echo $calendar->month() ?></th>
				<th class="next-month">
					<?= CHtml::link($calendar->next_month(), "#", array(
							'class' => 'calendar-next-month-button'
						)) ?></th>
			</tr>
			<tr class="weekdays">
				<?php foreach ($calendar->days() as $day): ?>
					<th><?php echo $day ?></th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($calendar->weeks() as $week): ?>
				<tr>
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
							<span class="date" title="<?php echo implode(' / ', $title) ?>"><?php echo $number ?></span>
							<div class="day-content">
							<? if (!empty($output)): ?>
								<ul class="output">
								<? for ($i = 0; $i < count($title); $i++): ?>
									<li><a href="<?=$output[$i]?>"><?= $title[$i] ?></a></li>
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