<?php

// BPC client core version 0.9.0, 25/2-2009
// Denne fila kan bli oppdatert av oss senere, bruk den som den er eller lag din egen implementasjon av denne koden slik du ønsker.
// Check for curl availability
if (!function_exists("curl_init") || !function_exists("curl_setopt") || !function_exists("curl_exec") || !function_exists("curl_close"))
	die('You do not have cURL-support installed with php, please contact your system administrator.<br />
	     On debian-based systems, this is simply done by "aptitude install php5-curl"');

class BpcCore {

	/**
	 * Do a curl request
	 * curl_exec returns a string containing either php code or xml depending on the method selected by $postdata['method']
	 */
	public static function doRequest($postdata) {

		// Set common values for postdata
		$postdata['forening'] = bpcConfig::$forening;
		$postdata['key'] = bpcConfig::$key;
		$postdata['debug'] = bpcConfig::$debug;
		$postdata['timing'] = bpcConfig::$timing;
		$postdata['version'] = '1.1';
		if (!isset($postdata['method']))
			$postdata['method'] = bpcConfig::$defaultmethod;

		// Initialize curl handle
		$ch = curl_init();

		// Set curl options
		curl_setopt($ch, CURLOPT_URL, bpcConfig::$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);

		// Execute the curl connection
		if (!$curlres = curl_exec($ch)) {
			echo "Curl request failed:" . curl_error($ch);
			return false;
		}

		// Close the curl connection and destroy the handle
		curl_close($ch);

		if ($postdata['method'] == 'phparray') {
			die('The \'phparray\'-method is no longer supported, use \'serialized_array\' instead.');
		} elseif ($postdata['method'] == 'serialized_array') {
			if (!($data = @unserialize($curlres))) {
				// This should only trigger on parse errors in the remote script, and should thus hopefully never occur in a production environment.
				echo "An error occured on the BPC server:<br />";
				var_dump($curlres);
				return false;
			} else {
				return $data;
			}
		} else {
			echo "Sorry, " . $postdata['method'] . " is not supported.<br />";
		}
	}

	public static function addAttending($bpcID, $userID) {
		$user = User::model()->findByPk($userID);
		if (!$user) {
			return;
		}
		
		if ($user->cardinfo == "" || $user->cardinfo == null) {
			throw new CHttpException("Du må legge inn kortnummer først", "Du har ikke lagt inn noe kortnummer");
		}
		
		$inData = array(
			'request' => 'add_attending',
			'fullname' => $user->fullName,
			'username' => $user->username,
			'card_no' => (float) $user->cardinfo,
			'event' => $bpcID,
			'year' => 2, //FIXME
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