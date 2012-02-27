<h2>Error:  <?php echo $code; ?></h2>
<div class="error">
	<?php echo CHtml::encode($message); ?>
</div>

<? if (user()->isGuest): ?>
	<p>Du må være logget inn for å se denne siden</p>
<? endif; ?>
