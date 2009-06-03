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
$database	= &database::getInstance();


// SSL check - $http_host returns <live site url>:<port number if it is 443>
$http_host = explode(':',$_SERVER['HTTP_HOST']);
if((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' || isset($http_host[1]) && $http_host[1] == 443) && substr($config->config_live_site,0,8) !='https://') {
	$config->config_live_site = 'https://' . substr($config->config_live_site,7);
}


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

include_once ($config->config_absolute_path . '/language/' . $mosConfig_lang . '.php');

//Installation sub folder check, removed for work with SVN
if(file_exists('../installation/index.php') && $_VERSION->SVN == 0) {
	define('_INSTALL_CHECK',1);
	include ($config->config_absolute_path . '/templates/system/offline.php');
	exit();
}

$option = strtolower(strval(mosGetParam($_REQUEST,'option',null)));

// mainframe - �������� ������� ����� API, ������������ �������������� � '�����'
$mainframe = mosMainFrame::getInstance(true);

if(isset($_POST['submit'])) {
	$usrname	= stripslashes(mosGetParam($_POST,'usrname',null));
	$pass		= stripslashes(mosGetParam($_POST,'pass',null));

	session_name(md5($mosConfig_live_site));
	session_start();

	if($pass == null) {
		mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/',_PLEASE_ENTER_PASSWORD);
		exit();
	}

	if($config->config_admin_bad_auth <= mosGetParam($_SESSION,'bad_auth','') && (int) $config->config_admin_bad_auth >= 0) {
		$captcha = mosGetParam($_POST,'captcha','');
		$captcha_keystring = mosGetParam($_SESSION,'captcha_keystring','');
		if($captcha_keystring!=$captcha) {
			mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/',_BAD_CAPTCHA_STRING);
			unset($_SESSION['captcha_keystring']);
			exit;
		}
	}
	// ���������, ������� �� �� ����� �������������� � �������������������
	$query = "SELECT COUNT(*) FROM #__users"
			."\n WHERE (" // ��������������
			."\n gid = 24" // �������������������
			."\n OR gid = 25 )";
	$database->setQuery($query);
	$count = intval($database->loadResult());
	if($count < 1) {
		mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/index.php?'.$config->config_admin_secure_code,_LOGIN_NOADMINS);
	}

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
			if(!$database->query()) {
				// This is an error but not sure what to do with it ... we'll still work for now
			}
		}

		list($hash,$salt) = explode(':',$my->password);
		$cryptpass = md5($pass . $salt);

		if(strcmp($hash,$cryptpass) || !$acl->acl_check('administration','login','users',$my->usertype)) {
			// ������ �����������
			$query = 'UPDATE #__users SET bad_auth_count = bad_auth_count + 1 WHERE id = ' . (int)$my->id;
			$database->setQuery($query);
			$database->query();
			$_SESSION['bad_auth'] = ((int)$_SESSION['bad_auth']) + 1;
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
		$_SESSION['session_username'] = $my->username;
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
		mosRedirect($config->config_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/index.php?'.$config->config_admin_secure_code,_BAD_USERNAME_OR_PASSWORD2);
		exit();
	}
} else {
	initGzip();
	session_start();
	if(!isset($_SESSION['bad_auth'])){
		$_SESSION['bad_auth'] = 0;
	}

	if($config->config_admin_bad_auth <= $_SESSION['bad_auth'] && (int)$config->config_admin_bad_auth >= 0) {
		$config->config_captcha = 1;
	}
	$path = $config->config_absolute_path . '/'.ADMINISTRATOR_DIRECTORY.'/templates/' . $mainframe->getTemplate() . '/login.php';
	require_once ($path);
	doGzip();
}
?>
