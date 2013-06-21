<?php
$deleteUrl = $this->createUrl('delete', array('ids' => ''));
?>
<script language="javascript">

	function del (ids, element, fun){
		if (fun === undefined) {
			fun = function(){};
		}
		var url = '<?= $deleteUrl ?>/' + ids;

		var row = element;
		while (row.className != "row") {
			row = row.parentNode;
		}
		row.parentNode.removeChild(row);

		$.ajax({
			'url' : url
		}).done(function(data) {
			fun();
		});
	}

	function go (ids, element, url) {
		del(ids, element, function() {
			window.location = url;
		});
	}
</script>

<div class="notificationIndex">
	<h1>Ulest</h1>

	<? foreach ($unread as $notification): ?>
		<div class="row">
			<div class="top">
				<div class="date">
					<?= Html::dateToString($notification->timestamp, 'd. F H:i') ?>
				</div>
				<div class="delete">
					<a href="#" class="g-deleteButton" onclick="js:del('<?= $notification->ids ?>', this)">
						x
					</a>
				</div>
			</div>

			<div class="content">
				<?= $notification->changedByUserHtml ?>
				<?= $notification->message ?>
				<a href="#" onclick="js:go('<?= $notification->ids ?>', this, '<?= $notification->viewUrl ?>')">
					<?= $notification->title ?>
				</a>
			</div>
		</div>
	<? endforeach; ?>

	<? if (empty($unread)): ?>
		Ingen varslinger
	<? endif; ?>

	<h1>Lest</h1>

	<? foreach ($read as $notification): ?>
		<div class="row">
			<div class="top">
				<div class="date">
					<?= Html::dateToString($notification->timestamp, 'd. F H:i') ?>
				</div>
			</div>
			<div class="content">
				<?= $notification->changedByUserHtml ?>
				<?= $notification->message ?>
				<a href="<?= $notification->getViewUrlNoFlash() ?>">
					<?= $notification->title ?>
				</a>
			</div>
		</div>
	<? endforeach; ?>

	<? if (empty($read)): ?>
		Ingen varslinger
	<? endif; ?>
</div>


