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


/**
 * Denne javascripten sjekker hvor langt ned en har scrollet
 * og trykker på 'fetchNews' - knappen når en er 100 pixler fra
 * bunnen. Forandre på offset for å forandre hvor langt fra
 * bunnen en må være.
 */
$(document).ready(scrollChecker());

function processScroll() {
    if (shouldLoadMore()) {
        document.getElementById("fetchNews").click();
    }
}

function shouldLoadMore() {
    var offset = 100;
    var limit = $(document).height() - $(window).height() - offset;
    var bottomOfPage = $(window).scrollTop() >= limit;
    var fetchNewsExists = $('#fetchNews').length > 0;
    return bottomOfPage && fetchNewsExists;
}

/**
 * Denne gjør at vi ikke kaller processScroll så ofte, hvis dette endres
 * så kan vi få 'ikke flere nyheter' mange ganger hvis noen scroller litt
 * fort.
 */

var scrollTimer, lastScrollFireTime = 0;

function scrollChecker() {
    $(window).scroll(function() {
        var minScrollTime = 600;
        var now = new Date().getTime();

        if (!scrollTimer) {
            if (now - lastScrollFireTime > (minScrollTime)) {
                processScroll();
                lastScrollFireTime = now;
            }
            
            scrollTimer = setTimeout(function() {
                scrollTimer = null;
                lastScrollFireTime = new Date().getTime();
                processScroll();
            }, minScrollTime);
        }
    });
}
