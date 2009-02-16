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

/** Administrator Toolbar output */
class TOOLBAR_xmap {
	/**
	* Draws the toolbar
	*/
	function _DEFAULT() {
		mosMenuBar::startTable();
		/*
			//Testing
			mosMenuBar::custom('backup', 'archive.png', 'archive_f2.png', "Backup Settings", false);
			mosMenuBar::custom('restore', 'restore.png', 'restore_f2.png', "Restore Settings", false);
			mosMenuBar::spacer();
		*/
		if (_XMAP_JOOMLA15) {
			JToolBarHelper::title( 'Xmap', 'addedit.png' );
		}
		mosMenuBar::save('save', _XMAP_TOOLBAR_SAVE);
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancel', _XMAP_TOOLBAR_CANCEL);
		mosMenuBar::endTable();
	}
}
?>
