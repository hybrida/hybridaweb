<?php
$deleteUrl = $this->createUrl('delete', array('ids' => ''));
?>
<script language="javascript">

	function del (ids, element, fun){
		if (fun === undefined) {
			fun = function(){};
		}
		var url = '<?= $deleteUrl ?>/' + ids;
		var row = element.parentNode.parentNode;
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
			<div class="date">
				<?= Html::dateToString($notification->timestamp, 'd. F H:i') ?>
			</div>
			<div class="changedByAuthor">
				<?= $notification->changedByUserHtml ?>
			</div>
			<div class="statusMessage">
				<?= $notification->message ?>
			</div>
			<div class="link">
				<a href="#" onclick="js:go('<?= $notification->ids ?>', this, '<?= $notification->viewUrl ?>')">
					<?= $notification->title ?>
				</a>
			</div>
			<div class="delete">
				<a href="#" class="g-deleteButton" onclick="js:del('<?= $notification->ids ?>', this)">
					X
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
			<div class="date">
				<?= Html::dateToString($notification->timestamp, 'd. F H:i') ?>
			</div>
			<div class="changedByAuthor">
				<?= $notification->changedByUserHtml ?>
			</div>
			<div class="statusMessage">kommenterte på</div>
			<div class="link">
				<a href="<?= $notification->viewUrl ?>">
					<?= $notification->title ?>
				</a>
			</div>
		</div>
	<? endforeach; ?>

	<? if (empty($read)): ?>
		Ingen varslinger
	<? endif; ?>
</div>


