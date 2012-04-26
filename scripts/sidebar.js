var sidebarWidth = 230;
var pageMin = 800;
var pageMax = 1200;

$('window').onresize(function () {
	setSidebarHeight();
	setSidebarPos();
});

function setSidebarHeight() {
	$('document').getElementById("sidebar").style[height]=$('document').documentElement.innerHeight-90+"px";
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
	$('document').getElementById("sidebar").style[left]=leftvalue+"px";
}