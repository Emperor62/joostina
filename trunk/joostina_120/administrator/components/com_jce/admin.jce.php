<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

// ensure user has access to this function
//if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
// | $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_jce' ))) {
//  mosRedirect( 'index2.php', _NOT_AUTH );
//}

DEFINE('_BASE_PATH',dirname(__file__));

require_once ($mainframe->getPath('admin_html'));

require_once (_BASE_PATH.'/layout.php');
require_once (_BASE_PATH.'/layout.html.php');

require_once (_BASE_PATH.'/plugins/plugins.php');
require_once (_BASE_PATH.'/languages/languages.php');
require_once (_BASE_PATH.'/installer/installer.php');

$query = "SELECT id FROM #__mambots WHERE element = 'jce' AND folder = 'editors'";
$database->setQuery($query);
$eid = $database->loadResult();

function cleanInput($string) {
	return preg_replace('/[^a-zA-z._]/i','',$string);
}
switch($task) {
	case 'plugin':
		$query = "SELECT plugin FROM #__jce_plugins WHERE published = 1 AND type = 'plugin'";
		$database->setQuery($query);
		$plugins = $database->loadResultArray();

		$plugin = cleanInput(mosGetParam($_REQUEST,'plugin'));
		if(in_array($plugin,$plugins)) {
			$file = cleanInput(basename(mosGetParam($_REQUEST,'file')));
			$path = $mainframe->getCfg('absolute_path').'/mambots/editors/jce/jscripts/tiny_mce/plugins/'.$plugin;
			if(is_dir($path) && file_exists($path.'/'.$file)) {
				include_once $path.'/'.$file;
			} else {
			echo $path.'/'.$file;
				die('���� �� ������!');
			}
		} else {
			die('������ �� ������!');
		}
		break;
	case 'help':
		$file = cleanInput(basename(mosGetParam($_REQUEST,'file')));
		$path = $mainframe->getCfg('absolute_path').'/mambots/editors/jce/jscripts/tiny_mce/libraries/help/'.$file;
		if(file_exists($path)) {
			include_once $path;
		} else {
			die('���� �� ������!');
		}
		break;
	case 'main':
		HTML_JCEAdmin::showAdmin();
		break;
	case 'save':
		saveconfig();
		break;
	case 'config':
		global $client,$eid;
		if($eid) {
			mosRedirect('index2.php?option=com_mambots&client='.$client.'&task=editA&hidemainmenu=1&id='.$eid.'');
		} else {
			mosRedirect('index2.php?option='.$option.'&client='.$client.'','������ ��������� JCE �� ����������.');
		}
		break;
	case 'editlayout':
		global $client,$eid;
		if($eid) {
			editLayout($option,$client);
		} else {
			mosRedirect('index2.php?option='.$option.'&client='.$client.'','������ ��������� JCE �� ����������.');
		}
		break;
	case 'savelayout':
		saveLayout($option,$client);
		break;
	case 'applyaccess':
		applyAccess($cid,$option,$client);
		break;
	case 'showplugins':
	case 'plugins':
		global $client,$eid;
		if($eid) {
			viewPlugins($option,$client);
		} else {
			mosRedirect('index2.php?option='.$option.'&client='.$client.'',	'������ ��������� JCE �� ����������.');
		}
		break;
	case 'publish':
	case 'unpublish':
		publishPlugins($cid,($task == 'publish'),$option,$client);
		break;
	case 'newplugin':
	case 'editplugin':
		editPlugins($option,$id,$client);
		break;
	case 'saveplugin':
	case 'applyplugin':
		savePlugins($option,$client,$task);
		break;
	case 'canceledit':
		cancelEdit($option,$client);
		break;
	case 'removeplugin':
		removePlugin($cid[0],$option,$client);
		break;
	case 'installplugin':
		global $client;
		mosRedirect('index2.php?option=com_jce&client='.$client.
			'&task=install&element=plugins');
		break;
	case 'install':
		global $client,$eid;
		if($eid) {
			jceInstaller($option,$client,'show');
		} else {
			mosRedirect('index2.php?option='.$option.'&client='.$client.'',
				'������ ��������� JCE �� ����������.');
		}
		break;
	case 'uploadfile':
		jceInstaller($option,$client,'uploadfile');
		break;
	case 'installfromdir':
		jceInstaller($option,$client,'installfromdir');
		break;
	case 'remove':
		jceInstaller($option,$client,'remove');
		break;
	case 'lang':
		global $client,$eid;
		if($eid) {
			viewLanguages($option);
		} else {
			mosRedirect('index2.php?option='.$option.'&client='.$client.'',
				'������ ��������� JCE �� ����������.');
		}
		break;
	case 'newlang':
		mosRedirect('index2.php?option=com_jce&client='.$client.
			'&task=install&element=language');
		break;
	case 'removelang':
		removeLanguage($cid[0],$option,$client);
		break;
	case 'publishlang':
		publishLanguage($cid[0],$option,$client);
		break;
	default:
		HTML_JCEAdmin::showAdmin();
		break;
}
?>