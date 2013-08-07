define([], function () {

	/**
	 * Denne javascripten sjekker hvor langt ned en har scrollet
	 * og trykker på 'fetchNews' - knappen når en er 100 pixler fra
	 * bunnen. Forandre på offset for å forandre hvor langt fra
	 * bunnen en må være.
	 */

	var scrollTimer, lastScrollFireTime = 0;

	function scrollChecker() {
		/**
		 * Denne gjør at vi ikke kaller processScroll så ofte, hvis dette endres
		 * så kan vi få 'ikke flere nyheter' mange ganger hvis noen scroller litt
		 * fort.
		 */
		$(window).scroll(function() {
			var minScrollTime = 300;
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

	scrollChecker();



	function NewsFeedView(options) {
		var self = this;
		this.template = options.template;
		this.feedContent = options.feedContent;
		this.url = "/newsfeed/feedJSON";

		this.lastTimestamp = 0;
		this.lastWeight = Number.MIN_VALUE;  // Alt er bedre enn dette.
		this.limit = 10;
		this.fetchButton = options.ajaxButton;

		this.lastIndex = -1;

		this.fetchButton.click(function (e) {
			self.load();
		});

		this.removeFetchButton = function() {
			this.fetchButton.remove();
			console.log("Sletter boks");
		};

		this.load = function() {
			var data = {
				minWeight: this.lastWeight,
				minTimestamp: this.lastTimestamp,
				limit: this.limit
			};

			$.ajax({
				url: self.url,
				dataType: 'json',
				success: function(json) {
					self.addMore(json);
				},
				error: function(e) {
					console.log("ERROR");
					console.log(e.responseText);
				},
				data : data
			});
		};

		this.addMore = function(news) {
			var start = this.lastIndex + 1;
			var end = start + this.limit;
			for (var i = start; i < end ; i++) {
				if (i >= news.length) {
					this.removeFetchButton();
					break;
				}
				var model = news[i];
				var templateHtml = this.template(model);
				this.feedContent.append(templateHtml);
				this.lastTimestamp = model.timestamp;
				this.lastWeight = model.weight;
				this.lastIndex = i;
			}
		};
	}


	return {
		NewsFeedView: NewsFeedView
	};

});
