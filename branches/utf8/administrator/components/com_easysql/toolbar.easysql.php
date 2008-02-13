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


switch ($task) {
	case "new" :
		mosMenuBar::startTable();
		mosMenuBar::save('create');
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
		break;
	case "edit" :
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancel' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
		break;
	case "execsql" :
	default:
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save('tocsv',_ES_TOCSV);
		mosMenuBar::spacer();
		mosMenuBar::addnew();
		mosMenuBar::spacer();
		mosMenuBar::apply('execsql', _ES_EXECSQL);
		mosMenuBar::spacer();
		mosMenuBar::endTable();
		break;
}

?>
