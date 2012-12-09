<?php

class m121209_184746_move_from_article_content_to_article_text extends CDbMigration {
	
	/** @property PDO $pdo */
	private $pdo;

	public function up() {
		$this->pdo = $this->getDbConnection()->getPdoInstance();
		$this->truncateTable("article_text");
		$articles = Article::model()->findAll("content IS NOT NULL");
		foreach ($articles as $article) {
			$id = $article->id;
			$content = $this->getOldArticleContent($id);
			$phpFile = $this->getOldArticlePhpFile($id);
			$article->setContent($content);
			$article->articleText->phpFile = $phpFile;
			$article->save();
		}
		$this->dropColumn("article", "content");
		return true;
	}
	
	private function prepare($sql) {
		return $this->pdo->prepare($sql);
	}
	
	private function getOldArticleContent($id) {
		$sql = "SELECT content FROM article WHERE id = ?";
		$stmt = $this->prepare($sql);
		$stmt->execute(array($id));
		$tmp = $stmt->fetch();
		$content = $tmp[0];
		return $content;
	}
	
		private function getOldArticlePhpFile($id) {
		$sql = "SELECT phpFile FROM article WHERE id = ?";
		$stmt = $this->prepare($sql);
		$stmt->execute(array($id));
		$tmp = $stmt->fetch();
		$content = $tmp[0];
		return $content;
	}

	public function down() {
		echo "m121209_184746_move_from_article_content_to_article_text does not support migration down.\n";
		return true;
	}

	/*
	  // Use safeUp/safeDown to do migration with transaction
	  public function safeUp()
	  {
	  }

	  public function safeDown()
	  {
	  }
	 */
}