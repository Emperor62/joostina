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

global $JPLang, $JPConfiguration;
?>
<table class="adminheading">
	<tr>
		<th class="cpanel" nowrap rowspan="2">
			<?php echo $JPLang['common']['jptitle']; ?>
		</th>
	</tr>
	<tr>
		<td nowrap><h2><?php echo $JPLang['log']['logbanner']; ?></h2></td>
	</tr>
</table>
<div style="text-align: left; padding: 0.5em; background-color: #EEEEFE; border: thin solid black; margin: 0.5em;"
<?php
CJPLogger::VisualizeLogDirect();
?>
</div>