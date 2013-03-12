require(['autocomplete'],function(autocomplete){

	var source = function( request, response ) {
		$.ajax({
			url: "/get/userSearch",
			dataType: "json",
			data: {
				usernameStartsWith: request.term
			},
			success: function( data ) {
				console.log(data);
				response( $.map( data, function( item ) {
					var fullName = item.firstName + " " + item.middleName + " " + item.lastName;
					var label = item.username + ": " + fullName;
					return {
						label: label,
						value: item.username
					}
				}));
			}
		});
	};

	var selector = data.selector;

	autocomplete(selector, source);

});