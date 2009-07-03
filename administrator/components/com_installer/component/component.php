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

if(!$acl->acl_check('administration','install','users',$my->usertype,$element.'s','all')) {
	mosRedirect('index2.php',_NOT_AUTH);
}

require_once ($mainframe->getPath('installer_html','component'));
require_once ($mainframe->getPath('installer_class','component'));

switch($task) {
	case 'remove':
		removeElement($client);
		js_menu_cache_clear();
		break;
	default:
		showInstalledComponents($option);
		js_menu_cache_clear();
		break;
}
//showInstalledComponents($option);

/**
*
* @param
*/
function removeElement($client) {
	josSpoofCheck(null, null, 'request');
	$cid = mosGetParam($_REQUEST,'cid',array(0));
	if(!is_array($cid)) {
		$cid = array(0);
	}

	$installer = new mosInstallerComponent();
	$result = false;
	if($cid[0]) {
		$result = $installer->uninstall($cid[0],$option,$client);
	}

	$msg = $installer->getError();

	mosRedirect($installer->returnTo('com_installer','component',$client),$result?_DELETE_SUCCESS.' '.$msg : _UNSUCCESS.' '.$msg);
}
/**
* @param string The URL option
*/
function showInstalledComponents($option) {
	$database = &database::getInstance();

	$query = "SELECT * FROM #__components WHERE parent = 0 AND iscore = 0 ORDER BY name";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	// Read the component dir to find components
	$componentBaseDir = mosPathName(Jconfig::getInstance()->config_absolute_path.DS.ADMINISTRATOR_DIRECTORY.DS.'components');
	$componentDirs = mosReadDirectory($componentBaseDir);

	$n = count($rows);
	for($i = 0; $i < $n; $i++) {
		$row = &$rows[$i];

		$dirName = $componentBaseDir.$row->option;
		$xmlFilesInDir = mosReadDirectory($dirName,'.xml$');

		foreach($xmlFilesInDir as $xmlfile) {
			// Read the file to see if it's a valid component XML file
			$xmlDoc = new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors(true);

			if(!$xmlDoc->loadXML($dirName.'/'.$xmlfile,false,true)) {
				continue;
			}

			$root = &$xmlDoc->documentElement;

			if($root->getTagName() != 'mosinstall') {
				continue;
			}
			if($root->getAttribute("type") != "component") {
				continue;
			}

			$element = &$root->getElementsByPath('creationDate',1);
			$row->creationdate = $element?$element->getText():_UNKNOWN;

			$element = &$root->getElementsByPath('author',1);
			$row->author = $element?$element->getText():_UNKNOWN;

			$element = &$root->getElementsByPath('copyright',1);
			$row->copyright = $element?$element->getText():'';

			$element = &$root->getElementsByPath('authorEmail',1);
			$row->authorEmail = $element?$element->getText():'';

			$element = &$root->getElementsByPath('authorUrl',1);
			$row->authorUrl = $element?$element->getText():'';

			$element = &$root->getElementsByPath('version',1);
			$row->version = $element?$element->getText():'';

			$row->mosname = strtolower(str_replace(" ","_",$row->name));

			$row->img = ($row->menuid ==0) ? 'publish_g.png':'publish_x.png';
			unset($xmlDoc,$root,$element);
		}
	}

	HTML_component::showInstalledComponents($rows,$option);
}
?>
