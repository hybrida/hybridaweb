<?php

// BPC client core version 0.9.0, 25/2-2009
// Denne fila kan bli oppdatert av oss senere, bruk den som den er eller lag din egen implementasjon av denne koden slik du ønsker.
// Check for curl availability
if (!function_exists("curl_init") || !function_exists("curl_setopt") || !function_exists("curl_exec") || !function_exists("curl_close"))
	die('You do not have cURL-support installed with php, please contact your system administrator.<br />
	     On debian-based systems, this is simply done by "aptitude install php5-curl"');

class BpcCore {
	
	public static function doRequest($postdata) {
		$request = new BpcRequest($postdata);
		$request->send();
		return $request->getResponse();
	}

	public static function addAttending($bpcID, $userID) {
		$user = User::model()->findByPk($userID);
		if (!$user) {
			return;
		}
		
		if ($user->cardHash == "" || $user->cardHash == null) {
			throw new CHttpException("Du må legge inn kortnummer først", "Du har ikke lagt inn noe kortnummer");
		}
		
		$inData = array(
			'request' => 'add_attending',
			'fullname' => $user->fullName,
			'username' => $user->username,
			'card_no' => (float) $user->cardHash,
			'event' => $bpcID,
			'year' => $user->classYear,
		);
		BpcCore::doRequest($inData);
	}

	public static function removeAttending($bpcID, $userID) {
		$user = User::model()->findByPk($userID);
		if (!$user) {
			return;
		}
		$inData = array(
			'request' => 'rem_attending',
			'username' => $user->username,
			'event' => $bpcID,
		);
		BpcCore::doRequest($inData);
	}
	
	public static function update($bpcID) {
		$b = new BpcUpdate();
		$b->update($bpcID);
	}
	
	public static function updateAll() {
		$b = new BpcUpdate();
		$b->updateAll();
	}

}