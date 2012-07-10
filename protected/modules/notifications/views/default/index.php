<h1>Varslinger</h1>


<script language="javascript">
	function del (id, element){
		var url = '<?= $this->createUrl('delete', array('id' => ''))?>/' + id;
		console.log(url);
		var row = element.parentNode.parentNode;
		row.parentNode.removeChild(row);
		
		$.ajax({
			'url' : url
		});
	}
</script>

<div class="notificatonIndex">
	<table>
		<tr>
			<th></th>
			<th>Dato</th>
			<th>Lenke</th>
			<th>Melding</th>
		</tr>
		<? foreach ($notifications as $notification): ?>
			<tr>
				<td><a href="#" class="button" onclick="js:del(<?= $notification->id ?>, this)">Slett</a></td>
				<td><?= $notification->timestamp ?></td>
				<td><a href="<?= $notification->viewUrl ?>" class="button">Lenke</a></td>
				<td><?= $notification->message ?></td>
			</tr>
		<? endforeach; ?>
	</table>
</div>



