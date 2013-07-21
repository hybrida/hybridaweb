define([], function(){

	var urlOn = '<?= $griffOnUrl ?>';
	var urlOff = '<?= $griffOffUrl ?>';

	var hasGriffedClassName = "c-toggled";
	var hasGriffedAttribute = "data-isgriffed";

	function setData(data) {
		urlOn = data.griffOnUrl;
		urlOff = data.griffOffUrl;
	}

	var griff = function (id, element) {

		var griffButton = $(element);
		var count = griffButton.find(".count");
		var griffCount = parseInt(count.html(), 10);
		var userHasGriffed = griffButton.attr(hasGriffedAttribute) == "true";

		var url = "";
		if (userHasGriffed) {
			url = urlOff + id;
			runAjax(url, function(html) {
				count.html(griffCount - 1);
				griffButton.removeClass(hasGriffedClassName);
				griffButton.attr(hasGriffedAttribute, "false");
			});
		} else {
			url = urlOn + id;
			runAjax(url, function(html) {
				count.html(griffCount + 1);
				griffButton.addClass(hasGriffedClassName);
				griffButton.attr(hasGriffedAttribute, "true");
			});
		}
		setGriffButtonColors();
	};

	function runAjax(url, callback) {
		$.ajax({
			'url': url,
			'success': function (html) {
				callback(html);
			},
			'error': function(a, b) {
			}
		});
	}

	function setGriffButtonColors() {
		var comments = $(".c-griffButton");
		comments.each(function(i, item){
			item = $(item);
			if (item.attr('data-isgriffed') == "true") {
				item.addClass(hasGriffedClassName);
			}
		});
	}

	setGriffButtonColors();

	return {
		griff: griff,
		setData: setData
	};

});