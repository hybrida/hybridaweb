var sidebarWidth = 230;
var headerHeight = 90;
var pageMin = 800;
var pageMax = 1200;

$(window).resize(function () {
	setSidebarHeight();
	setSidebarPos();
});

function setSidebarHeight() {
	$(".sidebar").height($('document').documentElement.innerHeight-headerHeight;
}

function setSidebarPos(){
	var leftValue = 0;
	var width = $('document').documentElement.innerHeight;
	if (width < pageMax) {
		leftValue = pageMin - sidebarWidth;
	}
	else if (width > pageMax) {
		leftValue = (width-pageMax)/2+pageMax-sidebarWidth;
	}
	else {
		width-sidebarWidth;
	}
	$(".sidebar").left(leftvalue);
}