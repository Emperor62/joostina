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
		mosMenuBar::custom('main','-back','','�������',false);
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
		mosMenuBar::custom('newplugin','-new','','�����',false);
		mosMenuBar::spacer();
		mosMenuBar::custom('installplugin','-new','','���������',false);
		mosMenuBar::spacer();
		mosMenuBar::custom('editlayout','-preview','','������������',false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cancel','-cancel','','������',false);
		mosMenuBar::endTable();
	}
	function _EDIT_PLUGINS() {
		global $id;

		mosMenuBar::startTable();
		mosMenuBar::custom('saveplugin','-save','','���������',false);
		mosMenuBar::spacer();
		if($id) {
			mosMenuBar::custom('canceledit','-cancel','','�������',false);
		} else {
			mosMenuBar::custom('canceledit','-cancel','','������',false);
		}
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function _INSTALL($element) {
		if($element == 'plugins') {
			mosMenuBar::startTable();
			mosMenuBar::custom('showplugins','-new','','�������',false);
			mosMenuBar::spacer();
			mosMenuBar::custom('removeplugin','-delete','','��������',false);
			mosMenuBar::spacer();
			mosMenuBar::custom('cancel','-cancel','','������',false);
			mosMenuBar::endTable();
		}
	}
	function _LAYOUT() {
		mosMenuBar::startTable();
		mosMenuBar::custom('savelayout','-save','','���������',false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cancel','-cancel','','������',false);
		mosMenuBar::endTable();
	}
	function _LANGS() {
		mosMenuBar::startTable();
		mosMenuBar::publishList('publishlang');
		mosMenuBar::spacer();
		mosMenuBar::custom('removelang','-delete','','�������',false);
		mosMenuBar::spacer();
		mosMenuBar::custom('newlang','-new','','����������',false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cancel','-cancel','','������',false);
		mosMenuBar::endTable();
	}
}
?>
