var sidebarWidth = 230;
var headerHeight = 90;
var pageMin = 800;
var pageMax = 1200;

window.onresize = function () {
	setSidebarHeight();
	setSidebarPos();
}

function setSidebarHeight() {
	document.getElementById("rightBar").style.height = (window.innerHeight-headerHeight) + "px";
}

function setSidebarPos(){
	var leftValue = 0;
	var width = window.innerWidth;
	if (width < pageMax) {
		leftValue = pageMin - sidebarWidth;
	}
	else if (width > pageMax) {
		leftValue = (width-pageMax)/2+pageMax-sidebarWidth;
	}
	else {
		width-sidebarWidth;
	}
	document.getElementById("rightBar").style.left = leftValue + "px";
}