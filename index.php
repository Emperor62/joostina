<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ��������� ����� ������������� �����
define('_VALID_MOS',1);


if(function_exists('memory_get_usage')){
	define('_MEM_USAGE_START', memory_get_usage());
}else{
	define('_MEM_USAGE_START',null);
}

// �������� ����������������� �����, ���� �� ���������, �� ����������� �������� ���������
if(!file_exists('configuration.php') || filesize('configuration.php') < 10) {
	$self = rtrim(dirname($_SERVER['PHP_SELF']),'/\\').'/';
	header('Location: http://'.$_SERVER['HTTP_HOST'].$self.'installation/index.php');
	exit();
}
// ���������������� ��� ������������� ������
$mosConfig_absolute_path = dirname( __FILE__ );

// ����������� ����� �������� ���������� ����������� ���������� ����������
require ($mosConfig_absolute_path.'/includes/globals.php');

// ����������� ����� ������������
require_once ('./configuration.php');

// ������� ����� �� ������� ������������� ��������
if($mosConfig_time_gen) {
	list($usec,$sec) = explode(" ",microtime());
	$sysstart = ((float)$usec + (float)$sec);
}
// �������� � ��������� ������������ ���������
if($mosConfig_debug) {
	require_once $mosConfig_absolute_path.'/includes/libraries/debug/jdebug.php';
	$debug = new jdebug();
}

// �������� SSL - $http_host ���������� <url_�����>:<�����_�����, ���� �� 443>
$http_host = explode(':',$_SERVER['HTTP_HOST']);
if((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' || isset($http_host[1]) && $http_host[1] == 443) && substr($mosConfig_live_site,0,8) !='https://') {
	$mosConfig_live_site = 'https://'.substr($mosConfig_live_site,7);
}
// ����������� �������� ����� - ���� �������
require_once ($mosConfig_absolute_path.'/includes/joomla.php');

// �������� � ������������� � �� WWW ������
joostina_api::check_host();

//�������� �������� ���������, ������� ��� ������ � SVN
if(file_exists('installation/index.php') && $_VERSION->SVN == 0) {
	define('_INSTALL_CHECK',1);
	include ($mosConfig_absolute_path.'/templates/system/offline.php');
	exit();
}

// ����������� �������� ������������ �����
if($mosConfig_offline == 1) {
	require ($mosConfig_absolute_path.'/templates/system/offline.php');
	exit();
}

// ���������, ��������� �� ������������� ��������� ��������
if($mosConfig_mmb_system_off == 0) {
	$_MAMBOTS->loadBotGroup('system');
	// ������� ������� onStart
	$_MAMBOTS->trigger('onStart');
}

if(file_exists($mosConfig_absolute_path.'/components/com_sef/sef.php')) {
	require_once ($mosConfig_absolute_path.'/components/com_sef/sef.php');
} else {
	require_once ($mosConfig_absolute_path.'/includes/sef.php');
}


require_once ($mosConfig_absolute_path.'/includes/frontend.php');


// ����� ��������� ���������� url (��� form)
$option = strval(strtolower(mosGetParam($_REQUEST,'option')));
$Itemid = intval(mosGetParam($_REQUEST,'Itemid',null));

if($option == '') {
	if($Itemid) {
		$query = "SELECT id, link"
		."\n FROM #__menu"
		."\n WHERE menutype = 'mainmenu'"
		."\n AND id = ".(int)$Itemid
		."\n AND published = 1";
		$database->setQuery($query);
	} else {
		$query = "SELECT id, link"
		."\n FROM #__menu"
		."\n WHERE menutype = 'mainmenu'"
		."\n AND published = 1"
		."\n ORDER BY parent, ordering";
		$database->setQuery($query,0,1);
	}
	$menu = new mosMenu($database);
	if($database->loadObject($menu)) {
		$Itemid = $menu->id;
	}
	$link = $menu->link;
	unset($menu);
	if(($pos = strpos($link,'?')) !== false) {
		$link = substr($link,$pos + 1).'&Itemid='.$Itemid;
	}
	parse_str($link,$temp);
	/** ��� ����, ��������� ���������� ��� ������� ���������� ����������� �����������*/
	foreach($temp as $k => $v) {
		$GLOBALS[$k] = $v;
		$_REQUEST[$k] = $v;
		if($k == 'option') {
			$option = $v;
		}
	}
}

if(!$Itemid) {
	// ����� �� ������ Itemid, �� ��� ������������� �������� �� ���������
	$Itemid = 99999999;
}

// mainframe - �������� ������� ����� API, ������������ �������������� � '�����'
$mainframe = mosMainFrame::getInstance();

// ���������� ������� ������ �� ������
if($mosConfig_session_front == 0) {
	$mainframe->initSession();
}
// ������� ������� onAfterStart
if($mosConfig_mmb_system_off == 0) {
	$_MAMBOTS->trigger('onAfterStart');
}
// ��������, ���� �� ����� ����� Itemid � ����������
if($option == 'com_content' && $Itemid === 0) {
	$id = intval(mosGetParam($_REQUEST,'id',0));
	$Itemid = $mainframe->getItemid($id);
}

/** �� ��� ��� �� ���������� Itemid??*/
if($Itemid === 0) {
	/** ���, ������������ ������ ������� ��������.*/
	$query = "SELECT id"
	."\n FROM #__menu"
	."\n WHERE menutype = 'mainmenu'"
	."\n AND published = 1"
	."\n ORDER BY parent, ordering";
	$database->setQuery($query,0,1);
	$Itemid = $database->loadResult();
}

// ���� ���������� ����������� �� �������
if($option == 'search') {
	$option = 'com_search';
}

// �������� ����� �������� ����� �� ���������
if($mosConfig_lang == '') {
	$mosConfig_lang = 'russian';
}
include_once ($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'.php');

// �������� ����� � ������ � �����-���
$return		= strval(mosGetParam($_REQUEST,'return',null));
$message	= intval(mosGetParam($_POST,'message',0));

/** ��������� ���������� � ������� ������������� �� ������� ������*/
// $my - ������ ��������, � �� ���������� �� ������� �� �������� ������������
$my = $mainframe->getUser();
$gid = intval($my->gid);

if($option == 'login') {
	$mainframe->login();
	// ����������� ��������� JS
	if($message) {?>
		<script language="javascript" type="text/javascript">
		<!--//
		alert( "<?php echo addslashes(_LOGIN_SUCCESS); ?>" );
		//-->
		</script>
<?php
	}

	if($return && !(strpos($return,'com_registration') || strpos($return,'com_login'))) {
		// checks for the presence of a return url
		// and ensures that this url is not the registration or login pages
		// ���� sessioncookie ����������, �������� �� �������� ��������. Otherwise, take an extra round for a cookiecheck
		if(isset($_COOKIE[mosMainFrame::sessionCookieName()])) {
			mosRedirect($return);
		} else {
			mosRedirect($mosConfig_live_site.'/index.php?option=cookiecheck&return='.urlencode($return));
		}
	} else {
		// If a sessioncookie exists, redirect to the start page. Otherwise, take an extra round for a cookiecheck
		if(isset($_COOKIE[mosMainFrame::sessionCookieName()])) {
			mosRedirect($mosConfig_live_site.'/index.php');
		} else {
			mosRedirect($mosConfig_live_site.'/index.php?option=cookiecheck&return='.urlencode($mosConfig_live_site.'/index.php'));
		}
	}

} elseif($option == 'logout') {
	$mainframe->logout();

	// ����������� ��������� JS
	if($message) {?>
		<script language="javascript" type="text/javascript">
		<!--//
		alert( "<?php echo addslashes(_LOGOUT_SUCCESS); ?>" );
		//-->
		</script>
<?php
	}

	if($return && !(strpos($return,'com_registration') || strpos($return,'com_login'))) {
		// checks for the presence of a return url
		// and ensures that this url is not the registration or logout pages
		mosRedirect($return);
	} else {
		mosRedirect($mosConfig_live_site.'/index.php');
	}
} elseif($option == 'cookiecheck') {
	// No cookie was set upon login. If it is set now, redirect to the given page. Otherwise, show error message.
	if(isset($_COOKIE[mosMainFrame::sessionCookieName()])) {
		mosRedirect($return);
	} else {
		mosErrorAlert(_ALERT_ENABLED);
	}
}


// ��������� ������� ��������
$cur_template = $mainframe->getTemplate();

/**
** * @global - ����� ��� �������� ���������� ��������� ����������*/
$_MOS_OPTION = array();

// ����������� ������� ���������, �.�. ������(����������� ) �� ������ ��������� - ��� ���� ���������
if($mosConfig_frontend_login == 1) {
	require_once ($mosConfig_absolute_path.'/includes/editor.php');
}
// ������ ����������� ��������� �����������

include($mosConfig_absolute_path.'/includes/libraries/html_optimize/html_optimize.php');


ob_start();
if($path = $mainframe->getPath('front')) {
	$task = strval(mosGetParam($_REQUEST,'task',''));
	$ret = mosMenuCheck($Itemid,$option,$task,$gid);
	if($ret) {
		require_once ($path);
	} else {
		mosNotAuth();
	}
} else {
	header('HTTP/1.0 404 Not Found');
	echo _NOT_EXIST;
}
$_MOS_OPTION['buffer'] = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
ob_end_clean();

// ��������� �������� ������ mainbody
if($mosConfig_mmb_mainbody_off == 0) {
	$_MAMBOTS->loadBotGroup('mainbody');
	$_MAMBOTS->trigger('onMainbody');
}

initGzip();

header('Content-type: text/html; charset=UTF-8');
// ��� �������� ����������� �������� �������� ����� "����������" ���������
if(!$mosConfig_caching) { // �� ����������
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Pragma: no-cache');
} elseif($option != 'logout' or $option != 'login') { // ����������
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Expires: '.gmdate('D, d M Y H:i:s',time() + 3600).' GMT');
	header('Cache-Control: max-age=3600');
}


// ����������� �������������� � ����������� �����, ��� ����� ������
if(defined('_ADMIN_OFFLINE')) {
	include ($mosConfig_absolute_path.'/templates/system/offlinebar.php');
}
// ����������� ��������� �����������, ���������� ��� �������� ������ templates
ob_start();
// �������� ����� �������
if(!file_exists($mosConfig_absolute_path.'/templates/'.$cur_template.'/index.php')) {
	echo _TEMPLATE_WARN.$cur_template;
} else {
	require_once ($mosConfig_absolute_path.'/templates/'.$cur_template.'/index.php');
}
$_MOS_OPTION['mainbody'] = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
ob_end_clean();

// ��������� �������� ������ mainbody
if($mosConfig_mmb_mainbody_off == 0) {
	$_MAMBOTS->loadBotGroup('mainbody');
	$_MAMBOTS->trigger('onTemplate');
}
// boston, ��������� ������ ������, �� ������ ��-���� �������
unset($_MAMBOTS,$mainframe,$my);
// ����� ����� ����� ���� ��������, ��� ����� ��������� ��������� ������ onTemplate
echo $_MOS_OPTION['mainbody'];
flush();

// ������� ������� ��������� ��������
if($mosConfig_time_gen) {
	list($usec,$sec) = explode(' ',microtime());
	$sysstop = ((float)$usec + (float)$sec);
	echo '<div id="time_gen">'.round($sysstop - $sysstart,4).'</div>';
}

// ����� ���� �������
if($mosConfig_debug) {
	if(function_exists('memory_get_usage')) {
		$mem_usage = (memory_get_usage() - _MEM_USAGE_START);
		$debug->add('<b>'._SCRIPT_MEMORY_USING.':</b> '.sprintf('%0.2f',$mem_usage / 1048576).' MB');
	}
	echo $debug->get($mosConfig_front_debug);
}

doGzip();
// ��������� ���������� ����������� ������
if($mosConfig_optimizetables == 1) {
	joostina_api::optimizetables();
}
// ������� �������� ����
//if($mosConfig_clearCache == 1 && $mosConfig_caching == 1) {
	joostina_api::clear_cache();
//}
exit();
?>
