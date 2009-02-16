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

if( defined( '_LANG_QUICKICONS' )){
	return;
}else{
	define( '_LANG_QUICKICONS', 1 );

	// common
	define( '_QI_LNG',				'ru' ); // de - tr - etc. ....
	define( '_QI_BTN_LNG',			'ru_RU' ); // do not change!
	define( '_QI_QUICKICONS',		'������ �������� �������');
	define( '_QI_CMN_ACCESS',		'������');
	define( '_QI_SEARCH',			'�����');
	define( '_QI_TITLE',			'���������' ); // (for title.tag)
	define( '_QI_MOD_MGMNT',		'���������� �������' ); // new 2.0.5

	// header
	define( '_QI_HDR_MGMNT',		'����������');

	// Toolbar
	define('_QI_PUBLISH', 			'�����������');
	define('_QI_UNPUBLISH', 		'������');
	define('_QI_NEW',				'��������');
	define('_QI_EDIT',				'��������');
	define('_QI_DELETE',			'�������');
	define('_QI_SAVE',				'���������');
	define('_QI_APPLY',				'���������');
	define('_QI_CANCEL',			'��������');

	// QickIcons List
	define('_QI_NAME',				'���');
	define('_QI_PUBLISHED',			'������������');
	define('_QI_UNPUBLISHED',		'�� ������������');
	define('_QI_REORDER',			'�����������');
	define('_QI_ORDER',				'�������');
	define('_QI_SAVE_ORDER',		'��������� �������');
	define('_QI_TARGET',			'������');
	define('_QI_ORDER_UP',			'�����');
	define('_QI_ORDER_DOWN',		'����');

	// Edit/New QuickIcon
	define('_QI_DETAIL',			'������');
	define('_QI_DETAIL_EDIT',		'��������������');
	define('_QI_DETAIL_NEW',		'��������');
	define('_QI_DETAIL_PREFIX',		'�������');
	define('_QI_DETAIL_POSTFIX',	'��������');
	define('_QI_DETAIL_TEXT',		'�����');
	define('_QI_DETAIL_NEW_WINDOW',	'� ����� ����');
	define('_QI_DETAIL_YES',		'��');
	define('_QI_DETAIL_NO',			'���');
	define('_QI_DETAIL_ORDER',		'����������� �����');
	define('_QI_DETAIL_ICON',		'��������');
	define('_QI_DETAIL_CHOOSE_ICON','������� ��������');

	define( '_QI_ACCESSKEY',		'��������� ������' );
	define( '_QI_DISPLAY',			'���������� ���' );

	// fonts
	define( '_QI_FONT_BOLD',		'�����' );
	define( '_QI_FONT_ITALIC',		'��������' );
	define( '_QI_FONT_UNDERLINE',	'�����������' );

	// Others
	define('_QI_MSG_SUC_DELETED', 	'������ ������� �������' );
	define('_QI_MSG_CHOOSE_ICON', 	'������� �� ������ ��� ������' );
	define('_QI_MSG_TEXT', 			'����������, ������� ���� �����' );
	define('_QI_MSG_TARGET', 		'��������� ������' );
	define('_QI_MSG_ICON', 			'��������� ��������' );
	define( '_QI_CMT_CHECK',		'��������� ���������' );
	define( '_QI_CMT_NAME_TO_CHECK','��� � ����' );
	define( '_QI_CHECK_VERSION',	'�������&nbsp;������' );
	define( '_QI_ERR_NO_TARGET',	'�� ������� ������' );

	// module
	define( '_QI_MOD_ACCESSKEY',	'��������� ������: ALT +' );
	define( '_QI_MOD_NO_COM',		'��������� ����������� � ������ ���� ����������' );

	// msgs
	define( '_QI_MSG_NEW_ORDER_SAVED',	'����� ������� ��������' );

	// tips
	define( '_QI_TIP_TARGET',		'������ ��� ������ ����� ��� ����������.<br />��� ����������� ������ ������� ������ ������ ���� ��������: <br />index2.php?option=com_joomlastats&task=stats  [ joomlastats - ���������, &task=stats ����� ����������� ������� ���������� ].<br />������� ������ ������ ���� <strong>����������� ��������</strong> (��������: http://www....)!');
	define( '_QI_TIP_CMT_CHECK',	'<strong>�����������</strong><br />����� �������������� �������� �� ����������� ���������� ����� ���������.');
	define( '_QI_TIP_CM_PATH',		'<strong>�����������</strong><br />root/administrator/components/ - ������������� ����<br />�����������: <strong>���_����������/����.php</strong>,<br />������ ������ ����� �� ��������� ���: :<br />../administrator/components/com_NAME/FILE_TO_CHECK.php');
	define( '_QI_TIP_CM_PATH_CHECK','��� ���������� ������������ ������ ����� ���������� ������ ���� ������������� ���������.<br />� ������ ����������� ��������� ����� [ com_xxxxx ] <strong>� ��� ����������, ������� ����� �����������</strong>!<br />������ ������ ����� �� ���� ������ ��::<br />com_costumquickicons/admin.customquickicons.php' );
	define( '_QI_TIP_DETAIL_NEW_WINDOW','������ ����� ������� � ����� ����');
	define( '_QI_TIP_TITLE',		'<strong>�����������</strong><br />����� �� ������ ���������� ����� ��� ����������� ���������.<br />��� �������� ����� ����� ��������� ���� �� ������� ����������� ������ ��������!');
	define( '_QI_TIP_FONT',			'�������� ����������� ��������, ���� ������ �������� ������ ��������� ������ ������');
	define( '_QI_TIP_ACCESSKEY',	'���������� ������ �������� ������� (�������) ��� ���� ������.<br />������� ����� ������ ������� ����� �������������� ��� ������� � ������� ���� ������ ��� ������� ��� ��������� � �������� ALT. ��������: ���� ������ <strong>������ ���� ����������</strong>!');
	define('_QI_TIP_ICON', 			'����������, �������� �������� ��� ���� ������. ���� ������ ��������� ����������� �������� ��� ������, �� ��� ������ ���� ��������� � ../administrator/images - ../images ../images/icons' );

	// tabs
	define( '_QI_TABS_GENERAL',		'�����' );
	define( '_QI_TABS_TEXT',		'�����');
	define( '_QI_TABS_DISPLAY',		'�����������' );
	define( '_QI_TABS_CHECK',		'��������');
	define( '_QI_TABS_ABOUT',		'� ���...' );

	// title & alt
	define( '_QI_TIT_EDIT_ENTRY',	'������� ��� �������������� ��������' );
	define( '_QI_TIT_CHOOSE_ICON',	'������� ��� ������ �������� (��������� � ����� ����)' );

	// select lists
		// display
	define( '_QI_DISPLAY_ICON_TEXT','�������� � �����');
	define( '_QI_DISPLAY_TEXT',		'������ �����');
	define( '_QI_DISPLAY_ICON',		'������ ������');

	// install
	define( '_QI_INST_NEW_ARTICLE',		'�������� ������/�������' );
	define( '_QI_INST_NEW_ARTICLE_ALT',	'�������� ������/�������' );
	define( '_QI_INST_SECTIONS',		'�������' );
	define( '_QI_INST_SECTIONS_ALT',	'���������� ���������' );
	define( '_QI_INST_FRONTPAGE',		'������� ��������' );
	define( '_QI_INST_FRONTPAGE_ALT',	'���������� ��������� ������� ��������' );
	define( '_QI_INST_ARTICLE',			'��� ���������� �����' );
	define( '_QI_INST_ARTICLE_ALT',		'���������� ��������� �����������' );
	define( '_QI_INST_ST_CONTENT',		'��������� ����������' );
	define( '_QI_INST_ST_CONTENT_ALT',	'���������� ��������� ���������� �����������' );
	define( '_QI_INST_MEDIA',			'�����' );
	define( '_QI_INST_MEDIA_ALT',		'���������� ����� �������' );
	define( '_QI_INST_CATEGORIES',		'���������' );
	define( '_QI_INST_CATEGORIES_ALT',	'���������� �����������' );
	define( '_QI_INST_WASTE',			'�������' );
	define( '_QI_INST_WASTE_ALT',		'���������� �������� ��������� ��������' );
	define( '_QI_INST_MENUS',			'����' );
	define( '_QI_INST_MENUS_ALT',		'���������� ��������� ����' );
	define( '_QI_INST_LANGUAGE',		'�������� ������' );
	define( '_QI_INST_LANGUAGE_ALT',	'���������� ��������� �������' );
	define( '_QI_INST_CONFIG',			'���������� ������������' );
	define( '_QI_INST_CONFIG_ALT',		'���������� ������������ �����' );
	define( '_QI_INST_USER',			'������������' );
	define( '_QI_INST_USER_ALT',		'���������� ��������������' );

	// install msgs
	define( '_QI_INST_ERROR',			'� �������� ��������� ���������� �������� ��������� ������!');
	define( '_QI_INST_SUCCESS',			'��������� ������� ����������');
	define( '_QI_INST_DB_ENTRIES',		'���� ������');
	define( '_QI_INST_TXT1',			'CustomQuickIcons - ���������� ��� Joomla 1.x ������� �������� ����������� ������ <strong style="color:red;"><em>mod_quickicon</em></strong>.<br />�������� �����������:<br /><ul><li>������� ���������� �������� �������� �������</li><li>���������� ����� ������ �������� �������</li><li>�������� �������� ������ �������� �������</li><li>������ �� �������� ������ ������ � ������ �������� �������</li><li>����� ���� ����������� ������</li><li>���������� ��������</li><li>���������� ������� ������</li><li>� �.�.</li></ul>');
	define( '_QI_INST_TXT2',			'CQI - CustomQuickIcons ������� ����������'); // changed 2.0.5

	define( '_QI_INST_MSG_BU_OLD_TABLE','������� �� ���������� ������ ������� ���������' ); // new 2.0.5
	define( '_QI_INST_MSG_NEW_TABLE',	'����� ������� ������� � ���� ������' ); // new 2.0.5
	define( '_QI_INST_MSG_DB_ENTRIES',	'��������� � ���� ������ ���������' ); // new 2.0.5
	define( '_QI_INST_MSG_MOD_FILE',	'���� ������ %s ������� ����������' ); // new 2.0.5
	define( '_QI_INST_MSG_MOD_REGGED',	'������ CQI ������� ���������������' ); // new 2.0.5

	define( '_QI_INST_ERR_COPY_MOD_FILE','������: ����������� ����� ������ �� ������� �����������' ); // new 2.0.5
	define( '_QI_INST_ERR_TARGET_DIR',	'������: �� ������� ������� ����������� ����������' ); // new 2.0.5

	// alt
	define( '_QI_INST_ALT_WEBSITE',		'����������� ���� QuickIcons');
	define( '_QI_INST_ALT_ACT_VERSION',	'��������� ������');
	define( '_QI_INST_ALT_BUGTRACKER',	'�������� �� ������');
	define( '_QI_INST_ALT_FORUM',		'�����');
	define( '_QI_INST_ALT_EMAIL',		'Email');

	//  errors
	define( '_QI_ERR_NO_MOD_INSTALLED',	'������ <em>mod_customquickicons</em> �� ����������!' );
	define( '_QI_ERR_MOD_INCORR_POS',	'������ [ mod_customquickicons ] �� ����������� � ������� [ icon ]' ); // new 2.0.5

	// support (new 2.0.5)
	define( '_QI_SUPP1',			'���� �� �������� ���� ������������ �������� � ������������� ��� �������, �� �������� �� �������� ���������� ��� ������, ����� �� ����� ���������� ��� ��������� � ��������. � ����� ������ ���������� ���!' );
	define( '_QI_SUPP2',			'<br /><br />�� ������ ������� ������ ����� ���� �� ��������� ������ ������.<br />����� ����� ����� ��� �������.' );
	define( '_QI_SUPP_BTN_TITLE',	'��������� CQI' );
	define( '_QI_SUPP_HEAD_TITLE',	'CustomQuickIcons - ��������� �������������� ������ �������� �������' );
	define( '_QI_SUPP_INP_TXT',		'��������� CustomQuickIcons' );
	define( '_QI_SUPP_BTN_SUBMIT',	'��, � ���� �������� ���������' );
	define( '_QI_SUPP_TXT_PAY_W_MB','������ ����� Moneybookers' );

	// readme (new 2.0.5)
	define( '_QI_RM_VERSION',	'������' );
	define( '_QI_RM_BY',		'By' );
	define( '_QI_RM_COPYR',		'Copyright' );
	define( '_QI_RM_LICENSE',	'�������� <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank" title="GPL in English">GPL in English</a>' );
	define( '_QI_RM_BASED',		'������� �� �������' );
	define( '_QI_RM_NO_MOD',	'��������:</span> ��� ���������������� ���������� ���������� ��������� ������ <strong>mod_customquickicons</strong> (�������� ����), ������� ������ ���� ���������� � ����������� �� �����, � ������������ ������ ���������� ����� � ����������!' );
	define( '_QI_RM_TRANS_BY',	'����������' );
	define( '_QI_RM_TRANS_HU',	'����������' );
	define( '_QI_RM_NEW_TRANS',	'���� �� ������� ������� �� ����� ������ ����, �� ��������� � %s � �������� ���� ��������' );
	define( '_QI_RM_DELETE',	'��������: ���� �� ������� ���� ���������, �� ������� � ���� ������ ����� ���������! ������ CQI ����� ������, � ����������� ������ ����� �����������.' );
	// joostina
	define( '_QI_ICO',	'������' );
}
?>
