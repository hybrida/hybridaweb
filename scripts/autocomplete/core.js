define([], function() {

	var autocomplete = function (selector, source, select) {
		$(selector).autocomplete({
			source: source,
			minLength: 2,
			select: select,
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	};

	return autocomplete;
});