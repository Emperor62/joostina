<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� LICENSE.php
* Joostina! - ��������� ����������� ����������� ��������������� �� �������� ��������� GNU/GPL
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� COPYRIGHT.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();


switch($task) {
	case "edit":
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancel');
		mosMenuBar::endTable();
		break;
	case "execsql":
	default:
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::apply('execsql','��������� SQL');
		mosMenuBar::endTable();
		break;
}

?>
