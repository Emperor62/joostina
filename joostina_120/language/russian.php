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

global $mosConfig_form_date,$mosConfig_form_date_full;

// �������� ����� �� �������
define('_404','����������� �������� �� �������.');
define('_404_RTS','��������� �� ����');

define('_SYSERR1','��� ��������� MySQL');
define('_SYSERR2','���������� ������������ � ������� ���� ������');
define('_SYSERR3','���������� ������������ � ���� ������');

// �����
DEFINE('_LANGUAGE','ru');
DEFINE('_NOT_AUTH','��������, �� ��� ��������� ���� �������� � ��� ������������ ����.');
DEFINE('_DO_LOGIN','�� ������ �������������� ��� ������ �����������.');
DEFINE('_VALID_AZ09',"����������, ���������, ��������� �� �������� %s.  ��� �� ������ ��������� ��������, ������ ������� 0-9,a-z,A-Z � ����� ����� �� ����� %d ��������.");
DEFINE('_VALID_AZ09_USER',"����������, ��������� ������� %s. ������ ��������� ������ ������� 0-9,a-z,A-Z � ����� ����� �� ����� %d ��������.");
DEFINE('_CMN_YES','��');
DEFINE('_CMN_NO','���');
DEFINE('_CMN_SHOW','��������');
DEFINE('_CMN_HIDE','������');

DEFINE('_CMN_NAME','���');
DEFINE('_CMN_DESCRIPTION','��������');
DEFINE('_CMN_SAVE','���������');
DEFINE('_CMN_APPLY','���������');
DEFINE('_CMN_CANCEL','������');
DEFINE('_CMN_PRINT','������');
DEFINE('_CMN_EMAIL','E-mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','��������');
DEFINE('_CMN_ORDERING','����������');
DEFINE('_CMN_ACCESS','������� �������');
DEFINE('_CMN_SELECT','�������');

DEFINE('_CMN_NEXT','����.');
DEFINE('_CMN_NEXT_ARROW',"&nbsp;&raquo;");
DEFINE('_CMN_PREV','����.');
DEFINE('_CMN_PREV_ARROW',"&laquo;&nbsp;");

DEFINE('_CMN_SORT_NONE','��� ����������');
DEFINE('_CMN_SORT_ASC','�� �����������');
DEFINE('_CMN_SORT_DESC','�� ��������');

DEFINE('_CMN_NEW','�������');
DEFINE('_CMN_NONE','���');
DEFINE('_CMN_LEFT','�����');
DEFINE('_CMN_RIGHT','������');
DEFINE('_CMN_CENTER','�� ������');
DEFINE('_CMN_ARCHIVE','�������� � �����');
DEFINE('_CMN_UNARCHIVE','������� �� ������');
DEFINE('_CMN_TOP','������');
DEFINE('_CMN_BOTTOM','�����');

DEFINE('_CMN_PUBLISHED','������������');
DEFINE('_CMN_UNPUBLISHED','�� ������������');

DEFINE('_CMN_EDIT_HTML','������������� HTML');
DEFINE('_CMN_EDIT_CSS','������������� CSS');

DEFINE('_CMN_DELETE','�������');

DEFINE('_CMN_FOLDER','�������');
DEFINE('_CMN_SUBFOLDER','����������');
DEFINE('_CMN_OPTIONAL','�� �����������');
DEFINE('_CMN_REQUIRED','�����������');

DEFINE('_CMN_CONTINUE','����������');

DEFINE('_STATIC_CONTENT','����������� ����������');

DEFINE('_CMN_NEW_ITEM_LAST','�� ��������� ����� ������� ����� ��������� � ����� ������. ������� ������������ ����� ���� ������� ������ ����� ���������� �������.');
DEFINE('_CMN_NEW_ITEM_FIRST','�� ��������� ����� ������� ����� ��������� � ������ ������. ������� ������������ ����� ���� ������� ������ ����� ���������� �������.');
DEFINE('_LOGIN_INCOMPLETE','����������, ��������� ���� ��� ������������ � ������.');
DEFINE('_LOGIN_BLOCKED','��������, ���� ������� ������ �������������. �� ����� ��������� ����������� ���������� � �������������� �����.');
DEFINE('_LOGIN_INCORRECT','������������ ��� ������������ (�����) ��� ������. ���������� ��� ���.');
DEFINE('_LOGIN_NOADMINS','��������, �� �� ������ ����� �� ����. �������������� �� ����� �� ����������������.');
DEFINE('_CMN_JAVASCRIPT','��������! ��� ���������� ������ ��������, � ����� �������� ������ ���� �������� ��������� Java-script.');

DEFINE('_NEW_MESSAGE','��� ������ ����� ������ ���������');
DEFINE('_MESSAGE_FAILED','������������ ������������ ���� �������� ����. ��������� �� ����������.');

DEFINE('_CMN_IFRAMES','��� �������� ����� ���������� �����������. ��� ������� �� ������������ ��������� ������ (IFrame)');

DEFINE('_INSTALL_3PD_WARN','��������������: ��������� ��������� ���������� ����� �������� ������������ ������ �����. ��� ���������� Joomla! ��������� ���������� �� �����������.<br />��� ��������� �������������� ���������� � ����� ������ ������ ����� � �������, ����������, �������� <a href="http://forum.joomla.org/index.php/board,267.0.html" target="_blank" style="color: blue; text-decoration: underline;">����� ������������ Joomla!</a>.');
DEFINE('_INSTALL_WARN','�� ������������ ������������, ����������, ������� ������� <strong>installation</strong> � ������ ������� � �������� ��������.');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><strong>���� ������� �� ������:</strong></font> <br /> ������� � ������ ���������� ������ � �������� ����� ������ ');
DEFINE('_NO_PARAMS','������ �� �������� ������������� ����������');
DEFINE('_HANDLER','���������� ��� ������� ���� �����������');

/** �������*/
DEFINE('_TOC_JUMPTO','����������');

/**  ����������*/
DEFINE('_READ_MORE','���������...');
DEFINE('_READ_MORE_REGISTER','������ ��� ������������������ �������������...');
DEFINE('_MORE','�����...');
DEFINE('_ON_NEW_CONTENT',"������������ [ %s ] ������� ����� ������ [ %s ]. ������: [ %s ]. ���������: [ %s ]");
DEFINE('_SEL_CATEGORY','- �������� ��������� -');
DEFINE('_SEL_SECTION','- �������� ������ -');
DEFINE('_SEL_AUTHOR','- �������� ������ -');
DEFINE('_SEL_POSITION','- �������� ������� -');
DEFINE('_SEL_TYPE','- �������� ��� -');
DEFINE('_EMPTY_CATEGORY','������ ��������� �� �������� ��������.');
DEFINE('_EMPTY_BLOG','��� �������� ��� �����������!');
DEFINE('_NOT_EXIST','��������, �������� �� �������.<br />����������, ��������� �� ������� �������� �����.');
DEFINE('_SUBMIT_BUTTON','���������');

/** classes/html/modules.php*/
DEFINE('_BUTTON_VOTE','����������');
DEFINE('_BUTTON_RESULTS','����������');
DEFINE('_USERNAME','������������');
DEFINE('_LOST_PASSWORD','������ ������?');
DEFINE('_PASSWORD','������');
DEFINE('_BUTTON_LOGIN','�����');
DEFINE('_BUTTON_LOGOUT','�����');
DEFINE('_NO_ACCOUNT','��� �� ����������������?');
DEFINE('_CREATE_ACCOUNT','�����������');
DEFINE('_VOTE_POOR','������');
DEFINE('_VOTE_BEST','������');
DEFINE('_USER_RATING','�������');
DEFINE('_RATE_BUTTON','�������');
DEFINE('_REMEMBER_ME','���������');

/** contact.php*/
DEFINE('_ENQUIRY','�������');
DEFINE('_ENQUIRY_TEXT','��� ��������� ���������� � ����� %s. ����� ���������:');
DEFINE('_COPY_TEXT',
	'��� ����� ���������, ������� �� ��������� ��� %s � ����� %s ');
DEFINE('_COPY_SUBJECT','�����: ');
DEFINE('_THANK_MESSAGE','�������! ��������� ������� ����������.');
DEFINE('_CLOAKING','���� e-mail ������� �� ����-�����. ��� ��� ��������� � ����� �������� ������ ���� �������� ��������� Java-script');
DEFINE('_CONTACT_HEADER_NAME','���');
DEFINE('_CONTACT_HEADER_POS','���������');
DEFINE('_CONTACT_HEADER_EMAIL','E-mail');
DEFINE('_CONTACT_HEADER_PHONE','�������');
DEFINE('_CONTACT_HEADER_FAX','����');
DEFINE('_CONTACTS_DESC','������ ��������� ����� �����.');
DEFINE('_CONTACT_MORE_THAN','�� �� ������ ������� ����� ������ ������ e-mail.');

/** classes/html/contact.php*/
DEFINE('_CONTACT_TITLE','�������� �����');
DEFINE('_EMAIL_DESCRIPTION','��������� e-mail ������������:');
DEFINE('_NAME_PROMPT',' ������� ���� ���:');
DEFINE('_EMAIL_PROMPT',' ������� ��� e-mail:');
DEFINE('_MESSAGE_PROMPT',' ������� ����� ���������:');
DEFINE('_SEND_BUTTON','���������');
DEFINE('_CONTACT_FORM_NC','����������, ��������� ����� ��������� � ���������.');
DEFINE('_CONTACT_TELEPHONE','�������: ');
DEFINE('_CONTACT_MOBILE','���������: ');
DEFINE('_CONTACT_FAX','����: ');
DEFINE('_CONTACT_EMAIL','E-mail: ');
DEFINE('_CONTACT_NAME','���: ');
DEFINE('_CONTACT_POSITION','���������: ');
DEFINE('_CONTACT_ADDRESS','�����: ');
DEFINE('_CONTACT_MISC','���. ����������: ');
DEFINE('_CONTACT_SEL','�������� ����������:');
DEFINE('_CONTACT_NONE','������ ���� ���������� ������ �����������.');
DEFINE('_CONTACT_ONE_EMAIL','������ ������� ����� ������ ������ email.');
DEFINE('_EMAIL_A_COPY','��������� ����� ��������� �� ����������� �����');
DEFINE('_CONTACT_DOWNLOAD_AS','������� ���������� � �������');
DEFINE('_VCARD','VCard');

/** pageNavigation*/
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_PN_PAGE','��������');
DEFINE('_PN_OF','��');
DEFINE('_PN_START','[������]');
DEFINE('_PN_PREVIOUS','����������');
DEFINE('_PN_NEXT','���������');
DEFINE('_PN_END','[���������]');
DEFINE('_PN_DISPLAY_NR','����������');
DEFINE('_PN_RESULTS','����������');

/** ������ �����*/
DEFINE('_EMAIL_TITLE','��������� e-mail �����');
DEFINE('_EMAIL_FRIEND','��������� ������ �������� �� e-mail:');
DEFINE('_EMAIL_FRIEND_ADDR','E-Mail �����:');
DEFINE('_EMAIL_YOUR_NAME','���� ���:');
DEFINE('_EMAIL_YOUR_MAIL','��� e-mail:');
DEFINE('_SUBJECT_PROMPT',' ���� ���������:');
DEFINE('_BUTTON_SUBMIT_MAIL','���������');
DEFINE('_BUTTON_CANCEL','������');
DEFINE('_EMAIL_ERR_NOINFO','�� ������ ��������� ������ ���� e-mail � e-mail ���������� ����� ������.');
DEFINE('_EMAIL_MSG',' ������������! ��������� ������ �� �������� ����� "%s" �������� ��� %s ( %s ).

�� ������� ����������� � �� ���� ������:
%s');
DEFINE('_EMAIL_INFO','������ ��������');
DEFINE('_EMAIL_SENT','������ �� ��� �������� ���������� ���');
DEFINE('_PROMPT_CLOSE','������� ����');

/** classes/html/content.php*/
DEFINE('_AUTHOR_BY',' �����');
DEFINE('_WRITTEN_BY',' �����');
DEFINE('_LAST_UPDATED','��������� ����������');
DEFINE('_BACK','���������');
DEFINE('_LEGEND','�������');
DEFINE('_DATE','����');
DEFINE('_ORDER_DROPDOWN','�������');
DEFINE('_HEADER_TITLE','���������');
DEFINE('_HEADER_AUTHOR','�����');
DEFINE('_HEADER_SUBMITTED','�������');
DEFINE('_HEADER_HITS','����������');
DEFINE('_E_EDIT','�������������');
DEFINE('_E_ADD','��������');
DEFINE('_E_WARNUSER','����������, ������� ������ "������" ��� "���������", ����� �������� ��� ��������');
DEFINE('_E_WARNTITLE','���������� ������ ����� ���������');
DEFINE('_E_WARNTEXT','���������� ������ ����� ������� �����');
DEFINE('_E_WARNCAT','����������, �������� ���������');
DEFINE('_E_CONTENT','����������');
DEFINE('_E_TITLE','���������:');
DEFINE('_E_CATEGORY','���������');
DEFINE('_E_INTRO','������� �����');
DEFINE('_E_MAIN','�������� �����');
DEFINE('_E_MOSIMAGE','�������� ��� {mosimage}');
DEFINE('_E_IMAGES','�����������');
DEFINE('_E_GALLERY_IMAGES','������� �����������');
DEFINE('_E_CONTENT_IMAGES','����������� � ������');
DEFINE('_E_EDIT_IMAGE','��������� �����������');
DEFINE('_E_NO_IMAGE','��� �����������');
DEFINE('_E_INSERT','��������');
DEFINE('_E_UP','����');
DEFINE('_E_DOWN','����');
DEFINE('_E_REMOVE','�������');
DEFINE('_E_SOURCE','�������� �����:');
DEFINE('_E_ALIGN','������������:');
DEFINE('_E_ALT','�������������� �����:');
DEFINE('_E_BORDER','�����:');
DEFINE('_E_CAPTION','���������');
DEFINE('_E_CAPTION_POSITION','��������� �������');
DEFINE('_E_CAPTION_ALIGN','������������ �������');
DEFINE('_E_CAPTION_WIDTH','������ �������');
DEFINE('_E_APPLY','���������');
DEFINE('_E_PUBLISHING','����������');
DEFINE('_E_STATE','���������:');
DEFINE('_E_AUTHOR_ALIAS','��������� ������:');
DEFINE('_E_ACCESS_LEVEL','������� �������:');
DEFINE('_E_ORDERING','�������:');
DEFINE('_E_START_PUB','���� ������ ����������:');
DEFINE('_E_FINISH_PUB','���� ��������� ����������:');
DEFINE('_E_SHOW_FP','���������� �� ������� ��������:');
DEFINE('_E_HIDE_TITLE','������ ���������:');
DEFINE('_E_METADATA','����-����');
DEFINE('_E_M_DESC','��������:');
DEFINE('_E_M_KEY','�������� �����:');
DEFINE('_E_SUBJECT','����:');
DEFINE('_E_EXPIRES','���� ���������:');
DEFINE('_E_VERSION','������');
DEFINE('_E_ABOUT','�� �������');
DEFINE('_E_CREATED','���� ��������:');
DEFINE('_E_LAST_MOD','��������� ���������:');
DEFINE('_E_HITS','���������� ����������:');
DEFINE('_E_SAVE','���������');
DEFINE('_E_CANCEL','������');
DEFINE('_E_REGISTERED','������ ��� ������������������ �������������');
DEFINE('_E_ITEM_INFO','����������');
DEFINE('_E_ITEM_SAVED','������� ���������!');
DEFINE('_ITEM_PREVIOUS','&laquo; ');
DEFINE('_ITEM_NEXT',' &raquo;');
DEFINE('_KEY_NOT_FOUND','���� �� ������');


/** content.php*/
DEFINE('_SECTION_ARCHIVE_EMPTY','� ���� ������� ������ ������ ��� ��������. ����������, ������� �����');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','� ���� ��������� ������ ������ ��� ��������. ����������, ������� �����');
DEFINE('_HEADER_SECTION_ARCHIVE','����� ��������');
DEFINE('_HEADER_CATEGORY_ARCHIVE','����� ���������');
DEFINE('_ARCHIVE_SEARCH_FAILURE','�� ������� �������� ������� ��� %s %s'); // �������� ������, � ����� ����
DEFINE('_ARCHIVE_SEARCH_SUCCESS','������� �������� ������ ��� %s %s'); // �������� ������, � ����� ����
DEFINE('_FILTER','������');
DEFINE('_ORDER_DROPDOWN_DA','���� (�� �����������)');
DEFINE('_ORDER_DROPDOWN_DD','���� (�� ��������)');
DEFINE('_ORDER_DROPDOWN_TA','�������� (�� �����������)');
DEFINE('_ORDER_DROPDOWN_TD','�������� (�� ��������)');
DEFINE('_ORDER_DROPDOWN_HA','��������� (�� �����������)');
DEFINE('_ORDER_DROPDOWN_HD','��������� (�� ��������)');
DEFINE('_ORDER_DROPDOWN_AUA','����� (�� �����������)');
DEFINE('_ORDER_DROPDOWN_AUD','����� (�� ��������)');
DEFINE('_ORDER_DROPDOWN_O','�� �������');

/** poll.php*/
DEFINE('_ALERT_ENABLED','Cookies ������ ���� ���������!');
DEFINE('_ALREADY_VOTE','�� ��� ������������� � ���� ������!');
DEFINE('_NO_SELECTION',
	'�� �� ������� ���� �����. ����������, ���������� ��� ���');
DEFINE('_THANKS','������� �� ���� ������� � �����������!');
DEFINE('_SELECT_POLL','�������� ����� �� ������');

/** classes/html/poll.php*/
DEFINE('_JAN','������');
DEFINE('_FEB','�������');
DEFINE('_MAR','����');
DEFINE('_APR','������');
DEFINE('_MAY','���');
DEFINE('_JUN','����');
DEFINE('_JUL','����');
DEFINE('_AUG','������');
DEFINE('_SEP','��������');
DEFINE('_OCT','�������');
DEFINE('_NOV','������');
DEFINE('_DEC','�������');
DEFINE('_POLL_TITLE','���������� ������');
DEFINE('_SURVEY_TITLE','�������� ������:');
DEFINE('_NUM_VOTERS','���������� ���������������:');
DEFINE('_FIRST_VOTE','������ �����:');
DEFINE('_LAST_VOTE','��������� �����:');
DEFINE('_SEL_POLL','�������� �����:');
DEFINE('_NO_RESULTS','��� ������ �� ���������� ������.');

/** registration.php*/
DEFINE('_ERROR_PASS','��������, ����� ������������ �� ������.');
DEFINE('_NEWPASS_MSG',
	'������� ������ ������������ $checkusername ������������� ������ e-mail.\n'.
	' ������������ ����� $mosConfig_live_site ������ ������ �� ��������� ������ ������.\n\n'.
	' ��� ����� ������: $newpass\n\n���� �� �� ����������� ��������� ������, �������� �� ���� ��������������.'.
	' ������ �� ������ ������� ��� ���������, ������ �����. ���� ��� ������, ������ ������� '.
	' �� ����, ��������� ����� ������, � �����, �������� ��� �� ������� ���.');
DEFINE('_NEWPASS_SUB','$_sitename :: ����� ������ ��� $checkusername');
DEFINE('_NEWPASS_SENT','����� ������ ������ � ��������� ������������!');
DEFINE('_REGWARN_NAME','����������, ������� ���� ��������� ��� (���, ������������ �� �����).');
DEFINE('_REGWARN_UNAME','����������, ������� ���� ��� ������������ (�����).');
DEFINE('_REGWARN_MAIL','����������, ��������� ������� ����� e-mail.');
DEFINE('_REGWARN_PASS','����������, ��������� ������� ������. ������ �� ������ ��������� �������, ��� ����� ������ ���� �� ������ 6 �������� � �� ������ �������� ������ �� ���� (0-9) � ��������� �������� (a-z, A-Z)');
DEFINE('_REGWARN_VPASS1','����������, ��������� ������.');
DEFINE('_REGWARN_VPASS2','������ � ��� ������������� �� ���������. ����������, ���������� ��� ���.');
DEFINE('_REGWARN_INUSE','��� ��� ������������ ��� ������������. ����������, �������� ������ ���.');
DEFINE('_REGWARN_EMAIL_INUSE','���� e-mail ��� ������������. ���� �� ������ ���� ������, ������� �� ������ "������ ������?" � �� ��������� e-mail ����� ������ ����� ������.');
DEFINE('_SEND_SUB','������ � ����� ������������ %s � %s');
DEFINE('_USEND_MSG_ACTIVATE','������������ %s,

���������� �� ����������� �� ����� %s. ���� ������� ������ ������� ������� � ������ ���� ������������.
����� ������������ ������� ������, ������� �� ������ ��� ���������� �� � �������� ������ ��������:
%s

����� ��������� �� ������ ����� �� ���� %s, ��������� ���� ��� ������������ � ������:

��� ������������ - %s
������ - %s');
DEFINE('_USEND_MSG',"������������ %s,

���������� ��� �� ����������� �� ����� %s.

������ �� ������ ����� �� ���� %s, ��������� ��� ������������ � ������, ��������� ���� ��� �����������.");
DEFINE('_USEND_MSG_NOPASS','������������ $name,\n\n�� ������� ���������������� �� ����� $mosConfig_live_site.\n'.
	'�� ������ ����� �� ���� $mosConfig_live_site, ��������� ������, ������� �� ������� ��� �����������.\n\n'.
	'�� ��� ������ �� ���� ��������, ��� ��� ��� ������� ������������� � ������������� ������ ��� �����������\n');
DEFINE('_ASEND_MSG','������������! ��� ��������� ��������� � ����� %s.

�� ����� %s ����������������� ����� ������������.

������ ������������:
��������� ��� - %s
����� e-mail - %s
��� ������������ - %s

�� ��� ������ �� ���� ��������, ��� ��� ��� ������� ������������� � ������������� ������ ��� �����������');
DEFINE('_REG_COMPLETE_NOPASS',
	'<div class="componentheading">����������� ���������!</div><br />&nbsp;&nbsp;'.
	'������ �� ������ ����� �� ����.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE',
	'<div class="componentheading">����������� ���������!</div><br />������ �� ������ ����� �� ����.');
DEFINE('_REG_COMPLETE_ACTIVATE',
	'<div class="componentheading">����������� ���������!</div><br />���� ������� ������ ������� � ������ ���� ������������ ����� ���, ��� �� �� ��������������. �� ��� e-mail ���� ���������� ������ �� �������, � ������� ������� �� ������ ������������ ���� ������� ������.');
DEFINE('_REG_ACTIVATE_COMPLETE',
	'<div class="componentheading">������� ������ ������������!</div><br />���� ������� ������ ������������. ������ �� ������ ����� �� ����, ��������� ��� ������������ � ������, ������� �� ����� ��� �����������.');
DEFINE('_REG_ACTIVATE_NOT_FOUND',
	'<div class="componentheading">�������� ������ ���������!</div><br />������ ������� ������ ����������� �� ����� ��� ��� ������������.');
DEFINE('_REG_ACTIVATE_FAILURE',
	'<div class="componentheading">������ ���������!</div><br />��������� ����� ������� ������ ����������. ����������, ���������� � ��������������.');

/** classes/html/registration.php*/
DEFINE('_PROMPT_PASSWORD','������ ������?');
DEFINE('_NEW_PASS_DESC',
	'����������, ������� ���� ��� ������������ � ����� e-mail, ����� ������� ������ "��������� ������".<br />'.
	'������, �� ��������� ����� e-mail �� �������� ������ � ����� �������. ����������� ���� ������ ��� ����� �� ����.');
DEFINE('_PROMPT_UNAME','��� ������������:');
DEFINE('_PROMPT_EMAIL','����� e-mail:');
DEFINE('_BUTTON_SEND_PASS','��������� ������');
DEFINE('_REGISTER_TITLE','�����������');
DEFINE('_REGISTER_NAME','��������� ���:');
DEFINE('_REGISTER_UNAME','��� ������������:');
DEFINE('_REGISTER_EMAIL','E-mail:');
DEFINE('_REGISTER_PASS','������:');
DEFINE('_REGISTER_VPASS','������������� ������:');
DEFINE('_REGISTER_REQUIRED',
	'��� ����, ���������� �������� (*), ����������� ��� ����������!');
DEFINE('_BUTTON_SEND_REG','��������� ������');
DEFINE('_SENDING_PASSWORD',
	'��� ������ ����� ��������� �� ��������� ���� ����� e-mail.<br />����� �� ��������'.
	' ����� ������, �� ������� ����� �� ���� � �������� ���� ������ � ����� �����.');

/** classes/html/search.php*/
DEFINE('_SEARCH_TITLE','�����');
DEFINE('_PROMPT_KEYWORD','����� �� �������� �����');
DEFINE('_SEARCH_MATCHES','������� %d ����������');
DEFINE('_CONCLUSION','����� ������� $totalRows ����������.');
DEFINE('_NOKEYWORD','������ �� �������');
DEFINE('_IGNOREKEYWORD','� ������ ���� ��������� ��������');
DEFINE('_SEARCH_ANYWORDS','����� �����');
DEFINE('_SEARCH_ALLWORDS','��� �����');
DEFINE('_SEARCH_PHRASE','����� �����');
DEFINE('_SEARCH_NEWEST','�� ��������');
DEFINE('_SEARCH_OLDEST','�� �����������');
DEFINE('_SEARCH_POPULAR','�� ������������');
DEFINE('_SEARCH_ALPHABETICAL','���������� �������');
DEFINE('_SEARCH_CATEGORY','������ / ���������');
DEFINE('_SEARCH_MESSAGE','����� ��� ������ ������ ��������� �� 3 �� 20 ��������');
DEFINE('_SEARCH_ARCHIVED','� ������');
DEFINE('_SEARCH_CATBLOG','���� ���������');
DEFINE('_SEARCH_CATLIST','������ ���������');
DEFINE('_SEARCH_NEWSFEEDS','����� ��������');
DEFINE('_SEARCH_SECLIST','������ �������');
DEFINE('_SEARCH_SECBLOG','���� �������');


/** templates/*.php*/
DEFINE('_ISO2','cp1251');
DEFINE('_ISO','charset=windows-1251');
DEFINE('_DATE_FORMAT','�������: d.m.Y �.'); //����������� ������ PHP-������� DATE
/**
* �������� ������� ����, ��� ��������� ������ ���� �� �����
*
* ��������, DEFINE("_DATE_FORMAT_LC"," %d %B %Y �. %H:%M"); //����������� ������ PHP-������� strftime
*/
DEFINE('_DATE_FORMAT_LC',$mosConfig_form_date); //����������� ������ PHP-������� strftime
DEFINE('_DATE_FORMAT_LC2',$mosConfig_form_date_full); // ������ ������ �������
DEFINE('_SEARCH_BOX','�����...');
DEFINE('_NEWSFLASH_BOX','������� �������!');
DEFINE('_MAINMENU_BOX','������� ����');

/** classes/html/usermenu.php*/
DEFINE('_UMENU_TITLE','���� ������������');
DEFINE('_HI','������������, ');

/** user.php*/
DEFINE('_SAVE_ERR','����������, ��������� ��� ����.');
DEFINE('_THANK_SUB','������� �� ��� ��������. �� ����� ���������� ��������������� ����� ����������� �� �����.');
DEFINE('_THANK_SUB_PUB','������� �� ��� ��������.');
DEFINE('_UP_SIZE','�� �� ������ ��������� ����� �������� ������ ��� 15��.');
DEFINE('_UP_EXISTS','����������� � ������ $userfile_name ��� ����������. ����������, �������� �������� ����� � ���������� ��� ���.');
DEFINE('_UP_COPY_FAIL','������ ��� �����������');
DEFINE('_UP_TYPE_WARN','�� ������ ��������� ����������� ������ � ������� gif ��� jpg.');
DEFINE('_MAIL_SUB','����� �������� �� ������������');
DEFINE('_MAIL_MSG','������������ $adminName,\n\n������������ $author ���������� ����� �������� � ������ $type � ��������� $title'.
	' ��� ����� $mosConfig_live_site.\n\n\n'.
	'����������, ������� � ������ �������������� �� ������ $mosConfig_live_site/administrator ��� ��������� � ���������� ��� � $type.\n\n'.
	'�� ��� ������ �� ���� ��������, ��� ��� ��� ������� ������������� � ������������� ������ ��� �����������\n');
DEFINE('_PASS_VERR1','���� �� ������� �������� ������, ����������, ������� ��� ��� ��� ��� ������������� ���������.');
DEFINE('_PASS_VERR2','���� �� ������ �������� ������, ����������, �������� ��������, ��� ������ � ��� ������������� ������ ���������.');
DEFINE('_UNAME_INUSE','��������� ��� ������������ ��� ������������.');
DEFINE('_UPDATE','��������');
DEFINE('_USER_DETAILS_SAVE','���� ������ ���������.');
DEFINE('_USER_LOGIN','���� ������������');

/** components/com_user*/
DEFINE('_EDIT_TITLE','������ ������');
DEFINE('_YOUR_NAME','������ ���');
DEFINE('_EMAIL','����� e-mail');
DEFINE('_UNAME','��� ������������ (�����)');
DEFINE('_PASS','������');
DEFINE('_VPASS','������������� ������');
DEFINE('_SUBMIT_SUCCESS','���� ���������� �������!');
DEFINE('_SUBMIT_SUCCESS_DESC','���� ���������� ������� ���������� ��������������. ����� ���������, ��� �������� ����� ����������� �� ���� �����');
DEFINE('_WELCOME','����� ����������!');
DEFINE('_WELCOME_DESC','����� ���������� � ������ ������������ ������ �����');
DEFINE('_CONF_CHECKED_IN','��� \'���������������\' ���� �������� ������ \'��������������\'.');
DEFINE('_CHECK_TABLE','�������� �������');
DEFINE('_CHECKED_IN','��������� ');
DEFINE('_CHECKED_IN_ITEMS','');
DEFINE('_PASS_MATCH','������ �� ���������');

/** components/com_banners*/
DEFINE('_BNR_CLIENT_NAME','�� ������ ������ ��� �������.');
DEFINE('_BNR_CONTACT','�� ������ ������� ������� ��� �������.');
DEFINE('_BNR_VALID_EMAIL','����� ����������� ����� ������� ������ ���� ����������.');
DEFINE('_BNR_CLIENT','�� ������ ������� �������,');
DEFINE('_BNR_NAME','������� ��� �������.');
DEFINE('_BNR_IMAGE','�������� ����������� �������.');
DEFINE('_BNR_URL','�� ������ ������ URL/��� �������.');

/** components/com_login*/
DEFINE('_ALREADY_LOGIN','�� ��� ��������������!');
DEFINE('_LOGOUT','������� ����� ��� ���������� ������');
DEFINE('_LOGIN_TEXT','����������� ���� "������������" � "������" ��� ������� � �����');
DEFINE('_LOGIN_SUCCESS','�� ������� �����');
DEFINE('_LOGOUT_SUCCESS','�� ������� ��������� ������ � ������');
DEFINE('_LOGIN_DESCRIPTION','�� ������ ����� �� ���� ��� ������������, ��� ������� � �������� ��������');
DEFINE('_LOGOUT_DESCRIPTION','�� ������������� ������ �������� �������?');


/** components/com_weblinks*/
DEFINE('_WEBLINKS_TITLE','������');
DEFINE('_WEBLINKS_DESC','� ������ ������� ������� �������� ���������� � �������� ������ � ����. <br />�������� �� ������ ���� �� ��������, � ����� �������� ������ ������.');
DEFINE('_HEADER_TITLE_WEBLINKS','������');
DEFINE('_SECTION','������:');
DEFINE('_SUBMIT_LINK','�������� ������');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','��������:');
DEFINE('_NAME','��������:');
DEFINE('_WEBLINK_EXIST','������ � ����� ������ ��� ����������. �������� ��� � ���������� ��� ���.');
DEFINE('_WEBLINK_TITLE','������ ������ ����� ��������.');

/** components/com_newfeeds*/
DEFINE('_FEED_NAME','�������� ���������');
DEFINE('_FEED_ARTICLES','������');
DEFINE('_FEED_LINK','������ ���������');

/** whos_online.php*/
DEFINE('_WE_HAVE','������ �� ����� ���������: <br />');
DEFINE('_AND',' � ');
DEFINE('_GUEST_COUNT','%s �����');
DEFINE('_GUESTS_COUNT','%s ������');
DEFINE('_MEMBER_COUNT','%s ������������');
DEFINE('_MEMBERS_COUNT','%s �������������');
DEFINE('_ONLINE','');
DEFINE('_NONE','��� ����������� � ������');

/** modules/mod_banners*/
DEFINE('_BANNER_ALT','�������');

/** modules/mod_random_image*/
DEFINE('_NO_IMAGES','��� �����������');

/** modules/mod_stats.php*/
DEFINE('_TIME_STAT','�����');
DEFINE('_MEMBERS_STAT','�������������');
DEFINE('_HITS_STAT','���������');
DEFINE('_NEWS_STAT','��������');
DEFINE('_LINKS_STAT','������');
DEFINE('_VISITORS','�����������');

/** /adminstrator/components/com_menus/admin.menus.html.php*/
DEFINE('_MAINMENU_HOME',
	'* ������ �� ������ �������������� ����� ����� ���� [mainmenu] ������������� ���������� `�������` ��������� �����*');
DEFINE('_MAINMENU_DEL',
	'* �� �� ������ `�������` ��� ����, ��������� ��� ���������� ��� ����������� ���������������� �����*');
DEFINE('_MENU_GROUP',
	'* ��������� `���� ����` ���������� ����� ��� � ����� ������*');


/** administrators/components/com_users*/
DEFINE('_NEW_USER_MESSAGE_SUBJECT','����� ������ ������������');
DEFINE('_NEW_USER_MESSAGE','������������, %s


�� ���� ���������������� ��������������� �� ����� %s.

��� ��������� �������� ���� ��� ������������ � ������, ��� ����� �� ���� %s:

��� ������������ - %s
������ - %s


�� ��� ��������� �� ����� ��������. ��� ������������� ������� �������� � ���������� ������ ��� ��������������.');

/** administrators/components/com_massmail*/
DEFINE('_MASSMAIL_MESSAGE',"��� ��������� � ����� '%s'

���������:
");

// Joostina!

DEFINE('_REG_CAPTCHA','������� ����� � �����������:*');
DEFINE('_REG_CAPTCHA_VAL','���������� ������ ��� � �����������.');
DEFINE('_REG_CAPTCHA_REF','������� ����� �������� �����������.');

DEFINE('_PRINT_PAGE_LINK','����� �������� �� �����');

$bad_text = array( ' ���� ' , ' ��� ' , ' ������ ' , ' ��� ' , ' ���� ' , ' ���� ' , ' ���� ' , ' ���� ' , ' ��� ' , ' ��� ' , ' ����� ' , ' ����� ' , ' ��� ' , ' ��� ' , ' ������ ' , ' ���� ' , ' ��� ' , ' �������� ' , ' ������� ' , ' ������� ' , ' ���� ' , ' ��� ' , ' ��� ' , ' ��� ' , ' ��� ' , ' ���� ' , ' ���� ' , ' ��� ' , ' ����� ' , ' ����� ' , ' ����� ' , ' ���� ' , ' ��� ' , ' ��� ' , ' ������ ' , ' ������� ' , ' �������� ' , ' ��� ' , ' ����� ' , ' ����� ' , ' ������� ' , ' ������� ' , ' ��� ' , ' ���� ' , ' ��� ' , ' ��� ' , ' ����� ' , ' ���� ' , ' ��� ' , ' ���� ' , ' ����� ' , ' ����� ' , ' ��� ' , ' ��� ' , ' ��� ' , ' ��� ' , ' ���� ' , ' ��� ' , ' ����� ' , ' ������ ' , ' ���� ' , ' ��� ' , ' ��� ' , ' ������� ' , ' �������� ' , ' ���� ' , ' ��������� ' , ' ��� ' , ' ������� ' , ' ��� ' , ' ������ ' , ' ������ ' , ' ��� ' , ' ��� ' , ' ��� ' , ' ����� ' , ' ����� ' , ' ��� ' , ' ���� ' , ' ����� ' , ' ����� ' , ' ����� ' , ' ��� ' , ' ��� ' , ' ��� ' , ' ����� ' , ' ���� ' ,  ' ���� ' ,  ' ���� ' ,  ' ���� ' ,  ' ������ ' ,  ' ������ ' ,  ' ������� ' ,  ' ������ ' , ' ������� ' ,  ' ������ ' ,  ' ����� ' ,  ' ���� ' ,  ' ����� ' ,  ' ����� ' ,  ' ��� ' ,  ' ��� ' ,  ' ���� ' , ' ���� ' ,  ' ���� ' ,  ' ���� ' ,  ' ������ ' ,  ' ����� ' ,  ' ���� ' ,  ' ���� ' ,  ' ������ ' ,  ' ��� ' ,  ' ��� ' , ' ��� ' ,  ' ���� ' ,  ' ��� ' ,  ' ����� ' ,  ' ��� ' ,  ' ����� ' ,  ' ���� ' ,  ' ��� ' ,  ' ��� ' ,  ' ���� ' ,  ' ��� ' , ' ����� ' ,  ' ���� ' ,  ' ���� ' ,  ' ��� ' );


/* administrator components com_admin */
DEFINE('_FILE_UPLOAD','�������� �����');
DEFINE('_MAX_SIZE','������������ ������');
DEFINE('_ABOUT_JOOSTINA','� Joostina');
DEFINE('_ABOUT_SYSTEM','� �������');
DEFINE('_SYSTEM_OS','�������');
DEFINE('_DB_VERSION','������ ���� ������');
DEFINE('_PHP_VERSION','������ PHP');
DEFINE('_APACHE_VERSION','���-������');
DEFINE('_PHP_APACHE_INTERFACE','��������� ����� ���-�������� � PHP');
DEFINE('_JOOSTINA_VERSION','������ Joostina!');
DEFINE('_BROWSER','������� (User Agent)');
DEFINE('_PHP_SETTINGS','������ ��������� PHP');
DEFINE('_RG_EMULATION','�������� Register Globals');
DEFINE('_REGISTER_GLOBALS','Register Globals - ����������� ���������� ����������');
DEFINE('_MAGIC_QUOTES','�������� Magic Quotes');
DEFINE('_SAFE_MODE','���������� ����� - Safe Mode');
DEFINE('_SESSION_HANDLING','��������� ������');
DEFINE('_SESS_SAVE_PATH','������� �������� ������ - Session save path');
DEFINE('_PHP_TAGS','�������� php');
DEFINE('_BUFFERING','�����������');
DEFINE('_OPEN_BASEDIR','�����������/�������� ��������');
DEFINE('_ERROR_REPORTING','����������� ������');
DEFINE('_XML_SUPPORT','��������� XML');
DEFINE('_ZLIB_SUPPORT','��������� Zlib');
DEFINE('_DISABLED_FUNCTIONS','����������� �������');
DEFINE('_CONFIGURATION_FILE','���� ������������');
DEFINE('_ACCESS_RIGHTS','����� �������');
DEFINE('_DIRS_WITH_RIGHTS','��� ������ ���� ������� � ������������ Joostina, ��� ��������� ���� �������� ������ ���� �������� ��� ������');
DEFINE('_CACHE_DIRECTORY','������� ����');
DEFINE('_SESSION_DIRECTORY','������� ������');
DEFINE('_DATABASE','���� ������');
DEFINE('_TABLE_NAME','�������� �������');
DEFINE('_DB_CHARSET','���������');
DEFINE('_DB_NUM_RECORDS','�������');
DEFINE('_DB_SIZE','������');
DEFINE('_FIND','�����');
DEFINE('_CLEAR','��������');
DEFINE('_GLOSSARY','���������');
DEFINE('_DEVELOPERS','������������');
DEFINE('_SUPPORT','���������');
DEFINE('_LICENSE','��������');
DEFINE('_CHANGELOG','������ ���������');
DEFINE('_CHECK_VERSION','��������� ������ Joomla! RE');
DEFINE('_PREVIEW_SITE','������������ �����');
DEFINE('_IN_NEW_WINDOW','������� � ����� ����');


/* administrator components com_banners */

DEFINE('_BANNERS_MANAGEMENT','���������� ���������');
DEFINE('_EDIT_BANNER','�������������� �������');
DEFINE('_NEW_BANNER','�������� �������');
DEFINE('_IN_CURRENT_WINDOW','��� �� ����');
DEFINE('_IN_PARENT_WINDOW','������� ����');
DEFINE('_IN_MAIN_FRAME','������� ������');
DEFINE('_BANNER_CLIENTS','������� ��������');
DEFINE('_BANNER_CATEGORIES','��������� ��������');
DEFINE('_NO_BANNERS','������ �� ����������');
DEFINE('_BANNER_COUNTER_RESETTED','������� ������ �������� ������');
DEFINE('_CHECK_PUBLISH_DATE','��������� ������������ ����� ���� ����������');
DEFINE('_CHECK_START_PUBLICATION_DATE','��������� ���� ������ ����������');
DEFINE('_CHECK_END_PUBLICATION_DATE','��������� ���� ��������� ����������');
DEFINE('_TASK_UPLOAD','���������');
DEFINE('_BANNERS_PANEL','������ ��������');
DEFINE('_BANNERS_DIRECTORY_DOESNOT_EXISTS','����� banners �� ����������');
DEFINE('_CHOOSE_BANNER_IMAGE','�������� ����������� ��� ��������');
DEFINE('_BAD_FILENAME','���� ������ ��������� ���������-�������� ������� ��� ��������.');
DEFINE('_FILE_ALREADY_EXISTS','���� #FILENAME# ��� ���������� � ���� ������.');
DEFINE('_BANNER_UPLOAD_ERROR','�������� #FILENAME# ��������');
DEFINE('_BANNER_UPLOAD_SUCCESS','�������� #FILENAME# � #DIRNAME# ������� ��������');
DEFINE('_UPLOAD_BANNER_FILE','��������� ���� �������');


/* administrator components com_categories */


DEFINE('_CATEGORY_CHANGES_SAVED','��������� � ��������� ���������');
DEFINE('_USER_GROUP_ALL','�����');
DEFINE('_USER_GROUP_REGISTERED','���������');
DEFINE('_USER_GROUP_SPECIAL','�����������');
DEFINE('_CONTENT_CATEGORIES','��������� �����������');
DEFINE('_ALL_CONTENT','�� ����������');
DEFINE('_ACTIVE','��������');
DEFINE('_IN_TRASH','� �������');
DEFINE('_VIEW_CATEGORY_CONTENT','_E_PUBLISHING');
DEFINE('_CHOOSE_MENU_PLEASE','����������, �������� ����');
DEFINE('_CHOOSE_MENUTYPE_PLEASE','����������, �������� ��� ����');
DEFINE('_ENTER_MENUITEM_NAME','����������, ������� �������� ��� ����� ������ ����');
DEFINE('_CATEGORY_NAME_IS_BLANK','��������� ������ ����� ��������');
DEFINE('_ENTER_CATEGORY_NAME','������� ��������� ���������');
DEFINE('_EDIT_CATEGORY','��������������');
DEFINE('_NEW_CATEGORY','�����');
DEFINE('_CATEGORY_PROPERTIES','�������� ���������');
DEFINE('_CATEGORY_TITLE','��������� ��������� (Title)');
DEFINE('_CATEGORY_NAME','�������� ��������� (Name)');
DEFINE('_SORT_ORDER','������� ������������');
DEFINE('_IMAGE','�����������');
DEFINE('_IMAGE_POSTITION','������������ �����������');
DEFINE('_MENUITEM','����� ����');
DEFINE('_NEW_MENUITEM_IN_YOUR_MENU','�������� ������ ������ � ��������� ���� ����.');
DEFINE('_MENU_NAME','�������� ������ ����');
DEFINE('_CREATE_MENU_ITEM','������� ����� ����');
DEFINE('_EXISTED_MENU_ITEMS','������������ ������ ����');
DEFINE('_NOT_EXISTS','�����������');
DEFINE('_MENU_LINK_AVAILABLE_AFTER_SAVE','����� � ���� ����� �������� ����� ����������');
DEFINE('_IMAGES_DIRS','�������� ����������� (MOSImage)');
DEFINE('_MOVE_CATEGORIES','����������� ���������');
DEFINE('_CHOOSE_CATEGORY_SECTION','����������, �������� ������ ��� ������������ ���������');
DEFINE('_MOVE_INTO_SECTION','����������� � ������');
DEFINE('_CATEGORIES_TO_MOVE','������������ ���������');
DEFINE('_CONTENT_ITEMS_TO_MOVE','������������ ������� �����������');
DEFINE('_IN_SELECTED_SECTION_WILL_BE_MOVED_ALL','� ��������� ������ ����� ���������� ��� <br /> ������������� ��������� � �� <br /> ������������� ���������� ���� ���������.');
DEFINE('_CATEGORY_COPYING','����������� ���������');
DEFINE('_CHOOSE_CAT_SECTION_TO_COPY','����������, �������� ������ ��� ���������� ���������');
DEFINE('_COPY_TO_SECTION','���������� � ������');
DEFINE('_CATS_TO_COPY','���������� ���������');
DEFINE('_CONTENT_ITEMS_TO_COPY','���������� ���������� ���������');
DEFINE('_IN_SELECTED_SECTION_WILL_BE_COPIED_ALL','� ��������� ������ ����� ����������� ��� <br /> ������������� ��������� � �� <br /> ������������� ���������� ���� ���������.');
DEFINE('_COMPONENT','���������');
DEFINE('_BEFORE_CREATION_CAT_CREATE_SECTION','����� ��������� ��������� �� ������ ������� ���� �� ���� ������');
DEFINE('_CATEGORY_IS_EDITING_NOW','��������� #CATNAME# � ��������� ����� ������������� ������ ���������������');
DEFINE('_TABLE_WEBLINKS_CATEGORY','������� - ���-������ ���������');
DEFINE('_TABLE_NEWSFEEDS_CATEGORY','������� - ����� �������� ���������');
DEFINE('_TABLE_CATEGORY_CONTACTS','������� - �������� ���������');
DEFINE('_TABLE_CATEGORY_CONTENT','������� - ���������� ���������');
DEFINE('_BLOG_CATEGORY_CONTENT','���� - ���������� ���������');
DEFINE('_BLOG_CATEGORY_ARCHIVE','���� - �������� ���������� ���������');
DEFINE('_USE_SECTION_SETTINGS','������������ ��������� �������');
DEFINE('_CMN_ALL','���');
DEFINE('_CHOOSE_CATEGORY_TO_REMOVE','�������� ��������� ��� ��������');
DEFINE('_CANNOT_REMOVE_CATEGORY','���������: #CIDS# �� ����� ���� �������, �.�. ��� �������� ������');
DEFINE('_CHOOSE_CATEGORY_FOR_','�������� ��������� ���');
DEFINE('_CHOOSE_OBJECT_TO_MOVE','�������� ������ ��� �����������');
DEFINE('_CATEGORIES_MOVED_TO','��������� ���������� � ');
DEFINE('_CATEGORY_MOVED_TO','��������� ���������� � ');
DEFINE('_CATEGORIES_COPIED_TO','��������� ����������� � ');
DEFINE('_CATEGORY_COPIED_TO','��������� ����������� � ');
DEFINE('_NEW_ORDER_SAVED','����� ������� ��������');
DEFINE('_SAVE_AND_ADD','��������� � ��������');
DEFINE('_CLOSE','�������');
DEFINE('_CREATE_CONTENT','������� ����������');
DEFINE('_MOVE','���������');
DEFINE('_COPY','����������');

/* administrator components com_checkin */

DEFINE('_BLOCKED_OBJECTS','��������������� �������');
DEFINE('_OBJECT','������');
DEFINE('_WHO_BLOCK','������������');
DEFINE('_BLOCK_TIME','����� ����������');
DEFINE('_ACTION','��������');
DEFINE('_GLOBAL_CHECKIN','���������� �������������');
DEFINE('_TABLE_IN_DB','������� ���� ������');
DEFINE('_OBJECT_COUNT','���-�� ��������');
DEFINE('_UNBLOCKED','��������������');
DEFINE('_CHECHKED_TABLE','��������� �������');
DEFINE('_ALL_BLOCKED_IS_UNBLOCKED','��� ��������������� ������� ��������������');
DEFINE('_MINUTES','�����');
DEFINE('_HOURS','�����');
DEFINE('_DAYS','����');
DEFINE('_ERROR_WHEN_UNBLOCKING','��� ��������������� ��������� ������');
DEFINE('_UNBLOCKED2','�������������');

/* administrator components com_config */

DEFINE('_CONFIGURATION_IS_UPDATED','������������ ������� ���������');
DEFINE('_CANNOT_OPEN_CONF_FILE','������! ���������� ������� ��� ������ ���� ������������!');
DEFINE('_DO_YOU_REALLY_WANT_DEL_AUTENT_METHOD','�� ������������� ������ �������� `����� �������������� ������`? \n\n ��� �������� ������ ��� ������������ ������ ��������� \n\n');
DEFINE('_GLOBAL_CONFIG','���������� ������������');
DEFINE('_PROTECT_AFTER_SAVE','�������� �� ������ ����� ����������');
DEFINE('_IGNORE_PROTECTION_WHEN_SAVE','������������ ������ �� ������ ��� ����������');
DEFINE('_CONFIG_SAVING','���������� ������������');
DEFINE('_NOT_AVAILABLE_CHECK_RIGHTS','');
DEFINE('_SITE_NAME','�������� �����');
DEFINE('_SITE_OFFLINE','���� ��������');
DEFINE('_SITE_OFFLINE_MESSAGE','��������� ��� ����������� �����');
DEFINE('_SITE_OFFLINE_MESSAGE2','���������, ������� ��������� ������������� ������ �����, ����� �� ��������� � ����������� ���������.');
DEFINE('_SYSTEM_ERROR_MESSAGE','��������� ��� ��������� ������');
DEFINE('_SYSTEM_ERROR_MESSAGE2','���������, ������� ��������� ������������� ������ �����, ����� Joostina! �� ����� ������������ � ���� ������ MySQL.');
DEFINE('_SHOW_READMORE_TO_AUTH','���������� \"���������...\" ����������������');
DEFINE('_SHOW_READMORE_TO_AUTH2','���� ��, �� ���������������� ������������� ����� ������������ ������ �� ���������� � ������� ������� -��� ������������������-. ��� ����������� ������� ��������� ������������ ������ ����� ��������������.');
DEFINE('_ENABLE_USER_REGISTRATION','��������� ����������� �������������');
DEFINE('_ENABLE_USER_REGISTRATION2','���� ��, �� ������������� ����� ��������� ���������������� �� �����.');
DEFINE('_ACCOUNT_ACTIVATION','������������ ��������� ������ ��������');
DEFINE('_ACCOUNT_ACTIVATION2','���� ��, �� ������������ ���������� ����� ������������ ����� �������, ����� ��������� �� ������ �� ������� ��� ���������.');
DEFINE('_UNIQUE_EMAIL','��������� ���������� E-mail');
DEFINE('_UNIQUE_EMAIL2','���� ��, �� ������������ �� ������ ��������� ��������� ��������� � ���������� ������� e-mail.');
DEFINE('_USER_PARAMS','��������� ������������ �����');
DEFINE('_USER_PARAMS2','���� `���`, �� ����� ��������� ����������� ��������� ������������� ���������� ����� (����� ���������)');
DEFINE('_DEFAULT_EDITOR','WYSIWYG-�������� �� ���������');
DEFINE('_LIST_LIMIT','����� ������� (���-�� �����)');
DEFINE('_LIST_LIMIT2','������������� ����� ������� �� ��������� � ������ ���������� ��� ���� �������������');
DEFINE('_FRONTPAGE','�����');
DEFINE('_SITE','����');
DEFINE('_CUSTOM_PRINT','�������� ������ �� �������� �������');
DEFINE('_CUSTOM_PRINT2','������������� ������������ �������� ��� ��������� ���� �� �������� �������� �������');
DEFINE('_MODULES_MULTI_LANG','��������� �������������� �������');
DEFINE('_MODULES_MULTI_LANG2','��������� ������� ��������� �������� ����� �������, ���� � ��� ����� �� ������� - ������������� ���������� ���');
DEFINE('_DATE_FORMAT_TXT','������ ����');
DEFINE('_DATE_FORMAT2','�������� ������ ��� ����������� ����. ���������� ������������ ������ � ������������ � ��������� strftime.');
DEFINE('_DATE_FORMAT_FULL','������ ������ ���� � �������');
DEFINE('_DATE_FORMAT_FULL2','�������� ������ ������ ��� ����������� ���� � �������. ���������� ������������ ������ � ������������ � ��������� strftime.');
DEFINE('_USE_H1_FOR_HEADERS','��������� ��������� ����������� ����� H1 ��� ������ ���������');
DEFINE('_USE_H1_FOR_HEADERS2','��������� ��������� ����� h1 ������ � ������ ������� ��������� ����������� ( ��� ������� �� ���������... ).');
DEFINE('_USE_H1_HEADERS_ALWAYS','��������� ��� ��������� ����������� ����� H1');
DEFINE('_USE_H1_HEADERS_ALWAYS2','�������� ��������� ��������� � ���� h1.');
DEFINE('_DISABLE_RSS','��������� ��������� RSS (syndicate)');
DEFINE('_DISABLE_RSS2','���� `��`, �� ����� ��������� ����������� ��������� RSS ���� � ������ � ����');
DEFINE('_USE_TEMPLATE','������������ ������');
DEFINE('_USE_TEMPLATE2','��� ������ ������� �� ����� ����������� �� ���� ����� ���������� �� �������� � ������� ���� ������ ��������. ��� ������������� ���������� �������� �������� \\\'������\\\'');
DEFINE('_FAVICON_IMAGE','������ ����� � ��������� ��������');
DEFINE('_FAVICON_IMAGE2','������ ����� � ��������� (���������) ��������. ���� �� ������� ��� ���� ������ �� ������, �� ��������� ����� �������������� ���� favicon.ico.');
DEFINE('_FAVICON_IMAGE3','������ ����� � ���������');
DEFINE('_DISABLE_FAVICON','��������� favicon');
DEFINE('_DISABLE_FAVICON2','������������ � �������� ������ ����� favicon');
DEFINE('_DISABLE_SYSTEM_MAMBOTS','��������� ������� ������ system');
DEFINE('_DISABLE_SYSTEM_MAMBOTS2','���� `��`, �� ������������� ��������� �������� ����� ����������. ��������, ���� �� ����� ������������ ������� ���� ������, �� ��������� ��������� �� �������������');
DEFINE('_DISABLE_CONTENT_MAMBOTS','��������� ������� ������ content');
DEFINE('_DISABLE_CONTENT_MAMBOTS2','���� `��`, �� ������������� �������� ��������� �������� ����� ����������. ��������, ���� �� ����� ������������ ������� ���� ������, �� ��������� ��������� �� �������������');
DEFINE('_DISABLE_MAINBODY_MAMBOTS','��������� ������� ������ mainbody');
DEFINE('_DISABLE_MAINBODY_MAMBOTS2','���� `��`, �� ������������� �������� ��������� ����� ����������� (mainbody) ����� ����������.');
DEFINE('_SITE_AUTH','����������� �� �����');
DEFINE('_SITE_AUTH2','���� `���`, �� �������� ����������� �� ����� ����� ���������, ���� � ��� �� ������ ����� ����. ����� ����� ��������� ����������� ����������� �� �����');
DEFINE('_FRONT_SESSION_TIME','����� ������������� ������ �� ������');
DEFINE('_FRONT_SESSION_TIME2','����� �������������� ������������ ����� ��� ������������. ������� �������� ����� ��������� ������� ������������.');
DEFINE('_DISABLE_FRONT_SESSIONS','��������� ������ �� ������');
DEFINE('_DISABLE_FRONT_SESSIONS2','���� `��`, �� ����� ��������� ������� ������ ��� ������� ������������ �� �����. ���� ������� ����� ������������� �� ����� � ����������� ��������� - ����� ���������.');
DEFINE('_DISABLE_ACCESS_CHECK_TO_CONTENT','��������� �������� ������� � �����������');
DEFINE('_DISABLE_ACCESS_CHECK_TO_CONTENT2','���� `��`, �� �������� ������� � ����������� �������������� �� �����, � ���� ������������� ����� ���������� �� ����������. ������������� ��������� � �������� ���������� ����������� � ������ �� ������.');
DEFINE('_COUNT_CONTENT_HITS','������� ����� ��������� �����������');
DEFINE('_COUNT_CONTENT_HITS2','��� ���������� ��������� ���������� ��������� ����������� ����� �� �������.');
DEFINE('_DISABLE_CHECK_CONTENT_DATE','��������� �������� ���������� �� �����');
DEFINE('_DISABLE_CHECK_CONTENT_DATE2','���� �� ����� �� �������� ��������� ���������� ���������� ����������� - �� ������ �������� ����� ��������������.');
DEFINE('_DISABLE_MODULES_WHEN_EDIT','��������� ������ � ��������������');
DEFINE('_DISABLE_MODULES_WHEN_EDIT2','���� `��`, �� �� �������� �������������� ����������� � ������ ����� ��������� ��� ������');
DEFINE('_COUNT_GENERATION_TIME','������������ ����� ��������� ��������');
DEFINE('_COUNT_GENERATION_TIME2','���� `��`, �� �� ������ �������� ����� ���������� ����� �� � ���������');
DEFINE('_ENABLE_GZIP','GZIP-������ �������');
DEFINE('_ENABLE_GZIP2','��������� ������ ������� ����� ��������� (���� ��������������). ��������� ���� ������� ��������� ������ ����������� ������� � �������� � ���������� �������. � �� �� �����, ��� ����������� �������� �� ������.');
DEFINE('_IS_SITE_DEBUG','����� ������� �����');
DEFINE('_IS_SITE_DEBUG2','���� ��, �� ����� ������������ ��������������� ����������, ������� � ������ MySQL...');
DEFINE('_EXTENDED_DEBUG','����������� ��������');
DEFINE('_EXTENDED_DEBUG2','������������ �� ������ ����� ����������� �������� ��������� ��������� ���������� � �����.');
DEFINE('_CONTROL_PANEL','������ ����������');
DEFINE('_DISABLE_ADMIN_SESS_DEL','��������� �������� ������ � ������ ����������');
DEFINE('_DISABLE_ADMIN_SESS_DEL2','�� ������� ������ ���� ����� ��������� ������� �������������.');
DEFINE('_DISABLE_HELP_BUTTON','��������� ������ "������"');
DEFINE('_DISABLE_HELP_BUTTON2','��������� ��������� � ������ ������ ������ ������� ������ ����������.');
DEFINE('_USE_OLD_TOOLBAR','������������ ������ ����������� ��������');
DEFINE('_USE_OLD_TOOLBAR2','��� ������������� ��������� ����� ������ �������� ����� ��������� � ������ ������, ��� ���� � Joomla.');
DEFINE('_DISABLE_IMAGES_TAB','��������� ������� "�����������"');
DEFINE('_DISABLE_IMAGES_TAB2','��������� ��������� � ������ ��� �������������� ����������� ������� �����������.');
DEFINE('_ADMIN_SESS_TIME','����� ������������� ������ � ������ ����������');
DEFINE('_SECONDS','������');
DEFINE('_ADMIN_SESS_TIME2','�����, �� ��������� �������� ����� ��������� ������������ <strong>�����������</strong> ��� ������������. ������� ������� �������� ��������� ������������ �����!');
DEFINE('_SAVE_LAST_PAGE','���������� �������� ����������� ��� ��������� ������');
DEFINE('_SAVE_LAST_PAGE2','���� ������ ������ � ������ ���������� �����������, � �� �������� �� ���� � ������� 10 �����, �� ��� ����� �� ������ �������������� �� ��������, � ������� ��������� ����������');
DEFINE('_HTML_CSS_EDITOR','���������� �������� ��� html � css');
DEFINE('_HTML_CSS_EDITOR2','������������ �������� � ���������� ���������� ��� �������������� html � css ������ �������');
DEFINE('_THIS_PARAMS_CONTROL_CONTENT','* ��� ��������� ������������ ����� ��������� ����������� *');
DEFINE('_LINK_TITLES','��������� � ���� ������');
DEFINE('_LINK_TITLES2','���� ��, ��������� �������� ����������� �������� �������� ��� ����������� �� ��� �������');
DEFINE('_READMORE_LINK','������ "���������..."');
DEFINE('_READMORE_LINK2','���� ������ �������� ��������, �� ����� ������������ ������ -���������...- ��� ��������� ������� �����������');
DEFINE('_VOTING_ENABLE','�������/�����������');
DEFINE('_VOTING_ENABLE2','���� ������ �������� ��������, ������� --�������/�����������-- ����� ��������');
DEFINE('_AUTHOR_NAMES','����� �������');
DEFINE('_AUTHOR_NAMES2','��������, ���������� �� ����� �������. ��� ���������� ���������, �� ��� ����� ���� �������� � ������ ������ �� ������ ���� ��� �������.');
DEFINE('_DATE_TIME_CREATION','���� � ����� ��������');
DEFINE('_DATE_TIME_CREATION2','���� ��������, �� ������������ ���� � ����� �������� ������. ��� ���������� ���������, �� ����� ���� �������� � ������ ������ �� ������ ���� ��� �������.');
DEFINE('_DATE_TIME_MODIFICATION','���� � ����� ���������');
DEFINE('_DATE_TIME_MODIFICATION2','���� ����������� ��������, �� ����� ������������ ���� ��������� ������. ��� ���������� ���������, �� ��� ����� ���� �������� � ������ ������.');
DEFINE('_VIEW_COUNT','���-�� ����������');
DEFINE('_VIEW_COUNT2','���� ����������� -��������-, �� ������������ ���������� ���������� ������� ������������ �����. ��� ���������� ��������� ����� ���� �������� � ������ ������ ������ ����������.');
DEFINE('_LINK_PRINT','������ ������');
DEFINE('_LINK_EMAIL','������ E-mail');
DEFINE('_PRINT_EMAIL_ICONS','������ ������ � E-mail');
DEFINE('_PRINT_EMAIL_ICONS2','���� ������� ��������, �� ������ ������ � E-mail ����� ������������ � ���� �������, ����� - ������� �������-�������.');
DEFINE('_ENABLE_TOC','���������� ��� ��������������� ��������');
DEFINE('_BACK_BUTTON','������ ����� (���������)');
DEFINE('_CONTENT_NAV','��������� �� �����������');
DEFINE('_UNIQ_ITEMS_IDS','���������� �������������� ��������');
DEFINE('_UNIQ_ITEMS_IDS2','��� ��������� ��������� ��� ������ ������� � ������ ����� ���������� ���������� ������������� �����.');
DEFINE('_AUTO_PUBLICATION_FRONT','�������������� ���������� �� �������');
DEFINE('_AUTO_PUBLICATION_FRONT2','��� ��������� ��������� �� ����������� ���������� ����� ������������� �������� ��� ���������� �� ������� ��������.');
DEFINE('_DISABLE_BLOCK','��������� ���������� �����������');
DEFINE('_DISABLE_BLOCK2','��� ��������� ��������� ���������� �������� ����������� �� ����� �����������. �� ������������� ������������ �� ������ � ������� ������ ����������.');
DEFINE('_ITEMID_COMPAT','����� ������ Itemid');
DEFINE('_ONE_EDITOR','������������ ������ ���� ���������');
DEFINE('_ONE_EDITOR2','������������ ���� ���� ��� �������� � ��������� ������.');
DEFINE('_LOCALE','������');
DEFINE('_TIME_OFFSET','������� ���� (�������� ������� ������������ UTC, �)');
DEFINE('_TIME_OFFSET2','������� ���� � �����, ������� ����� ������������ �� �����:');
DEFINE('_TIME_DIFF','������� �� �������� �������, �');
DEFINE('_TIME_DIFF2','RSS (�������� ������� ������������ UTC, �)');
DEFINE('_CURR_DATE_TIME_RSS','������� ���� � �����, ������� ����� ������������ � RSS');
DEFINE('_COUNTRY_LOCALE','������ ������');
DEFINE('_COUNTRY_LOCALE2','���������� ������������ ��������� ������: ����������� ����, �������, ����� � �.�.');
DEFINE('_LOCALE_WINDOWS','��� ������������� � Windows ���������� ������ <span style="color: red"><strong>RU</strong></span>.
	  <br />� Unix-��������, ���� �� �������� �������� �� ���������, ����� ����������� �������� ������� �������� ������ �� <strong>RU_RU.CP1251, ru_RU.cp1251, ru_ru.CP1251</strong>, ��� ������ �������� ������� ������ � ����������.<br />
����� ����� ����������� ������ ���� �� ��������� �������: <strong>rus, russian</strong>');
DEFINE('_DB_HOST','����� ����� MySQL');
DEFINE('_DB_USER','��� ������������ �� (MySQL)');
DEFINE('_DB_NAME','���� ������ MySQL');
DEFINE('_DB_PREFIX','������� ���� ������ MySQL');
DEFINE('_DB_PREFIX2','!! �� ���������, ���� � ��� ��� ���� ������� ���� ������. � ��������� ������, �� ������ �������� � ��� ������ !!');
DEFINE('_EVERYDAY_OPTIMIZATION','���������� ����������� ������ ���� ������');
DEFINE('_EVERYDAY_OPTIMIZATION2','���� `��`, �� ������ ����� ���� ������ ����� ������������� �������������� ��� ������� ��������������');
DEFINE('_OLD_MYSQL_SUPPORT','��������� ������� ������ MySQL');
DEFINE('_OLD_MYSQL_SUPPORT2','�������� ��������� ��������� �������������� ������� ������ �� � ����� ������������� � ����������');
DEFINE('_DISABLE_SET_SQL','��������� SET sql_mode');
DEFINE('_DISABLE_SET_SQL2','��������� ������� ������ ������ ���� ������ SET sql_mode');
DEFINE('_SERVER','������');
DEFINE('_ABS_PATH','���������� ����( ������ ����� )');
DEFINE('_MEDIA_ROOT','������ ����� ���������');
DEFINE('_MEDIA_ROOT2','�������� ������� ��� ������ ���������� ���������� ����� �������. ���� �� ����� ����� ��� / �� �����.');
DEFINE('_FILE_ROOT','������ ��������� ���������');
DEFINE('_FILE_ROOT2','�������� ������� ��� ������ ���������� ���������� �������. ��� / � �����. ��� ������������� � Windows (c) ���� ����� ���������� � �������� ����� �����.');
DEFINE('_SECRET_WORD','��������� �����');
DEFINE('_GZ_CSS_JS','������ CSS � JS ������');
DEFINE('_SESSION_TYPE','����� ������������� ������');
DEFINE('_SESSION_TYPE2','�� ���������, ���� �� ������, ����� ��� ����!<br /><br /> ���� ���� ����� �������������� �������������� ������ AOL ��� ��������������, ������������� ��� ������� �� ���� ������-�������, �� ������ ������������ ��������� 2 ������');
DEFINE('_HELP_SERVER','������ ������');
DEFINE('_HELP_SERVER2','������ ������ - ���� ���� ������, �� ����� ������ ����� ������� �� ��������� ����� http://�����_������_�����/help/, ��� ��������� ������� On-Line ������ ������� http://help.joom.ru ��� http://help.joomla.org');
DEFINE('_FILE_MODE','�������� ������');
DEFINE('_FILE_MODE2','���������� ������� � ������');
DEFINE('_FILE_MODE3','�� ������ CHMOD ��� ����� ������ (������������ ��������� �������)');
DEFINE('_FILE_MODE4','���������� CHMOD ��� ����� ������');
DEFINE('_FILE_MODE5','�������� ���� ����� ��� ��������� ���������� ������� � ����� ����������� ������');
DEFINE('_OWNER','��������');
DEFINE('_O_READ','������');
DEFINE('_O_WRITE','������');
DEFINE('_O_EXEC','����������');
DEFINE('_APPLY_TO_FILES','��������� � ������������ ������');
DEFINE('_APPLY_TO_FILES2','��������� �������� <em>���� ������������ ������</em> �� �����.<br/><b>������������ ������������� ���� ����� ����� �������� � ������������������� �����!</b>');
DEFINE('_DIR_CREATION','�������� ���������');
DEFINE('_DIR_CREATION2','���������� ������� � ���������');
DEFINE('_DIR_CREATION3','�� ������ CHMOD ��� ����� ��������� (������������ ��������� �������)');
DEFINE('_DIR_CREATION4','���������� CHMOD ��� ����� ���������');
DEFINE('_DIR_CREATION5','�������� ���� ����� ��� ��������� ���������� ������� � ����� ����������� ���������');
DEFINE('_O_SEARCH','�����');
DEFINE('_APPLY_TO_DIRS','��������� � ������������ ���������');
DEFINE('_APPLY_TO_DIRS2','��������� ���� ������ ����� ��������� ��<em> ���� ������������ ���������</em> �� �����.<br/>'.'<b>������������ ������������� ���� ����� ����� �������� � ������������������� �����!</b>');
DEFINE('_O_GROUP','������');
DEFINE('_O_AS','���');
DEFINE('_RG_EMULATION_TXT','�������� ����������� ���������� ����������');
DEFINE('_RG_DISABLE','����. (�������������) - �������������� ������');
DEFINE('_RG_ENABLE','���. (�� �������������) - ������������� �� ������� ������������, ��� ������������� ��������� ���������� ������ ������������.');
DEFINE('_METADATA','����������');
DEFINE('_SITE_DESC','�������� �����, ������� ������������� ������������');
DEFINE('_SITE_DESC2',' �� ������ �� ������������ ���� �������� ��������� �������, � ����������� �� ���������� �������, ������� �� ���������� ������������. ������� �������� ������� � ���������� ��� ���������� ������ �����. �� ������ �������� ��������� �� ����� �������� ���� � �������� ����. ��� ��� ��������� ��������� ������� ������ ������ 20 ����, �� �� ������ �������� ���� ��� ��� �����������. ���������� ��������������, ��� ����� ������ ����� ������ �������� ��������� � ������ 20 ������.');
DEFINE('_SITE_KEYWORDS','�������� ����� �����');
DEFINE('_SHOW_TITLE_TAG','���������� ����-��� <b>title</b>');
DEFINE('_SHOW_TITLE_TAG2','���������� ����-��� <b>title</b> ��� ��������� �������� �����������');
DEFINE('_SHOW_AUTHOR_TAG','���������� ����-��� <b>author</b>');
DEFINE('_SHOW_AUTHOR_TAG2','���������� ����-��� <b>author</b> ��� ��������� �������� �����������');
DEFINE('_SHOW_BASE_TAG','���������� ����-��� <b>base</b>');
DEFINE('_SHOW_BASE_TAG2','���������� ����-��� <b>base</b> � ���� ������ ��������');
DEFINE('_REVISIT_TAG','�������� ���� <b>revisit</b>');
DEFINE('_REVISIT_TAG2','������� �������� ���� <b>revisit</b> � ����');
DEFINE('_DISABLE_GENERATOR_TAG','��������� ��� Generator');
DEFINE('_DISABLE_GENERATOR_TAG2','���� `��`, �� �� ���� ������ HTML �������� ����� �������� ��� name=\\\'Generator\\\'');
DEFINE('_EXT_IND_TAGS','����������� ���� ����������');
DEFINE('_EXT_IND_TAGS2','���� `��`, �� � ��� ������ �������� ����� ��������� ����������� ���� ��� ������ ����������');
DEFINE('_MAIL','�����');
DEFINE('_MAIL_METHOD','��� �������� ����� ������������');
DEFINE('_MAIL_FROM_ADR','������ �� (Mail From)');
DEFINE('_MAIL_FROM_NAME','����������� (From Name)');
DEFINE('_SENDMAIL_PATH','���� � Sendmail');
DEFINE('_USE_SMTP','������������ SMTP-�����������');
DEFINE('_USE_SMTP2','�������� ��, ���� ��� �������� ����� ������������ smtp-������ � �������������� �����������');
DEFINE('_SMTP_USER','��� ������������ SMTP');
DEFINE('_SMTP_USER2','�����������, ���� ��� �������� ����� ������������ smtp-������ � �������������� �����������');
DEFINE('_SMTP_PASS','������ ��� ������� � SMTP');
DEFINE('_SMTP_PASS2','�����������, ���� ��� �������� ����� ������������ smtp-������ � �������������� �����������');
DEFINE('_SMTP_SERVER','����� SMTP-�������');
DEFINE('_CACHE','���');
DEFINE('_ENABLE_CACHE','�������� �����������');
DEFINE('_ENABLE_CACHE2','��������� ����������� ��������� ������� � MySQL � ���������� �������� �� ������');
DEFINE('_CACHE_OPTIMIZATION','����������� �����������');
DEFINE('_CACHE_OPTIMIZATION2','������������� ������� �� ������ ���� ������ ������� ��� ����� �������� ������ ������.');
DEFINE('_AUTOCLEAN_CACHE_DIR','�������������� ������� �������� ����');
DEFINE('_AUTOCLEAN_CACHE_DIR2','������������� ������� ������� ���� ������ ������������ �����.');
DEFINE('_CACHE_MENU','����������� ���� ������ ����������');
DEFINE('_CACHE_MENU2','��������� ����������� ���� ������ ����������. �������� ���������� �� ������������ ����.');
DEFINE('_CANNOT_CACHE','����������� �� ��������');
DEFINE('_CANNOT_CACHE2','<font color="red"><b>������� ���� �� �������� ��� ������.</b></font>');
DEFINE('_CACHE_DIR','������� ����');
DEFINE('_CACHE_DIR2','������� ������� ���� <b>�������� ��� ������</b>');
DEFINE('_CACHE_DIR3','������� ������� ���� <b>�� �������� ��� ������</b> - ������� CHMOD �������� �� 755 ����� ���������� ����');
DEFINE('_CACHE_TIME','����� ����� ����');
DEFINE('_DB_CACHE','��� �������� ���� ������');
DEFINE('_DB_CACHE_TIME','����� ����� ���� �������� ���� ������');
DEFINE('_STATICTICS','����������');
DEFINE('_ENABLE_STATS','�������� ���� ����������');
DEFINE('_ENABLE_STATS2','���������/��������� ���� ���������� �����');
DEFINE('_STATS_HITS_DATE','����� ���������� ��������� ����������� �� ����');
DEFINE('_STATS_HITS_DATE2','��������������: � ���� ������ ������������ ������� ������ ������!');
DEFINE('_STATS_SEARCH_QUERIES','���������� ��������� ��������');
DEFINE('_SEF_URLS','������������� ��� ��������� ������ URL-� (SEF)');
DEFINE('_SEF_URLS2','������ ��� Apache! ����� �������������� ������������ htaccess.txt � .htaccess. ��� ���������� ��� ��������� ������ apache - mod_rewrite');
DEFINE('_DYNAMIC_PAGETITLES','������������ ��������� ������� (���� title)');
DEFINE('_DYNAMIC_PAGETITLES2','������������ ��������� ���������� ������� � ����������� �� �������� ���������������� �����������');
DEFINE('_CLEAR_FRONTPAGE_LINK','������� ������ �� com_frontpage');
DEFINE('_CLEAR_FRONTPAGE_LINK2','��������� ������ �� ��������� ������� �������� ����� �������� ���.');
DEFINE('_DISABLE_PATHWAY_ON_FRONT','�������� ������ (pathway) �� �������');
DEFINE('_DISABLE_PATHWAY_ON_FRONT2','��� ���������� ������ ������ \\\'�������\\\' �� ������ �������� ����� ����� �������� �� ������ ������������ �������.');
DEFINE('_TITLE_ORDER','������� ������������ ��������� title');
DEFINE('_TITLE_ORDER2','������� ������������ ��������� ��������� ������� (��� title)');
DEFINE('_TITLE_SEPARATOR','����������� ��������� title');
DEFINE('_TITLE_SEPARATOR2','����������� ��������� ��������� ������� (��� title). �� ��������� - �����.');
DEFINE('_INDEX_PRINT_PAGE','���������� �������� ������');
DEFINE('_INDEX_PRINT_PAGE2','���� `��`, �� �������� ������ ����������� ����� �������� ��� ����������');
DEFINE('_REDIR_FROM_NOT_WWW','������������� � �� WWW �������');
DEFINE('_REDIR_FROM_NOT_WWW2','��� ������ �� ���� �� ������ site.ru, ������������� ����� ����������� ������������� �� www.sie.ru');
DEFINE('_ADMIN_CAPTCHA','��� ����������� � ������ ����������');
DEFINE('_ADMIN_CAPTCHA2','������������ captcha ��� ����� ���������� ����������� � ������ ����������.');
DEFINE('_REGISTRATION_CAPTCHA','��� �����������');
DEFINE('_REGISTRATION_CAPTCHA2','������������ captcha ��� ����� ���������� �����������.');
DEFINE('_CONTACTS_CAPTCHA','��� ����� ���������');
DEFINE('_CONTACTS_CAPTCHA2','������������ captcha ��� ����� ���������� ����� ���������.');

DEFINE('_O_OTHER','������');
DEFINE('_SECURITY_LEVEL3','3 ������� ������ - �� ��������� - ���������');
DEFINE('_SECURITY_LEVEL2','2 ������� ������ - ��������� ��� IP-������� ������');
DEFINE('_SECURITY_LEVEL1','1 ������� ������ - �������� �������������');
DEFINE('_PHP_MAIL_FUNCTION','������� PHP mail');
DEFINE('_CONSTRUCT_ERROR','������ ������');

DEFINE('_TIME_OFFSET_M_12','(UTC -12:00) ������������� ����� ��������� �������');
DEFINE('_TIME_OFFSET_M_11','(UTC -11:00) ������ ������, �����');
DEFINE('_TIME_OFFSET_M_10','(UTC -10:00) ������');
DEFINE('_TIME_OFFSET_M_9_5','(UTC -09:30) �������, ���������� �������');
DEFINE('_TIME_OFFSET_M_9','(UTC -09:00) ������');
DEFINE('_TIME_OFFSET_M_8','(UTC -08:00) ������������� ����� (��� &amp; ������)');
DEFINE('_TIME_OFFSET_M_7','(UTC -07:00) ����� ������� (��� &amp; ������)');
DEFINE('_TIME_OFFSET_M_6','(UTC -06:00) ����������� �����  (��� &amp; ������), ������');
DEFINE('_TIME_OFFSET_M_5','(UTC -05:00) ��������� ����� (��� &amp; ������), ������, �����');
DEFINE('_TIME_OFFSET_M_4','(UTC -04:00) ������������� ����� (������), �������, ��-���');
DEFINE('_TIME_OFFSET_M_3_5','(UTC -03:30) ������������ � ��������');
DEFINE('_TIME_OFFSET_M_3','(UTC -03:00) ��������, ������ �����, ����������');
DEFINE('_TIME_OFFSET_M_2','(UTC -02:00) ������-������������� �����');
DEFINE('_TIME_OFFSET_M_1','(UTC -01:00 ���) �������� �������, ������� �������� ����');
DEFINE('_TIME_OFFSET_M_0','(UTC 00:00) �������-����������� �����, ������, ��������, ����������');
DEFINE('_TIME_OFFSET_P_1','(UTC +01:00 ���) ��������, ����������, ������, �����');
DEFINE('_TIME_OFFSET_P_2','(UTC +02:00) �������, ����, �����, �����������, ����� ������');
DEFINE('_TIME_OFFSET_P_3','(UTC +03:00) ������, �����-���������, ������, ��-����');
DEFINE('_TIME_OFFSET_P_3_5','(UTC +03:30) �������');
DEFINE('_TIME_OFFSET_P_4','(UTC +04:00) ������, ����, �������, ���-����, ������');
DEFINE('_TIME_OFFSET_P_4_5','(UTC +04:30) �����');
DEFINE('_TIME_OFFSET_P_5','(UTC +05:00) ��������, ������������, �����, �������, ���������, ������');
DEFINE('_TIME_OFFSET_P_5_5','(UTC +05:30) ������, ���������, ������, ���-����');
DEFINE('_TIME_OFFSET_P_5_75','(UTC +05:45) ��������');
DEFINE('_TIME_OFFSET_P_6','(UTC +06:00) ����, �����������, ������, ����, �������');
DEFINE('_TIME_OFFSET_P_6_5','(UTC +06:30) ����');
DEFINE('_TIME_OFFSET_P_7','(UTC +07:00) ����������, �������, �����, ��������');
DEFINE('_TIME_OFFSET_P_8','(UTC +08:00) �������, ����-�����, �����, ��������, �������');
DEFINE('_TIME_OFFSET_P_8_75','(UTC +08:00) �������� ���������');
DEFINE('_TIME_OFFSET_P_9','(UTC +09:00) ������, �����, ����, �����, �������');
DEFINE('_TIME_OFFSET_P_9_5','(UTC +09:30) ��������, ������');
DEFINE('_TIME_OFFSET_P_10','(UTC +10:00) �����������, ����, ��������� ���������');
DEFINE('_TIME_OFFSET_P_10_5','(UTC +10:30) ������ Lord Howe (���������)');
DEFINE('_TIME_OFFSET_P_11','(UTC +11:00) �������, ���������� �������, ����� ���������');
DEFINE('_TIME_OFFSET_P_11_5','(UTC +11:30) ������ �������');
DEFINE('_TIME_OFFSET_P_12','(UTC +12:00) ��������, ������, ����������, �����');
DEFINE('_TIME_OFFSET_P_12_75','(UTC +12:45) ������ �����');
DEFINE('_TIME_OFFSET_P_13','(UTC +13:00) �����');
DEFINE('_TIME_OFFSET_P_14','(UTC +14:00) ��������');

/* administrator components com_contact */

DEFINE('_CONTACT_MANAGEMENT','���������� ����������');
DEFINE('_ON_SITE','�� �����');
DEFINE('_RELATED_WITH_USER','������� � �������������');
DEFINE('_CHANGE_CONTACT','�������� �������');
DEFINE('_CHANGE_CATEGORY','�������� ���������');
DEFINE('_CHANGE_USER','�������� ������������');
DEFINE('_ENTER_NAME_PLEASE','�� ������ ������ ���');
DEFINE('_NEW_CONTACT','�����');
DEFINE('_CONTACT_DETAILS','������ ��������');
DEFINE('_USER_POSITION','��������� (���������)');
DEFINE('_ADRESS_STREET_HOUSE','����� (�����, ���)');
DEFINE('_CITY','�����');
DEFINE('_STATE','����/�������/����������');
DEFINE('_COUNTRY','������');
DEFINE('_POSTCODE','�������� ������');
DEFINE('_ADDITIONAL_INFO','�������������� ����������');
DEFINE('_PUBLISH_INFO','���������� � ����������');
DEFINE('_POSITION','������������');
DEFINE('_IMAGES_INFO','���������� �� �����������');
DEFINE('_PARAMETERS','���������');
DEFINE('_CONTACT_PARAMS','* ��� ��������� ��������� ������������ ������ ��� ��������� ���������� � ��������*');


/* administrator components com_content */

DEFINE('_SITE_CONTENT','���������� �����');
DEFINE('_GOTO_EDIT','������� � ��������������');
DEFINE('_SORT_BY','���������� ��');
DEFINE('_HIDE_NAV_TREE','������ ������ ���������');
DEFINE('_ON_FRONTPAGE','�� �������');
DEFINE('_SAVE_ORDER','��������� �������');
DEFINE('_TO_TRASH','� �������');
DEFINE('_NEVER','�������');
DEFINE('_START','������');
DEFINE('_ALWAYS','������');
DEFINE('_END','���������');
DEFINE('_WITHOUT_END','��� ���������');
DEFINE('_CHANGE_USER_DATA','�������� ������ ������������');
DEFINE('_CHANGE_CONTENT','�������� ����������');
DEFINE('_CHOOSE_OBJECTS_TO_TRASH','����������, �������� �� ������ �������, ������� �� ������ ��������� � �������');
DEFINE('_WANT_TO_TRASH','�� �������, ��� ������ ��������� ������(�) � �������? \n ��� �� �������� � ������� �������� ��������');
DEFINE('_ARCHIVE','�����');
DEFINE('_ALL_SECTIONS','��� �������');
DEFINE('_OBJECT_MUST_HAVE_TITLE','���� ������ ������ ����� ���������');
DEFINE('_PLEASE_CHOOSE_SECTION','�� ������ ������� ������');
DEFINE('_PLEASE_CHOOSE_CATEGORY','�� ������ ������� ���������');
DEFINE('_O_EDITING','��������������');
DEFINE('_O_CREATION','��������');
DEFINE('_OBJECT_DETAILS','������ �������');
DEFINE('_ALIAS','���������');
DEFINE('_INTROTEXT_M','������� �����: (�����������)');
DEFINE('_MAINTEXT_M','�������� �����: (�������������)');
DEFINE('_NOTETEXT_M','�������: (�������������)');
DEFINE('_HIDE_PARAMS_PANEL','������ ������ ����������');
DEFINE('_SETTINGS','���������');
DEFINE('_IN_ARCHIVE','� ������');
DEFINE('_DRAFT_NOT_PUBLISHED','�������� - �� �����������');
DEFINE('_RESET','��������');
DEFINE('_CHANGED','����������');
DEFINE('_CREATED','�������');
DEFINE('_NEW_DOCUMENT','����� ��������');
DEFINE('_LAST_CHANGE','��������� ���������');
DEFINE('_NOT_CHANGED','�� ����������');
DEFINE('_START_PUBLICATION','������ ����������');
DEFINE('_END_PUBLICATION','��������� ����������');
DEFINE('_OBJECT_ID','ID �������');
DEFINE('_USED_IMAGES','������������ �����������');
DEFINE('_SUBDIRECTORY','��������');
DEFINE('_IMAGE_EXAMPLE','������ �����������');
DEFINE('_ACTIVE_IMAGE','�������� �����������');
DEFINE('_SOURCE','��������');
DEFINE('_ALIGN','������������');
DEFINE('_PARAMS_IN_VIEW','* ��� ��������� ��������� ������� ����� ������ � ������ ������� ���������*');
DEFINE('_ROBOTS_PARAMS','��������� ���������� ��������');
DEFINE('_MENU_LINK','����� � ����');
DEFINE('_MENU_LINK2','����� ��������� ����� ���� (������ - ������ �����������), ������� ����������� � ��������� �� ������ ����');
DEFINE('_EXISTED_MENUITEMS','������������ ������ ����');
DEFINE('_PLEASE_SELECT_SMTH','����������, �������� ���-������');
DEFINE('_OBJECT_MOVING','����������� ��������');
DEFINE('_MOVE_INTO_CAT_SECT','����������� � ������/���������');
DEFINE('_OBJECTS_TO_MOVE','����� ���������� �������');
DEFINE('_SELECT_CAT_TO_MOVE_OBJECTS','����������, �������� ������ ��� ��������� ��� ����������� ��������');
DEFINE('_COPYING_CONTENT_ITEMS','����������� �������� �����������');
DEFINE('_COPY_INTO_CAT_SECT','���������� � ������/���������');
DEFINE('_OBJECTS_TO_COPY','����� ����������� �������');
DEFINE('_ORDER_BY_NAME','����������� �������');
DEFINE('_ORDER_BY_HEADERS','����������');
DEFINE('_ORDER_BY_DATE_CR','���� ��������');
DEFINE('_ORDER_BY_DATE_MOD','���� �����������');
DEFINE('_ORDER_BY_ID','��������������� ID');
DEFINE('_ORDER_BY_HITS','����������');
DEFINE('_CANNOT_EDIT_ARCHIVED_ITEM','�� �� ������ ��������������� �������� ������');
DEFINE('_NOW_EDITING_BY_OTHER','� ��������� ����� ������������� ������ �������������');
DEFINE('_ROBOTS_HIDE','������ ����-��� robots');
DEFINE('_CONTENT_ITEM_SAVED','��������� ������� ��������� �');
DEFINE('_OBJ_ARCHIVED','������(�) ������� �����������(�)');
DEFINE('_OBJ_PUBLISHED','������(�) ������� �����������(�)');
DEFINE('_OBJ_UNARCHIVED','������(�) ������� ��������(�) �� ������');
DEFINE('_OBJ_UNPUBLISHED','������(�) ������� ����(�) � ����������');
DEFINE('_CHOOSE_OBJ_TOGGLE','�������� ������ ��� ������������');
DEFINE('_CHOOSE_OBJ_DELETE','�������� ������ ��� ��������');
DEFINE('_MOVED_TO_TRASH','���������� � �������');
DEFINE('_CHOOSE_OBJ_MOVE','�������� ������ ��� �����������');
DEFINE('_ERROR_OCCURED','��������� ������');
DEFINE('_OBJECTS_MOVED_TO_SECTION','������(�) ������� ���������(�) � ������');
DEFINE('_OBJECTS_COPIED_TO_SECTION','������(�) ������� ����������� � ������');
DEFINE('_HITCOUNT_RESETTED','������� ���������� �������');

/* administrator components com_easysql */

DEFINE('_SQL_COMMAND','�������');
DEFINE('_MANAGEMENT','����������');
DEFINE('_FIELDS','����');
DEFINE('_EXEC_SQL','��������� SQL');

/* administrator components com_frontpage */

DEFINE('_UNKNOWN_ID','������������� �� �������');
DEFINE('_REMOVE_FROM_FRONT','������ � �������');
DEFINE('_PUBLISH_TIME_END','����� ���������� �������');
DEFINE('_CANNOT_CHANGE_PUBLISH_STATE','����� ������� ���������� ����������');
DEFINE('_CHANGE_SECTION','�������� ������');

/* administrator components com_installer */

DEFINE('_OTHER_COMPONENT_USE_DIR','������ ��������� ��� ���������� �������');
DEFINE('_CANNOT_CREATE_DIR','���������� ������� �������');
DEFINE('_SQL_ERROR','������ ���������� SQL');
DEFINE('_ERROR_MESSAGE','����� ������');
DEFINE('_CANNOT_COPY_PHP_INSTALL','�� ���� ����������� PHP-���� ���������');
DEFINE('_CANNOT_COPY_PHP_REMOVE','�� ���� ����������� PHP-���� ��������');
DEFINE('_ERROR_DELETING','������ ��������');
DEFINE('_IS_PART_OF_CMS','�������� ��������� ���� Joomla � �� ����� ���� ������.<br />�� ������ ����� ��� � ����������, ���� �� ������ ��� ������������');
DEFINE('_DELETE_ERROR','�������� - ������');
DEFINE('_UNINSTALL_ERROR','������ �������������');
DEFINE('_BAD_XML_FILE','������������ XML-����');
DEFINE('_PARAM_FILED_EMPTY','���� ��������� ������ � ���������� ������� �����');
DEFINE('_INSTALLED_COMPONENTS','������������� ����������');
DEFINE('_INSTALLED_COMPONENTS2','����� �������� ������ �� ����������, ������� �� ������ �������. ����� ���� Joostina ������� ������.');
DEFINE('_COMPONENT_NAME','�������� ����������');
DEFINE('_COMPONENT_LINK','������ ���� ����������');
DEFINE('_COMPONENT_AUTHOR_URL','URL ������');
DEFINE('_OTHER_COMPONENTS_NOT_INSTALLED','��������� ���������� �� �����������');
DEFINE('_COMPONENT_INSTALL','��������� ����������');
DEFINE('_DELETING','��������');
DEFINE('_CANNOT_DEL_LANG_ID','id ����� �����, ������� ���������� ������� �����');
DEFINE('_GOTO_LANG_MANAGEMENT','������� � ���������� �������');
DEFINE('_INTALL_LANG','��������� ��������� ������ �����');
DEFINE('_NO_FILES_OF_MAMBOTS','��� ������, ���������� ��� �������');
DEFINE('_WRONG_ID','������������ id �������');
DEFINE('_BAD_DIR_NAME_EMPTY','���� ����� ������, ���������� ������� �����');
DEFINE('_INSTALLED_MAMBOTS','������������� �������');
DEFINE('_MAMBOT','������');
DEFINE('_TYPE','���');
DEFINE('_OTHER_MAMBOTS','��� �� ������� ����, � ��������� �������');
DEFINE('_INSTALL_MAMBOT','��������� �������');
DEFINE('_UNKNOWN_CLIENT','����������� ��� �������');
DEFINE('_NO_FILES_MODULES','�����, ���������� ��� ������, �����������');
DEFINE('_ALREADY_EXISTS','��� ����������');
DEFINE('_DELETING_XML_FILE','�������� XML �����');
DEFINE('_INSTALL_MODULE','������������� �������');
DEFINE('_MODULE','������');
DEFINE('_USED_ON','������������');
DEFINE('_NO_OTHER_MODULES','��������� ������ �� �����������');
DEFINE('_MODULE_INSTALL','��������� ������');
DEFINE('_SITE_MODULES','������ �����');
DEFINE('_ADMIN_MODULES','������ ������ ����������');
DEFINE('_CANNOT_DEL_FILE_NO_DIR','���������� ������� ����, �.�. ������� �� ����������');
DEFINE('_WRITEABLE','�������� ��� ������');
DEFINE('_UNWRITEABLE','���������� ��� ������');
DEFINE('_CHOOSE_DIRECTORY_PLEASE','����������, �������� �������');
DEFINE('_ZIP_UPLOAD_AND_INSTALL','�������� ������ ���������� � ����������� ����������');
DEFINE('_PACKAGE_FILE','���� ������');
DEFINE('_UPLOAD_AND_INSTALL','��������� � ����������');
DEFINE('_INSTALL_FROM_DIR','��������� �� ��������');
DEFINE('_INSTALLATION_DIRECTORY','������� ���������');
DEFINE('_CONTINUE','����������');
DEFINE('_NO_INSTALLER','�� ������ �����������');
DEFINE('_CANNOT_INSTALL','��������� [$element] ����������');
DEFINE('_CANNOT_INSTALL_DISABLED_UPLOAD','��������� ����������, ���� ��������� �������� ������. ����������, ����������� ��������� �� ��������.');
DEFINE('_INSTALL_ERROR','������ ���������');
DEFINE('_CANNOT_INSTALL_NO_ZLIB','��������� ����������, ���� �� ����������� ��������� zlib');
DEFINE('_NO_FILE_CHOOSED','���� �� ������');
DEFINE('_ERORR_UPLOADING_EXT','������ �������� ������ ������');
DEFINE('_UPLOADING_ERROR','�������� ��������');
DEFINE('_SUCCESS','�������');
DEFINE('_UNSUCCESS','��������');
DEFINE('_UPLOAD_OF_EXT','�������� ������ ��������');
DEFINE('_DELETE_SUCCESS','�������� �������');
DEFINE('_CANNOT_CHMOD','�� ���� �������� ����� ������� � ����������� �����');
DEFINE('_CANNOT_MOVE_TO_MEDIA','�� ���� ����������� ��������� ���� � ������� <code>/media</code>');
DEFINE('_CANNOT_WRITE_TO_MEDIA','�������� �������, ��� ��� ������� <code>/media</code> ���������� ��� ������.');
DEFINE('_CANNOT_INSTALL_NO_MEDIA','�������� �������, ��� ��� ������� <code>/media</code> �� ����������');
DEFINE('_ERROR_NO_XML_JOOMLA','������: � ������������ ������ ���������� ����� XML-���� ��������� Joomla.');
DEFINE('_ERROR_NO_XML_INSTALL','������: � ������������ ������ ���������� ����� XML-���� ���������.');
DEFINE('_NO_NAME_DEFINED','�� ���������� ��� �����');
DEFINE('_FILE','����');
DEFINE('_NOT_CORRECT_INSTALL_FILE_FOR_JOOMLA','�� �������� ���������� ������ ��������� Joomla!');
DEFINE('_CANNOT_RUN_INSTALL_METHOD','����� "install" �� ����� ���� ������ �������');
DEFINE('_CANNOT_RUN_UNINSTALL_METHOD','����� "uninstall" �� ����� ���� ������ �������');
DEFINE('_CANNOT_FIND_INSTALL_FILE','������������ ���� �� ������');
DEFINE('_XML_NOT_FOR','������������ XML-���� - �� ���');
DEFINE('_FILE_NOT_EXISTS','���� �� ����������');
DEFINE('_INSTALL_TWICE','�� ��������� ������ ���������� ���� � �� �� ����������');
DEFINE('_ERROR_COPYING_FILE','������ ����������� �����');

/* administrator components com_jce */

DEFINE('_LANG_ALREADY_EXISTS','���� ��� ����������');
DEFINE('_EMPTY_LANG_ID','������ id �����, ���������� ������� �����');
DEFINE('_NO_PLUGIN_FILES','����� �������� �����������');
DEFINE('_BAD_OBJECT_ID','�������� id �������');
DEFINE('_EMPRY_DIR_NAME_CANNOT_DEL_FILE','���� ����� ������, ���������� ������� ����');
DEFINE('_INSTALLED_JCE_PLUGINS','������������� ������� JCE');
DEFINE('_PCLZIP_UNKNOWN_ERROR','������������ ������');
DEFINE('_UNZIP_ERROR','������ ����������');
DEFINE('_JCE_INSTALL_ERROR_NO_XML','������: ���������� ����� � ������ XML-���� ��������� JCE 1.1.x.');
DEFINE('_JCE_INSTALL_ERROR_NO_XML2','������: ���������� ����� � ������ XML-���� ���������.');
DEFINE('_JCE_UNKNOWN_FILENAME','��� ����� �� ����������');
DEFINE('_BAD_JCE_INSTALL_FILE',' ������������ ���� ��������� JCE ��� ��� ������ ������������.');
DEFINE('_WRONG_PLUGIN_VERSION','������������ ������ �������');
DEFINE('_ERROR_CREATING_DIRECTORY','������ �������� ��������');
DEFINE('_INSTALLER_NOT_FIND_ELEMENT','����������� �� ��������� �������');
DEFINE('_NO_INSTALLER_FOR_COMPONENT','����������� ���������� ��� ��������');
DEFINE('_NO_CHOOSED_FILES','����� �� �������');
DEFINE('_ERROR_OF_UPLOAD','������ ��������');
DEFINE('_UPLOADING','��������');
DEFINE('_IS_SUCCESS','�������');
DEFINE('_HAS_ERROR','����������� �������');
DEFINE('_CANNOT_DELETE_LANG_FILE','������ ������� ������������ �������� �����');
DEFINE('_GUEST','�����');
DEFINE('_EDITOR','��������');
DEFINE('_PUBLISHER','��������');
DEFINE('_MANAGER','��������');
DEFINE('_ADMINISTRATOR','�������������');
DEFINE('_SUPER_ADMINISTRATOR','�����-�������������');
DEFINE('_CHANGES_FOR_PLUGIN','��������� ��� �������');
DEFINE('_SUCCESS_SAVE','�������� ����������');
DEFINE('_PLUGIN','������');
DEFINE('_MODULE_IS_EDITING_BY_ADMIN','������ $row->title � ��������� ����� ������������� ������ ���������������');
DEFINE('_CHOOSE_PLUGIN_FOR_ACCESS_MANAGEMENT','��� ���������� ���� ������� ���������� ������� ������');
DEFINE('_CHOOSE_PLUGIN_FOR','�������� ������ ���');
DEFINE('_JCE_CONFIG','������������ JCE');
DEFINE('_EDITOR_CONFIG','������������ ���������');
DEFINE('_EXTENSIONS','����������');
DEFINE('_EXTENSION_MANAGEMENT','���������� ������������');
DEFINE('_ICONS_POSITIONS','������������ �������');
DEFINE('_LANG_MANAGER','�������� �����������');
DEFINE('_FILE_NOT_FOUND','���� �� �����');
DEFINE('_PLUGIN_NOT_FOUND','������ �� ������');
DEFINE('_JCE_CONTENT_MAMBOT_NOT_INSTALLED','������ ��������� JCE �� ����������');
DEFINE('_ICONS_POSITIONS_SAVED','������������ ������� ���������');
DEFINE('_MAIN_PAGE','�������');
DEFINE('_NEW','�����');
DEFINE('_INSTALLATION','���������');
DEFINE('_PREVIEW','������������');
DEFINE('_PLUGINS','�������');
/*
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
DEFINE('_','');
*/
?>