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
* @package Joostina
* @subpackage Trash
*/
class TOOLBAR_Trash {
	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::custom('restoreconfirm','-check','','�������', true);
		mosMenuBar::spacer();
		mosMenuBar::custom('deleteconfirm','-delete','','�������', true);
		mosMenuBar::spacer();
		mosMenuBar::custom('deleteall','-delete','','�������� �������', false);
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.trashmanager' );
		mosMenuBar::endTable();
	}

	function _DELETE() {
		mosMenuBar::startTable();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	function _SETTINGS() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::save();
		mosMenuBar::endTable();
	}

}
?>
