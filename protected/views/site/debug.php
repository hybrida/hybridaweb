<!-- bare for webutvikling -->
<h2>Info</h2>

<p><strong>UserName:</strong> <?= $username ?>
<p><strong>UserID:</strong> <?= $id ?>
<p><strong>Access:</strong> <pre><? print_r($access) ?></pre>

<? foreach ($_SESSION as $key => $value): ?>
<p><strong><?=$key?></strong> <?print_r($value);?>
<? endforeach;?>

<h2>Hardcore debugging</h2>
<pre>
	<?
		Access::deleteAccessRelation("event", 2);
		Access::insertAccessRelation(2, 4, "event");
		//echo PHP_EOL;
		print_r(Access::getAccessRelation(2, "event"));
		?>

</pre>