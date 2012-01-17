var inDuration = 200;
var outDuration = 300;

var defaultLinkBackgroundColor = "rgb(0, 73, 147)";
var hoverLinkBackgroundColor = "black";

$('document').ready(function(){
    
    $('.button').hover(function(){
        $(this).animate(
            {backgroundColor: hoverLinkBackgroundColor}, inDuration);
    }, function(){
        $(this).animate(
        {backgroundColor: defaultLinkBackgroundColor}, outDuration);
    });
    
});