<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/copyleft/gpl.html GNU/GPL, �������� LICENSE.php
* Joostina! - ��������� ����������� �����������. ��� ������ ����� ���� ��������
* � ������������ � ����������� ������������ ��������� GNU, ������� ��������
* � ���������� ��������������� � ������� ���������� ������, ����������������
* �������� ����������� ������������ ��������� GNU ��� ������ �������� ���������
* �������� ��� �������� � �������� �������� �����.
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� COPYRIGHT.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die( '������ ����� ����� ��������' );

global $mainframe, $database;
$database->setQuery( "SELECT lang FROM #__jce_langs WHERE published= '1'" );
$lang = $database->loadResult();

$database->setQuery( "SELECT id as id, plugin as plugin FROM #__jce_plugins WHERE type = 'plugin'" );
$plugins = $database->loadObjectList();

require_once( $mainframe->getCfg('absolute_path') . '/administrator/components/com_jce/language/' . $lang . '.php' );

$backlink = '<a href="index2.php?option=com_jce&task=lang">'._JCE_LANG_BACK.'</a>';
HTML_installer::showInstallForm( _JCE_LANG_HEADING_INSTALL, $option, 'language', '', dirname(__FILE__), $backlink );
?>
<table class="content">
<?php
writableCell( 'administrator/components/com_jce/language' );
writableCell( 'mambots/editors/jce/jscripts/tiny_mce/langs' );
writableCell( 'mambots/editors/jce/jscripts/tiny_mce/themes/advanced/langs' );
foreach( $plugins as $plugin ){
	if( file_exists( $mainframe->getCfg('absolute_path') . '/mambots/editors/jce/jscripts/tiny_mce/plugins/' . $plugin->plugin . '/langs' ) ){
		writableCell( 'mambots/editors/jce/jscripts/tiny_mce/plugins/' . $plugin->plugin . '/langs' );
	}
}
?>
</table>
