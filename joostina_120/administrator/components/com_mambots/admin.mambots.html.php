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
* @subpackage Mambots
*/
class HTML_modules {

	/**
	* Writes a list of the defined modules
	* @param array An array of category objects
	*/
	function showMambots(&$rows,$client,&$pageNav,$option,&$lists,$search) {
		global $my,$mosConfig_live_site;
		mosCommonHTML::loadOverlib();
?>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminheading">
		<tr>
			<th class="mambots">�������</th>
			<td>������:</td>
			<td>
				<input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
			<td width="right"><?php echo $lists['type']; ?></td>
		</tr>
	</table>
	<table class="adminlist">
		<tr>
			<th width="20">#</th>
			<th width="2%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title">�������� �������</th>
			<th class="jtd_nowrap" width="10%">������������</th>
			<th colspan="2" class="jtd_nowrap" width="5%">����������</th>
			<th width="2%">�������</th>
			<th width="1%">
				<a href="javascript: saveorder( <?php echo count($rows) - 1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="��������� �������" /></a>
			</th>
			<th class="jtd_nowrap" width="10%">������</th>
			<th class="jtd_nowrap" align="left" width="10%">���</th>
			<th class="jtd_nowrap" align="left" width="10%">����</th>
		</tr>
		<?php
		$k = 0;
		for($i = 0,$n = count($rows); $i < $n; $i++) {
			$row = &$rows[$i];
			mosMakeHtmlSafe($row);
			$link		= 'index2.php?option=com_mambots&client='.$client.'&task=editA&hidemainmenu=1&id='.$row->id;
			$access		= mosCommonHTML::AccessProcessing($row,$i,1);
			$checked	= mosCommonHTML::CheckedOutProcessing($row,$i);
			$img		= $row->published ? 'publish_g.png' : 'publish_x.png';
?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="right"><?php echo $pageNav->rowNumber($i); ?></td>
				<td><?php echo $checked; ?></td>
				<td>
<?php
			if($row->checked_out && ($row->checked_out != $my->id)) {
				echo $row->name;
			} else {
?>
					<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
<?php
			}
?>
				</td>
				<td align="center" <?php echo ($row->checked_out && ($row->checked_out != $my->id)) ? null : 'onclick="ch_publ('.$row->id.',\'com_mambots\');" class="td-state"';?>>
					<img class="img-mini-state" src="images/<?php echo $img;?>" id="img-pub-<?php echo $row->id;?>" alt="����������" />
				</td>
				<td><?php echo $pageNav->orderUpIcon($i,($row->folder == @$rows[$i - 1]->folder && $row->ordering > -10000 && $row->ordering < 10000)); ?></td>
				<td><?php echo $pageNav->orderDownIcon($i,$n,($row->folder == @$rows[$i + 1]->folder && $row->ordering > -10000 && $row->ordering < 10000)); ?></td>
				<td align="center" colspan="2"><input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" /></td>
				<td align="center" id="acc-id-<?php echo $row->id;?>"><?php echo $access; ?></td>
				<td align="left" class="jtd_nowrap"><?php echo $row->folder; ?></td>
				<td align="left" class="jtd_nowrap"><?php echo $row->element; ?></td>
			</tr>
			<?php
			$k = 1 - $k;
		}
?>
	</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
	</form>
		<?php
	}

	/**
	* Writes the edit form for new and existing module
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param mosCategory The category object
	* @param array <p>The modules of the left side.  The array elements are in the form
	* <var>$leftorder[<i>order</i>] = <i>label</i></var>
	* where <i>order</i> is the module order from the db table and <i>label</i> is a
	* text label associciated with the order.</p>
	* @param array See notes for leftorder
	* @param array An array of select lists
	* @param object Parameters
	*/
	function editMambot(&$row,&$lists,&$params,$option) {
		global $mosConfig_live_site;
		mosCommonHTML::loadOverlib();
		$row->nameA = '';
		if($row->id) {
			$row->nameA = '<small><small>[ '.$row->name.' ]</small></small>';
		}
?>
	<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	<script language="javascript" type="text/javascript">
		function ch_apply(){
			SRAX.get('tb-apply').className='tb-load';
			dax({
				url: 'ajax.index.php?option=com_mambots&task=apply',
				id:'publ-1',
				method:'post',
				form: 'adminForm',
				callback:
					function(resp){
						log('������� �����: ' + resp.responseText);
						mess_cool(resp.responseText);
						SRAX.get('tb-apply').className='tb-apply';
			}});
		}
		function submitbutton(pressbutton) {
			if (pressbutton == "cancel") {
				submitform(pressbutton);
				return;
			}
			// validation
			var form = document.adminForm;
			if (form.name.value == "") {
				alert( "������ ������ ����� ��������" );
			} else if (form.element.value == "") {
				alert( "������ ������ ����� ��� �����" );
			} else {
				submitform(pressbutton);
			}
		}
	</script>
	<table class="adminheading">
		<tr>
			<th class="mambots">������ �����:<small><?php echo $row->id?'��������������':'��������'; ?></small><?php echo $row->nameA; ?></th>
		</tr>
		</table>
		<form action="index2.php" method="post" name="adminForm" id="adminForm">
		<table cellspacing="0" cellpadding="0" width="100%">
		<tr valign="top">
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2">������ �������</th>
				<tr>
				<tr>
					<td width="100" class="key">��������:</td>
					<td><input class="text_area" type="text" name="name" size="35" value="<?php echo $row->name; ?>" /></td>
				</tr>
				<tr>
					<td valign="top" class="key">���:</td>
					<td><?php echo $lists['folder']; ?></td>
				</tr>
				<tr>
					<td valign="top" class="key">������������ ����:</td>
					<td><input class="text_area" type="text" name="element" size="35" value="<?php echo $row->element; ?>" />.php</td>
				</tr>
				<tr>
					<td valign="top" class="key">������� ������:</td>
					<td><?php echo $lists['ordering']; ?></td>
				</tr>
				<tr>
					<td valign="top" class="key">������� �������:</td>
					<td><?php echo $lists['access']; ?></td>
				</tr>
				<tr>
					<td valign="top" class="key">�������:</td>
					<td><?php echo $lists['published']; ?></td>
				</tr>
				<tr>
					<td valign="top" class="key">��������:</td>
					<td><?php echo $row->description; ?></td>
				</tr>
				</table>
			</td>
			<td width="40%">
				<table class="adminform">
				<tr>
					<th colspan="2">���������</th>
				<tr>
				<tr>
					<td>
<?php
		if($row->id) {
			echo $params->render();
		} else {
			echo '<i>��������� �����������</i>';
		}
?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="client" value="<?php echo $row->client_id; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
}
?>
