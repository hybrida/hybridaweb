$(document).ready(function(){
	console.log("Hello");
});
$('#delLink').click(function(e){
	e.preventDefault();
	r = confirm('Er du sikker på at du vil slette dette bildet?');
	if(r) {
		var  url = '/gallery/picdelete/' + albumID + "/" + imageID;
		var request =  get_XmlHttp();
		request.open("POST", url, true);
		request.send(null);
		window.location.href = "/gallery/" + albumID;
	}
});
$('#image').click(function(e){
	e.preventDefault();
	console.log("I clicked image");
});
$('#next').click(function(e){
	e.preventDefault();
	ajaxrequest(window.nextID);
});
$('#prev').click(function(e){
	e.preventDefault();
	ajaxrequest(window.prevID);
});

function get_XmlHttp() {
	if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	return xmlHttp;
}

function ajaxrequest(pictureID) {
	var request =  get_XmlHttp();
	var  url = '/gallery/ajax/' + albumID + "/" + pictureID;

	request.open("POST", url, true);
	request.send(null);

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			var data = JSON.parse(request.responseText);
			changeData(data);
			history.pushState('data', '','/gallery/' + albumID + "/" + pictureID);
		}
	}
}

function changeData(data) {
	imageID = data.imageID;
	nextID = data.nextID;
	prevID = data.prevID;
	$("#image").attr("src", data.bigURL);
	$("#fullLink").attr("href", data.fullURL);
	$("#counter").text("Bilde " + (data.index+1) + " av " + data.num);
	$("#timestamp").text(data.timestamp);	
	$("#userName").text(data.userName);	
	if (nextID >= 0) {
		$("#next").attr("href", "/gallery/"+albumID+"/"+nextID);
		$("#next").attr("style", "");
		$("#noNext").attr("style", "display:none;");
	} else {
		$("#noNext").attr("style", "");
		$("#next").attr("style", "display:none;");
	}
	if (prevID >= 0) {
		$("#prev").attr("href", "/gallery/"+albumID+"/"+prevID);
		$("#prev").attr("style", "");
		$("#noPrev").attr("style", "display:none;");
	} else {
		$("#noPrev").attr("style", "");
		$("#prev").attr("style", "display:none;");
	}
	if (eval(data.deleteAble)) {
		$("#delLink").attr("style", "");
	} else {
		$("#delLink").attr("style", "display:none");
	}
}
