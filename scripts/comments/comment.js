define([], function(){

	var submitUrl;
	var deleteUrl;

	function setData(data) {
		submitUrl = data.submitUrl;
		deleteUrl = data.deleteUrl;
	}

	function attachSubmitAction() {
		jQuery('body')
		.undelegate('#comment-submit','click')
		.delegate('#comment-submit','click',function(){
			$.ajax({
				'type':'POST',
				'url': submitUrl,
				'cache':false,
				'data': $(this).parents("form").serialize(),
				'success':function(html){
					$(".comment-view-all").html(html);
					$("#CommentForm_content").val("");
				}
			});
			return false;
		});
	}

	function flashComment(commentName) {
		var comment = $('.' + commentName);
		comment.addClass("c-flashed");
	}

	function scrollToComment(id) {
		var idName = "comment-" + id;
		document.getElementsByClassName(idName)[0].scrollIntoView();
	}

	function flashCurrentComment() {
		var commentNameAndIDs = window.location.hash.substring(1);
		if (commentNameAndIDs !== "") {
			var idsString = commentNameAndIDs.replace("comment-", "");
			var ids = idsString.split(",");
			var firstId = ids[0];
			for(var i = 0; i < ids.length; i++) {
				if (ids[i] < firstId)  {
					firstId = ids[i];
				}
				var commentName = "comment-" + ids[i];
				flashComment(commentName);
			}
			scrollToComment(firstId);
		}
	}

	attachSubmitAction();
	flashCurrentComment();

	function deleteComment(id) {
		var commentViewAll = $(".comment-view-all");
		var url = deleteUrl + "/" + id;
		var shouldDelete = confirm("Vil du slette kommentaren?");
		if (shouldDelete) {
			commentViewAll.load(url);
		}
	}

	return {
		setData: setData,
		deleteComment: deleteComment
	};

});