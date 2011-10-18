console.log('start');
var url = "/yii/get/";
var split = '~%~';

function XHR() {
	var objects = [],
		nObjects = 10,
		queue = [],
		next,
		request;
	for(var i = 0; i < nObjects; i++) {
		objects[i] = null;
	}
	next = function() {
		if(queue.length > 0) {
			for(var i = 0; i < objects.length; i++) {
				if(objects[i] == null) {
					objects[i] = new XMLHttpRequest();
					var o = objects[i],
						request = queue.shift();
					for(var f in request.functions) o[f] = request.functions[f];
				for(var uf in request.uploadFunctions) o.upload[uf] = request.uploadFunctions[uf];
					for(var h in request.headers) o.setRequestHeader(h, request.headers[h]);
					o.addEventListener('load', function(){objects[i] = null; next();});
					o.open(request.type, request.url, true);
					o.send(request.data);
					break;
				}
			}
		}
	}
	request = function(req) {
		queue.push(req);
		next();
	}
	
	this.request = request;
}
xhr = new XHR();
xhr.request({
	'type':'GET',
	'url':'get.php?t=' + (Math.random()*10).toFixed(0)
});

function create(info) {
	var element = document.createElement(info.type);
	if(info.storeAs) info.storeAs.v = element;
	if(info.innerHTML) element.innerHTML = info.innerHTML;
	for(var a in info.attributes) element.setAttribute(a, info.attributes[a]);
	for(var c in info.children)	element.appendChild(create(info.children[c]));
	for(var f in info.functions) element.addEventListener(f, info.functions[f]);
	return element;
}

function Search(dn) {
	var start = 0,
		limit = 10,
		input = domtb.getFirstElementChild(dn),
		dropdown = domtb.getLastElementChild(dn),
		advanced,
		lastvalue = '',
		nodes = [];
	
	advanced = create({
		'type': 'li',
		'innerHTML': 'Avansert sok'
	});
	dropdown.appendChild(advanced);
	
	input.onblur = function() { dropdown.style.display = 'none'; }
	input.onfocus = function() { dropdown.style.display = 'block'; }

	input.onkeyup = function(e) {
		if(e.keyCode == 27) {
			for(var i = 0; i < limit; i++) {
				if(nodes[i] != null) {
					dropdown.removeChild(nodes[i]);
					nodes[i] = null;
				}
			}
			input.value = '';
		} else if(lastvalue != input.value) {
			xhr.request({
				'type': 'GET',
				'url': url+'search/?q=' + input.value,
				'functions': {
					'onload': function() {
						var response = this.responseText.split(split);
						for(var i = 0; i < limit; i++) {
							if(response[i]) {
								if(nodes[i] != null) {
									nodes[i].innerHTML = response[i]
								} else {
									var newNode = document.createElement('li');
									newNode.innerHTML = response[i];
									dropdown.insertBefore(newNode, advanced);
									nodes[i] = newNode;
								}
							} else {
								if(nodes[i] != null) {
									dropdown.removeChild(nodes[i]);
									nodes[i] = null;
								}
							}
						}
					}
				}
			});
			lastvalue = input.value;
		}
	}
}
function Feed(dn) {
	var start = 0,
		limit = 10,
		moreButton,
		addElements;
	
	moreButton = create({
		'type': 'li',
		'innerHTML': 'mer...',
		'attributes': {
			'class': 'moreButton',
		},
		'functions': {
			'click': function() {
				addElements();
				return false;
			}
		}
	});
	dn.appendChild(moreButton);
	
	addElements = function() {
		xhr.request({
			'type':'GET',
			'url':url+'feed/?s='+start+'&l='+limit,
			'functions': {
				'onload': function(){
					var response = this.responseText.split(split);
					for(var i = 0; i < response.length; i++) {
						var newNode = document.createElement('li');
						newNode.innerHTML = response[i];
						dn.insertBefore(newNode, moreButton);
						start++;
					}
				}
			}
		});
	}
	addElements();
	this.addElements = addElements;
}
xhrtb = {
	'urlEncodeForm': function(form) {
		var inputs = form.getElementsByTagName('input'),
			ret = [];
		for(var i = 0; i < inputs.length; i++) ret.push(inputs[i].name + '=' + inputs[i].value);
		return ret.join('&');
	}
}

function Comment(dn) {
	var form = dn.firstChild,
		comment = new Feed(dn.lastChild);
	form.onsubmit = function() {
		xhr.request({
			'type': 'POST',
			'url': 'comment.php',
			'data': xhrtb.urlEncodeForm(form),
			'functions': {
				'onload': function(){
					comment.addElements();
				}
			}
		});
		return false;
	}
}
domtb = {
	'getChildElements': function(dn) {
		var children = dn.childNodes,
			ret = [];
		for(var i = 0; i < children.length; i++) if(children[i].nodeType == 1) ret.push(children[i]);
		return ret;
	},
	'getFirstElementChild': function(dn) {
		var children = dn.childNodes;
		for(var i = 0; i < children.length; i++) if(children[i].nodeType == 1) return children[i];
		return null;
	},
	'getLastElementChild': function(dn) {
		var children = dn.childNodes;
		for(var i = children.length - 1; i >= 0; i--) if(children[i].nodeType == 1) return children[i];
		return null;
	}
}
animtb = {
	'ease': function(dn, setting, stop, time, callback) {
		var start = parseInt(dn.style[setting].substring(0, dn.style[setting].length - 2)),
			steps = time/20,
			step = 0,
			array = [],
			timer;
		for(var i = 0; i < steps; i++) {
			var x = i/steps;
			array[i] = Math.round(start+(stop-start)*((6*x*x-15*x+10)*x*x*x));
		}
		array[array.length - 1] = stop;
		timer = setInterval(function(){
			dn.style[setting] = array[step++] + 'px';
			if(step >= array.length) {
				clearInterval(timer);
				if(callback) callback();
			}
		}, 20);
	}
}
numtb = {
	'isInt': function(i) {
		if(isNaN(parseInt(i))) return false;
		return true;
	}
}
function Slider(dn) {
	var children = domtb.getChildElements(dn),
		wWidth = dn.offsetWidth,
		currentSlide = 0,
		timer,
		move,
		stop;
	for(var i = 0; i < children.length; i++) children[i].style.width = wWidth + 'px';
	dn.style.width = (children.length * wWidth) + 'px';
	dn.style.left = '0px';
	
	move = function(where) {
		stop();
		var n;
		if(numtb.isInt(where)) {
			n = parseInt(where);
			timer = animtb.ease(dn, 'left', -(n * wWidth), 500);
			currentSlide = n;
		} else if(where == 'next') {
			n = currentSlide + 1;
			if(n >= children.length) n = 0;
			move(n);
		} else if(where == 'previous') {
			n = currentSlide - 1;
			if(n < 0) n = children.length - 1;
			move(n);
		}
	}
	stop = function() { clearInterval(timer); }
	this.move = move;
	this.stop = stop;
}
function SlideShow(dn) {
	var slider = new Slider(dn),
		timer = setInterval(function() { slider.move('next'); }, 4000),
		stop = function() { clearInterval(timer); }
	this.stop = stop;
}
function Menu(dn) {
	var slider = new Slider(domtb.getFirstElementChild(domtb.getLastElementChild(dn))),
		buttons = domtb.getChildElements(domtb.getFirstElementChild(dn));
	for(var i = 0; i < buttons.length; i++) {
		buttons[i].onmouseover = function(i) { 
			return function() { 
				slider.move(i);
			} 
		}(i);
	}
}
function Dialog(text) {
	var mask = document.getElementById('mask'),
		filler = domtb.getFirstElementChild(mask),
		wrapper = document.getElementById('dialogWrapper'),
		hide = function() {
			filler.removeEventListener('click', hide);
			wrapper.removeChild(node);
			mask.style.display = 'none';
		},
		node = create({
			'type': 'div',
			'attributes': { 'class': 'dialog' },
			'children': {
				0: {
					'type': 'span',
					'innerHTML': text
				},1: {
					'type': 'input',
					'attributes': { 'class': 'right', 'type': 'image', 'src': 'exit.png' },
					'functions': {
						'click': hide
					}
				}
			}
		});
	filler.addEventListener('click', hide);
	mask.style.display = 'block';
	wrapper.appendChild(node);
	return node;
}
function Dropdown(dn) {
	var button = domtb.getFirstElementChild(dn),
		content = domtb.getLastElementChild(dn),
		toggle = true,
		height;
	height = content.clientHeight;
	content.style.height = height + 'px';

	button.addEventListener('click', function() {
		if(toggle) {
			animtb.ease(content, 'height', 0, 200, function() { content.style.display = 'none'; });
		} else {
			content.style.display = 'block';
			animtb.ease(content, 'height', height, 200);
		}
		toggle = !toggle;
	});
}
//needs work
function Signup(dn) {
	var form = domtb.getFirstElementChild(dn),
		content = domtb.getLastElementChild(dn);
	form.addEventListener('submit', function() {
		xhr.request({
			'type': 'post',
			'url': 'signup.php',
			'data': xhrtb.urlEncodeForm(form),
			'functions': {
				'onload': function() { content.innerHTML = this.responseText; }
			}
		});
	});
}
//-----
function Calendar(dn) {
	dn = domtb.getFirstElementChild(dn);
	var temp  = domtb.getChildElements(dn),
		temp2 = domtb.getChildElements(temp[0]),
		previous = temp2[0],
		monthDisplay = temp2[1],
		next = temp2[2],
		months = ['Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Desember'],
		temp3 = new Date(),
		year = temp3.getFullYear(),
		month = temp3.getMonth(),
		nodes = [], 
		update;
	for(var i = 2; i <= 7; i++) {
		var elements = domtb.getChildElements(temp[i]);
		for(var j = 0; j < elements.length; j++) nodes.push(elements[j]);
	}
	update = function() {
		xhr.request({
			'type': 'GET',
			'url': 'calendar.php?year='+year+'&month='+month,
			'functions': {
				'onload': function() {
					monthDisplay.innerHTML = months[month];
					var response = this.responseText.split('~%~');
					for(var i = 0; i < response.length; i++) nodes[i].innerHTML = response[i];
				}
			}
		});
	}
	previous.addEventListener('click', function() { month--; if(month < 0) {month = 12; year--} update(); });
	next.addEventListener('click', function() { month++; if(month > 11) {month = 0; year++} update(); });
	update();
}

function cleanNodeList(nodes) {
for(var n in nodes) if(nodes[n].v) nodes[n] = nodes[n].v;
}
Array.prototype.indexOf = function(val) {
	for(var i = 0; i < this.length; i++) if(this[i] == val) return i;
	return -1;
}
testtb = {
	'isObject': function(obj) {
		if(obj) if(obj.toString) if(obj.toString()==='[object Object]') return true;
		return false;
	}
}
function merge(obj1, obj2) {
	for(var n in obj2) {
		if(testtb.isObject(obj1[n]) && testtb.isObject(obj2[n])) merge(obj1[n], obj2[n]);
		else obj1[n] = obj2[n];
	}
	return obj1;
}
filetb = {
	'split': function(file, name, ext) {
		var name = (name ? name : 'name'),
			ext = (ext ? ext : 'ext'),
			matches = file.match(/(.*)\.(.*)/);
		return name + '=' + matches[1] + '&' + ext + '=' + matches[2];
	},
	'size': function(b) {
		var i = 0;
		while((b > 1024) && i < 4) {
			b /= 1024;
			i++;

		}
		return b.toFixed(2) + ['B', 'kB', 'MB', 'GB', 'TB'][i];
	}
}
function FileUploader(info) {
	var	info = (info ? info : {}),
		files = [],
		addFiles,
		totalUpload = 0,
		totalSize = 0,
		nodes = {},
		uploading = false,
		uploadId = 0,
		menu = create({
			'type': 'div',
			'attributes': { 'class': 'menu' },
			'children': {
				0: {
					'type': 'input',
					'attributes': { 'type': 'file', 'multiple': 'multiple' },
					'functions': { 'change': function() { addFiles(this.files); } }
				}
			}
		}),
		fileTable = create({
			'type': 'table',
			'children': {
				0: {
					'type': 'thead',
					'children': {
						0: {
							'type': 'tr',
							'children': {
								0: {
									'type': 'th',
									'attributes': { 'colspan': '4' },
									'children': {
										0: {
											'type': 'div',
											'attributes': { 'class': 'asd' },
											'children': {
												0: {
													'type': 'div',
													'attributes': { 'class': 'progressBar' },
													'storeAs': nodes.progressBar = {}
												}, 1: {
													'type': 'div',
													'attributes': { 'class': 'progressName' },
													'innerHTML': '0B / 0B',
													'storeAs': nodes.totalPercent = {}
												}
											}
										}
									}
								}
							}
						}, 1: {
							'type': 'tr',
							'children': {
								0: {
									'type': 'th',
									'innerHTML': '#'
								}, 1: {
									'type': 'th',
									'innerHTML': 'fil'
								}, 2: {
									'type': 'th',
									'innerHTML': 'size'
								}, 3: {
									'type': 'th',
									'innerHTML': 'status'
								}
							}
						}, 2: {
							'type': 'tr',
							'children': {
								0: {
									'type': 'th',
									'attributes': { 'colspan': '4' },
									'children': { 
										0: {
											'type': 'div',
											'attributes': { 'class': 'asd' },
											'children': {
												0: {
													'type': 'div',
													'attributes': { 'class': 'progressBar' },
													'storeAs': nodes.fileProgressBar = {}
												}, 1: {
													'type': 'div',
													'attributes': { 'class': 'progressName' },
													'innerHTML': '-',
													'storeAs': nodes.fileName = {}
												}
											}
										}
									}
								}
							}
						}
					}
				}, 1: {
					'type': 'tbody',
					'children': {
						0: {
							'type': 'tr',
							'children': {
								0: {
									'type': 'td',
									'attributes': { 'colspan': '4' },
									'children': {
										0: {
											'type': 'div',
											'attributes': { 'class': 'scrolltable' },
											'children': {
												0: {
													'type': 'table',
													'storeAs': nodes.table = {}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}),
		update,
		uploadNext,
		dialog = new Dialog((info.name ? info.name : 'Filopplaster'));
	dialog.appendChild(menu);
	dialog.appendChild(fileTable);
	
	cleanNodeList(nodes);
	update = function(loaded) {
		if(!loaded) var loaded = 0;
		nodes.progressBar.style.width = ((totalUpload + loaded)/totalSize*100) + '%';
		nodes.totalPercent.innerHTML = filetb.size(totalUpload + loaded) + ' / ' + filetb.size(totalSize);
	}
	uploadNext = function() {
		if(uploading || ((uploadId + 1) > files.length)) return;
		var file = files[uploadId++];
		file.nodes.state.innerHTML = 'uploading...';
		nodes.fileName.innerHTML = file.file.name;
		uploading = true;
		xhr.request({
			'type': 'post',
			'url': 'fileReceive.php?' + filetb.split(file.file.name) + (info.urlappendage ? '&' + info.urlappendage : ''),
			'uploadFunctions': {
				'onprogress': function(e) {
					update(e.loaded);
					nodes.fileProgressBar.style.width = ((e.loaded/e.total)*100) + '%';
				},
				'onload': function(e) {
					totalUpload += e.total;
					uploading = false;
					file.nodes.state.innerHTML = 'done!';
					nodes.fileProgressBar.style.width = '100%';
					update();
					uploadNext();
				}
			},
			'data': file.file
		});
	}
	addFiles = function(newFiles) {
		for(var i = 0; i < newFiles.length; i++) {
			if(info.filter) if(!info.filter(newFiles[i])) continue;
			var id = files.push({}),
				file = files[id - 1];
			file.file = newFiles[i],
			file.nodes = {},
			file.element = create({
				'type': 'tr',
				'children': {
					0: {
						'type': 'td',
						'storeAs': file.nodes.id = {},
						'innerHTML': id
					}, 1: {
						'type': 'td',
						'innerHTML': file.file.name
					}, 2: {
						'type': 'td',
						'innerHTML': filetb.size(file.file.size)
					}, 3: {
						'type': 'td',
						'storeAs': file.nodes.state = {},
						'children': {
							0: {
								'type': 'input',
								'attributes': { 'type': 'button' },
								'functions': {
									'click': (function(file) { return function() {
										var id = files.indexOf(file);
										for(var i = id; i < files.length; i++) files[i].nodes.id.innerHTML = i;
										nodes.table.removeChild(file.element);
										files.splice(id, 1);
										totalSize -= file.file.size;
										update();
									}})(file)
								}
							}
						}
					}
										
				}
			});
			totalSize += file.file.size;
			update();
			cleanNodeList(file.nodes);
			nodes.table.appendChild(file.element);
		}
		uploadNext();
	}
}
function ImageUploader(info) {
	new FileUploader({
		'name': 'Last opp bilder',
		'filter': function(file) {
			if(file.type.match(/^image\//)) return true;
			return false;
		},
		'urlappendage': 'albumId=' + info.albumId
	});
}
function AlbumMaker() {
	new Dialog();
}
onload = function() {
	new Feed(document.getElementsByClassName('feed')[0]);
	new Search(document.getElementsByClassName('search')[0]);
	new Comment(document.getElementsByClassName('comment')[0]);
	new Menu(document.getElementsByClassName('menu')[0]);
	new SlideShow(document.getElementsByClassName('slideshow')[0]);
	new Dropdown(document.getElementsByClassName('dropdown')[0]);
	new Calendar(document.getElementsByClassName('calendar')[0]);
	document.getElementById('mask').style.display = 'none';
}

console.log('fin');

