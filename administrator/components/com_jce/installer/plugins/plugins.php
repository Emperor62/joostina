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

require_once ($mosConfig_absolute_path.
	'/'.ADMINISTRATOR_DIRECTORY.'/components/com_jce/installer/plugins/plugins.html.php');

global $mosConfig_absolute_path,$database;
$database->setQuery("SELECT lang FROM #__jce_langs WHERE published= '1'");
$lang = $database->loadResult();
require_once ($mosConfig_absolute_path.
	"/".ADMINISTRATOR_DIRECTORY."/components/com_jce/language/".$lang.".php");

HTML_installer::showInstallForm(_JCE_PLUGINS_INSTALL_HEADING,$option,'plugins',
	'',dirname(__file__));
?>
<table class="content">
<?php
writableCell('mambots/editors/jce/jscripts/tiny_mce/plugins');
?>
</table>
<?php
showInstalledPlugins($option);

function showInstalledPlugins($_option) {
	global $database,$mosConfig_absolute_path;

	$query = "SELECT id, name, plugin, client_id"."\n FROM #__jce_plugins"."\n WHERE iscore = 0 AND type = 'plugin'".
		"\n ORDER BY plugin, name";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	// path to mambot directory
	$mambotBaseDir = mosPathName(mosPathName($mosConfig_absolute_path).
		"mambots/editors/jce/jscripts/tiny_mce/plugins");
	$xmlfile = '';
	$id = 0;
	$n = count($rows);
	for($i = 0; $i < $n; $i++) {
		$row = &$rows[$i];
		// xml file for module
		$xmlfile = $mambotBaseDir."/".$row->plugin.'/'.$row->plugin.".xml";

		if(file_exists($xmlfile)) {
			$xmlDoc = new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors(true);
			if(!$xmlDoc->loadXML($xmlfile,false,true)) {
				continue;
			}

			$root = &$xmlDoc->documentElement;

			if($root->getTagName() != 'mosinstall') {
				continue;
			}
			if($root->getAttribute("type") != "jceplugin") {
				continue;
			}

			$element = &$root->getElementsByPath('creationDate',1);
			$row->creationdate = $element?$element->getText():'';

			$element = &$root->getElementsByPath('author',1);
			$row->author = $element?$element->getText():'';

			$element = &$root->getElementsByPath('copyright',1);
			$row->copyright = $element?$element->getText():'';

			$element = &$root->getElementsByPath('authorEmail',1);
			$row->authorEmail = $element?$element->getText():'';

			$element = &$root->getElementsByPath('authorUrl',1);
			$row->authorUrl = $element?$element->getText():'';

			$element = &$root->getElementsByPath('version',1);
			$row->version = $element?$element->getText():'';

		}
	}

	HTML_plugins::showInstalledPlugins($rows,$_option,$id,$xmlfile);
}
?>