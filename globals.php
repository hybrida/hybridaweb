<?php
/**
 * This is the shortcut to DIRECTORY_SEPARATOR
 */
defined('DS') or define('DS',DIRECTORY_SEPARATOR);

/**
 * This is the shortcut to Yii::app()
 */
function app()
{
    return Yii::app();
}

/**
 * This is the shortcut to Yii::app()->user.
 */
function user()
{
    return Yii::app()->getUser();
}

/**
 * Returns the named application parameter.
 * This is the shortcut to Yii::app()->params[$name].
 */
function param($name)
{
    return Yii::app()->params[$name];
}

function url($route,$params=array(),$ampersand='&') {
	return Yii::app()->createUrl($route, $params, $ampersand);
}

function debug($output, $name="") {
	$trace = debug_backtrace();
	$lastTrace = $trace[1];
	$function = $trace[1]['function'] . "()";
	if (isset($lastTrace['class'])) {
		$function = $lastTrace['class'] . "::" . $function;
	}
	echo '<div style="border:1px #888 solid; background-color: #cff; margin:1em;">';
	echo "<Strong>Name:</strong> " . $name . "<br/>\n";
	echo "<Strong>Called from:</strong> " . $function . "<br/>\n";
	if ($output === true) $output = "true";
	if ($output === false) $output = "false";
	if ($output === null) $output = "null";
	$output = print_r($output, true);
	echo "<strong>Output:</strong>\n<pre>$output</pre>";
	echo "</div>";
}

function println($string="") {
	echo $string . PHP_EOL;
}

function cdebug($output, $name="") {
	$trace = debug_backtrace();
	$lastTrace = $trace[1];
	$function = $trace[1]['function'] . "()";
	if (isset($lastTrace['class'])) {
		$function = $lastTrace['class'] . "::" . $function;
	}
	println();
	println("Name: " . $name);
	println("Called from: " . $function);
	if ($output === true) $output = "true";
	if ($output === false) $output = "false";
	if ($output === null) $output = "null";
	$output = print_r($output, true);
	println("Output: " . $output);
	println();
}