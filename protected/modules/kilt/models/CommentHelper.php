<?php

class CommentHelper
{
	public function getUserNameByID($id) {
        $connection = Yii::app()->db;
		$sql = "SELECT firstName, lastName FROM user WHERE id = :id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":id", $id);
		$data = $command->queryRow(); 
        return $data;
	}

	public function insertComment($newComment, $timeID)
	{
        $connection = Yii::app()->db;
		$userID = Yii::app()->user->id;
		$sql = "INSERT INTO kilt_comment (user_id,  comment,  time_id) 
								VALUES ( :user_id, :comment, :time_id)";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userID);
		$command = $command->bindParam(":comment", $newComment);
		$command = $command->bindParam(":time_id", $timeID);
		$command->execute(); 
	}
	public function updateComment($newComment, $timeID)
	{
        $connection = Yii::app()->db;
		$userID = Yii::app()->user->id;
		$sql = "UPDATE kilt_comment
				SET comment = :comment
				WHERE user_id = :user_id
				AND time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userID);
		$command = $command->bindParam(":comment", $newComment);
		$command = $command->bindParam(":time_id", $timeID);
		$command->execute(); 
	}
	public function deleteComment($timeID)
	{
        $connection = Yii::app()->db;
		$userID = Yii::app()->user->id;
		$sql = "DELETE FROM kilt_comment WHERE user_id = :user_id AND time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userID);
		$command = $command->bindParam(":time_id", $timeID);
		$command->execute(); 
	}

	public function getUserCommentByTimeID($timeID)
	{
        $connection = Yii::app()->db;
		$userID = Yii::app()->user->id;
		$sql = "SELECT comment FROM kilt_comment WHERE user_id = :user_id AND time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userID);
		$command = $command->bindParam(":time_id", $timeID);
		$data = $command->queryScalar(); 
		return $data;
	}
	public function getCommentsByTimeIDIndexedByName($timeID)
	{
        $connection = Yii::app()->db;
		$sql = "SELECT * FROM kilt_comment WHERE time_id = :time_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":time_id", $timeID);
		$data = $command->queryAll(); 
		$commentsByName = array();
		foreach($data as $c)
		{
			$name = $this->getUserNameByID($c['user_id']);
			$name = $name['firstName']." ".  $name['lastName'];
			$commentsByName[$name] = $c['comment'];
		}
        return $commentsByName;
	}
	public function getUserCommentsIndexedByTime()
	{
        $connection = Yii::app()->db;
		$userID = Yii::app()->user->id;
		$sql = "SELECT * FROM kilt_comment WHERE user_id = :user_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":user_id", $userID);
		$data = $command->queryAll(); 
		$timeComments = array();
		foreach ($data as $d)
			$timeComments[$d['time_id']] = $d['comment'];
		 return $timeComments;
	}
}

?>
