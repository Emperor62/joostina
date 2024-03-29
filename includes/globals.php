<?php
/**
 * @package Joostina
 * @copyright Авторские права (C) 2007-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */
// запрет прямого доступа
defined('_VALID_MOS') or die();

function checkInputArray(&$array,$globalise = false) {
	static $banned = array('_files','_env','_get','_post','_cookie','_server','_session','globals');

	foreach($array as $key => $value) {
		// PHP GLOBALS injection bug
		$failed = in_array(strtolower($key),$banned);
		// PHP Zend_Hash_Del_Key_Or_Index bug
		$failed |= is_numeric($key);
		if($failed) {
			die('error <b>'.implode('</b> & <b>',$banned).'</b>');
		}
		if($globalise) {
			$GLOBALS[$key] = $value;
		}
	}
}

function unregisterGlobals() {
	checkInputArray($_FILES);
	checkInputArray($_ENV);
	checkInputArray($_GET);
	checkInputArray($_POST);
	checkInputArray($_COOKIE);
	checkInputArray($_SERVER);

	if(isset($_SESSION)) {
		checkInputArray($_SESSION);
	}

	$REQUEST = $_REQUEST;
	$GET = $_GET;
	$POST = $_POST;
	$COOKIE = $_COOKIE;
	if(isset($_SESSION)) {
		$SESSION = $_SESSION;
	}
	$FILES = $_FILES;
	$ENV = $_ENV;
	$SERVER = $_SERVER;
	foreach($GLOBALS as $key => $value) {
		if($key != 'GLOBALS') {
			unset($GLOBALS[$key]);
		}
	}
	$_REQUEST = $REQUEST;
	$_GET = $GET;
	$_POST = $POST;
	$_COOKIE = $COOKIE;
	if(isset($SESSION)) {
		$_SESSION = $SESSION;
	}
	$_FILES = $FILES;
	$_ENV = $ENV;
	$_SERVER = $SERVER;
}
unregisterGlobals();
