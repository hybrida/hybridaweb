<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupMembership
 *
 * @author sigurd
 */
class MembershipGroup {
	
	
	public static function insert($groupId, $userId) {
		$data = array(
				'gID' => $groupId,
				'uID' => $userId
		);

		$sql = "INSERT INTO membership_access(`accessId` ,`userId`)
			VALUES (
			(SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID)),
			:uID
		)";
		$query = Yii::app()->db->getPdoInstance()->prepare($sql);
		$query->execute($data);
	}

	public static function delete($groupId, $userId) {
		$data = array(
				'gID' => $groupId,
				'uID' => $userId
		);

		$sql = "DELETE FROM membership_access WHERE accessId = 
            (SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID))
            AND userId = :uID";
		$query = Yii::app()->db->getPdoInstance()->prepare($sql);
		$query->execute($data);
	}
	
}

?>
