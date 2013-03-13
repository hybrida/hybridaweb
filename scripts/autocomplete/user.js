require(['autocomplete/core'],function(autocomplete){

	var source = function( request, response ) {
		$.ajax({
			url: "/get/userSearch",
			dataType: "json",
			data: {
				usernameStartsWith: request.term
			},
			success: function( data ) {
				//console.log(data);
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

	var selector = data.selector;

	autocomplete({
		selector: selector,
		source: source
	});
});