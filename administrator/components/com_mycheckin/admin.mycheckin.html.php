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
* My Check in
*/
class HTML_mycheckin {
	
	function showlist( $option, &$itemlist, $itemcnt ) {
		global $mosConfig_live_site;
		?>
		<table class="adminheading">
		<tr> 
			<th class="checkin">
			��������������� �������
			</th>
		</tr>
		</table>
		<table class="adminlist">
		<tr>
			<th class="title">
			������
			</th>
			<th class="title">
			���������
			</th>
			<th>
			������������
			</th>
			<th>
			����� ����������
			</th>
			<th>
			��������
			</th>
		</tr>
			<?php
		for ($i = 0; $i < $itemcnt; $i++)
		{
		     print "<tr><td>\n";
		     print $itemlist[$i]["component"];
		     print "</td>\n";
		     print "<td>\n";
		     print $itemlist[$i]["title"];
		     print "</td>\n";
		     print "<td>\n";
		     print $itemlist[$i]["name"];
		     print "</td>\n";
		     print "<td>\n";
		     print $itemlist[$i]["cotime"];
		     print "</td>\n";
		     print "<td>\n";
		     print "<a href=\"$mosConfig_live_site/administrator/index2.php?option=$option&task=checkin&component=".$itemlist[$i]["component"]."&pkey=".$itemlist[$i]["PKEY"]."&checkid=".$itemlist[$i]["id"]."&editor=".$itemlist[$i]["editor"]."\">��������������</a>\n";
		     print "</td></tr>";
		}
			?>
		</table>
		<?php
	}
}
?>
