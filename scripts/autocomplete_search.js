$(document).ready(function() {
    var options = [
        "XKCD",
        "WastedTalent",
        "Anantech",
        "Some site",
        "Some awesome site"
    ];
    
    $(".search input").autocomplete({
        source: options
    });
});