var inDuration = 350;
var outDuration = 150;

// var defaultLinkBackgroundColor = "rgb(0, 73, 147)"; -- Mork blaa
var defaultLinkBackgroundColor = "rgb(0, 98, 196)"
var hoverLinkBackgroundColor = "black";

$('document').ready(function(){
    $('.button').hover(function(){
        // Prevents stacking of animations, max two are added each time 
        $(this).stop().stop();
        
        $(this).animate(
            {
                backgroundColor: hoverLinkBackgroundColor
            }
            , inDuration);
    }, function(){
        $(this).animate(
            {
                backgroundColor: defaultLinkBackgroundColor
            }
            , outDuration);
    });
    
    $('.button').css({textDecoration: "underline"});
    
});