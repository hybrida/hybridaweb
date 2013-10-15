define([], function(){

	var isFollowing;
	var baseUrl;

	var button = $(".widget-followButton-button");
	var buttonText = $(".widget-followButton-button span");
	var toggleClassName = "c-toggled";

	function init(data) {
		isFollowing = data.isFollowing;
		baseUrl = data.baseUrl;
	}

	function run() {
		button.click(function(e){
			e.preventDefault();
			actionFollow();
		});
		setFollowButtonClassName();
	}

	function actionFollow() {
		var toggle = getToggle();
		var url = baseUrl + toggle;
		$.ajax({
			'url': url,
			'success': function(html) {
				buttonText.text(html);
				isFollowing = !isFollowing;
				setFollowButtonClassName();
			}
		});
	}

	function getToggle() {
		if (isFollowing) {
			return "unfollow";
		} else {
			return "follow";
		}
	}

	function setFollowButtonClassName() {
		if (isFollowing) {
			button.addClass(toggleClassName);
		} else {
			button.removeClass(toggleClassName);
		}
	}

	return {
		init: init,
		run: run
	};

});