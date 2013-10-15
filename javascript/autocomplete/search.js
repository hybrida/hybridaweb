require(['autocomplete/core', "shortcut"],function(autocomplete, shortcut){

	var foundViewUrl = null;

	var source = function( request, response ) {
		console.log(request);
		$.ajax({
			url: "/get/newsSearch",
			dataType: "json",
			data: {
				titleLike: request.term
			},
			success: function( data ) {
				console.log(data);
				response( $.map( data, function( news ) {
					var label = news.title;
					var isSelector = news.title == "---";
					foundViewUrl = news.id;
					return {
						label: label,
						value: label,
						foundViewUrl: news.viewUrl,
						isSelector: isSelector
					}
				}));
			}
		});
	};

	var onSelect = function( event, ui ) {
		if (ui.item && ! ui.item.isSelector) {
			window.location.href = ui.item.foundViewUrl;
		}
	}

	var selector = "input#searchField";
	var searchField = $(selector);

	shortcut.add("Ctrl+i", function(e){
		searchField.focus();
	});

	autocomplete({
		selector: selector,
		source: source,
		select: onSelect
	});
});