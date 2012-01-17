var inDuration = 300;
var outDuration = 350;

var defaultLinkBackgroundColor = "rgb(0, 73, 147)";
var hoverLinkBackgroundColor = "black";

$('document').ready(function(){
    
    $('.button').hover(function(){
        // Stop previous animations in and out.
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