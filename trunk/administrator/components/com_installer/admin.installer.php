<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

require_once ($mainframe->getPath('admin_html'));
require_once ($mainframe->getPath('installer_class','installer'));


// XML library
require_once ($mosConfig_absolute_path.'/includes/domit/xml_domit_lite_include.php');

$element	= mosGetParam($_REQUEST,'element','');
$client		= mosGetParam($_REQUEST,'client','');
$option		= mosGetParam($_REQUEST,'option','');
$url		= mosGetParam($_REQUEST,'url','');

// ensure user has access to this function
if(!$acl->acl_check('administration','install','users',$my->usertype,$element.'s','all')) {
	mosRedirect('index2.php',_NOT_AUTH);
}

$path = $mosConfig_absolute_path.DS.ADMINISTRATOR_DIRECTORY."/components/com_installer/$element/$element.php";

if(file_exists($path)) {
	require $path;
} else {
	echo "[$element] - "._NO_INSTALLER;
}
?>
