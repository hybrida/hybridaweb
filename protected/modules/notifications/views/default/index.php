<h1>Varslinger</h1>

<pre>
<? foreach ($notifications as $notification): ?>
	<?= print_r($notification->attributes, true) ?>
<? endforeach; ?>
</pre>