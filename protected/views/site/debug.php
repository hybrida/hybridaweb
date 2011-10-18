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

		$user = new User;
		$user->member = false;
		$user->username = "fredrik";
		$user->firstName = "Geir";
		$user->lastName = "Hjelstend";
		$user->save();
		
		?>
<h3>id: <?=$user->id?></h3>
</pre>