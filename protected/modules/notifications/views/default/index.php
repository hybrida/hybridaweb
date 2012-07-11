<h1>Varslinger</h1>


<script language="javascript">
	
	function del (id, element, callback){
		var url = '<?= $this->createUrl('delete', array('id' => ''))?>/' + id;
		console.log(url);
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
		<tr>
			<th>Merk som lest</th>
			<th>Lenke</th>
			<th>Dato</th>
			<th>Melding</th>
			<th>Endret av </th>
		</tr>
		<? foreach ($notifications as $notification): ?>
			<tr>
				<td><a href="#" class="button"onclick="js:del(<?= $notification->id ?>, this, function(){})">Slett</a></td>
				<td><a href="#" class="button"onclick="js:go(<?= $notification->id ?>, this, '<?= $notification->viewUrl ?>')">Lenke</a></td>
				<td><?= $notification->timestamp ?></td>
				<td><?= $notification->message ?></td>
				<td><?= $notification->changedByUser->fullname ?></td>
			</tr>
		<? endforeach; ?>
	</table>
</div>



