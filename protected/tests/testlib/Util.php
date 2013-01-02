<?php


Yii::import("comment.models.*");
Yii::import("comment.components.*");

class Util {

	public static function getNewNews() {
		$news = new News;
		$news->title = "test";
		$news->content = "test";
		return $news;
	}

	public static function getNews() {
		$news = self::getNewNews();
		$news->save();
		return $news;
	}

	public static function getNewEvent() {
		$event = new Event;
		$event->start = "2012-01-01 00:00";
		$event->end = "2013-01-01 00:00";
		$event->location = "test";
		return $event;
	}

	public static function getEvent() {
		$event = self::getNewEvent();
		$event->save();
		return $event;
	}
	
	
	public static function getNewSignup() {
		$signup = new Signup;
		$signup->spots = 1;
		$signup->close = "2011-10-22 14:30";
		$signup->open = "2015-10-22 14:30";
		$signup->eventId = 10000 + Signup::model()->count();
		return $signup;
	}
	
	public static function getSignup() {
		$signup = self::getNewSignup();
		$signup->save();
		return $signup;
	}
	
	
	public static function getNewUser() {
		$user = new User;
		$user->username = 'test' . User::model()->count();
		$user->firstName = $user->lastName = "test";
		$user->member = "false";
		return $user;
	}
	
	public static function getUser() {
		$user = self::getNewUser();
		$user->save();
		return $user;
	}
	
	public static function getNewFacebookUser($userId) {
		$fbUser = new FacebookUser;
		$fbUser->fb_token = sha1($userId);
		$fbUser->userId = $userId;
		$fbUser->postEvents = 'false';
		return $fbUser;
	}
	
	public static function getFacebookUser($userId) {
		$fbUser = self::getNewFacebookUser($userId);
		$fbUser->save();
		return $fbUser;
	}
	
	public static function getNewGroup() {
		$group = new Groups;
		$group->url = $group->title = "test" . Groups::model()->count();
		$group->menu = 123;
		return $group;
	}
	
	public static function getGroup() {
		$group = self::getNewGroup();
		$group->save();
		return $group;
	}
	
	public static function getNewArticle() {
		$article = new Article;
		$article->title = "test";
		return $article;
	}
	
	public static function getArticle() {
		$article = self::getNewArticle();
		$article->save();
		return $article;
	}
	
	public static function getNewComment() {
		$comment = new Comment;
		$comment->content = "test";
		$comment->parentId = 1;
		return $comment;
	}
	
	public static function getComment() {
		$comment = self::getNewComment();
		$comment->save();
		return $comment;
	}
	
	public static function getNewArticleText($articleId) {
		$articleText = new ArticleText;
		$articleText->content = "test";
		$articleText->articleId = $articleId;
		return $articleText;
	}
	
	public static function getArticleText($articleId) {
		$articleText = self::getNewArticleText($articleId);
		$articleText->save();
		return $articleText;
	}

	public static function getNewSignupMembershipAnonym($eventId){
		$signupMembershipAnonym = new SignupMembershipAnonym();
		$signupMembershipAnonym->eventId = $eventId;
		return $signupMembershipAnonym;
	}
}