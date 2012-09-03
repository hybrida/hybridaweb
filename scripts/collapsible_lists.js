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
				$(lis[index]).mousedown(function (event) {
					event.preventDefault();
				})
				
				$(lis[index]).click(function (event) {
					if (!event) event = window.event;
					
					$(this).toggleClass('collapsibleListClosed collapsibleListOpen');
				})
				
				$(lis[index]).toggleClass('collapsibleListClosed collapsibleListOpen');
			}
		}
	}
}();
