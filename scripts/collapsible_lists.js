require([],function(){

	// http://code.stephenmorley.org/javascript/collapsible-lists/
	var CollapsibleLists = new function() {
		this.apply = function() {
			var uls = document.getElementsByClassName('collapsibleList');
			console.log(Object.prototype.toString.call( uls ));
			for (var index = 0; index < uls.length; index++) {
				this.applyTo(uls[index]);
			}
		}

		this.applyTo = function(node) {
			var lis = node.getElementsByClassName('collapsibleListHeader');
			for (var index = 0; index < lis.length; index++) {
				$(lis[index]).mousedown(function (event) {
					event.preventDefault();
				})

				$(lis[index]).click(function (event) {
					if (!event) event = window.event;

					$(this.parentNode).toggleClass('collapsibleListClosed collapsibleListOpen');

				})
			}
		}
	} ();

	CollapsibleLists.apply();
});
