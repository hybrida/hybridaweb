/*
	eScript v0.1
*/

/*
	global variables
*/
//shift or control is held down
var control = false;
var shift = false;
//splitter for response text from get.php, for the feed function;
var splitter = "¤¤";
//xmlHttpRequest object and queue hand
var xhr = new XHR();
//predefined elements
var body, wrapper;
//JS objects
var slideshows, polls, calenders, feeds, activeFeeds, commentFields, dropdowns;


/*
	script initiation
*/

function initiate() {
	//define elements
	body = gbtn("body")[0];
	
	//Object initiation
	slideshows = addAllElements( "slideshow", Slideshow );
	feeds = addAllElements( "feed", Feed );
	calenders = addAllElements( "calender", Calender );
	polls = addAllElements( "poll", Poll );
	if(gbid("activeSearchBox")) activeFeed = new ActiveFeed( gbid("activeSearchBox"), gbid("hintList") );
	signups = addAllElements( "signup", Signup );
	dropdowns = addAllElements( "dropdown", Dropdown );
	commentFields = addAllElements( "commentfield", CommentField );

}
window.onload = initiate;

function addAllElements(elementNames, Object) {
	var array = [];
	var elements = gbtn( elementNames );
	for( var i = 0; i < elements.length; i++ ) {
		array.push( new Object( elements[i] ) );
	}
	return array;
}


/*
	main functions
*/

//choose/make new album
function AlbumChooser( element ) {
	var chooser, newAlbumform, current;
	
	this.build = function() {
		current = this;
		xhr.request( this, "db=albumList" );
		
		var form = create( "form" );
		chooser = create( "select" );
		this.newAlbum = create( "input" );
		this.newAlbum.setAttribute("type", "button");
		this.newAlbum.setAttribute("value", "Lag nytt album");
		this.newAlbum.onclick = function() {
			this.setAttribute("disabled", "disabled");
		
			var title, submit;
			newAlbumForm = create( "form" );
			title = create( "input" );
			submit = create( "input" );
			
			title.setAttribute("type", "text");
			title.setAttribute("name", "title");
			submit.setAttribute("type", "submit");
			submit.setAttribute("value", "Opprett!");
			submit.onclick = function() {
				var formData = new FormData(newAlbumForm);
				formData.append("type", "newAlbum");
				xhr.send( null, formData );
				xhr.request( current, "db=albumList" );
				element.removeChild(newAlbumForm);
				current.newAlbum.removeAttribute("disabled");
				return false;
			}
			
			newAlbumForm.appendChild(title);
			newAlbumForm.appendChild(submit);
			element.appendChild(newAlbumForm);
			return false;
		}
		form.appendChild(chooser);
		form.appendChild(this.newAlbum);
		element.appendChild(form);
	}
	this.setRequestResult = function( text ) {
		var albums = text.split( splitter );
		chooser.innerHTML = "";
		console.log("here");
		for( var i = 0; i < albums.length-1; i+=2 ) {
			console.log( albums[i+1] );
			var newOption = create("option");
			newOption.setAttribute("value", albums[i]);
			newOption.innerHTML = albums[i+1];
			chooser.appendChild(newOption);
		}
	}
	this.build();
}

//comment field
function CommentField( element ) {
	var submit, feed, current;
	this.build = function() {
		current = this;
		var form, textarea, feedElement, id;
		id = getAttribute(element, "data-id", "null");
		
		form = create("form");
		textarea = create("textarea");
		textarea.setAttribute("name", "content");
		submit = create("input");
		form.appendChild(textarea);
		form.appendChild(submit);
		
		submit.setAttribute("type", "submit");
		submit.setAttribute("value", "post");
		submit.onclick = function() {
				if( !(textarea.value == "") ) {
				var formData = new FormData(form);
				formData.append("type", "comment");
				formData.append("kind", "profile");
				formData.append("id", id);
				xhr.send( current, formData );
				textarea.value = "";
			}
			return false;
		}
		
		feedElement = create("feed");
		feedElement.setAttribute("data-type", "profile");
		feedElement.setAttribute("data-id", id);
		feedElement.setAttribute("class", "comments");
		feed = new Feed( feedElement );
		
		element.appendChild( form );
		element.appendChild( feedElement );
	}
	this.setRequestResult = function() {
		feed.update();
	}
	this.build();
}

//image uploader
function FileUploader() {
	var dialog = new Dialog( body );
	element = dialog.getElement();
	dialog.show();

	var imagePreview = create("div");
	var progressBar = create("div");
	var submit;
	var fileChoose;
	var imageList;
	
	this.build = function() {
		var formDiv = create("div");
		formDiv.setAttribute("class", "imageUploaderForm");
		imagePreview.setAttribute("class", "imagePreview");
		
		var albumChooser = create( "div" );
		
		progressBar.setAttribute("class", "progressBar");

		formDiv.innerHTML = "<form><table><tr><td><input /></td></tr><tr><td><input /></td></tr></table></form><div>klikk på bilder for å fjerne, fikser noe snasne ikoner etter hvert. ytteligere CSS kan noen andre kose seg med. Ellers ta det med ro med hva slags bilder dere laster opp, aner ikke hva ntnus regler er... Det er også noe skit med ajax slik at den ikke alltid lastes, bare refresh intil videre, fikser det snart</div>";
		var inputs = formDiv.getElementsByTagName("input");
		submit = inputs[0];
		submit.setAttribute( "type", "submit" );
		submit.setAttribute( "value", "last opp!" );
		checkImageCount();
		submit.parent = this;
		submit.onclick = function() {
			this.parent.upload();
			return false;
		}
		fileChoose = inputs[1];
		fileChoose.setAttribute( "type", "file" );
		fileChoose.setAttribute( "multiple", "multiple" );
		fileChoose.parent = this;
		fileChoose.onchange = function() {
			this.parent.addFiles( this.files );
		}
		element.appendChild( formDiv );
		element.appendChild( albumChooser );
		new AlbumChooser( albumChooser );
		element.appendChild( progressBar );
		element.appendChild( imagePreview );
	}

	this.upload = function() {
		var formData = new FormData();
		formData.append("type", "imageUpload");
		for( var i = 0; i < imageList.length; i++ ) {
			formData.append( "images[]", imageList[i].file );
		}
		xhr.send( this, formData );
	}
	this.setProgress = function( percent ) {
		progressBar.style.width = (percent/100 * 778) + "px";
		progressBar.innerHTML = percent + "%";
		if( percent == 100 ) {
			dialog.hide();
		}
	}
	this.addFiles = function(files) {
		for( var i = 0; i < files.length; i++ ) {
			loadImage( this, files[i] );
		}
	}
	var checkImageCount = function() {
		imageList = imagePreview.getElementsByTagName("img");
		var count = imageList.length;
		if( submit.hasAttribute("disabled") && count > 0 ) {
			submit.removeAttribute("disabled");
		}
		if( count == 0 ) {
			submit.setAttribute("disabled", "disabled");
		}
	}
	this.setResult = function( image ) {
		image.onclick = function() {
			this.parentNode.removeChild(this);
			checkImageCount();
		}
		imagePreview.appendChild( image );
		checkImageCount();
	}
	this.build();
}
function loadImage( source, file ) {
	var img = create("img");
	var reader = new FileReader();
	reader.source = source;
	reader.file = file;
	reader.onload = function() {
		var img = create("img");
		img.setAttribute( "src", this.result );
		img.file = file;
		this.source.setResult( img );
	}
	reader.readAsDataURL( file );
}

//dropdown
function Dropdown( element ) {
	var collapsed = false;
	var current = this;
	var content, image;
	this.build = function() {		
		var head;
		head = create("a");
		image = create("img");
		content = create("div");
		
		content.innerHTML = element.innerHTML;
		removeAll( element );
		head.innerHTML = getAttribute( element, "data-text", "dropdown" );
		
		image.setAttribute("src", "images/icons/dropdown_right.png");
		head.appendChild( image );
		
		head.setAttribute("href", "#");
		head.onclick = function() {
			toggle();
			return false;
		}
		element.appendChild( head );
		element.appendChild( content );
		toggle();
	}
	var toggle = function() {
		console.log("Here");
		if( collapsed ) {
			image.setAttribute("src", "images/icons/dropdown_down.png");
			content.style.display = "block";
			collapsed = false;
		} else {
			image.setAttribute("src", "images/icons/dropdown_right.png");
			content.style.display = "none";
			collapsed = true;
		}
	}
	this.build();
}

//signup
function Signup( element ) {
	var current, id, signup;
	
	this.build = function() {
		current = this;
		id = getAttribute(element, "data-id", null);
		xhr.request( this, "db=signup&id="+id );
	}
	this.setRequestResult = function( text ) {
		element.innerHTML = text;
		var form = element.getElementsByTagName("form")[0];
		var signType = getAttribute(form, "data-sign_type", "on");
		form.submit.onclick = function() {
			var formData = new FormData( form );
			formData.append( "type", "signup" );
			formData.append( "id", id );
			formData.append( "signType", signType );
			xhr.send( null, formData );
			this.setAttribute("disabled", "disabled");
			current.build();
			return false;
		}
	}
	this.build();
}

//slideshow
function Slideshow( element ) {
	var current = this;
	var currentSlide = 0;
	var slideWidth = element.getAttribute("data-width");
	var win = document.createElement("div");
	win.style.height = element.getAttribute("data-height");
	win.style.width = slideWidth;
	var slides = document.createElement("div");
	win.appendChild( slides );
	element.appendChild( win );
	
	xhr.request( this, "db=slideshow&id=" + element.getAttribute("data-id") );

	this.setRequestResult = function( text ) {
		var response = text.split( splitter );
		var left = 0;
		
		for( var i = 0; i < response.length-1; i+=2 ) {
			var container = create("div");
			var image = create("img");
			var textContainer = create("div");
			var text = create("p");
			
			
			image.src = response[i];
			text.innerHTML = response[i+1];
			
			container.appendChild( image );
			textContainer.appendChild( text );
			container.appendChild( textContainer );	
			
			slides.appendChild( container );
			
			container.style.left = left + "px";
			left += container.offsetWidth;
		}
	}
	this.gotoSlide = function( index ) {
		start = currentSlide * slideWidth;
		stop = index * slideWidth;
		currentSlide = index;
		steps = 40;
		var ease = easeMovement( start, stop, steps );
		for( var i = 0; i < steps; i++ ) {
			new slideMove( -ease[i], 20*i );
		}
	}
	var slideMove = function( move, delay ) {
		setTimeout( function() {
			slides.style.left = move + "px";
		}, delay);
	}
	var gotoNextSlide = function() {
		var nextSlide = currentSlide+1;
		if( nextSlide >= slides.childNodes.length ) nextSlide = 0;
		current.gotoSlide( nextSlide );
	}

	setInterval( function() {
		gotoNextSlide();
	}, 7000);
}
function move(element, move) {
	element.style.left = move + "px";
}

//poll
function Poll( element ) {
	var id, current;
	this.build = function() {
		current = this;
		id = element.getAttribute("data-id");
		removeAll( element );
		xhr.request( this, "db=poll&id=" + id );
	}
	this.setRequestResult = function( text ) {
		element.innerHTML = text;
		var form = element.getElementsByTagName("form")[0];
		if( form ) {
			form.submit.onclick = function() {
				var formData = new FormData( form );
				formData.append( "type", "pollVote" );
				formData.append( "pollId", id );
				xhr.send( null, formData );
				this.setAttribute("disabled", "disabled");
				current.build();
				return false;
			}
		}
	}
	this.build();
}

//calender
function Calender( element ) {
	var backButton = null;
	var month = null;
	var nextButton = null;
	var calender = [];
	var lastRow = null;
	
	this.build = function() {
		var backIcon = getAttribute( element, "data-back-icon", "images/icons/calender_back.png" );
		var nextIcon = getAttribute( element, "data-next-icon", "images/icons/calender_forward.png" );
		var table = create( "table" );
		var row = create( "tr" );
		
		var cell = create( "td" );
		backButton = create( "img" );
		backButton.setAttribute("src", backIcon);
		cell.appendChild( backButton );
		row.appendChild( cell );
		
		month = create( "td" );
		month.setAttribute("colspan", 5);
		row.appendChild( month );
		
		cell = create( "td" );
		nextButton = create( "img" );
		nextButton.setAttribute("src", nextIcon);
		cell.appendChild( nextButton );
		row.appendChild( cell );

		table.appendChild( row );


		row = create( "tr" );
		var days = ["M", "T", "O", "T", "F", "L", "S"];
		for(var i = 0; i < 7; i++) { 
			cell = create("td");
			cell.innerHTML = days[i];
			row.appendChild( cell );
		}
		table.appendChild( row );

		for( var i = 0; i < 6; i++ ) {
			row = create( "tr" );
			for( var j = 0; j < 7; j++ ) {
				cell = create("td");
				calender[calender.length] = cell;
				row.appendChild( cell );
			}
			table.appendChild( row );
		}
		lastRow = row;
		element.appendChild( table );
	}
	this.build();
	
	backButton.father = this;
	nextButton.father = this;
	backButton.onclick = function() { this.father.changeMonth(-1); return false; }
	nextButton.onclick = function() { this.father.changeMonth(1); return false; }
	
	var months = ["Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktovber", "November", "Desember"];
	
	var currentTime = new Date();
	var displayMonth = currentTime.getMonth();
	var displayYear = currentTime.getFullYear();	

	this.changeMonth = function(add) {
		displayMonth += add;
		if( displayMonth >= months.length ) {
			displayMonth = 0;
			displayYear++;
		} else if( displayMonth < 0 ) {
			displayMonth = months.length -1;
			displayYear--;
		}
		month.innerHTML = months[displayMonth] + " " + displayYear;
		
		xhr.request( this, "db=calender&year=" + displayYear + "&month=" + (displayMonth +1) );
	}
	
	this.setRequestResult = function( responseText ) {
		response = responseText.split( splitter );
		if( response.length == 35 ) lastRow.style.display = "none";
		else lastRow.style.display = "table-row";
		for( var i = 0; i < response.length; i++ ) {
			calender[i].innerHTML = response[i];
		}
	}
	this.changeMonth(0);
}

//feed class for feed from database
function Feed( element ) {
	var title = getAttribute(element, "data-title", "");
	if( title != "" ) {
		var header = create("h1");
		header.innerHTML = title;
		element.appendChild(header);
	}
	var showMoreButton = getAttribute(element, "data-more_button", true);
	var currentAmmountShown = 0
	var type = element.getAttribute("data-type");
	var interval = getAttribute(element, "data-interval", 10);
	var id = element.getAttribute("data-id");
	id = (id ? "&id=" + id : "");
	var moreButton = null;
	
	this.addMoreItems = function( ) {
		xhr.request( this, "db=" + type + id + "&s=" + currentAmmountShown + "&l="+ interval );
	}
	this.setRequestResult = function( text ) {
		if( moreButton ) element.removeChild( moreButton );
		var response = text.split( splitter );
		for( var i = 0; i < response.length; i++ ) {
			if(response[i] == "") continue;
			var newElement = document.createElement("div");
			newElement.setAttribute("class", "container");
			newElement.innerHTML = response[i];
			element.appendChild( newElement );
			currentAmmountShown++;
		}
		if( showMoreButton ) {
			moreButton = document.createElement("a");
			moreButton.setAttribute("href", "#");
			moreButton.innerHTML = "(vis mer)";
			moreButton.parent = this;
			moreButton.onclick = function() { this.parent.addMoreItems(); return false; }
			element.appendChild( moreButton );
		}
	}
	this.update = function() {
		element.innerHTML = "";
		currentAmmountShown = 0;
		moreButton = false;
		this.addMoreItems();
	}
	this.addMoreItems();
}

//active feed - feed subclass for continious updating
function ActiveFeed( element, listContainerElement ) {
	element.father = this;
	element.onkeypress = function(event) { if( event.keyCode == 13 ) return false; }
	element.onkeyup = function(event) { this.father.handleKeyStroke(event); }
	element.onblur = function() { listContainerElement.style.display = "none"; }
	element.onfocus = function() { if( elementList.length > 0 ) listContainerElement.style.display = "block"; }
	element.setAttribute("autocomplete", "off");
	
	listContainerElement.style.display = "none";
	
	var elementList = new Array();
	var currentElement = 0;
	var maxListLength = element.getAttribute("data-max_length");
	if( !maxListLength ) maxListLength = 10;
	
	this.handleKeyStroke = function(event) {
		if( event.keyCode == 38 ) {
			this.setCurrentElement( currentElement - 1);
		} else if( event.keyCode == 40 ) {
			this.setCurrentElement( currentElement + 1);
		} else if( event.keyCode == 13 ) {
			this.enterPress();
		} else if( event.keyCode == 27 ) {
			element.value = "";
			this.clearElementList();
		} else {
			this.search();
		}
	}
	
	this.enterPress = function() {
		if( currentElement < elementList.length ) {
			window.location = elementList[currentElement].getElementsByTagName("a")[0].href;
		} else {
			window.location = "?site=search";
		}
	}
	
	this.search = function() {
		if( element.value == "" ) {
			this.clearElementList();
		} else {
			xhr.request( this, "db=all&q=" + element.value + "&l=" + maxListLength );
		}
	}
	
	this.clearElementList = function() {
		listContainerElement.style.display = "none";
		for( var i = 0; i < elementList.length; i++ ) {
			listContainerElement.removeChild( elementList[i] );
		}
		elementList = new Array();
	}
	
	this.setRequestResult = function( text ) {
		response = text.split( splitter );
		iterate = (elementList.length > response.length) ? elementList.length : response.length;
		for( var i = 0; i < iterate; i++ ) {
			if( i < response.length && response[i] != "" ) {
				if( elementList[i] ) {
					elementList[i].innerHTML = response[i];
				} else {
					var newElement = document.createElement("li");
					elementList[i] = newElement;
					newElement.setAttribute("onmouseover", "setCurrentElement( " + i + " );" );
					newElement.innerHTML = response[i];
					listContainerElement.appendChild( newElement );
				}
			} else {
				if( elementList[i] ) {
					listContainerElement.removeChild( elementList[i] );
					elementList[i] = undefined;
				}
			}
		}
		
		if( listContainerElement.style.display == "none" && elementList.length > 0 ) listContainerElement.style.display = "block";
		elementList.splice(response.length, iterate-response.length);
		this.setCurrentElement(0);
	}
	
	this.setCurrentElement = function( curr ) {
		if( curr > elementList.length ) curr = 0;
		else if( curr < 0 ) curr = elementList.length;
		currentElement = curr;
		
		for( var i = 0; i < elementList.length; i++ ) {
			elementList[i].className = (i == currentElement) ? "highlight" : "";
		}
	}
}

//Dialog popup class
function Dialog( element ) {
	var wrapper = create("div");
	var shadow = create("div");
	var dialog = create("div");
	var exit = create("a");
	exit.parent = this;
	
	exit.setAttribute( "href", "#" );
	exit.setAttribute( "class", "exit_button" );
	exit.onclick = function() { this.parent.hide(); return false; }
	exit.innerHTML = "<img src='images/icons/dialog_exit.png' />";
	dialog.appendChild( exit );
	dialog.setAttribute( "class", "dialog" );
	shadow.setAttribute( "class", "shadow" );
	shadow.appendChild( dialog );
	wrapper.setAttribute( "class", "wrapper" );
	wrapper.appendChild( shadow );
	element.appendChild( wrapper );
	
	this.setContent = function( type, variables ) {
		var string = "";
		for( var i = 0; i < variables.length; i++ ) {
			string += "&" + variables[i];
		}
		xhr.request( this, "db=" + type + string );
	}
	this.getElement = function() {
		return dialog;
	}
	this.setRequestResult = function( text ) {
		dialog.innerHTML = text;
		dialog.appendChild( exit );
		this.show();
	}
	this.show = function() {
		shadow.style.display = "block";
	}
	this.hide = function() {
		shadow.style.display = "none";
	}
}

//Konami listener
function KonamiListener( element ) {
	var sequence = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];
	var current = 0;
	element.onkeyup = function() {
		if( event.keyCode == sequence[current] ) {
			current++;
			if( current == sequence.length ) {
				setInterval( function() {
					console.log("konami");
					var image = create("img");
					var x = Math.floor(Math.random()*(window.innerWidth + image.width) ) - image.width/2;
					var y = Math.floor(Math.random()*(window.innerHeight + image.height) ) - image.height/2;
					image.setAttribute("src", "images/unicorn.png");
					image.style.position = "absolute";
					image.style.top = y + "px";
					image.style.left = x + "px";
					element.appendChild( image );
				}, 400);
			}
		
		} else {
			current = 0;
		}
	}
}


/*
	Prototypes - added functions
*/


/*
	Utilities - helping functions
*/

//queue system for xmlHTTP requests
function XHR() {
	var queue = [];
	var currentRequest = null;
	var xmlhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	
	//GET
	this.request = function( source, data ) {
		queue.push( new request( data, source, 1 ) );
		handleNextRequest();
	}
	//POST
	this.send = function( source, data ) {
		queue.push( new request( data, source, 2 ) );
		handleNextRequest();
	}
	var handleNextRequest = function() {
		if( (xmlhttp.readyState==4 || xmlhttp.readyState==0) && (xmlhttp.status==200 || xmlhttp.status==0) && queue.length > 0 ) {
			currentRequest = queue.shift();
			if( currentRequest.type == 1 ) {
				xmlhttp.open( "GET", "php/get.php?" + currentRequest.data );
				xmlhttp.send( null );
			} else {
				xmlhttp.open( "POST", "php/post.php" );
				xmlhttp.send( currentRequest.data );
				if( currentRequest.source ) {
					if( currentRequest.source.setProgress ) {
						console.log("here");
						xmlhttp.upload.onprogress = function(e) {
								console.log("lal");
							if (e.lengthComputable) {
								var percentage = Math.round((e.loaded * 100) / e.total);
								currentRequest.source.setProgress( percentage );
							}
						}
					}
				}
			}
		}
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			if( currentRequest.source ) if( currentRequest.source.setRequestResult ) currentRequest.source.setRequestResult( xmlhttp.responseText );
			xmlhttp.upload.onprogress = null;
			handleNextRequest();
		}
	}
}
function request( data, source, type ) {
	this.data = data;
	this.source = source;
	this.type = type;
}

//quick function for hide and show elements
function hide( element ) {
	element.style.display = "none";
}
function show( element ) {
	element.style.display = "block";
}

//document.getElementById - gbid
function gbid( id ) {	
	return document.getElementById( id );
}
//document.getElementsByTagName - gbtn
function gbtn( tagName) {
	return document.getElementsByTagName( tagName );
}
//document.createElement - create
function create( type ) {
	return document.createElement( type );
}
//delete all children of an element
function removeAll( element ) {
	element.innerHTML = "";
}
//get attribute, or set standard
function getAttribute( element, attribute, standard ) {
	var ret = element.getAttribute( attribute );
	if( !ret ) return standard;
	else if( ret == "false" ) return false;
	else if( ret == "true" ) return true;
	else return ret;
}
//ease movemenet, ease in and out
function easeMovement(start, stop, steps) {
	var ret = [];
	for(var i = 0; i < steps; i++) {
		var a = i/steps;
		ret[i] = Math.round(start+(stop-start)*((6*a*a - 15*a + 10)*a*a*a));
	}
	return ret;
}
//pushChild
function pushChild( element, child ) {
	var children = element.getElementsByTagName("*");
	console.log(children);
	removeAll( element );
	element.appendChild( child );
	for( var i = 0; i < children.length; i++ ) {
		element.appendChild( children[i] );
	}
}


