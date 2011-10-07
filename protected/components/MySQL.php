<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQL
 *
 * @author sigurd
 */
class MySQL {
	
	public static $link;

	public static function connect() {
		$server = "localhost";
		$username = "www-data";
		$password = "Q8JdU5MY7dDr5XEU";
		$database = "hybrida";

		self::$link = mysql_connect($server, $username, $password);
		mysql_select_db($database, self::$link);
		mysql_query("SET charset 'utf8'");
	}

}

?>
