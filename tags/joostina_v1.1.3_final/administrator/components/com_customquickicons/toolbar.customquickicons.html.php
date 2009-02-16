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

/**
 * @package Custom QuickIcons
 */
class QI_Toolbar {

	function _edit() {
		mosMenuBar::startTable();
		mosMenuBar::save('save', _QI_SAVE);
		mosMenuBar::spacer();
		mosMenuBar::apply('apply', _QI_APPLY);
		mosMenuBar::spacer();
		mosMenuBar::cancel('', _QI_CANCEL);
		mosMenuBar::endTable();
	}

	function _show() {
		mosMenuBar::startTable();
		mosMenuBar::publishList('publish', _QI_PUBLISH);
		mosMenuBar::spacer();
		mosMenuBar::unpublishList('unpublish', _QI_UNPUBLISH);
		mosMenuBar::spacer();
		mosMenuBar::addNew('new',_QI_NEW);
		mosMenuBar::spacer();
		mosMenuBar::editList('edit', _QI_EDIT);
		mosMenuBar::spacer();
		mosMenuBar::deleteList('', 'delete', _QI_DELETE);
		mosMenuBar::endTable();
	}
	
	function _chooseIcon(){
		mosMenuBar::startTable();
		mosMenuBar::endTable();
	}
}
?>