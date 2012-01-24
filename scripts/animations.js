var inDuration = 'fast';
var outDuration = 'medium';

// var defaultLinkBackgroundColor = "rgb(0, 73, 147)"; -- Mork blaa
var defaultLinkBackgroundColor = "rgb(0, 98, 196)"
var hoverLinkBackgroundColor = "black";

$('document').ready(function(){
    $('.button').hover(function(){
		$(this).css({
				'cursor': 'pointer'
			});
		
        // Prevents stacking of animations, max two are added each time 
        $(this).stop().stop();
        
        $(this).animate(
            {
                backgroundColor: hoverLinkBackgroundColor
            },
			inDuration,
			'easeInOutSine'
		);
    }, function(){		
        $(this).animate(
            {
                backgroundColor: defaultLinkBackgroundColor
            },
			outDuration,
			'easeInOutSine'
		);
    });
    
    $('.button').css({textDecoration: "underline"});
    
});