<?php
/**
* @JoostFREE
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

// �������� ������� ������ ���������� ������� icon ��� ������������� ������� ������� �� ��������
mosLoadAdminModules('icon',0);
?>
<form action="index2.php" method="post" name="adminForm" id="adminForm">
<table width="100%">
	<tr>
		<td width="65%" valign="top">
<?php
	// �������� ������� ������ ���������� ������� advert1 c �������������� ������� ������� �� ��������
	mosLoadAdminModules('advert1',0);
?>
		</td>
		<td width="35%" valign="top">
<?php
	// �������� ������� ������ ���������� ������� advert1 c �������������� ������� ������� �� ��������
	mosLoadAdminModules('advert2',0);
?>
		</td>
	</tr>
</table>
</form>
