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

/**
* My Check in
*/
class HTML_checkin {

	function showlist($option,&$itemlist,$itemcnt) {
		global $mosConfig_live_site;
?>
	<table class="adminheading">
		<tr> 
			<th class="checkin">��������������� �������</th>
		</tr>
	</table>
	<table class="adminlist">
		<tr>
			<th class="title">������</th>
			<th class="title">���������</th>
			<th>������������</th>
			<th>����� ����������</th>
			<th>��������</th>
		</tr>
<?php
		$k = 0;
		for($i = 0; $i < $itemcnt; $i++) {
			echo "<tr class=\"row$k\"><td align=\"center\">\n";
			echo $itemlist[$i]["component"];
			echo "</td>\n<td>\n";
			echo $itemlist[$i]["title"];
			echo "</td>\n<td>\n";
			echo $itemlist[$i]["name"];
			echo "</td>\n<td>\n";
			echo $itemlist[$i]["cotime"];
			echo "</td>\n<td>\n";
			echo "<a href=\"$mosConfig_live_site/administrator/index2.php?option=$option&task=checkin&component="
					.$itemlist[$i]["component"]."&pkey="
					.$itemlist[$i]["PKEY"]."&checkid="
					.$itemlist[$i]["id"]."&editor="
					.$itemlist[$i]["editor"]."\">��������������</a>\n";
			echo "</td></tr>";
			$k = 1 - $k;
		}
?>
	</table>
<?php
	}
}
?>
