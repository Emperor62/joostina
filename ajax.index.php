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

$mosConfig_absolute_path = dirname( __FILE__ );
require ($mosConfig_absolute_path.'/includes/globals.php');
require_once ('./configuration.php');

require_once ('includes/joomla.php');

// ����������� ��������� ������������ �����
if($mosConfig_offline == 1) {
	echo 'syte-offline';
	exit();
}

if(file_exists($mosConfig_absolute_path.'/components/com_sef/sef.php')) {
	require_once ($mosConfig_absolute_path.'/components/com_sef/sef.php');
} else {
	require_once ($mosConfig_absolute_path.'/includes/sef.php');
}

// �������������� ������������� � ������, �� ��������� �������
$utf_conv	= intval(mosGetParam($_REQUEST,'utf',1));
$option		= strval(strtolower(mosGetParam($_REQUEST,'option','')));
$task		= strval(mosGetParam($_REQUEST,'task',''));

$commponent = str_replace('com_','',$option);

if($mosConfig_mmb_system_off == 0) {
	$_MAMBOTS->loadBotGroup('system');
	$_MAMBOTS->trigger('onAjaxStart');
}

// mainframe - �������� ������� ����� API, ������������ �������������� � '�����'
$mainframe = &mosMainFrame::getInstance();
//����������� ����������
if(is_file($mosConfig_absolute_path.DS.'multisite.config.php')){
	include_once($mosConfig_absolute_path.DS.'multisite.config.php');
}

$mainframe->initSession();


// �������� ����� �������� ����� �� ���������
if($mosConfig_lang == '') {
	$mosConfig_lang = 'russian';
}
$mainframe->set('lang', $mosConfig_lang);
include_once($mainframe->getLangFile());

// get the information about the current user from the sessions table
if($mainframe->get('_multisite')=='2' && $cookie_exist ){
	$mainframe->set('_multisite_params', $m_s);
	$my = $mainframe->getUser_from_sess($_COOKIE[mosMainFrame::sessionCookieName($m_s->main_site)]);
}
else{
	$my = $mainframe->getUser();
}
$gid = intval($my->gid);

if($mosConfig_mmb_system_off == 0) {
	$_MAMBOTS->trigger('onAfterAjaxStart');
}

header("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate ");

// ���������, ����� ���� ���������� ����������, ������ ������� �� ���������� GET �������
if(file_exists($mosConfig_absolute_path . "/components/$option/$commponent.ajax.php")) {
	include_once ($mosConfig_absolute_path . "/components/$option/$commponent.ajax.php");
} else {
	die('error-1');
}