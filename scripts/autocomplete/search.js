require(['autocomplete/core'],function(autocomplete){

	//alert("autocomplete_search");

	var source = function( request, response ) {
		$.ajax({
			url: "/get/userSearch",
			dataType: "json",
			data: {
				usernameStartsWith: request.term
			},
			success: function( data ) {
				response( $.map( data, function( user ) {
					var fullName = user.firstName + " " + user.middleName + " " + user.lastName;
					var label = user.username + ": " + fullName;
					return {
						label: label,
						value: user.username
					}
				}));
			}
		});
	};

	var onSelect = function( event, ui ) {
		if (ui.item) {
			window.location.href = "/profil/" + ui.item.value;
		}
	}

	autocomplete("input#searchField", source, onSelect);
});