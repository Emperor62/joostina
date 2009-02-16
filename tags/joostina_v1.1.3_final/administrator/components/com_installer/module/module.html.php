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
* @subpackage Installer
*/
class HTML_module {

	function showInstalledModules( &$rows, $option, &$xmlfile, &$lists ) {
		if (count($rows)) {
			?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
			<tr>
				<th class="install">������������� ������</th>
				<td>������:	</td>
				<td width="right"><?php echo $lists['filter'];?></td>
			</tr>
			<tr>
				<td colspan="3">
				����� �������� ������ �� ������, ������� �� ������ �������. ������ ���� Joomla ������� ������.
				<br /><br />
				</td>
			</tr>
			</table>

			<table class="adminlist">
			<tr>
				<th width="20%" class="title">
				������
				</th>
				<th width="10%" align="left">
				������������
				</th>
				<th width="10%" align="left">
				�����
				</th>
				<th width="5%" align="center">
				������
				</th>
				<th width="10%" align="center">
				����
				</th>
				<th width="15%" align="left">
				E-mail ������
				</th>
				<th width="15%" align="left">
				URL ������
				</th>
			</tr>
			<?php
			$rc = 0;
			for ($i = 0, $n = count( $rows ); $i < $n; $i++) {
				$row =& $rows[$i];
				?>
				<tr class="<?php echo "row$rc"; ?>">
					<td align="left">
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);"><span class="bold"><?php echo $row->module; ?></span></td>
					<td align="left">
					<?php echo $row->client_id == "0" ? '����' : '������ ����������'; ?>
					</td>
					<td>
					<?php echo @$row->author != "" ? $row->author : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->version != "" ? $row->version : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->creationdate != "" ? $row->creationdate : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorEmail != "" ? $row->authorEmail : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorUrl != "" ? "<a href=\"" .(substr( $row->authorUrl, 0, 7) == 'http://' ? $row->authorUrl : 'http://'.$row->authorUrl) ."\" target=\"_blank\">$row->authorUrl</a>" : "&nbsp;"; ?>
					</td>
				</tr>
				<?php
				$rc = $rc == 0 ? 1 : 0;
			}
		} else {
			?>
			<td class="small">
			������������ ������ �� �����������
			</td>
			<?php
		}
		?>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="element" value="module" />
		</form>
		<?php
	}
}
?>
