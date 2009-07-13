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
include_once(mosMainFrame::getInstance()->getLangFile('com_users'));
class userlist_menu_html {

	function edit($menu,$lists,$params,$option) {
		global $mosConfig_live_site, $acl;
 		mosCommonHTML::loadOverlib();
 		
 		
 		$gtree = $acl->get_group_children_tree(null,'USERS',false); 
	 	$gtree[0] = mosHTML::makeOption(0, 'All');

?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (trim(form.name.value) == ""){
				alert( "<?php echo _LINK_MUST_HAVE_NAME?>" );
			}  

				if (form.gid.value == "29") {
					alert( "<?php echo _BAD_GROUP_1?>" );
				} 
				else if (form.gid.value == "30") {
					alert( "<?php echo _BAD_GROUP_2?>" );
				} 
				else if  (form.gid.value == 0) {
					form.link.value = "index.php?option=com_users&task=userlist";
					submitform( pressbutton );
				} 
			else {
				form.link.value = "index.php?option=com_users&task=userlist&group=" + form.gid.value;
				submitform( pressbutton );
			}
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $menu->id?_EDITING.' -':_CREATION.' -'; ?> ������ �������������
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr valign="top">
			<td width="70%">
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo _DETAILS?>
					</th>
				</tr>
				<tr>
					<td width="30%" align="right">
					<?php echo _NAME?>:
					</td>
					<td width="70%">
					<input class="inputbox" type="text" name="name" size="50" maxlength="150" value="<?php echo htmlspecialchars($menu->name,ENT_QUOTES); ?>" />
					</td>
				</tr>
				<tr>
					<td width="10%" align="right" valign="top">
					<?php echo _LINK_TITLE?>:
					</td>
					<td width="80%">
						<input class="inputbox" type="text" name="params[title]" size="50" maxlength="100" value="<?php echo htmlspecialchars($params->get('title',''),ENT_QUOTES); ?>" />
					</td>
				</tr>
				<tr>
					<td width="30%" align="right">
					<?php echo _GROUP?>:
					</td>
					<td width="70%">
					<?php echo mosHTML::selectList($gtree,'gid','size="1"','value','text',$params->get('group',''));?>
					<br />
					<?php echo $menu->link; ?>
					<input class="inputbox" type="hidden" name="link" size="50" maxlength="250" value="<?php echo $menu->link; ?>" />
					<input class="inputbox" type="hidden" name="params[group]" size="50" maxlength="250" value="<?php echo $params->get('group',''); ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo _LINK_TARGET?>
					</td>
					<td>
					<?php echo $lists['target']; ?>
					</td>
				</tr>
				<tr>
					<td align="right">
					<?php echo _PARENT_MENU_ITEM?>:
					</td>
					<td>
					<?php echo $lists['parent']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo _ORDER_DROPDOWN?>:
					</td>
					<td>
					<?php echo $lists['ordering']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo _ACCESS?>:
					</td>
					<td>
					<?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
					<?php echo _PUBLISHED?>:
					</td>
					<td>
					<?php echo $lists['published']; ?>
					</td>
				</tr>
				</table>
			</td>
			<td width="30%">
				<table class="adminform">
				<tr>
					<th>
					<?php echo _PARAMETERS?>
					</th>
				</tr>
				<tr>
					<td>
					<?php echo $params->render(); ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $menu->id; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menu->menutype; ?>" />
		<input type="hidden" name="type" value="<?php echo $menu->type; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
}
?>