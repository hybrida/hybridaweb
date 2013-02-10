require([], function () {

	var ajaxButton = $(data.ajaxButtonSelector);
	var feeds = $(data.feedContentSelector);
	var count = data.count;
	var limit = data.limit;
	var feedContentSelector = data.feedContentSelector;
	var ajaxFeedUrl = data.ajaxFeedUrl;


	ajaxButton.click(function (){
		$.ajax({
			success: function(html){
				feeds.append(html);
				
				if (html.indexOf("Ingen flere nyheter") != -1) {
					ajaxButton.off('click');
					ajaxButton.remove();
				}
			},
			type: 'get',
			url: ajaxFeedUrl + count,
			data: {
				index: $(feedContentSelector + " li").size()
			},
			cache: false,
			dataType: 'html'
		});
		count += limit;
	});

});