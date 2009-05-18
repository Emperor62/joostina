<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

/**
* Writes the edit form for new and existing content item
*
* A new record is defined when <var>$row</var> is passed with the <var>id</var>
* property set to 0.
* @package Joostina
* @subpackage Menus
*/
class content_blog_category_html {

	function edit(&$menu,&$lists,&$params,$option) {
		/* in the HTML below, references to "section" were changed to "category"*/
		global $mosConfig_live_site;
		mosCommonHTML::loadOverlib();
?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var form = document.adminForm;
			<?php
		if(!$menu->id) {
?>
				if ( form.name.value == '' ) {
					alert( '<?php echo _OBJECT_MUST_HAVE_NAME?>' );
					return;
				} else {
					submitform( pressbutton );
				}
				<?php
		} else {
?>
				if ( form.name.value == '' ) {
					alert( '<?php echo _OBJECT_MUST_HAVE_NAME?>' );
				} else {
					submitform( pressbutton );
				}
				<?php
		}
?>
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $menu->id?_O_EDITING.' -':_O_CREATION.' -'; ?> <?php echo _MENU_ITEM_BLOGCATEGORY?>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr valign="top">
			<td width="60%">
				<table class="adminform">
				<tr>
					<th colspan="3"><?php echo _DETAILS?></th>
				</tr>
				<tr>
					<td width="10%" align="right"><?php echo _CMN_NAME?>:</td>
					<td width="200px">
					<input class="inputbox" type="text" name="name" id="name" size="50" maxlength="100" value="<?php echo htmlspecialchars($menu->name,ENT_QUOTES); ?>" />
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td width="10%" align="right" valign="top"><?php echo _LINK_TITLE?>:</td>
					<td width="80%">
						<input class="inputbox" type="text" name="params[title]" size="50" maxlength="100" value="<?php echo htmlspecialchars($params->get('title',''),ENT_QUOTES); ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo _E_CATEGORY?>:</td>
					<td><?php echo $lists['categoryid']; ?></td>
					<td valign="top">
<?php
		echo mosToolTip(_YOU_CAN_CHOOSE_SEVERAL_CATEGORIES)
?>
					</td>
				</tr>
				<tr>
					<td align="right">URL:</td>
					<td colspan="2"><?php echo ampReplace($lists['link']); ?></td>
				</tr>
				<tr valign="top">
					<td align="right"><?php echo _PARENT_MENU_ITEM?>:</td>
					<td colspan="2"><?php echo $lists['parent']; ?></td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo _ORDER_DROPDOWN?>:</td>
					<td colspan="2"><?php echo $lists['ordering']; ?></td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo _CMN_ACCESS?>:</td>
					<td colspan="2"><?php echo $lists['access']; ?></td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo _CMN_PUBLISHED?>:</td>
					<td colspan="2"><?php echo $lists['published']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
			</td>
			<td width="40%">
				<table class="adminform">
				<tr>
					<th><?php echo _PARAMETERS?></th>
				</tr>
				<tr>
					<td><?php echo $params->render(); ?></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $menu->id; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menu->menutype; ?>" />
		<input type="hidden" name="type" value="<?php echo $menu->type; ?>" />
		<input type="hidden" name="link" value="index.php?option=com_content&task=blogcategory&id=0" />
		<input type="hidden" name="componentid" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
}
?>
