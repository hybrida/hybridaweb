require(['autocomplete/core'],function(autocomplete){

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
					foundViewUrl = news.id;
					return {
						label: label,
						value: label,
						foundViewUrl: news.viewUrl
					}
				}));
			}
		});
	};

	var onSelect = function( event, ui ) {
		if (ui.item) {
			window.location.href = ui.item.foundViewUrl;
		}
	}

	autocomplete({
		selector: "input#searchField",
		source: source,
		select: onSelect
	});
});