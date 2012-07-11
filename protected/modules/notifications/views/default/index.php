<h1>Varslinger</h1>


<script language="javascript">
	
	function del (id, element, callback){
		var url = '<?= $this->createUrl('delete', array('id' => ''))?>/' + id;
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

<div class="notificatonIndex">
	<table id="notificationTable">
		<? foreach ($notifications as $notification): ?>
				<td><a href="#" class="button"onclick="js:del(<?= $notification->id ?>, this, function(){})">Merk som lest</a></td>
				<td><a href="#" class="button"onclick="js:go(<?= $notification->id ?>, this, '<?= $notification->viewUrl ?>')">Link</a></td>
				<td><?= Html::dateToString($notification->timestamp, 'medium') ?></td>
				<td><?= $notification->message ?></td>
				<td><strong>Fra:</strong> <?= $notification->changedByUser->fullname ?></td>
			</tr>
		<? endforeach; ?>
	</table>
	
	<? if (empty($notifications)): ?>
		Ingen varslinger
	<? endif; ?>
</div>



