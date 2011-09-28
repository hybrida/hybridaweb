<h4><?=$firstName." ".$middleName." ".$sirName?></h4>
<img class='block' src='php/image.php?id=<?=$imageId ?>&size=1' width='248px'>
<div class='barTitle'><?=$firstName?>s aktiviteter</div>
<div class='barText'>
	<feed class='eventFeed' data-type='event' data-interval='3' data-more_button='false' data-title='Kommende hendingar'></feed>
</div>