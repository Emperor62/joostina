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
* @subpackage Config
*/
class HTML_config {
	function showconfig(&$row,&$lists,$option) {
		global $mosConfig_absolute_path,$mosConfig_live_site,$mosConfig_session_type,$mainframe;
		$tabs = new mosTabs(1,1);
		mosCommonHTML::loadOverlib();

?>
	<script type="text/javascript">
	<!--
		function saveFilePerms() {
			var f = document.adminForm;
			if (f.filePermsMode0.checked){
				f.config_fileperms.value = '';
			}else {
				var perms = 0;
				if (f.filePermsUserRead.checked) perms += 400;
				if (f.filePermsUserWrite.checked) perms += 200;
				if (f.filePermsUserExecute.checked) perms += 100;
				if (f.filePermsGroupRead.checked) perms += 40;
				if (f.filePermsGroupWrite.checked) perms += 20;
				if (f.filePermsGroupExecute.checked) perms += 10;
				if (f.filePermsWorldRead.checked) perms += 4;
				if (f.filePermsWorldWrite.checked) perms += 2;
				if (f.filePermsWorldExecute.checked) perms += 1;
				f.config_fileperms.value = '0'+''+perms;
			}
		}
		function changeFilePermsMode(mode) {
			if(document.getElementById) {
				switch (mode) {
					case 0:
						SRAX.get('filePermsValue').style.display = 'none';
						SRAX.get('filePermsTooltip').style.display = '';
						SRAX.get('filePermsFlags').style.display = 'none';
					break;
					default:
						SRAX.get('filePermsValue').style.display = '';
						SRAX.get('filePermsTooltip').style.display = 'none';
						SRAX.get('filePermsFlags').style.display = '';
				} // switch
			} // if
			saveFilePerms();
		}
		function saveDirPerms()  {
			var f = document.adminForm;
			if (f.dirPermsMode0.checked)
				f.config_dirperms.value = '';
			else {
				var perms = 0;
				if (f.dirPermsUserRead.checked) perms += 400;
				if (f.dirPermsUserWrite.checked) perms += 200;
				if (f.dirPermsUserSearch.checked) perms += 100;
				if (f.dirPermsGroupRead.checked) perms += 40;
				if (f.dirPermsGroupWrite.checked) perms += 20;
				if (f.dirPermsGroupSearch.checked) perms += 10;
				if (f.dirPermsWorldRead.checked) perms += 4;
				if (f.dirPermsWorldWrite.checked) perms += 2;
				if (f.dirPermsWorldSearch.checked) perms += 1;
				f.config_dirperms.value = '0'+''+perms;
			}
		}
		function changeDirPermsMode(mode)   {
			if(document.getElementById) {
				switch (mode) {
					case 0:
						SRAX.get('dirPermsValue').style.display = 'none';
						SRAX.get('dirPermsTooltip').style.display = '';
						SRAX.get('dirPermsFlags').style.display = 'none';
						break;
					default:
						SRAX.get('dirPermsValue').style.display = '';
						SRAX.get('dirPermsTooltip').style.display = 'none';
						SRAX.get('dirPermsFlags').style.display = '';
				} // switch
			} // if
			saveDirPerms();
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (form.config_session_type.value != <?php echo $row->config_session_type; ?> ){
				if ( confirm('�� ������������� ������ �������� `����� �������������� ������`? \n\n ��� �������� ������ ��� ������������ ������ ��������� \n\n') ) {
					submitform( pressbutton );
				} else {
					return;
				}
			} else {
				submitform( pressbutton );
			}
		}
		function ch_apply(){
			SRAX.get('tb-apply').className='tb-load';
			saveFilePerms();
			saveDirPerms();
			dax({
				url: 'ajax.index.php?option=com_config&task=apply',
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
	//-->
	</script>
<?php
?>
<div style="text-align:left;">
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<table cellpadding="1" cellspacing="1" border="0" width="100%">
			<tr>
				<td width="70%"><table class="adminheading"><tr><th class="config">���������� ������������</th></tr></table></td>
<?php
		if(mosIsChmodable('../configuration.php')) {
			if(is_writable('../configuration.php')) {
?>
				<td class="jtd_nowrap">
					<input type="checkbox" id="disable_write" name="disable_write" value="1"/>
					<label for="disable_write">�������� �� ������ ����� ����������</label>
				</td>
<?php
			} else {
?>
				<td class="jtd_nowrap">
					<input type="checkbox" id="enable_write" name="enable_write" value="1"/>
					<label for="enable_write">������������ ������ �� ������ ��� ����������</label>
				</td>
<?php
			} // if
		} // if

?>
			</tr>
		</table>
		<div class="message">���������� ������������:
			<?php echo is_writable('../configuration.php')?'<b><font color="green">��������</font></b>':'<b><font color="red">����������, ��������� ����� ������� �� ���� ������������</font></b>' ?>
		</div
		<br />
<?php
	$tabs->startPane("configPane");
	$tabs->startTab("����","site-page");
?>
				<table class="adminform">
					<tr>
						<td>�������� �����:</td>
						<td><input class="text_area" style="width:500px;" type="text" name="config_sitename" size="50" value="<?php echo $row->config_sitename; ?>"/></td>
					</tr>
					<tr>
						<td width="185">���� ��������:</td>
						<td><?php echo $lists['offline']; ?></td>
					</tr>
					<tr>
						<td valign="top">��������� ��� ����������� �����:</td>
						<td>
							<textarea class="text_area" cols="60" rows="2" style="width:500px; height:40px" name="config_offline_message"><?php echo $row->config_offline_message; ?></textarea>
<?php
	$tip = '���������, ������� ��������� ������������� ������ �����, ����� �� ��������� � ����������� ���������.';
	echo mosToolTip($tip);
?>
						</td>
					</tr>
					<tr>
						<td valign="top">��������� ��� ��������� ������:</td>
						<td><textarea class="text_area" cols="60" rows="2" style="width:500px; height:40px" name="config_error_message"><?php echo $row->config_error_message; ?></textarea>
<?php
	$tip = '���������, ������� ��������� ������������� ������ �����, ����� Joostina! �� ����� ������������ � ���� ������ MySQL.';
	echo mosToolTip($tip);
?>
						</td>
					</tr>
					<tr>
						<td>���������� "���������..." ����������������:</td>
						<td><?php echo $lists['shownoauth']; ?><?php $tip = '���� ��, �� ���������������� ������������� ����� ������������ ������ �� ���������� � ������� ������� -��� ������������������-. ��� ����������� ������� ��������� ������������ ������ ����� ��������������.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>��������� ����������� �������������:</td>
								<td><?php echo $lists['allowUserRegistration']; ?><?php
		$tip = '���� ��, �� ������������� ����� ��������� ���������������� �� �����.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>������������ ��������� ������ ��������:</td>
								<td><?php echo $lists['useractivation']; ?>
								<?php
		$tip = '���� ��, �� ������������ ���������� ����� ������������ ����� �������, ����� ��������� �� ������ �� ������� ��� ���������.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>��������� ���������� E-mail:</td>
								<td><?php echo $lists['uniquemail']; ?><?php
		$tip = '���� ��, �� ������������ �� ������ ��������� ��������� ��������� � ���������� ������� e-mail.';
		echo mosToolTip($tip);
?></td>
						</tr>
			<tr>
				<td>��������� ������������ �����:</td>
				<td>
					<?php echo $lists['frontend_userparams']; ?>
					<?php
		$tip = '���� `���`, �� ����� ��������� ����������� ��������� ������������� ���������� ����� (����� ���������)';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
						<tr>
						<td>WYSIWYG-�������� �� ���������:</td>
								<td><?php echo $lists['editor']; ?></td>
						</tr>
						<tr>
						<td>����� ������� (���-�� �����):</td>
								<td>
<?php
		echo $lists['list_limit'];
		$tip = '������������� ����� ������� �� ��������� � ������ ���������� ��� ���� �������������';
		echo mosToolTip($tip);
?>
				</td>
						</tr>
						</table>
						<?php
		$tabs->endTab();
		$tabs->startTab("�����","front-page"); ?>
		<table class="adminform">
			<tr>
				<td width="300">���� �����:</td>
				<td><?php echo $lists['lang']; ?></td>
			</tr>
				<td>�������� ������ �� �������� �������:</td>
				<td>
<?php
		echo $lists['config_custom_print'];
		$tip = '������������� ������������ �������� ��� ��������� ���� �� �������� �������� �������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			</tr>
				<td>��������� �������������� �������:</td>
				<td>
<?php
		echo $lists['config_module_multilang'];
		$tip = '��������� ������� ��������� �������� ����� �������, ���� � ��� ����� �� ������� - ������������� ���������� ���';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>������ ����:</td>
				<td><input class="text_area" type="text" name="config_form_date" size="35" value="<?php echo $row->config_form_date; ?>"/>
<?php
	echo $lists['form_date_help'];
	$tip = '�������� ������ ��� ����������� ����. ���������� ������������ ������ � ������������ � ��������� strftime.';
	echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>������ ������ ���� � �������:</td>
				<td><input class="text_area" type="text" name="config_form_date_full" size="35" value="<?php echo $row->config_form_date_full; ?>"/>
<?php echo $lists['form_date_full_help'];
	$tip = '�������� ������ ������ ��� ����������� ���� � �������. ���������� ������������ ������ � ������������ � ��������� strftime.';
	echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ��������� ����������� ����� H1 ��� ������ ���������:</td>
				<td><?php echo $lists['config_title_h1_only_view'];
		$tip = '��������� ��������� ����� h1 ������ � ������ ������� ��������� ����������� ( ��� ������� �� ���������... ).';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ��� ��������� ����������� ����� H1:</td>
				<td><?php echo $lists['config_title_h1'];
		$tip = '�������� ��������� ��������� � ���� h1.';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ��������� RSS (syndicate):</td>
				<td><?php echo $lists['syndicate_off'];
		$tip = '���� `��`, �� ����� ��������� ����������� ��������� RSS ���� � ������ � ����';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>������������ ������:</td>
				<td><?php echo $lists['one_template'];
		$tip = '��� ������ ������� �� ����� ����������� �� ���� ����� ���������� �� �������� � ������� ���� ������ ��������. ��� ������������� ���������� �������� �������� \\\'������\\\'';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>������ ����� � ��������� ��������:</td>
				<td><input class="text_area" type="text" name="config_favicon" size="20" value="<?php echo $row->config_favicon; ?>"/>
					<?php $tip = '������ ����� � ��������� (���������) ��������. ���� �� ������� ��� ���� ������ �� ������, �� ��������� ����� �������������� ���� favicon.ico.';
		echo mosToolTip($tip,'������ ����� � ���������');
?>
				</td>
			</tr>
			<tr>
				<td>��������� favicon:</td>
				<td><?php echo $lists['config_disable_favicon'];
		$tip = '������������ � �������� ������ ����� favicon';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ������� ������ system:</td>
				<td><?php echo $lists['mmb_system_off'];
		$tip = '���� `��`, �� ������������� ��������� �������� ����� ����������. ��������, ���� �� ����� ������������ ������� ���� ������, �� ��������� ��������� �� �������������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ������� ������ content:</td>
				<td><?php echo $lists['mmb_content_off'];
		$tip = '���� `��`, �� ������������� �������� ��������� �������� ����� ����������. ��������, ���� �� ����� ������������ ������� ���� ������, �� ��������� ��������� �� �������������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ������� ������ mainbody:</td>
				<td><?php echo $lists['config_mmb_mainbody_off'];
		$tip = '���� `��`, �� ������������� �������� ��������� ����� ����������� (mainbody) ����� ����������.';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>����������� �� �����:</td>
				<td><?php echo $lists['frontend_login'];
		$tip = '���� `���`, �� �������� ����������� �� ����� ����� ���������, ���� � ��� �� ������ ����� ����. ����� ����� ��������� ����������� ����������� �� �����';
		echo mosToolTip($tip); ?>
				</td>
			</tr>
			<tr>
				<td>����� ������������� ������ �� ������:</td>
				<td>
					<input class="text_area" type="text" name="config_lifetime" size="10" value="<?php echo $row->config_lifetime; ?>"/>&nbsp;������&nbsp;
						<?php echo mosWarning('����� �������������� ������������ ����� ��� ������������. ������� �������� ����� ��������� ������� ������������.'); ?>
					</td>
			</tr>
			<tr>
				<td>��������� ������ �� ������</td>
				<td><?php echo $lists['session_front'];
		$tip = '���� `��`, �� ����� ��������� ������� ������ ��� ������� ������������ �� �����. ���� ������� ����� ������������� �� ����� � ����������� ��������� - ����� ���������.';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� �������� ������� � �����������</td>
				<td><?php echo $lists['config_disable_access_control'];
		$tip = '���� `��`, �� �������� ������� � ����������� �������������� �� �����, � ���� ������������� ����� ���������� �� ����������. ������������� ��������� � �������� ���������� ����������� � ������ �� ������.';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>������� ����� ��������� �����������:</td>
				<td><?php echo $lists['config_content_hits'];
		echo mosToolTip('��� ���������� ��������� ���������� ��������� ����������� ����� �� �������.'); ?></td>
			</tr>
			<tr>
				<td>��������� �������� ���������� �� �����:</td>
				<td><?php echo $lists['config_disable_date_state'];
		echo mosToolTip('���� �� ����� �� �������� ��������� ���������� ���������� ����������� - �� ������ �������� ����� ��������������.'); ?></td>
			</tr>
			<tr>
				<td>��������� ������ � ��������������:</td>
				<td><?php echo $lists['module_on_edit_off'];
		$tip = '���� `��`, �� �� �������� �������������� ����������� � ������ ����� ��������� ��� ������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>������������ ����� ��������� ��������:</td>
				<td><?php echo $lists['time_gen'];
		$tip = '���� `��`, �� �� ������ �������� ����� ���������� ����� �� � ���������';
		echo mosToolTip($tip); ?>
			</td>
			</tr>
			<tr>
				<td>GZIP-������ �������:</td>
				<td><?php echo $lists['gzip'];
		echo mosToolTip('��������� ������ ������� ����� ��������� (���� ��������������). ��������� ���� ������� ��������� ������ ����������� ������� � �������� � ���������� �������. � �� �� �����, ��� ����������� �������� �� ������.'); ?>
				</td>
			</tr>
			<tr>
				<td>����� ������� �����:</td>
				<td><?php echo $lists['debug'];
		$tip = '���� ��, �� ����� ������������ ��������������� ����������, ������� � ������ MySQL...';
		echo mosToolTip($tip);
?></td>
				</tr>
			<tr>
				<td>����������� ��������:</td>
				<td><?php echo $lists['config_front_debug'];
		echo mosToolTip('������������ �� ������ ����� ����������� �������� ��������� ��������� ���������� � �����.'); ?>
				</td>
			</tr>
		</table>
<?php
	$tabs->endTab();
	$tabs->startTab("������ ����������","back-page");
?>
		<table class="adminform">
			<tr>
				<td width="300">��������� �������� ������ � ������ ����������:</td>
				<td><?php echo $lists['config_adm_session_del'];
		echo mosToolTip('�� ������� ������ ���� ����� ��������� ������� �������������.'); ?>
				</td>
			</tr>
			<tr>
				<td>��������� ������ "������":</td>
				<td><?php echo $lists['config_disable_button_help'];
		echo mosToolTip('��������� ��������� � ������ ������ ������ ������� ������ ����������.'); ?>
				</td>
			</tr>
			<tr>
				<td width="300">������������ ������ ����������� ��������:</td>
				<td><?php echo $lists['config_old_toolbar'];
		echo mosToolTip('��� ������������� ��������� ����� ������ �������� ����� ��������� � ������ ������, ��� ���� � Joomla.'); ?>
				</td>
			</tr>
			<tr>
				<td>��������� ������� "�����������":</td>
				<td><?php echo $lists['config_disable_image_tab'];
		echo mosToolTip('��������� ��������� � ������ ��� �������������� ����������� ������� �����������.'); ?>
				</td>
			</tr>
			<tr>
				<td>����� ������������� ������ � ������ ����������:</td>
				<td>
				<input class="text_area" type="text" name="config_session_life_admin" size="10" value="<?php echo $row->config_session_life_admin; ?>"/>&nbsp;������&nbsp;
				<?php echo mosWarning('�����, �� ��������� �������� ����� ��������� ������������ <strong>�����������</strong> ��� ������������. ������� ������� �������� ��������� ������������ �����!'); ?>
				</td>
			</tr>
			<tr>
				<td>���������� �������� ����������� ��� ��������� ������:</td>
				<td><?php echo $lists['admin_expired'];
						echo mosToolTip('���� ������ ������ � ������ ���������� �����������, � �� �������� �� ���� � ������� 10 �����, �� ��� ����� �� ������ �������������� �� ��������, � ������� ��������� ����������'); ?>
				</td>
			</tr>
			<tr>
				<td>���������� �������� ��� html � css:</td>
				<td><?php echo $lists['config_codepress'];
						echo mosToolTip('������������ �������� � ���������� ���������� ��� �������������� html � css ������ �������'); ?>
				</td>
			</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab("����������","content-page");
?>
						<table class="adminform">
						<tr>
						<td colspan="3">* ��� ��������� ������������ ����� ��������� �����������*<br /><br /></td>
						</tr>
						<tr>
						<td width="250">��������� � ���� ������:</td>
						<td width="150"><?php echo $lists['link_titles']; ?></td>
								<td><?php
		$tip = '���� ��, ��������� �������� ����������� �������� �������� ��� ����������� �� ��� �������';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td width="250">������ "���������...":</td>
						<td width="150"><?php echo $lists['readmore']; ?></td>
								<td><?php
		$tip = '���� ������ �������� ��������, �� ����� ������������ ������ -���������...- ��� ��������� ������� �����������';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>�������/�����������:</td>
								<td><?php echo $lists['vote']; ?></td>
								<td><?php
		$tip = '���� ������ �������� ��������, ������� --�������/�����������-- ����� ��������';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>����� �������:</td>
								<td><?php echo $lists['hideAuthor']; ?></td>
								<td><?php
		$tip = '��������, ���������� �� ����� �������. ��� ���������� ���������, �� ��� ����� ���� �������� � ������ ������ �� ������ ���� ��� �������.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>���� � ����� ��������:</td>
								<td><?php echo $lists['hideCreateDate']; ?></td>
								<td><?php
		$tip = '���� ��������, �� ������������ ���� � ����� �������� ������. ��� ���������� ���������, �� ����� ���� �������� � ������ ������ �� ������ ���� ��� �������.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>���� � ����� ���������:</td>
								<td><?php echo $lists['hideModifyDate']; ?></td>
								<td><?php
		$tip = '���� ����������� ��������, �� ����� ������������ ���� ��������� ������. ��� ���������� ���������, �� ��� ����� ���� �������� � ������ ������.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>���-�� ����������:</td>
								<td><?php echo $lists['hits']; ?></td>
								<td><?php
		$tip = '���� ����������� -��������-, �� ������������ ���������� ���������� ������� ������������ �����. ��� ���������� ��������� ����� ���� �������� � ������ ������ ������ ����������.';
		echo mosToolTip($tip);
?></td>
						</tr>
						<tr>
						<td>������ ������:</td>
								<td><?php echo $lists['hidePrint']; ?></td>
								<td>&nbsp;</td>
						</tr>
						<tr>
						<td>������ E-mail:</td>
								<td><?php echo $lists['hideEmail']; ?></td>
								<td>&nbsp;</td>
						</tr>
						<tr>
						<td>������ ������ � E-mail:</td>
								<td><?php echo $lists['icons']; ?></td>
						<td><?php echo mosToolTip('���� ������� ��������, �� ������ ������ � E-mail ����� ������������ � ���� �������, ����� - ������� �������-�������.'); ?></td>
						</tr>
						<tr>
						<td>���������� ��� ��������������� ��������:</td>
								<td><?php echo $lists['multipage_toc']; ?></td>
								<td>&nbsp;</td>
						</tr>
						<tr>
						<td>������ ����� (���������):</td>
								<td><?php echo $lists['back_button']; ?></td>
								<td>&nbsp;</td>
						</tr>
						<tr>
						<td>��������� �� �����������:</td>
								<td><?php echo $lists['item_navigation']; ?></td>
						</tr>
						<tr>
							<td>���������� �������������� ��������:</td>
							<td><?php echo $lists['config_uid_news']; ?></td>
							<td><?php echo mosToolTip('��� ��������� ��������� ��� ������ ������� � ������ ����� ���������� ���������� ������������� �����.'); ?></td>
						</tr>
						<tr>
							<td>�������������� ���������� �� �������:</td>
							<td><?php echo $lists['auto_frontpage']; ?></td>
							<td><?php echo mosToolTip('��� ��������� ��������� �� ����������� ���������� ����� ������������� �������� ��� ���������� �� ������� ��������.'); ?></td>
						</tr>
						<tr>
							<td>��������� ���������� �����������:</td>
							<td><?php echo $lists['config_disable_checked_out']; ?></td>
							<td><?php echo mosToolTip('��� ��������� ��������� ���������� �������� ����������� �� ����� �����������. �� ������������� ������������ �� ������ � ������� ������ ����������.'); ?></td>
						</tr>
						<tr>
							<td>����� ������ Itemid:</td>
							<td><?php echo $lists['itemid_compat']; ?></td>
						</tr>
						<tr>
							<td>������������ ������ ���� ���������:</td>
							<td><?php echo $lists['one_editor']; ?></td>
							<td><?php echo mosToolTip('������������ ���� ���� ��� �������� � ��������� ������.'); ?></td>
						</tr>
				</table>
				<input type="hidden" name="config_multilingual_support" value="<?php echo $row->config_multilingual_support ?>" />
<?php
		$tabs->endTab();
		$tabs->startTab("������","Locale-page");
?>
				<table class="adminform">
					<tr>
							<td width="185">������� ���� (�������� ������� ������������ UTC, �):</td>
							<td><?php echo $lists['offset'];
		$tip = "������� ���� � �����, ������� ����� ������������ �� �����: ".mosCurrentDate(_DATE_FORMAT_LC2);
		echo mosToolTip($tip);
?>
					</td>
					<td>&nbsp;</td>
						</tr>
						<tr>
							   <td width="185">������� �� �������� �������, �:</td>
							   <td>
								<input class="text_area" type="text" name="config_offset" size="15" value="<?php echo $row->config_offset; ?>" disabled="disabled"/>
							   </td>
					 <td>&nbsp;</td>
						</tr>
						<tr>
							<td width="185">RSS (�������� ������� ������������ UTC, �):</td>
							  <td>
								<?php echo $lists['feed_timeoffset']; ?>
<?php
		$tip = "������� ���� � �����, ������� ����� ������������ � RSS: ".mosCurrentDate(_DATE_FORMAT_LC2);
		echo mosToolTip($tip);
?>
					</td>
					<td>&nbsp;</td>
						</tr>
						<tr valign="top">
							<td width="185">������ ������:</td>
							  <td>
								<input class="text_area" type="text" name="config_locale" size="15" value="<?php echo $row->config_locale; ?>"/>
<?php
		$tip = "���������� ������������ ��������� ������: ����������� ����, �������, ����� � �.�.";
		echo mosToolTip($tip);
?>
					</td>
							  <td>&nbsp;</td>
				</tr>
				<tr valign="top">
							<td width="185">&nbsp;</td>
							  <td>��� ������������� � Windows ���������� ������ <span style="color: red"><strong>RU</strong></span>.
	  <br />� Unix-��������, ���� �� �������� �������� �� ���������, ����� ����������� �������� ������� �������� ������ �� <strong>RU_RU.CP1251, ru_RU.cp1251, ru_ru.CP1251</strong>, ��� ������ �������� ������� ������ � ����������.<br />
����� ����� ����������� ������ ���� �� ��������� �������: <strong>rus, russian</strong>.
	 			</td>
				<td>&nbsp;</td>
			</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab("���� ������","db-page");
?>
		<table class="adminform">
			<tr>
				<td width="185">����� ����� MySQL:</td>
				<td><input class="text_area" type="text" name="config_host" size="25" value="<?php echo $row->config_host; ?>"/></td>
			</tr>
			<tr>
				<td>��� ������������ �� (MySQL):</td>
				<td><input class="text_area" type="text" name="config_user" size="25" value="<?php echo $row->config_user; ?>"/></td>
			</tr>
			<tr>
				<td>���� ������ MySQL:</td>
				<td><input class="text_area" type="text" name="config_db" size="25" value="<?php echo $row->config_db; ?>"/></td>
			</tr>
			<tr>
				<td>������� ���� ������ MySQL:</td>
				<td>
					<input class="text_area" type="text" name="config_dbprefix" size="10" value="<?php echo $row->config_dbprefix; ?>"/>
					&nbsp;<?php echo mosWarning('!! �� ���������, ���� � ��� ��� ���� ������� ���� ������. � ��������� ������, �� ������ �������� � ��� ������ !!'); ?>
				</td>
			</tr>
			<tr>
				<td>���������� ����������� ������ ���� ������:</td>
				<td>
<?php echo $lists['optimizetables'];
		$tip = '���� `��`, �� ������ ����� ���� ������ ����� ������������� �������������� ��� ������� ��������������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� ������� ������ MySQL:</td>
				<td>
<?php echo $lists['config_dbold'];
		$tip = '�������� ��������� ��������� �������������� ������� ������ �� � ����� ������������� � ����������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
			<tr>
				<td>��������� SET sql_mode:</td>
				<td>
<?php echo $lists['config_sql_mode_off'];
		$tip = '��������� ������� ������ ������ ���� ������ SET sql_mode';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab("������","server-page");
?>
		<table class="adminform">
			<tr>
				<td>URL �����:</td>
				<td><strong><?php echo $row->config_live_site; ?></strong></td>
				<td>&nbsp;</td>
			</tr>
				<tr>
				<td width="185">���������� ����( ������ ����� ):</td>
				<td width="450"><strong><?php echo $row->config_absolute_path; ?></strong></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>������ ����� ���������:</td>
				<td>
					<input class="text_area" type="text" name="config_media_dir" size="50" value="<?php echo $row->config_media_dir; ?>"/>
					<?php echo mosToolTip('�������� ������� ��� ������ ���������� ���������� ����� �������. ���� �� ����� ����� ��� / �� �����.'); ?>
				</td>
			</tr>
			<tr>
				<td>������ ��������� ���������:</td>
				<td>
					<input class="text_area" type="text" name="config_joomlaxplorer_dir" size="50" value="<?php echo $row->config_joomlaxplorer_dir; ?>"/>
					<?php echo mosToolTip('�������� ������� ��� ������ ���������� ���������� �������. ��� / � �����. ��� ������������� � Windows (c) ���� ����� ���������� � �������� ����� �����.'); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>��������� �����:</td>
				<td><strong><?php echo $row->config_secret; ?></strong></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>������ CSS � JS ������:</td>
				<td><?php echo $lists['config_gz_js_css']; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>����� ������������� ������:</td>
				<td>
				<?php echo $lists['session_type']; ?>
				&nbsp;
				<?php echo mosWarning('�� ���������, ���� �� ������, ����� ��� ����!<br /><br /> ���� ���� ����� �������������� �������������� ������ AOL ��� ��������������, ������������� ��� ������� �� ���� ������-�������, �� ������ ������������ ��������� 2 ������'); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>��������� �� �������:</td>
				<td><?php echo $lists['error_reporting']; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>������ ������:</td>
				<td><input class="text_area" type="text" name="config_helpurl" size="50" value="<?php echo $row->config_helpurl; ?>"/>
				<?php echo mosToolTip('������ ������ - ���� ���� ������, �� ����� ������ ����� ������� �� ��������� ����� http://�����_������_�����/help/, ��� ��������� ������� On-Line ������ ������� http://help.joom.ru ��� http://help.joomla.org'); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
<?php
		$mode = 0;
		$flags = 0644;
		if($row->config_fileperms != '') {
			$mode = 1;
			$flags = octdec($row->config_fileperms);
		} // if

?>
				<td valign="top">�������� ������:</td>
				<td>
					<fieldset><legend>���������� ������� � ������</legend>
						<table cellpadding="1" cellspacing="1" border="0">
							<tr>
								<td><input type="radio" id="filePermsMode0" name="filePermsMode" value="0" onclick="changeFilePermsMode(0)"<?php if(!$mode) echo ' checked="checked"'; ?>/></td>
								<td><label for="filePermsMode0">�� ������ CHMOD ��� ����� ������ (������������ ��������� �������)</label></td>
									</tr>
									<tr>
									<td><input type="radio" id="filePermsMode1" name="filePermsMode" value="1" onclick="changeFilePermsMode(1)"
									<?php if($mode) echo ' checked="checked"'; ?>/></td>
									<td>
									<label for="filePermsMode1">���������� CHMOD ��� ����� ������</label>
										<span id="filePermsValue"<?php if(!$mode) echo ' style="display:none"'; ?>>���:
											<input class="text_area" type="text" readonly="readonly" name="config_fileperms" size="4" value="<?php echo $row->config_fileperms; ?>"/>
										</span>
										<span id="filePermsTooltip"<?php if($mode) echo ' style="display:none"'; ?>>
											&nbsp;<?php echo mosToolTip('�������� ���� ����� ��� ��������� ���������� ������� � ����� ����������� ������'); ?>
										</span>
									</td>
								</tr>
									<tr id="filePermsFlags"<?php if(!$mode) echo ' style="display:none"'; ?>>
										<td>&nbsp;</td>
										<td>
											<table cellpadding="0" cellspacing="1" border="0">
											<tr>
											<td style="padding:0px">��������:</td>
											<td style="padding:0px"><input type="checkbox" id="filePermsUserRead" name="filePermsUserRead" value="1" onclick="saveFilePerms()"<?php if($flags &0400) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="filePermsUserRead">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsUserWrite" name="filePermsUserWrite" value="1" onclick="saveFilePerms()"<?php if($flags &0200) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="filePermsUserWrite">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsUserExecute" name="filePermsUserExecute" value="1" onclick="saveFilePerms()"<?php if($flags &0100) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px" colspan="3"><label for="filePermsUserExecute">����������</label></td>
																				</tr>
																				<tr>
											<td style="padding:0px">������:</td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsGroupRead" name="filePermsGroupRead" value="1" onclick="saveFilePerms()"<?php if($flags &040) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="filePermsGroupRead">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsGroupWrite" name="filePermsGroupWrite" value="1" onclick="saveFilePerms()"<?php if($flags &020) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="filePermsGroupWrite">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsGroupExecute" name="filePermsGroupExecute" value="1" onclick="saveFilePerms()"<?php if($flags &010) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px" width="70"><label for="filePermsGroupExecute">����������</label></td>
											<td><input type="checkbox" id="applyFilePerms" name="applyFilePerms" value="1"/></td>
											<td class="jtd_nowrap">
												<label for="applyFilePerms">
												��������� � ������������ ������
							&nbsp;
<?php
		echo mosWarning('��������� �������� <em>���� ������������ ������</em> �� �����.<br/><b>������������ ������������� ���� ����� ����� �������� � ������������������� �����!</b>'); ?>
								</label>
																						</td>
																				</tr>
																				<tr>
											<td style="padding:0px">���:</td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsWorldRead" name="filePermsWorldRead" value="1" onclick="saveFilePerms()"<?php if($flags &04) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="filePermsWorldRead">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsWorldWrite" name="filePermsWorldWrite" value="1" onclick="saveFilePerms()"<?php if($flags &02) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="filePermsWorldWrite">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="filePermsWorldExecute" name="filePermsWorldExecute" value="1" onclick="saveFilePerms()"<?php if($flags &01) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px" colspan="4"><label for="filePermsWorldExecute">����������</label></td>
																				</tr>
																		</table>
																</td>
														</tr>
												</table>
										</fieldset>
								</td>
								<td>&nbsp;</td>
						</tr>
						<tr>
<?php
		$mode = 0;
		$flags = 0755;
		if($row->config_dirperms != '') {
			$mode = 1;
			$flags = octdec($row->config_dirperms);
		} // if

?>
						<td valign="top">�������� ���������:</td>
								<td>
					<fieldset><legend>���������� ������� � ���������</legend>
												<table cellpadding="1" cellspacing="1" border="0">
														<tr>
																<td><input type="radio" id="dirPermsMode0" name="dirPermsMode" value="0" onclick="changeDirPermsMode(0)"<?php if(!$mode) echo ' checked="checked"'; ?>/></td>
								<td><label for="dirPermsMode0">�� ������ CHMOD ��� ����� ��������� (������������ ��������� �������)</label></td>
														</tr>
														<tr>
																<td><input type="radio" id="dirPermsMode1" name="dirPermsMode" value="1" onclick="changeDirPermsMode(1)"<?php if($mode) echo ' checked="checked"'; ?>/></td>
																<td>
																<label for="dirPermsMode1">���������� CHMOD ��� ����� ���������</label>
																		<span id="dirPermsValue"<?php if(!$mode) echo ' style="display:none"'; ?>>
															   ���: <input class="text_area" type="text" readonly="readonly" name="config_dirperms" size="4" value="<?php echo $row->config_dirperms; ?>"/>
																		</span>
																		<span id="dirPermsTooltip"<?php if($mode) echo ' style="display:none"'; ?>>
																&nbsp;<?php echo mosToolTip('�������� ���� ����� ��� ��������� ���������� ������� � ����� ����������� ���������'); ?>
																		</span>
																</td>
														</tr>
														<tr id="dirPermsFlags"<?php if(!$mode) echo ' style="display:none"'; ?>>
																<td>&nbsp;</td>
																<td>
																		<table cellpadding="1" cellspacing="0" border="0">
																				<tr>
											<td style="padding:0px">��������:</td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsUserRead" name="dirPermsUserRead" value="1" onclick="saveDirPerms()"<?php if($flags &0400) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="dirPermsUserRead">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsUserWrite" name="dirPermsUserWrite" value="1" onclick="saveDirPerms()"<?php if($flags &0200) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="dirPermsUserWrite">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsUserSearch" name="dirPermsUserSearch" value="1" onclick="saveDirPerms()"<?php if($flags &0100) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px" colspan="3"><label for="dirPermsUserSearch">�����</label></td>
																				</tr>
																				<tr>
											<td style="padding:0px">������:</td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsGroupRead" name="dirPermsGroupRead" value="1" onclick="saveDirPerms()"<?php if($flags &040) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="dirPermsGroupRead">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsGroupWrite" name="dirPermsGroupWrite" value="1" onclick="saveDirPerms()"<?php if($flags &020) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="dirPermsGroupWrite">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsGroupSearch" name="dirPermsGroupSearch" value="1" onclick="saveDirPerms()"<?php if($flags &010) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px" width="70"><label for="dirPermsGroupSearch">�����</label></td>
																						<td><input type="checkbox" id="applyDirPerms" name="applyDirPerms" value="1"/></td>
																						<td class="jtd_nowrap">
																								<label for="applyDirPerms">
																								��������� � ������������ ���������&nbsp;
<?php
		echo mosWarning('��������� ���� ������ ����� ��������� ��<em> ���� ������������ ���������</em> �� �����.<br/>'.'<b>������������ ������������� ���� ����� ����� �������� � ������������������� �����!</b>'); ?>
																								</label>
																						</td>
																				</tr>
																				<tr>
											<td style="padding:0px">���:</td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsWorldRead" name="dirPermsWorldRead" value="1" onclick="saveDirPerms()"<?php if($flags &04) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="dirPermsWorldRead">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsWorldWrite" name="dirPermsWorldWrite" value="1" onclick="saveDirPerms()"<?php if($flags &02) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px"><label for="dirPermsWorldWrite">������</label></td>
																						<td style="padding:0px"><input type="checkbox" id="dirPermsWorldSearch" name="dirPermsWorldSearch" value="1" onclick="saveDirPerms()"<?php if($flags &01) echo ' checked="checked"'; ?>/></td>
											<td style="padding:0px" colspan="3"><label for="dirPermsWorldSearch">�����</label></td>
																				</tr>
																		</table>
																</td>
														</tr>
												</table>
										</fieldset>
								</td>
								<td>&nbsp;</td>
						  </tr>
						 	<tr>
<?php
		$rgmode = 0;
		if(defined('RG_EMULATION')) {
			$rgmode = RG_EMULATION;
		}
?>
				<td valign="top">Register Globals Emulation:</td>
				<td>
					<fieldset><legend>�������� ����������� ���������� ����������</legend>
						<table cellpadding="1" cellspacing="1" border="0">
							<tr>
								<td><input type="radio" id="rgemulation" name="rgemulation" value="0"<?php if(!$rgmode) echo ' checked="checked"'; ?>/></td>
								<td><label for="rgemulation">����. (�������������) - �������������� ������</label></td>
							</tr>
							<tr>
								<td><input type="radio" id="rgemulation" name="rgemulation" value="1"<?php if($rgmode) echo ' checked="checked"'; ?>/></td>
								<td><label for="rgemulation">���. (�� �������������) - ������������� �� ������� ������������, ��� ������������� ��������� ���������� ������ ������������.</label></td>
							</tr>
						</table>
					</fieldset>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
<?php
		$tabs->endTab();
		$tabs->startTab("����������","metadata-page");
?>
	<table class="adminform">
		<tr>
			<td width="200" valign="top">�������� �����, ������� ������������� ������������:</td>
			<td>
				<textarea class="text_area" cols="50" rows="3" style="width:500px; height:50px" name="config_MetaDesc"><?php echo $row->config_MetaDesc; ?></textarea><?php echo mosToolTip(' �� ������ �� ������������ ���� �������� ��������� �������, � ����������� �� ���������� �������, ������� �� ���������� ������������. ������� �������� ������� � ���������� ��� ���������� ������ �����. �� ������ �������� ��������� �� ����� �������� ���� � �������� ����. ��� ��� ��������� ��������� ������� ������ ������ 20 ����, �� �� ������ �������� ���� ��� ��� �����������. ���������� ��������������, ��� ����� ������ ����� ������ �������� ��������� � ������ 20 ������.'); ?>
			</td>
		</tr>
		<tr>
			<td valign="top">�������� ����� �����:</td>
			<td><textarea class="text_area" cols="50" rows="3" style="width:500px; height:50px" name="config_MetaKeys"><?php echo $row->config_MetaKeys; ?></textarea></td>
		</tr>
		<tr>
			<td valign="top">���������� ����-��� <b>title</b>:</td>
			<td>
<?php echo $lists['MetaTitle'];
		echo mosToolTip('���������� ����-��� <b>title</b> ��� ��������� �������� �����������'); ?>
			</td>
		</tr>
		<tr>
			<td valign="top">���������� ����-��� <b>author</b>:</td>
			<td>
<?php echo $lists['MetaAuthor'];
		echo mosToolTip('���������� ����-��� <b>author</b> ��� ��������� �������� �����������'); ?>
			</td>
		</tr>
		<tr>
			<td valign="top">���������� ����-��� <b>base</b>:</td>
			<td>
<?php echo $lists['mtage_base'];
		echo mosToolTip('���������� ����-��� <b>base</b> � ���� ������ ��������'); ?>
			</td>
		</tr>
		<tr>
			<td valign="top">�������� ���� <b>revisit</b>:</td>
			<td>
				<input class="text_area" type="text" name="config_mtage_revisit" size="10" value="<?php echo $row->config_mtage_revisit; ?>"/>
				<?php echo mosToolTip('������� �������� ���� <b>revisit</b> � ����'); ?>
			</td>
		</tr>
		<tr>
			<td>��������� ��� Generator:</td>
			<td>
<?php echo $lists['generator_off'];
		$tip = '���� `��`, �� �� ���� ������ HTML �������� ����� �������� ��� name=\\\'Generator\\\'';
		echo mosToolTip($tip);
?>
			</td>
		</tr>
		<tr>
			<td>����������� ���� ����������:</td>
			<td>
<?php echo $lists['index_tag'];
		$tip = '���� `��`, �� � ��� ������ �������� ����� ��������� ����������� ���� ��� ������ ����������';
		echo mosToolTip($tip);
?>
			</td>
		</tr>
	</table>
<?php
		$tabs->endTab();
		$tabs->startTab("�����","mail-page");
?>
						<table class="adminform">
						<tr>
						<td width="185">��� �������� ����� ������������:</td>
								<td><?php echo $lists['mailer']; ?></td>
						</tr>
						<tr>
						<td>������ �� (Mail From):</td>
								<td><input class="text_area" type="text" name="config_mailfrom" size="50" value="<?php echo $row->config_mailfrom; ?>"/></td>
						</tr>
						<tr>
						<td>����������� (From Name):</td>
								<td><input class="text_area" type="text" name="config_fromname" size="50" value="<?php echo $row->config_fromname; ?>"/></td>
						</tr>
						<tr>
						<td>���� � Sendmail:</td>
								<td><input class="text_area" type="text" name="config_sendmail" size="50" value="<?php echo $row->config_sendmail; ?>"/></td>
						</tr>
						<tr>
						<td>������������ SMTP-�����������:</td>
								<td><?php echo $lists['smtpauth']; ?>&nbsp;<?php echo mosToolTip('�������� ��, ���� ��� �������� ����� ������������ smtp-������ � �������������� �����������'); ?></td>
						</tr>
						<tr>
						<td>��� ������������ SMTP:</td>
								<td><input class="text_area" type="text" name="config_smtpuser" size="50" value="<?php echo $row->config_smtpuser; ?>"/>&nbsp;<?php echo mosToolTip('�����������, ���� ��� �������� ����� ������������ smtp-������ � �������������� �����������'); ?></td>
						</tr>
						<tr>
						<td>������ ��� ������� � SMTP:</td>
								<td><input class="text_area" type="text" name="config_smtppass" size="50" value="<?php echo $row->config_smtppass; ?>"/>&nbsp;<?php echo mosToolTip('�����������, ���� ��� �������� ����� ������������ smtp-������ � �������������� �����������'); ?></td>
						</tr>
						<tr>
						<td>����� SMTP-�������:</td>
								<td><input class="text_area" type="text" name="config_smtphost" size="50" value="<?php echo $row->config_smtphost; ?>"/></td>
						</tr>
						</table>
						<?php
		$tabs->endTab();
		$tabs->startTab("���","cache-page");
?>
			<table class="adminform" >
<?php
		if(is_writeable($row->config_cachepath)) {
?>
				<tr>
					<td width="350">�������� �����������:</td>
					<td><?php echo $lists['caching']; ?><?php echo mosToolTip('��������� ����������� ��������� ������� � MySQL � ���������� �������� �� ������'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>����������� �����������:</td>
					<td><?php echo $lists['config_cache_opt']; ?><?php echo mosToolTip('������������� ������� �� ������ ���� ������ ������� ��� ����� �������� ������ ������.'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>�������������� ������� �������� ����:</td>
					<td><?php echo $lists['config_clearCache']; ?><?php echo mosToolTip('������������� ������� ������� ���� ������ ������������ �����.'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>����������� ���� ������ ����������:</td>
					<td><?php echo $lists['adm_menu_cache']; ?><?php echo mosToolTip('��������� ����������� ���� ������ ����������. �������� ���������� �� ������������ ����.'); ?></td>
					<td>&nbsp;</td>
				</tr>
<?php
		} else {
?><tr>
					<td width="350">����������� �� ��������:</td>
					<td><font color="red"><b>������� ���� �� �������� ��� ������.</b></font></td>
					<td>&nbsp;</td>
				</tr>
<?php
		}
?>

				<tr>
					<td>������� ����:</td>
					<td><input class="text_area" type="text" name="config_cachepath" size="50" value="<?php echo $row->config_cachepath; ?>"/>
<?php
		if(is_writeable($row->config_cachepath)) {
			echo mosToolTip('������� ������� ���� <b>�������� ��� ������</b>');
		} else {
			echo mosWarning('������� ������� ���� <b>�� �������� ��� ������</b> - ������� CHMOD �������� �� 755 ����� ���������� ����');
		}
?>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>����� ����� ����:</td>
					<td><input class="text_area" type="text" name="config_cachetime" size="5" value="<?php echo $row->config_cachetime; ?>"/> ������</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>��� �������� ���� ������:</td>
					<td><?php echo $lists['db_cache_handler'];?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>����� ����� ���� �������� ���� ������:</td>
					<td><input class="text_area" type="text" name="config_db_cache_time" size="5" value="<?php echo $row->config_db_cache_time; ?>"/> ������</td>
					<td>&nbsp;</td>
				</tr>
			</table>
<?php
		$tabs->endTab();
		$tabs->startTab("����������","stats-page");
?>
			<table class="adminform">
				<tr>
					<td width="185">�������� ���� ����������:</td>
					<td width="100"><?php echo $lists['enable_stats']; ?></td>
					<td><?php echo mostooltip('���������/��������� ���� ���������� �����'); ?></td>
				</tr>
				<tr>
					<td>����� ���������� ��������� ����������� �� ����:</td>
					<td><?php echo $lists['log_items']; ?></td>
					<td><span class="error"><?php echo mosWarning('��������������: � ���� ������ ������������ ������� ������ ������!'); ?></span></td>
				</tr>
				<tr>
					<td>���������� ��������� ��������:</td>
					<td><?php echo $lists['log_searches']; ?></td>
					<td>&nbsp;</td>
				</tr>
			</table>
<?php
		$tabs->endTab();
		$tabs->startTab("SEO","seo-page");
?>
						<table class="adminform">
						<tr>
						<td>������������� ��� ��������� ������ URL-� (SEF):</td>
							<td><?php
		echo $lists['sef'];
		echo mosWarning('������ ��� Apache! ����� �������������� ������������ htaccess.txt � .htaccess. ��� ���������� ��� ��������� ������ apache - mod_rewrite'); ?>
							</td>
						</tr>
						<tr>
						<td>������������ ��������� ������� (���� title):</td>
								<td><?php
		echo $lists['pagetitles'];
		echo mosToolTip('������������ ��������� ���������� ������� � ����������� �� �������� ���������������� �����������'); ?>
								</td>
						</tr>
						<tr>
						<td>������� ������ �� com_frontpage:</td>
								<td><?php
		echo $lists['com_frontpage_clear'];
		echo mosToolTip('��������� ������ �� ��������� ������� �������� ����� �������� ���.'); ?>
								</td>
						</tr>
						<tr>
						<td>�������� ������ (pathway) �� �������:</td>
								<td><?php
		echo $lists['config_pathway_clean'];
		echo mosToolTip('��� ���������� ������ ������ \\\'�������\\\' �� ������ �������� ����� ����� �������� �� ������ ������������ �������.'); ?>
								</td>
						</tr>
						<tr>
						<td>������� ������������ ��������� title:</td>
								<td><?php
		echo $lists['pagetitles_first'];
		echo mosToolTip('������� ������������ ��������� ��������� ������� (��� title)'); ?>
								</td>
						</tr>
						<tr>
						<td>����������� ��������� title:</td>
								<td><input class="text_area" type="text" name="config_tseparator" size="5" value="<?php echo $row->config_tseparator; ?>"/>
									<?php echo mosToolTip('����������� ��������� ��������� ������� (��� title). �� ��������� - �����.'); ?>
								</td>
						</tr>
						<tr>
				<td>���������� �������� ������:</td>
				<td>
					<?php echo $lists['index_print'];
		$tip = '���� `��`, �� �������� ������ ����������� ����� �������� ��� ����������';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
						<tr>
				<td>������������� � �� WWW �������:</td>
				<td>
					<?php echo $lists['www_redir'];
		$tip = '��� ������ �� ���� �� ������ syte.ru, ������������� ����� ����������� ������������� �� www.syte.ru';
		echo mosToolTip($tip);
?>
				</td>
			</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab("CAPTCHA","captcha-page");
?>
	<table class="adminform">
		<tr>
			<td width="300">��� ����������� � ������ ����������:</td>
			<td><?php echo $lists['captcha'];
		echo mosToolTip('������������ captcha ��� ����� ���������� ����������� � ������ ����������.'); ?>
			</td>
		</tr>
		<tr>
			<td width="300">��� �����������:</td>
			<td><?php echo $lists['config_captcha_reg'];
		echo mosToolTip('������������ captcha ��� ����� ���������� �����������.'); ?>
			</td>
		</tr>
		<tr>
			<td width="300">��� ����� ���������:</td>
			<td><?php echo $lists['config_captcha_cont'];
		echo mosToolTip('������������ captcha ��� ����� ���������� ����� ���������.'); ?>
			</td>
		</tr>
	</table>
<?php
		$tabs->endTab();
		$tabs->endPane();
		// show security setting check
		josSecurityCheck();
?>

		<input type="hidden" name="option" value="<?php echo $option; ?>"/>
		<input type="hidden" name="config_absolute_path" value="<?php echo $row->config_absolute_path; ?>"/>
		<input type="hidden" name="config_live_site" value="<?php echo $row->config_live_site; ?>"/>
		<input type="hidden" name="config_secret" value="<?php echo $row->config_secret; ?>"/>
		<input type="hidden" name="config_auto_activ_login" value="0"/>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
	</form>
	</div>
<?php
	}

}
?>
