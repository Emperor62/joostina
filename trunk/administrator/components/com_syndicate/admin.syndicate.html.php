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
* @subpackage Syndicate
*/
class HTML_syndicate {

	function settings( $option, &$params, $id ) {
		global $mosConfig_live_site, $mosConfig_cachepath, $my;
		?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="rss">
			��������� �������� ��������
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th>
			���������
			</th>
		</tr>
		<tr>
			<td>
			<?php
			echo $params->render();
			?>
			</td>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td>
				<table align="center">
				<?php
				$visible = 0;
				// check to hide certain paths if not super admin
				if ( $my->gid == 25 ) {
					$visible = 1;
				}
				mosHTML::writableCell( $mosConfig_cachepath, 0, '<strong>������� ����</strong> ', $visible );
				?>
				</table>
			</td>
		</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="name" value="RSS �������" />
		<input type="hidden" name="admin_menu_link" value="option=com_syndicate&amp;hidemainmenu=1" />
		<input type="hidden" name="admin_menu_alt" value="���������� ����������� �������� ��������" />
		<input type="hidden" name="option" value="com_syndicate" />
		<input type="hidden" name="admin_menu_img" value="js/ThemeOffice/component.png" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<?php
	}
}
?>
