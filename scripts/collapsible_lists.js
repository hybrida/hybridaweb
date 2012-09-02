/*
 *
 * http://code.stephenmorley.org/javascript/collapsible-lists/
 *
 */

$(document).ready(function() {CollapsibleLists.apply() });

var CollapsibleLists = new function() {
	this.apply = function() {
		var uls = document.getElementsByTagName('ul');
		for (var index = 0; index < uls.length; index++) {
			if (uls[index].className.match(/(^| )collapsibleList( |$)/)) {
				this.applyTo(uls[index]);
			}
		}
	}
	
	this.applyTo = function(node) {
		var lis = node.getElementsByTagName('li');
		for (var index = 0; index < lis.length; index++) {
			if (node == lis[index].parentNode) {
				if (lis[index].addEventListener) {
					lis[index].addEventListener(
						'mousedown', function (e) {  e.preventDefault(); }, false);
				} else {
					lis[index].attachEvent(
						'onselectstart', function() { event.returnValue = false; });
				}
				if (lis[index].addEventListener) {
					lis[index].addEventListener(
						'click', createClickListener(lis[index]), false);
				} else {
					lis[index].attachEvent(
						'onclick', createClickListener(lis[index]));
				}
				toggle(lis[index]);
			}
		}
	}
	
	function createClickListener(node) {
		return function (e) {
			if (!e) e = window.event;
			
			var li = (e.target ? e.target : e.srcElement);
			while (li.nodeName != 'LI') li = li.parentNode;
			
			if (li == node) toggle(node);
		};
	}
	
	function toggle(node) {
		var open = node.className.match(/(^| )collapsibleListClosed( |$)/);
		var uls = node.getElementsByTagName('ul');
		
		for  (var index = 0; index < uls.length; index++) {
			var li = uls[index];
			
			while (li.nodeName != 'LI') li = li.parentNode;
			
			if (li == node) uls[index].style.display = (open ? 'block' : 'none');
		}
		
		node.className = node.className.replace(/(^| )collapsibleList(Open|Closed)( |$)/, '');
		
		if (uls.length > 0) {
			node.className += 'collapsibleList' + (open ? 'Open' : 'Closed');
		}
	}
}();
