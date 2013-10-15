define([], function() {

	var autocomplete = function (options) {
		$(options.selector).autocomplete({
			source: options.source,
			minLength: 2,
			select: options.select,
			open: function(event, ui) {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	};

	return autocomplete;
});