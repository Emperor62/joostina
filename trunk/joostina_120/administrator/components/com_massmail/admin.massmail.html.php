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
* @package Joostina
* @subpackage Massmail
*/
class HTML_massmail {
	function messageForm(&$lists,$option) {
?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				// do field validation
				if (form.mm_subject.value == ""){
					alert( "����������, ������� ����" );
				} else if (getSelectedValue('adminForm','mm_group') < 0){
					alert( "����������, �������� ������" );
				} else if (form.mm_message.value == ""){
					alert( "����������, ��������� ���������" );
				} else {
					submitform( pressbutton );
				}
			}
		</script>

		<form action="index2.php" name="adminForm" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail">
			�������� �����
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="2">
			������
			</th>
		</tr>
		<tr>
			<td width="150" valign="top">
			������:
			</td>
			<td width="85%">
			<?php echo $lists['gid']; ?>
			</td>
		</tr>
		<tr>
			<td>
			��������� ����������� �������:
			</td>
			<td>
			<input type="checkbox" name="mm_recurse" value="RECURSE" />
			</td>
		</tr>
		<tr>
			<td>
			��������� � HTML-�������:
			</td>
			<td>
			<input type="checkbox" name="mm_mode" value="1" />
			</td>
		</tr>
		<tr>
			<td>
			����:
			</td>
			<td>
			<input class="inputbox" type="text" name="mm_subject" value="" size="50"/>
			</td>
		</tr>
		<tr>
			<td valign="top">
			���������:
			</td>
			<td>
			<textarea cols="80" rows="25" name="mm_message" class="inputbox"></textarea>
			</td>
		</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>"/>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
}
?>
