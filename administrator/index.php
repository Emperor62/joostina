<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ��������� ����� ������������� �����
define('_VALID_MOS',1);

if(!file_exists('../configuration.php')) {
	header('Location: ../installation/index.php');
	exit();
}

require ('../includes/globals.php');
require_once ('../configuration.php');
require_once ($mosConfig_absolute_path.'/includes/joomla.php');

$config		= &Jconfig::getInstance();

// SSL check - $http_host returns <live site url>:<port number if it is 443>
$http_host = explode(':',$_SERVER['HTTP_HOST']);
if((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' || isset($http_host[1]) && $http_host[1] == 443) && substr($config->config_live_site,0,8) !='https://') {
	$config->config_live_site = 'https://' . substr($config->config_live_site,7);
}

$database	= &database::getInstance();
$mainframe = &mosMainFrame::getInstance(true);

// ��������� ip �����: ���� �� ��������� � ����-����� � ������� ����� ���������� �������� � �������, �� ��������� ������
if(file_exists('./components/com_security/block_access.php')) {
	require_once ('./components/com_security/block_access.php');
	block_access(1);
}
// ������ ip ������ ��� � ����-�����. ���������� ��������.


// �������� ����� �������� ����� �� ���������
if($config->config_lang == '') {
	$config->config_lang = 'russian';
	$mosConfig_lang = 'russian';
}

$mainframe->set('lang', $mosConfig_lang);
include_once($mainframe->getLangFile());

//Installation sub folder check, removed for work with SVN
if(file_exists('../installation/index.php') && $_VERSION->SVN == 0) {
	define('_INSTALL_CHECK',1);
	include ($config->config_absolute_path .DS.'templates'.DS.'system'.DS.'offline.php');
	exit();
}

$option = strtolower(strval(mosGetParam($_REQUEST,'option',null)));

session_name(md5($mosConfig_live_site));
session_start();

$bad_auth_count =intval(mosGetParam($_SESSION,'bad_auth',0));

if(isset($_POST['submit'])) {
	$usrname	= stripslashes(mosGetParam($_POST,'usrname',null));
	$pass		= stripslashes(mosGetParam($_POST,'pass',null));

	if($pass == null) {
		mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/',_PLEASE_ENTER_PASSWORD);
		exit();
	}

	if($config->config_captcha OR ((int) $config->config_admin_bad_auth >= 0 && $config->config_admin_bad_auth <= $bad_auth_count) ) {
		$captcha = mosGetParam($_POST,'captcha','');
		$captcha_keystring = mosGetParam($_SESSION,'captcha_keystring','');
		if($captcha_keystring!=$captcha) {
			mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/',_BAD_CAPTCHA_STRING);
			unset($_SESSION['captcha_keystring']);
			exit;
		}
	}
/*
	if((int) $config->config_admin_bad_auth >= 0 && $config->config_admin_bad_auth <= $bad_auth_count) {
		mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/',_USER_BLOKED);
		unset($_SESSION['captcha_keystring']);
		exit;
	}
*/
	$my = null;
	$query = 'SELECT * FROM #__users WHERE username ='.$database->Quote($usrname).' AND block = 0';
	$database->setQuery($query);
	$database->loadObject($my);

	/** find the user group (or groups in the future)*/
	if(isset($my->id)) {
		$grp = $acl->getAroGroup($my->id);
		$my->gid = $grp->group_id;
		$my->usertype = $grp->name;

		// Conversion to new type
		if((strpos($my->password,':') === false) && $my->password == md5($pass)) {
			// Old password hash storage but authentic ... lets convert it
			$salt = mosMakePassword(16);
			$crypt = md5($pass . $salt);
			$my->password = $crypt . ':' . $salt;

			// Now lets store it in the database
			$query = 'UPDATE #__users SET password = ' . $database->Quote($my->password) . 'WHERE id = ' . (int)$my->id;
			$database->setQuery($query);
			$database->query();
		}

		list($hash,$salt) = explode(':',$my->password);
		$cryptpass = md5($pass . $salt);

		if(strcmp($hash,$cryptpass) || !$acl->acl_check('administration','login','users',$my->usertype)) {
			// ������ �����������
			$query = 'UPDATE #__users SET bad_auth_count = bad_auth_count + 1 WHERE id = ' . (int)$my->id;
			$database->setQuery($query);
			$database->query();
			$_SESSION['bad_auth'] = $bad_auth_count + 1;

			if($_SESSION['bad_auth']>=$config->config_count_for_user_block){
				$query = 'UPDATE #__users SET block = 1 WHERE id = ' . (int)$my->id;
				$database->setQuery($query);
				$database->query();
			}

			mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/index.php?'.$config->config_admin_secure_code,_BAD_USERNAME_OR_PASSWORD);
			exit();
		}

		session_destroy();
		session_unset();
		session_write_close();

		// construct Session ID
		$logintime = time();
		$session_id = md5($my->id . $my->username . $my->usertype . $logintime);

		session_name( md5( $mosConfig_live_site ) );
		session_id( $session_id );
		session_start();

		// add Session ID entry to DB
		$query = "INSERT INTO #__session SET time = " . $database->Quote($logintime) .", session_id = " . $database->Quote($session_id) . ", userid = " . (int)$my->id . ", usertype = " . $database->Quote($my->usertype) . ", username = " . $database->Quote($my->username);
		$database->setQuery($query);
		if(!$database->query()) {
			echo $database->stderr();
		}

		// check if site designated as a production site
		// for a demo site allow multiple logins with same user account
		if($_VERSION->SITE == 1) {
			// delete other open admin sessions for same account
			$query = "DELETE FROM #__session WHERE userid = " . (int)$my->id . " AND username = " .$database->Quote($my->username) . "\n AND usertype = " . $database->Quote($my->usertype) . "\n AND session_id != " . $database->Quote($session_id). "\n AND guest = 1" . "\n AND gid = 0";
			$database->setQuery($query);
			if(!$database->query()) {
				echo $database->stderr();
			}
		}

		$_SESSION['session_id'] = $session_id;
		$_SESSION['session_user_id'] = $my->id;
		$_SESSION['session_USER'] = $my->username;
		$_SESSION['session_usertype'] = $my->usertype;
		$_SESSION['session_gid'] = $my->gid;
		$_SESSION['session_logintime'] = $logintime;
		$_SESSION['session_user_params'] = $my->params;
		$_SESSION['session_bad_auth_count'] = $my->bad_auth_count;
		$_SESSION['session_userstate'] = array();

		session_write_close();

		$expired = 'index2.php';

		// check if site designated as a production site
		// for a demo site disallow expired page functionality
		if($_VERSION->SITE == 1 && $mosConfig_admin_expired === '1') {
			$file = $mainframe->getPath('com_xml','com_users');
			$params = &new mosParameters($my->params,$file,'component');

			$now = time();

			// expired page functionality handling
			$expired = $params->def('expired','');
			$expired_time = $params->def('expired_time','');

			// if now expired link set or expired time is more than half the admin session life set, simply load normal admin homepage
			$checktime = ($mosConfig_session_life_admin ? $mosConfig_session_life_admin : 1800) / 2;
			if(!$expired || (($now - $expired_time) > $checktime)) {
				$expired = 'index2.php';
			}
			// link must also be a Joomla link to stop malicious redirection
			if(strpos($expired,'index2.php?option=com_') !== 0) {
				$expired = 'index2.php';
			}

			// clear any existing expired page data
			$params->set('expired','');
			$params->set('expired_time','');

			// param handling
			if(is_array($params->toArray())) {
				$txt = array();
				foreach($params->toArray() as $k => $v) {
					$txt[] = "$k=$v";
				}
				$saveparams = implode("\n",$txt);
			}

			// save cleared expired page info to user data
			$query = "UPDATE #__users SET params = " . $database->Quote($saveparams) ." WHERE id = " . (int)$my->id . " AND username = " . $database->Quote($my->username) . " AND usertype = " . $database->Quote($my->usertype);
			$database->setQuery($query);
			$database->query();

			// ��������� ������� ��������� ���������� � �������
			$query = 'UPDATE #__users SET bad_auth_count = 0 WHERE id = ' . $my->id;
			$database->setQuery($query);
			$database->query();

		}

		/** cannot using mosredirect as this stuffs up the cookie in IIS*/
		// redirects page to admin homepage by default or expired page
		echo "<script>document.location.href='$expired';</script>\n";
		exit();
	} else {
		mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/index.php?'.$config->config_admin_secure_code,_BAD_USERNAME_OR_PASSWORD);
		exit();
	}
} else {
	initGzip();
	header('Content-type: text/html; charset=UTF-8');
	if($config->config_admin_bad_auth <= $bad_auth_count && (int)$config->config_admin_bad_auth >= 0) {
		$config->config_captcha = 1;
	}
	$path = $config->config_absolute_path .DS.ADMINISTRATOR_DIRECTORY.DS.'templates'.DS. $mainframe->getTemplate() .DS. 'login.php';
	require_once ($path);
	doGzip();
}
?>
