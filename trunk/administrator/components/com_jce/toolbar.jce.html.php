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

class TOOLBAR_JCE {
	function _CONFIG() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::custom('main','-back','',_MAIN_PAGE,false);
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
	function _PLUGINS() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::custom('newplugin','-new','',_NEW,false);
		mosMenuBar::spacer();
		mosMenuBar::custom('installplugin','-new','',_INSTALLATION,false);
		mosMenuBar::spacer();
		mosMenuBar::custom('editlayout','-preview','',_PREVIEW,false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cancel','-cancel','',_CMN_CANCEL,false);
		mosMenuBar::endTable();
	}
	function _EDIT_PLUGINS() {
		global $id;

		mosMenuBar::startTable();
		mosMenuBar::custom('saveplugin','-save','',_CMN_SAVE,false);
		mosMenuBar::spacer();
		if($id) {
			mosMenuBar::custom('canceledit','-cancel','',_CLOSE,false);
		} else {
			mosMenuBar::custom('canceledit','-cancel','',_CMN_CANCEL,false);
		}
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function _INSTALL($element) {
		if($element == 'plugins') {
			mosMenuBar::startTable();
			mosMenuBar::custom('showplugins','-new','',_PLUGINS,false);
			mosMenuBar::spacer();
			mosMenuBar::custom('removeplugin','-delete','',_CMN_DELETE,false);
			mosMenuBar::spacer();
			mosMenuBar::custom('cancel','-cancel','',_CMN_CANCEL,false);
			mosMenuBar::endTable();
		}
	}
	function _LAYOUT() {
		mosMenuBar::startTable();
		mosMenuBar::custom('savelayout','-save','',_CMN_SAVE,false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cancel','-cancel','',_CMN_CANCEL,false);
		mosMenuBar::endTable();
	}
	function _LANGS() {
		mosMenuBar::startTable();
		mosMenuBar::publishList('publishlang');
		mosMenuBar::spacer();
		mosMenuBar::custom('removelang','-delete','',_CMN_DELETE,false);
		mosMenuBar::spacer();
		mosMenuBar::custom('newlang','-new','',_INSTALLATION,false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cancel','-cancel','',_CMN_CANCEL,false);
		mosMenuBar::endTable();
	}
}
?>