<?php

class ArticleTemplateRenderer {

	public static function render($article) {
		if ($article->phpFile == null) {
			echo
				"<div id='article-title'>".
					"<h1>".$article->title."</h1>".
				"</div>".
				"<div id='article-content'>".
					$article->content.
				"</div>";
			return;
		}

		$phpFilePath = $article->phpFilePath;

		if (self::illegalPHP($article) || !file_exists($phpFilePath)) {
			$message = "The content of this article has been corrupted";
			throw new CHttpException(500, $message);
		}

		include $phpFilePath;
	}

	private static function illegalPHP($article) {
		$pattern = "/^[a-zA-Z0-9-_]+$/";
		// Allows only letters A-Z, a-z and numbers 0-9 for a word of any length.
		$subject = $article->phpFile;

		if (preg_match($pattern, $subject)) {
			return false;
		} else {
			return true;
		}
	}

}