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

switch($task) {
	case 'edit';
		mosMenuBar::startTable();
		mosMenuBar::ext('���������','#','-apply','id="tb-apply" onclick="UpdateImg(xajax.getFormValues(\'adminForm\'))"');
		mosMenuBar::ext('�������� ��','#','-unpublis','onclick="xajax_OriginalImage(xajax.getFormValues(\'adminForm\'));"');
		mosMenuBar::ext('���������','#','-save','onclick="submitform(\'saveimage\');"');
		mosMenuBar::ext('�������','#','-cancel','onclick="submitform(\'returnfromedit\');"');
		mosMenuBar::endTable();
		break;
	default;
	break;

}
?>
