<?php /**
 * @package Joostina
 * @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
 * @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
 * Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
 * ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
 */

// ������ ������� �������
defined('_VALID_MOS') or die();

class configUser_registration extends dbConfig {
	/**
	 * ��������� ��������
	 */
	var $title = _CREATE_ACCOUNT;
	/**
	 * ����� ����� ������ �����������
	 */
	var $pre_text = _REGISTER_REQUIRED;
	/**
	 * ����� ����� ����� �����������
	 */
	var $post_text = '';
	/**
	 * ������ ��� �������� ����� �����������
	 * �� ���������:
	 *	 - ���� ����������� �� ������� ��������� ��������, �������� ���������� � ������� ������������;
	 *	 - ���� ��������� ���������: �������� �� �������� � ����������� �� ��������� (������ ��������: after_registration/default.php)
	 */
	var $redirect_url = '';
	/**
	 * ������������ ������ ������ ����� ����������� ��� ���� ����� �������������
	 * �� - ���� ������ (view/tegistration/default.php)
	 * ��� - ��� ������ ������ ����� ����������� ������, ��� �������� ����������� �� ���������� �������:
	 * view/tegistration/��������_������_���_��������.php
	 *
	 * ��������! ��� ������� �� ������ ������� ���������������. ������ ����������� ������ ��-��������� � �������
	 * ��� �������� �������������� �������.
	 *
	 * ����� �������� ����������� ������������ � ������ ��������,
	 * ������ ������ ��������� �������� `type`, ��������� �������� ������ ���� �������� ������ ������������
	 * ��������: index.php?option=com_registration&task=register&type=author
	 *
	 * ����������� ���������� � �������� ����� � "type=���_������" ����� ������ � ����� ������������, �������������
	 * � ������ "���_������"
	 */
	var $template = 1;
	/**
	 * ������ ������������ �� ���������.
	 * �������� �������� � ������, ���� �� ������������ ������� ���
	 * ����������� ���������� � ������� ������� "�� ���������" (�.�. ��� ��������� "type")
	 */
	var $gid = '18';
	/**
	 * ��������� ���������������.
	 * ���� � ���������� ���������� ����� �������� ��������� ���������,
	 * ������������ ������ ����������� ����������� � ������� ������ � ���������� ��� ������.
	 * ���� �� ������������ ������ �������� - ������ ������������ ���������� �� �����, � ����� ��������
	 * ��������� �� ����������� ��������� ��� �������� ��������������� �����
	 */
	var $admin_activation = 0;

	function configUser_registration(&$db, $group = 'com_users', $subgroup = 'registration') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {

		$acl = &gacl::getInstance();

		$gtree = $acl->get_group_children_tree(null, 'USERS', false); ?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}

				// do field validation
				if  (form.gid.value == "") {
					alert( "<?php echo _ENTER_GROUP_PLEASE ?>" );
				}
				else if (form.gid.value == "29") {
					alert( "<?php echo _BAD_GROUP_1 ?>" );
				}
				else if (form.gid.value == "30") {
					alert( "<?php echo _BAD_GROUP_2 ?>" );
				} else {
					submitform( pressbutton );
				}

			}
		</script>
		<table class="adminheading">
			<tr><th class="config"><?php echo _C_USERS_REG_SETTINGS?></th></tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">

			<table class="paramlist">
				<tr>
					<th class="key"><?php echo _PAGE_TITLE?></th>
					<td><input size="100" class="inputbox" type="text" name="title" value="<?php echo $this->title; ?>" /></td>
				</tr>
				<tr>
					<th class="key"><?php echo _C_USERS_REG_FORM_BEFORE?></th>
					<td><textarea cols="56" rows="7" class="inputbox" name="pre_text"><?php echo $this->pre_text; ?></textarea></td>
				</tr>
				<tr>
					<th class="key"><?php echo _C_USERS_REG_FORM_AFTER?></th>
					<td><textarea cols="56" rows="7" class="inputbox" name="post_text"><?php echo $this->post_text; ?></textarea></td>
				</tr>
				<tr>
					<th class="key"><?php echo _C_USERS_REG_AFTER_LINK?></th>
					<td><input size="100" class="inputbox" type="text" name="redirect_url" value="<?php echo $this->redirect_url; ?>" /></td>
				</tr>
				<tr>
					<th class="key"><?php echo _C_USERS_REG_ONE_GROOP_TEMPLATE?></th>
					<td><?php echo mosHTML::yesnoRadioList('template', '', $this->template?1 : 0); ?></td>
				</tr>
				<tr>
					<th class="key"><?php echo _C_USERS_REG_DEFAULT_GROOPS?></th>
					<td><?php echo mosHTML::selectList($gtree, 'gid', 'size="1"', 'value', 'text', $this->gid); ?></td>
				</tr>
				<tr>
					<th class="key"><?php echo _C_USERS_REG_PROFILE_ACTIVATE?></th>
					<td><?php echo mosHTML::yesnoRadioList('admin_activation', '', $this->admin_activation?1 : 0); ?></td>
				</tr>
			</table>

			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="registration" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form><?php
	}

	function save_config() {
		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}
	}
}

class configUser_profile extends dbConfig {
	/**
	 * ��������� ��������
	 */
	var $title = _USER_PROFILE;

	/**
	 * ������������ ������ ������ ������� ��� ���� ����� �������������
	 * �� - ���� ������ (view/profile/default.php)
	 * ��� - ��� ������ ������ ����� ����������� ������, ��� �������� ����������� �� ���������� �������:
	 * view/profile/��������_������_���_��������.php
	 *
	 * ��������! ��� ������� �� ������ ������� ��������������. ������ ����������� ������ ��-��������� � �������
	 * ��� �������� �������������� �������.
	 */
	var $template = 1;

	/**
	 * ������������ ������ ������ �������������� ������ ��� ���� ����� �������������
	 * �� - ���� ������ (view/edit/default.php)
	 * ��� - ��� ������ ������ ����� ����������� ������, ��� �������� ����������� �� ���������� �������:
	 * view/edit/��������_������_���_��������.php
	 *
	 * ��������! ��� ������� �� ������ ������� ��������������. ������ ����������� ������ ��-��������� � �������
	 * ��� �������� �������������� �������.
	 */
	var $template_edit = 1;

	/**
	 * ���������� �������
	 * ��������� - ������� ����������� � `components/com_users/view/profile`
	 * ����� ������� - ������� ����������� � `templates/������_�����/html/com_users/profile`
	 */
	var $template_dir = '';

	function configUser_profile(&$db, $group = 'com_users', $subgroup = 'profile') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {

		$acl = &gacl::getInstance();

		$gtree = $acl->get_group_children_tree(null, 'USERS', false); ?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<table class="adminheading">
			<tr><th class="config"><?php echo _C_USERS_PROFILE_SETTINGS?></th></tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">

			<table class="paramlist">
				<tr>
					<th class="key"><?php echo _PAGE_TITLE?></th>
					<td><input size="100" class="inputbox" type="text" name="title" value="<?php echo $this->title; ?>" /></td>
				</tr>

				<tr>
					<th class="key"><?php echo _C_USERS_PROFILE_ONE_TEMPLATE?></th>
					<td><?php echo mosHTML::yesnoRadioList('template', '', $this->template ? 1 : 0); ?></td>
				</tr>

				<tr>
					<th class="key"><?php echo _C_USERS_PROFILE_ONE_TEMPLATE_EDIT?></th>
					<td><?php echo mosHTML::yesnoRadioList('template_edit', '', $this->template_edit?1 : 0); ?></td>
				</tr>

				<tr>
					<th class="key"><?php echo _TEMPLATE_DIR?></th>
					<td><?php echo mosHTML::yesnoRadioList('template_dir', '', $this->template_dir?1 : 0, _TEMPLATE_DIR_DEF, _TEMPLATE_DIR_SYSTEM); ?></td>
				</tr>

			</table>

			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="profile" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form><?php
	}

	function save_config() {
		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}
	}
}