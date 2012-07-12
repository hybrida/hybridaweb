<?php
$deleteUrl = $this->createUrl('delete', array('id' => ''));
?>
<script language="javascript">
	
	function del (id, element, callback){
		var url = '<?= $deleteUrl ?>/' + id;
		var row = element.parentNode.parentNode;
		row.parentNode.removeChild(row);
		
		$.ajax({
			'url' : url
		}).done(function(data) {
			callback();
		});
	}
	
	function go (id, element, url) {
		del(id, element, function() {
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
				<?=
				Html::link($notification->changedByUser->fullName, array(
					$notification->changedByUser->viewUrl
				))
				?>
			</div>
			<div class="statusMessage">
				<?= $notification->message ?>
			</div>
			<div class="link">
				<a href="#"onclick="js:go(<?= $notification->id ?>, this, '<?= $notification->viewUrl ?>')">
					<?= $notification->title ?>
				</a>
			</div>
			<div class="delete">
				<a href="#" onclick="js:del(<?= $notification->id ?>, this, function(){})">
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
				<?=
				Html::link($notification->changedByUser->fullName, array(
					$notification->changedByUser->viewUrl
				))
				?>
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


