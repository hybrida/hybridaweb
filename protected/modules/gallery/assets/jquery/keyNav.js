$(document).keydown(function(event)
{
	var key = event.keyCode || event.which;
	if (key === 37)
	{
		$("#prev").get(0).click();
		return false;  
	}
	if (key === 39) 
	{
		$("#next").get(0).click();
		return false;
	}
});
