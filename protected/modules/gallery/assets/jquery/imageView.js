$(document).ready(function(){
	var url = location.href;
	var ids = url.split('/');
	window.albumID = ids[4];
	window.imageID = ids[5];

	ajaxrequest(imageID);
});
$('#delLink').click(function(e){
	e.preventDefault();
	r = confirm('Er du sikker på at du vil slette dette bildet?');
	if(r) {
		var  url = '/galleri/picdelete/' + albumID + "/" + imageID;
		var request =  get_XmlHttp();
		request.open("POST", url, true);
		request.send(null);
		request.onreadystatechange = function() {
			if (request.readyState == 4) {
				window.location.href = "/galleri/" + albumID;
			}
		}
	}
});
$('#image').click(function(e){
	e.preventDefault();
});
$('#next').click(function(e){
	e.preventDefault();
	if (window.nextID != -1)
		ajaxrequest(window.nextID);
});
$('#prev').click(function(e){
	e.preventDefault();
	if (window.prevID != -1)
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
	var  url = '/galleri/ajax/' + window.albumID + "/" + pictureID;

	request.open("POST", url, true);
	request.send(null);

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			var string  = request.responseText;
			var skille = string.search("{\"albumID\"");
			var json = string.substr(skille);
			var comments = string.substr(0, skille);
			var data = JSON.parse(json);
			data.comments = comments;
			changeData(data);
			history.pushState('data', '','/galleri/' + albumID + "/" + pictureID);
		}
	}
}

function changeData(data) {
	albumID = data.albumID;
	imageID = data.imageID;
	nextID = data.nextID;
	prevID = data.prevID;
	$("#image").attr("src", data.bigURL);
	$("#fullLink").attr("href", data.fullURL);
	$("#counter").text("Bilde " + (data.index+1) + " av " + data.num);
	$("#timestamp").text(data.timestamp);	
	$("#userName").text(data.userName);	
	$("#comments").html(data.comments);
	if (nextID >= 0) {
		$("#next").attr("href", "/galleri/"+albumID+"/"+nextID);
		$("#next").attr("style", "");
		$("#noNext").attr("style", "display:none;");
	} else {
		$("#noNext").attr("style", "");
		$("#next").attr("style", "display:none;");
	}
	if (prevID >= 0) {
		$("#prev").attr("href", "/galleri/"+albumID+"/"+prevID);
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
