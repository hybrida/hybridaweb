<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestLib
 *
 * @author sigurd
 */
class TestLib {

	public static function truncateDatabase() {
		$sql = "TRUNCATE `access_relations`;
				TRUNCATE `membership_access`;
				TRUNCATE `news`;
				TRUNCATE `signup`;
				TRUNCATE `user_new`;";
		Yii::app()->db->getPdoInstance()->prepare($sql)->execute();
	}

}

?>
