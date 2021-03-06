<div class="accessWrapper<?=$this->id?>">
	<div class="accessField unique<?=$this->id?>">

	<? for ($sub = 0; $sub < $subs; $sub++): ?>
		<?php
			$this->render('accessField/_field', array(
				'sub' => $sub,
			));
		?>
	<? endfor ?>

	</div>

	<label>Tilgang</label>
	<?=
	CHtml::button('Legg til nytt tilgangsfelt', array(
		'class' => "g-button fetchNewAccessBlock{$this->id}",
	))
	?>

	<a class="g-button" style="font-weight: bold" href="/artikler/96/Guide+til+tilgangsrettigheter">?</a>

	<script type="text/javascript">
		var sub = <?=$this->sub?>;
		$(".fetchNewAccessBlock<?=$this->id?>").click(function(){

			$.ajax({
				success: function(html){
					$(".unique<?=$this->id?>").append(html);
					sub ++;
				},
				type: 'get',
				url: '<?=app()->createUrl('ajax/get/getAccessBlock', array(
					'name' => $this->name,
					'id' => $this->id,
					'sub' => '',
					))?>' + sub,
				cache: false,
				dataType: 'html'
			});
	});
	</script>

</div>