<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ��������� �����, ��� ��� - ������������ ����
define('_VALID_MOS',1);
// ���������������� ��� ������������� ������
$mosConfig_absolute_path = dirname( __FILE__ );


require ($mosConfig_absolute_path.'/includes/globals.php');
require_once ('./configuration.php');

// SSL check - $http_host returns <live site url>:<port number if it is 443>
$http_host = explode(':',$_SERVER['HTTP_HOST']);
if((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' || isset($http_host[1]) && $http_host[1] == 443) && substr($mosConfig_live_site,0,8) != 'https://') {
	$mosConfig_live_site = 'https://'.substr($mosConfig_live_site,7);
}

require_once ($mosConfig_absolute_path.'/includes/joomla.php');

// ����������� ��������� ������������ �����
if($mosConfig_offline == 1) {
	require ($mosConfig_absolute_path.'/templates/system/offline.php');
}

// �������� ������ ���������� ����
$_MAMBOTS->loadBotGroup('system');

// ������������ ������� onStart
$_MAMBOTS->trigger('onStart');

if(file_exists($mosConfig_absolute_path.'/components/com_sef/sef.php')) {
	require_once ($mosConfig_absolute_path.'/components/com_sef/sef.php');
} else {
	require_once ($mosConfig_absolute_path.'/includes/sef.php');
}
require_once ($mosConfig_absolute_path.'/includes/frontend.php');

// ������ ��������� ���������� url (��� �����)
$option		= strtolower(strval(mosGetParam($_REQUEST,'option')));
$Itemid		= intval(mosGetParam($_REQUEST,'Itemid',0));
$no_html	= intval(mosGetParam($_REQUEST,'no_html',0));
$act		= strval(mosGetParam($_REQUEST,'act',''));
$pop		= intval(mosGetParam($_GET,'pop'));
$page		= intval(mosGetParam($_GET,'page'));

$print = false;
if($pop=='1' && $page==0) $print = true;

// ������� ���� �������� ���������� API, ��� �������������� ������ '����'
//$mainframe = new mosMainFrame($database,$option,'.');
$mainframe = &mosMainFrame::getInstance();

//����������� ����������
if(is_file($mosConfig_absolute_path.DS.'multisite.config.php')){
	include_once($mosConfig_absolute_path.DS.'multisite.config.php');	
}

if($mosConfig_no_session_front == 0) {
	$mainframe->initSession();
}

// trigger the onAfterStart events
$_MAMBOTS->trigger('onAfterStart');

if($mainframe->get('_multisite')=='2' && $cookie_exist ){
	$mainframe->set('_multisite_params', $m_s);	
	$my = $mainframe->getUser_from_sess($_COOKIE[mosMainFrame::sessionCookieName($m_s->main_site)]);
}
else{
	$my = $mainframe->getUser();
}
$gid = intval($my->gid);
// patch to lessen the impact on templates
if($option == 'search') {
	$option = 'com_search';
}

// �������� ����� �������� ����� �� ���������
$mosConfig_lang = ($mosConfig_lang == '') ? 'russian' : $mosConfig_lang;
$mainframe->set('lang', $mosConfig_lang);
include_once($mainframe->getLangFile());

if($option == 'login') {
	$mainframe->login();
	mosRedirect('index.php');
} elseif($option == 'logout') {
	$mainframe->logout();
	mosRedirect('index.php');
}

$cur_template = $mainframe->getTemplate();
// ���������� ���������� ��������
require_once ($mosConfig_absolute_path . '/includes/editor.php');

ob_start();

if($path = $mainframe->getPath('front')) {
	$task = strval(mosGetParam($_REQUEST,'task',''));
	$ret = mosMenuCheck($Itemid,$option,$task,$gid);
	if($ret) {
		//���������� ���� ����������
		if($mainframe->getLangFile($option)){ 
			include_once($mainframe->getLangFile($option));
		}
		//$mainframe->addLib('mylib');
		require_once ($path);
	} else {
		mosNotAuth();
	}
} else {
	header("HTTP/1.0 404 Not Found");
	echo _NOT_EXIST;
}
$_MOS_OPTION['buffer'] = ob_get_contents();

ob_end_clean();

global $mosConfig_custom_print;

// ������ ��������
if($print){
	$cpex = 0;
	if($mosConfig_custom_print){
		$cust_print_file = $mosConfig_absolute_path.'/templates/'.$cur_template.'/html/print.php';
		if(file_exists($cust_print_file)){
			ob_start();
			include($cust_print_file);
			$_MOS_OPTION['buffer'] = ob_get_contents();
			ob_end_clean();
			$cpex = 1;
		}
	}
	if(!$cpex){
		$mainframe->addCSS($mosConfig_live_site.'/templates/css/print.css');
		$mainframe->addJS($mosConfig_live_site.'/includes/js/print/print.js');

		$pg_link	= str_replace(array('&pop=1','&page=0'),'',$_SERVER['REQUEST_URI']);
		$pg_link	= str_replace('index2.php','index.php',$pg_link);

		$_MOS_OPTION['buffer'] = '<div class="logo">'. $mosConfig_sitename .'</div><div id="main">'.$_MOS_OPTION['buffer']."\n</div>\n<div id=\"ju_foo\">"._PRINT_PAGE_LINK." :<br /><i>".sefRelToAbs($pg_link)."</i><br /><br />&copy; ".$mosConfig_sitename.",&nbsp;".date('Y').'</div>';
	}
}else{
	$mainframe->addCSS($mosConfig_live_site.'/templates/'.$cur_template.'/css/template_css.css');
}
// ����������� js ���������� �������
if($my->id || $mainframe->get('joomlaJavascript')) {
	$mainframe->addJS($mosConfig_live_site.'/includes/js/joomla.javascript.js');
}

initGzip();
header('Content-type: text/html; charset=UTF-8');
/*
// ��� �������� ����������� �������� �������� ����� "����������" ���������
if(!$mosConfig_caching) { // �� ����������
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Pragma: no-cache');
} else { // ����������
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	// 60*60=3600 - ������������� ����������� �� 1 ���
	header('Expires: '.gmdate('D, d M Y H:i:s',time() + 3600).' GMT');
	header('Cache-Control: max-age=3600');
}*/

// ����������� ��������� ������������ ����� ��� ����� ������
if(defined('_ADMIN_OFFLINE')) {
	include ($mosConfig_absolute_path.'/templates/system/offlinebar.php');
}

// ����� ��������� HTML
if($no_html == 0) {
	$customIndex2 = 'templates/'.$mainframe->getTemplate().'/index2.php';
	if(file_exists($customIndex2)) {
		require ($customIndex2);
	} else {
		// ��������� ��� ��������� ������ ISO �� ���������  _ISO ��������� ����� �����
		$iso = split('=',_ISO);
		// ������ xml
		echo '<?xml version="1.0" encoding="'.$iso[1].'"?'.'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="shortcut icon" href="<?php echo $mosConfig_live_site; ?>/images/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	<?php echo $mainframe->getHead(); ?>
</head>
	<body class="contentpane">
	<?php mosMainBody(); ?>
	</body>
</html>
<?php
	}
} else {
	mosMainBody();
}
doGzip();