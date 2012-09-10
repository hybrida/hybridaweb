<?php

class CommentHelper
{

	public function insertComment($newComment, $timeID)
	{
        $connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "INSERT INTO kilt_comment (user_id,  comment,  time_id) 
								VALUES ( :user_id, :comment, :time_id)";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$command = $command->bindParam(":comment", $newComment);
		$command = $command->bindParam(":time_id", $timeID);
		$command->execute(); 
	}
	public function updateComment($newComment, $timeID)
	{
        $connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "UPDATE kilt_comment
				SET comment = :comment
				WHERE user_id = :user_id
				AND time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$command = $command->bindParam(":comment", $newComment);
		$command = $command->bindParam(":time_id", $timeID);
		$command->execute(); 
	}
	public function deleteComment($timeID)
	{
        $connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "DELETE FROM kilt_comment WHERE user_id = :user_id AND time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$command = $command->bindParam(":time_id", $timeID);
		$command->execute(); 
	}
	public function getUserComments()
	{
        $connection = Yii::app()->db;
		$userId = Yii::app()->user->id;
		$sql = "SELECT * FROM kilt_comment WHERE user_id = :user_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userId);
		$data = $command->queryAll(); 
		$comments = array();
		foreach ($data as $c)
			$comments[$c['time_id']] = $c['comment'];
		return $comments;
	}
	public function getCommentsByTimeID($tid)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_comment WHERE time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":time_id", $tid);
		$data = $command->queryAll(); 
        return $data;
	}
}

?>
