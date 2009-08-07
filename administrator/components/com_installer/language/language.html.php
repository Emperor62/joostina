<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/copyleft/gpl.html GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

/**
* @package Joostina
* @subpackage Templates
*/
class HTML_language {

	/**
	* @param array An array of data objects
	* @param object A page navigation object
	* @param string The option
	*/
	function showLanguages($cur_lang,&$rows,&$pageNav,$option) {
		global $my;
?><form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="langmanager">
			<?php echo _LANGUAGE_PACKS?> <small><small>[ <?php echo _SITE?> ]</small></small>
			</th>
		</tr>
		<tr> 
			<?php HTML_installer::cPanel(); ?>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">#</th>
			<th width="30">&nbsp;</th>
			<th width="25%" class="title"><?php echo _E_LANGUAGE?></th>
			<th width="5%"><?php echo _USED_ON?></th>
			<th width="10%"><?php echo _VERSION?></th>
			<th width="10%"><?php echo _DATE?></th>
			<th width="20%"><?php echo _AUTHOR_BY?></th>
			<th width="25%">E-mail</th>
		</tr>
<?php
		$k = 0;
		for($i = 0,$n = count($rows); $i < $n; $i++) {
			$row = &$rows[$i];
?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20"><?php echo $pageNav->rowNumber($i); ?></td>
				<td width="20">
				<input type="radio" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->language; ?>" onClick="isChecked(this.checked);" />
				</td>
				<td width="25%">
				<a onclick="hideMainMenu();return listItemTask('cb<?php echo $i; ?>','edit_source')"><?php echo $row->name; ?></a></td>
				<td width="5%" align="center">
				<?php
			if($row->published == 1) { ?>
					<img src="images/tick.png" alt="<?php echo _PUBLISHED?>"/>
					<?php
			} else {
?>
					&nbsp;
				<?php
			}
?>
				</td>
				<td align=center>
				<?php echo $row->version; ?>
				</td>
				<td align=center>
				<?php echo $row->creationdate; ?>
				</td>
				<td align=center>
				<?php echo $row->author; ?>
				</td>
				<td align=center>
				<?php echo $row->authorEmail; ?>
				</td>
			</tr>
		<?php
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="element" value="language" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
}
?>