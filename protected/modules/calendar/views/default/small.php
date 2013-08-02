<div class="calendar-widget-wrapper">

<table class="calendar small">
	<thead>
		<tr class="navigation">
				<th class="prev-month">
					<?= CHtml::link("<<", "#", array(
							'class' => 'calendar-previous-month-button'
						)) ?>
				</th>
			<th colspan="5" class="current-month"><?php echo $calendar->month() ?> <?php echo $calendar->year ?></th>
				<th class="next-month">
					<?= CHtml::link(">>", "#", array(
							'class' => 'calendar-next-month-button'
						)) ?></th>
		</tr>
		<tr class="weekdays">
			<?php foreach ($calendar->days(1) as $day): ?>
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
					$output  = '';

					if (is_array($data)) {
						$classes = $data['classes'];
						$title   = $data['title'];
						$output  = $data['output'];
					}
					if (! $current) {
						$classes[] = "no-date";
					}
					?>
					<td class="day <?php echo implode(' ', $classes) ?>">
						<span class="date" title="<?php echo implode(' / ', $title) ?>">
							<? if (!$current): ?>
							<? elseif ( ! empty($output)): ?>
								<a href="<?= $output[0] ?>" class="view-events"><?php echo $number ?></a>
							<?php else: ?>
								<?php echo $number ?>
							<?php endif ?>
						</span>
					</td>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<script language="javascript">
	$(function() {
		var nextMonthButton = $(".calendar-next-month-button");
		var prevMonthButton = $(".calendar-previous-month-button");

		var nextMonthButtonUrl = "<?=$this->createUrl('/calendar/default/widgetAjax', array(
				'year' => $this->getNextMonthsYear(),
				'month' => $this->getNextMonth()))?>";
		var prevMonthButtonUrl = "<?=$this->createUrl('/calendar/default/widgetAjax', array(
				'year' => $this->getPrevMonthsYear(),
				'month' => $this->getPrevMonth()))?>";
		var content = $(".calendar-widget-wrapper");



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
