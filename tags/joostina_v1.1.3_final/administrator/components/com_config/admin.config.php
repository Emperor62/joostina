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

if (!$acl->acl_check( 'administration', 'config', 'users', $my->usertype )) {
	mosRedirect( 'index2.php?', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'class' ) );
require_once( $mainframe->getPath( 'admin_html' ) );

switch ( $task ) {
	case 'apply':
	case 'save':
		js_menu_cache_clear();
		saveconfig( $task );
		break;

	case 'cancel':
		mosRedirect( 'index2.php' );
		break;

	default:
		showconfig( $option );
		break;
}

/**
 * Show the configuration edit form
 * @param string The URL option
 */
function showconfig( $option) {
	global $database, $mosConfig_absolute_path, $mosConfig_editor;

	$row = new mosConfig();
	$row->bindGlobals();

	// compile list of the languages
	$langs 		= array();
	$menuitems 	= array();
	$lists 		= array();

// PRE-PROCESS SOME LISTS

	// -- ����� --

	if ($handle = opendir( $mosConfig_absolute_path . '/language/' )) {
		$i=0;
		while (false !== ($file = readdir( $handle ))) {
			if (!strcasecmp(substr($file,-4),".php") && $file != "." && $file != ".." && strcasecmp(substr($file,-11),".ignore.php")) {
				$langs[] = mosHTML::makeOption( substr($file,0,-4) );
			}
		}
	}

	// ���������� ������ ������
	sort( $langs );
	reset( $langs );

	// -- ��������� --

	// compile list of the editors
	$query = "SELECT element AS value, name AS text"
	. "\n FROM #__mambots"
	. "\n WHERE folder = 'editors'"
	. "\n AND published = 1"
	. "\n ORDER BY ordering, name"
	;
	$database->setQuery( $query );
	$edits = $database->loadObjectList();

	// -- ��������/������ --

	$show_hide = array(
		mosHTML::makeOption( 1, '������' ),
		mosHTML::makeOption( 0, '��������' ),
	);

	$show_hide_r = array(
		mosHTML::makeOption( 0, '������' ),
		mosHTML::makeOption( 1, '��������' ),
	);

	// -- ������ ���� --

	$query = "SELECT id AS value, name AS text FROM #__menu"
	. "\n WHERE ( type='content_section' OR type='components' OR type='content_typed' )"
	. "\n AND published = 1"
	. "\n AND access = 0"
	. "\n ORDER BY name"
	;
	$database->setQuery( $query );
	$menuitems = array_merge( $menuitems, $database->loadObjectList() );


// ��������� �����

	$lists['offline'] = mosHTML::yesnoRadioList( 'config_offline', 'class="inputbox"', $row->config_offline );


	if ( !$row->config_editor ) {
		$row->config_editor = '';
	}
	// build the html select list
	$lists['editor'] = mosHTML::selectList( $edits, 'config_editor', 'class="inputbox" size="1"', 'value', 'text', $row->config_editor );

	$listLimit = array(
		mosHTML::makeOption( 5, 5 ),
		mosHTML::makeOption( 10, 10 ),
		mosHTML::makeOption( 15, 15 ),
		mosHTML::makeOption( 20, 20 ),
		mosHTML::makeOption( 25, 25 ),
		mosHTML::makeOption( 30, 30 ),
		mosHTML::makeOption( 50, 50 ),
		mosHTML::makeOption( 100, 100),
		mosHTML::makeOption( 150, 150 ),
	);

	$lists['list_limit'] = mosHTML::selectList( $listLimit, 'config_list_limit', 'class="inputbox" size="1"', 'value', 'text', ( $row->config_list_limit ? $row->config_list_limit : 50 ) );

	$lists['frontend_login'] = mosHTML::yesnoRadioList( 'config_frontend_login', 'class="inputbox"', $row->config_frontend_login );

// boston, ���������� ������� ������ �������� ����� ������������� �� �����
	$lists['session_front'] = mosHTML::yesnoRadioList( 'config_session_front', 'class="inputbox"', $row->config_session_front );
// boston, ���������� syndicate
	$lists['syndicate_off'] = mosHTML::yesnoRadioList( 'config_syndicate_off', 'class="inputbox"', $row->config_syndicate_off );
// boston, ���������� ���� Generator
	$lists['generator_off'] = mosHTML::yesnoRadioList( 'config_generator_off', 'class="inputbox"', $row->config_generator_off );
// boston, ���������� �������� ������ system
	$lists['mmb_system_off'] = mosHTML::yesnoRadioList( 'config_mmb_system_off', 'class="inputbox"', $row->config_mmb_system_off );
// boston, �������� ������ ��������. ��� ������� �� ������ ������ �������
$titlelength = 20;
$template_path 	= "$mosConfig_absolute_path/templates";
$templatefolder = @dir( $template_path );
$darray = array();
$darray[] = mosHTML::makeOption( '...', '������' );// �������� �� ��������� - ��������� ������������ ����������� ������ ����������� �������
if ($templatefolder) {
	while ($templatefile = $templatefolder->read()) {
		if ($templatefile != "." && $templatefile != ".." && $templatefile != ".svn" && $templatefile != "css" && is_dir( "$template_path/$templatefile" )  ) {
			if(strlen($templatefile) > $titlelength) {
				$templatename = substr( $templatefile, 0, $titlelength-3 );
				$templatename .= "...";
			} else {
				$templatename = $templatefile;
			}
			$darray[] = mosHTML::makeOption( $templatefile, $templatename );
		}
	}
	$templatefolder->close();
}
	sort( $darray);
	$lists['one_template'] = mosHTML::selectList( $darray, 'config_one_template', "class=\"inputbox\" ",'value', 'text', $row->config_one_template );
// boston, ����� ��������� ��������
	$lists['time_gen'] = mosHTML::yesnoRadioList( 'config_time_gen', 'class="inputbox"', $row->config_time_gen );
//boston, ���������� �������� ������
	$lists['index_print'] = mosHTML::yesnoRadioList( 'config_index_print', 'class="inputbox"', $row->config_index_print );
// boston, ����������� ���� ����������
	$lists['index_tag'] = mosHTML::yesnoRadioList( 'config_index_tag', 'class="inputbox"', $row->config_index_tag );
// boston, ��������� ������ �� �������� �������������� �� ������
	$lists['module_on_edit_off'] = mosHTML::yesnoRadioList( 'config_module_on_edit_off', 'class="inputbox"', $row->config_module_on_edit_off );
// boston, ����������� ����������� ������ ��
	$lists['optimizetables'] = mosHTML::yesnoRadioList( 'config_optimizetables', 'class="inputbox"', $row->config_optimizetables );
// boston, ���������� �������� ������ content
	$lists['mmb_content_off'] = mosHTML::yesnoRadioList( 'config_mmb_content_off', 'class="inputbox"', $row->config_mmb_content_off );
// boston, ����������� ���� ������ ����������
	$lists['adm_menu_cache'] = mosHTML::yesnoRadioList( 'config_adm_menu_cache', 'class="inputbox"', $row->config_adm_menu_cache );
// ���������� captcha
	$lists['captcha'] = mosHTML::yesnoRadioList( 'config_captcha', 'class="inputbox"', $row->config_captcha );
// ���������� captcha
	$lists['com_frontpage_clear'] = mosHTML::yesnoRadioList( 'config_com_frontpage_clear', 'class="inputbox"', $row->config_com_frontpage_clear);
// ������ ��������� ���������
	$row->config_joomlaxplorer_dir = $row->config_joomlaxplorer_dir ? $row->config_joomlaxplorer_dir : $mosConfig_absolute_path;
// �������������� ��������� �������� "����������� �� �������"
	$lists['auto_frontpage'] = mosHTML::yesnoRadioList( 'config_auto_frontpage', 'class="inputbox"', $row->config_auto_frontpage);
// ���������� �������������� ��������
	$lists['config_uid_news'] = mosHTML::yesnoRadioList( 'config_uid_news', 'class="inputbox"', $row->config_uid_news);
// ������� ��������� �����������
	$lists['config_content_hits'] = mosHTML::yesnoRadioList( 'config_content_hits', 'class="inputbox"', $row->config_content_hits);
// ������ �������
	$form_date = array(
		mosHTML::makeOption( '%d.%m.%Y �.', '����.�����.��� �.' ),
		mosHTML::makeOption( '%d/%m/%Y �.', '����/�����/��� �.' ),
		mosHTML::makeOption( '%d:%m:%Y �.', '����:�����:��� �.' ),
	);
	$lists['form_date'] = mosHTML::selectList( $form_date, 'config_form_date', 'class="inputbox" size="1"', 'value', 'text', $row->config_form_date );
// ������ ������ ���� � �������
	$form_date_full = array(
		mosHTML::makeOption( '%d.%m.%Y �. %H:%M', '����.�����.��� �. ����:������' ),
		mosHTML::makeOption( '%d-%m-%Y �. %H-%M', '����-�����-��� �. ����-������' ),
		mosHTML::makeOption( '%d/%m/%Y �. %H/%M', '����/�����/��� �. ����/������' ),
	);
	$lists['form_date_full'] = mosHTML::selectList( $form_date_full, 'config_form_date_full', 'class="inputbox" size="1"', 'value', 'text', $row->config_form_date_full );
// ��������� ������ �� ������� ������� MySQL
	$lists['config_dbold'] = mosHTML::yesnoRadioList( 'config_dbold', 'class="inputbox"', $row->config_dbold);
// ��������� ������ �� ������� ������� MySQL
	$lists['config_pathway_clean'] = mosHTML::yesnoRadioList( 'config_pathway_clean', 'class="inputbox"', $row->config_pathway_clean);
// ���������� �������� ������ � ������ ����������
	$lists['config_adm_session_del'] = mosHTML::yesnoRadioList( 'config_adm_session_del', 'class="inputbox"', $row->config_adm_session_del);
// ���������� ������ "������"
	$lists['config_disable_button_help'] = mosHTML::yesnoRadioList( 'config_disable_button_help', 'class="inputbox"', $row->config_disable_button_help);
// ���������� ���������� ��������
	$lists['config_disable_checked_out'] = mosHTML::yesnoRadioList( 'config_disable_checked_out', 'class="inputbox"', $row->config_disable_checked_out);
// ���������� favicon
	$lists['config_disable_favicon'] = mosHTML::yesnoRadioList( 'config_disable_favicon', 'class="inputbox"', $row->config_disable_favicon);
// ������������� ������������ ��������� �� ������
	$lists['config_front_debug'] = mosHTML::yesnoRadioList( 'config_front_debug', 'class="inputbox"', $row->config_front_debug);
// ������������� �������� ������ mainbody
	$lists['config_mmb_mainbody_off'] = mosHTML::yesnoRadioList( 'config_mmb_mainbody_off', 'class="inputbox"', $row->config_mmb_mainbody_off);
// �������������� ����������� ����� ������������� �����������
	$lists['config_auto_activ_login'] = mosHTML::yesnoRadioList( 'config_auto_activ_login', 'class="inputbox"', $row->config_auto_activ_login);
// �������������� ����������� ����� ������������� �����������
	$lists['config_sql_mode_off'] = mosHTML::yesnoRadioList( 'config_sql_mode_off', 'class="inputbox"', $row->config_sql_mode_off);
// ���������� ������� '�����������'
	$lists['config_disable_image_tab'] = mosHTML::yesnoRadioList( 'config_disable_image_tab', 'class="inputbox"', $row->config_disable_image_tab);
// ��������� ��������� ����� h1
	$lists['config_title_h1'] = mosHTML::yesnoRadioList( 'config_title_h1', 'class="inputbox"', $row->config_title_h1);
// ��������� ��������� ����� h1 ������ � ������ ������� ��������� �����������
	$lists['config_title_h1_only_view'] = mosHTML::yesnoRadioList( 'config_title_h1_only_view', 'class="inputbox"', $row->config_title_h1_only_view);
// ��������� �������� ���������� �� �����
	$lists['config_disable_date_state'] = mosHTML::yesnoRadioList( 'config_disable_date_state', 'class="inputbox"', $row->config_disable_date_state);
// ��������� �������� ������� � �����������
	$lists['config_disable_access_control'] = mosHTML::yesnoRadioList( 'config_disable_access_control', 'class="inputbox"', $row->config_disable_access_control);
// ����������� ������� �����������
	$lists['config_cache_opt'] = mosHTML::yesnoRadioList( 'config_cache_opt', 'class="inputbox"', $row->config_cache_opt);
//  ��������� ������ css � js ������
	$lists['config_gz_js_css'] = mosHTML::yesnoRadioList( 'config_gz_js_css', 'class="inputbox"', $row->config_gz_js_css);
//  captcha ��� �����������
	$lists['config_captcha_reg'] = mosHTML::yesnoRadioList( 'config_captcha_reg', 'class="inputbox"', $row->config_captcha_reg);
//  captcha ��� ����� ���������
	$lists['config_captcha_cont'] = mosHTML::yesnoRadioList( 'config_captcha_cont', 'class="inputbox"', $row->config_captcha_cont);





// DEBUG - �������
	$lists['debug'] = mosHTML::yesnoRadioList( 'config_debug', 'class="inputbox"', $row->config_debug );


// ��������� �������
	$lists['gzip'] = mosHTML::yesnoRadioList( 'config_gzip', 'class="inputbox"', $row->config_gzip );

	$session = array(
		mosHTML::makeOption( 0, '3 ������� ������ - �� ��������� - ���������' ),
		mosHTML::makeOption( 1, '2 ������� ������ - ��������� ��� IP-������� ������' ),
		mosHTML::makeOption( 2, '1 ������� ������ - �������� �������������' )
	);	 

	$lists['session_type'] = mosHTML::selectList( $session, 'config_session_type', 'class="inputbox" size="1"', 'value', 'text', $row->config_session_type );	

	$errors = array(
		mosHTML::makeOption( -1, '��������� �������' ),
		mosHTML::makeOption( 0, '�����������' ),
		mosHTML::makeOption( E_ERROR|E_WARNING|E_PARSE, '�������' ),
		mosHTML::makeOption( E_ALL , '�������� (���)' )
	);

	$lists['error_reporting'] = mosHTML::selectList( $errors, 'config_error_reporting', 'class="inputbox" size="1"', 'value', 'text', $row->config_error_reporting );

	$lists['admin_expired'] = mosHTML::yesnoRadioList( 'config_admin_expired', 'class="inputbox"', $row->config_admin_expired );

// ��������� ������ ������
	$lists['lang'] = mosHTML::selectList( $langs, 'config_lang', 'class="inputbox" size="1"', 'value', 'text', $row->config_lang );

	$timeoffset = array(	
		mosHTML::makeOption( -12, '(UTC -12:00) ������������� ����� ��������� �������'),
		mosHTML::makeOption( -11, '(UTC -11:00) ������ ������, �����'),
		mosHTML::makeOption( -10, '(UTC -10:00) ������'),
		mosHTML::makeOption( -9.5, '(UTC -09:30) �������, ���������� �������'),
		mosHTML::makeOption( -9, '(UTC -09:00) ������'),
		mosHTML::makeOption( -8, '(UTC -08:00) ������������� ����� (��� &amp; ������)'),
		mosHTML::makeOption( -7, '(UTC -07:00) ����� ������� (��� &amp; ������)'),
		mosHTML::makeOption( -6, '(UTC -06:00) ����������� �����  (��� &amp; ������), ������'),
		mosHTML::makeOption( -5, '(UTC -05:00) ��������� ����� (��� &amp; ������), ������, �����'),
		mosHTML::makeOption( -4, '(UTC -04:00) ������������� ����� (������), �������, ��-���'),
		mosHTML::makeOption( -3.5, '(UTC -03:30) ������������ � ��������'),
		mosHTML::makeOption( -3, '(UTC -03:00) ��������, ������ �����, ����������'),
		mosHTML::makeOption( -2, '(UTC -02:00) ������-������������� �����'),
		mosHTML::makeOption( -1, '(UTC -01:00 ���) �������� �������, ������� �������� ����'),
		mosHTML::makeOption( 0, '(UTC 00:00) �������-����������� �����, ������, ��������, ����������'),
		mosHTML::makeOption( 1 , '(UTC +01:00 ���) ��������, ����������, ������, �����'),
		mosHTML::makeOption( 2, '(UTC +02:00) �����������, ����� ������'),
		mosHTML::makeOption( 3, '(UTC +03:00) ������, �����-���������, ������, ��-����'),
		mosHTML::makeOption( 3.5, '(UTC +03:30) �������'),
		mosHTML::makeOption( 4, '(UTC +04:00) ������, ����, �������, ���-����, ������'),
		mosHTML::makeOption( 4.5, '(UTC +04:30) �����'),
		mosHTML::makeOption( 5, '(UTC +05:00) ������������, �����, �������, ���������, ������'),
		mosHTML::makeOption( 5.5, '(UTC +05:30) ������, ���������, ������, ���-����'),
		mosHTML::makeOption( 5.75, '(UTC +05:45) ��������'),
		mosHTML::makeOption( 6, '(UTC +06:00) ����, �����������, ������, ����, �������'),
		mosHTML::makeOption( 6.30, '(UTC +06:30) ����'),
		mosHTML::makeOption( 7, '(UTC +07:00) ����������, �������, �����, ��������'),
		mosHTML::makeOption( 8, '(UTC +08:00) �������, ����-�����, �����, ��������, �������'),
		mosHTML::makeOption( 8.75, '(UTC +08:00) �������� ���������'),
		mosHTML::makeOption( 9, '(UTC +09:00) ������, �����, ����, �����, �������'),
		mosHTML::makeOption( 9.5, '(UTC +09:30) ��������, ������'),
		mosHTML::makeOption( 10, '(UTC +10:00) �����������, ����, ��������� ���������'),
		mosHTML::makeOption( 10.5, '(UTC +10:30) ������ Lord Howe (���������)'),
		mosHTML::makeOption( 11, '(UTC +11:00) �������, ���������� �������, ����� ���������'),
		mosHTML::makeOption( 11.30, '(UTC +11:30) ������ �������'),
		mosHTML::makeOption( 12, '(UTC +12:00) ��������, ������, ����������, �����'),
		mosHTML::makeOption( 12.75, '(UTC +12:45) ������ �����'),
		mosHTML::makeOption( 13, '(UTC +13:00) �����'),
		mosHTML::makeOption( 14, '(UTC +14:00) ��������'),
	);

	$lists['offset'] = mosHTML::selectList( $timeoffset, 'config_offset_user', 'class="inputbox" size="1"', 'value', 'text', $row->config_offset_user );

	$feed_timeoffset = array(
		mosHTML::makeOption( '-12:00', '(UTC -12:00) ������������� ����� ��������� �������'),
		mosHTML::makeOption( '-11:00', '(UTC -11:00) ������ ������, �����'),
		mosHTML::makeOption( '-10:00', '(UTC -10:00) ������'),
		mosHTML::makeOption( '-09:30', '(UTC -09:30) �������, ���������� �������'),
		mosHTML::makeOption( '-09:00', '(UTC -09:00) ������'),
		mosHTML::makeOption( '-08:00', '(UTC -08:00) ������������� ����� (��� &amp; ������)'),
		mosHTML::makeOption( '-07:00', '(UTC -07:00) ����� ������� (��� &amp; ������)'),
		mosHTML::makeOption( '-06:00', '(UTC -06:00) ����������� �����  (��� &amp; ������), ������'),
		mosHTML::makeOption( '-05:00', '(UTC -05:00) ��������� ����� (��� &amp; ������), ������, �����'),
		mosHTML::makeOption( '-04:00', '(UTC -04:00) ������������� ����� (������), �������, ��-���'),
		mosHTML::makeOption( '-03:30', '(UTC -03:30) ������������ � ��������'),
		mosHTML::makeOption( '-03:00', '(UTC -03:00) ��������, ������ �����, ����������'),
		mosHTML::makeOption( '-02:00', '(UTC -02:00) ������-������������� �����'),
		mosHTML::makeOption( '-01:00', '(UTC -01:00 ���) �������� �������, ������� �������� ����'),
		mosHTML::makeOption( '00:00', '(UTC 00:00) �������-����������� �����, ������, ��������, ����������'),
		mosHTML::makeOption( '01:00' , '(UTC +01:00 ���) ��������, ����������, ������, �����'),
		mosHTML::makeOption( '02:00', '(UTC +02:00) �����������, ����� ������'),
		mosHTML::makeOption( '03:00', '(UTC +03:00) ������, �����-���������, ������, ��-����'),
		mosHTML::makeOption( '03:30', '(UTC +03:30) �������'),
		mosHTML::makeOption( '04:00', '(UTC +04:00) ������, ����, �������, ���-����, ������'),
		mosHTML::makeOption( '04:30', '(UTC +04:30) �����'),
		mosHTML::makeOption( '05:00', '(UTC +05:00) ������������, �����, �������, ���������, ������'),
		mosHTML::makeOption( '05:30', '(UTC +05:30) ������, ���������, ������, ���-����'),
		mosHTML::makeOption( '05:45', '(UTC +05:45) ��������'),
		mosHTML::makeOption( '06:00', '(UTC +06:00) ����, �����������, ������, ����, �������'),
		mosHTML::makeOption( '06:30', '(UTC +06:30) ����'),
		mosHTML::makeOption( '07:00', '(UTC +07:00) ����������, �������, �����, ��������'),
		mosHTML::makeOption( '08:00', '(UTC +08:00) �������, ����-�����, �����, ��������, �������'),
		mosHTML::makeOption( '08:45', '(UTC +08:00) �������� ���������'),
		mosHTML::makeOption( '09:00', '(UTC +09:00) ������, �����, ����, �����, �������'),
		mosHTML::makeOption( '09:30', '(UTC +09:30) ��������, ������'),
		mosHTML::makeOption( '10:00', '(UTC +10:00) �����������, ����, ��������� ���������'),
		mosHTML::makeOption( '10:30', '(UTC +10:30) ������ Lord Howe (���������)'),
		mosHTML::makeOption( '11:00', '(UTC +11:00) �������, ���������� �������, ����� ���������'),
		mosHTML::makeOption( '11:30', '(UTC +11:30) ������ �������'),
		mosHTML::makeOption( '12:00', '(UTC +12:00) ��������, ������, ����������, �����'),
		mosHTML::makeOption( '12:45', '(UTC +12:45) ������ �����'),
		mosHTML::makeOption( '13:00', '(UTC +13:00) �����'),
		mosHTML::makeOption( '14:00', '(UTC +14:00) ��������'),
	);

	$lists['feed_timeoffset'] = mosHTML::selectList( $feed_timeoffset, 'config_feed_timeoffset', 'class="inputbox" size="1"', 'value', 'text', $row->config_feed_timeoffset );


// ��������� �����
	$mailer = array(
		mosHTML::makeOption( 'mail', '������� PHP mail' ),
		mosHTML::makeOption( 'sendmail', 'Sendmail' ),
		mosHTML::makeOption( 'smtp', '������ SMTP' )
	);
	$lists['mailer'] 	= mosHTML::selectList( $mailer, 'config_mailer', 'class="inputbox" size="1"', 'value', 'text', $row->config_mailer );
	$lists['smtpauth'] 	= mosHTML::yesnoRadioList( 'config_smtpauth', 'class="inputbox"', $row->config_smtpauth );

// ��������� ����
	$lists['caching'] 	= mosHTML::yesnoRadioList( 'config_caching', 'class="inputbox"', $row->config_caching );


// ��������� �������������

	$lists['allowUserRegistration'] = mosHTML::yesnoRadioList( 'config_allowUserRegistration', 'class="inputbox"',	$row->config_allowUserRegistration );
	$lists['useractivation'] 		= mosHTML::yesnoRadioList( 'config_useractivation', 'class="inputbox"',	$row->config_useractivation );
	$lists['uniquemail'] 			= mosHTML::yesnoRadioList( 'config_uniquemail', 'class="inputbox"',	$row->config_uniquemail );
	$lists['shownoauth'] 			= mosHTML::yesnoRadioList( 'config_shownoauth', 'class="inputbox"', $row->config_shownoauth );
	$lists['frontend_userparams']	= mosHTML::yesnoRadioList( 'config_frontend_userparams', 'class="inputbox"', $row->config_frontend_userparams );

// ��������� META-������
	$lists['MetaAuthor']			= mosHTML::yesnoRadioList( 'config_MetaAuthor', 'class="inputbox"', $row->config_MetaAuthor );
	$lists['MetaTitle'] 			= mosHTML::yesnoRadioList( 'config_MetaTitle', 'class="inputbox"', $row->config_MetaTitle );

// ��������� ����������
	$lists['log_searches'] 			= mosHTML::yesnoRadioList( 'config_enable_log_searches', 'class="inputbox"', $row->config_enable_log_searches );
	$lists['enable_stats'] 			= mosHTML::yesnoRadioList( 'config_enable_stats', 'class="inputbox"', $row->config_enable_stats );
	$lists['log_items']	 			= mosHTML::yesnoRadioList( 'config_enable_log_items', 'class="inputbox"', $row->config_enable_log_items );

// ��������� SEO
	$lists['sef'] 					= mosHTML::yesnoRadioList( 'config_sef', 'class="inputbox" onclick="javascript: if (document.adminForm.config_sef[1].checked) { alert(\'���������� ������������� htaccess.txt � .htaccess\') }"', $row->config_sef );
	$lists['pagetitles'] 			= mosHTML::yesnoRadioList( 'config_pagetitles', 'class="inputbox"', $row->config_pagetitles );

	$pagetitles_first = array(
		mosHTML::makeOption( '0', '�������� ����� - ��������� ��������' ),
		mosHTML::makeOption( '1', '��������� �������� - �������� ����� (�� ���������)' ),
		mosHTML::makeOption( '2', '�������� ����� ( ������ )' ),
		mosHTML::makeOption( '3', '��������� �������� ( ������ )' ),
	);
	$lists['pagetitles_first'] = mosHTML::selectList( $pagetitles_first, 'config_pagetitles_first', 'class="inputbox" size="1"', 'value', 'text', $row->config_pagetitles_first );



// ��������� �����������
	$lists['link_titles'] 			= mosHTML::yesnoRadioList( 'config_link_titles', 'class="inputbox"', $row->config_link_titles );
	$lists['readmore'] 				= mosHTML::RadioList( $show_hide_r, 'config_readmore', 'class="inputbox"', $row->config_readmore, 'value', 'text' );
	$lists['vote'] 					= mosHTML::RadioList( $show_hide_r, 'config_vote', 'class="inputbox"', $row->config_vote, 'value', 'text' );
	$lists['hideAuthor'] 			= mosHTML::RadioList( $show_hide, 'config_hideAuthor', 'class="inputbox"', $row->config_hideAuthor, 'value', 'text' );
	$lists['hideCreateDate'] 		= mosHTML::RadioList( $show_hide, 'config_hideCreateDate', 'class="inputbox"', $row->config_hideCreateDate, 'value', 'text' );
	$lists['hideModifyDate'] 		= mosHTML::RadioList( $show_hide, 'config_hideModifyDate', 'class="inputbox"', $row->config_hideModifyDate, 'value', 'text' );
	$lists['hits'] 					= mosHTML::RadioList( $show_hide_r, 'config_hits', 'class="inputbox"', $row->config_hits, 'value', 'text' );
	$lists['hidePrint'] 			= mosHTML::RadioList( $show_hide, 'config_hidePrint', 'class="inputbox"', $row->config_hidePrint, 'value', 'text' );
	$lists['hideEmail'] 			= mosHTML::RadioList( $show_hide, 'config_hideEmail', 'class="inputbox"', $row->config_hideEmail, 'value', 'text' );
	$lists['icons'] 				= mosHTML::RadioList( $show_hide_r, 'config_icons', 'class="inputbox"', $row->config_icons, 'value', 'text' );
	$lists['back_button'] 			= mosHTML::RadioList( $show_hide_r, 'config_back_button', 'class="inputbox"', $row->config_back_button, 'value', 'text' );
	$lists['item_navigation'] 		= mosHTML::RadioList( $show_hide_r, 'config_item_navigation', 'class="inputbox"', $row->config_item_navigation, 'value', 'text' );
	$lists['multipage_toc'] 		= mosHTML::RadioList( $show_hide_r, 'config_multipage_toc', 'class="inputbox"', $row->config_multipage_toc, 'value', 'text' );

	$itemid_compat = array(
		mosHTML::makeOption( '11', 'Joomla! 1.0.11 � ����' ),
		mosHTML::makeOption( '0', 'Joomla! 1.0.12 � ����' ),
	);
	$lists['itemid_compat'] 		= mosHTML::selectList( $itemid_compat, 'config_itemid_compat', 'class="inputbox" size="1"', 'value', 'text', $row->config_itemid_compat );

// SHOW EDIT FORM

	HTML_config::showconfig( $row, $lists, $option );
}

/**
 * ���������� ������������
 */
function saveconfig( $task ) {
	global $database, $mosConfig_absolute_path, $mosConfig_password, $mosConfig_session_type;

	$row = new mosConfig();
	if (!$row->bind( $_POST )) {
		mosRedirect( 'index2.php', $row->getError() );
	}
	
	// if Session Authentication Type changed, delete all old Frontend sessions only - which used old Authentication Type
	if ( $mosConfig_session_type != $row->config_session_type ) {
		$past = time();
		$query = "DELETE FROM #__session"
		. "\n WHERE time < " . $database->Quote( $past )
		. "\n AND ("
		. "\n ( guest = 1 AND userid = 0 ) OR ( guest = 0 AND gid > 0 )" 
		. "\n )"
		;
		$database->setQuery( $query );
		$database->query();
	}

	$server_time 		= date( 'O' ) / 100;
	$offset 			= $_POST['config_offset_user'] - $server_time;
	$row->config_offset = $offset;
	
	//override any possible database password change
	$row->config_password 	= $mosConfig_password;

	// handling of special characters
	$row->config_sitename			= htmlspecialchars( $row->config_sitename, ENT_QUOTES );	

	// handling of quotes (double and single) and amp characters
	// htmlspecialchars not used to preserve ability to insert other html characters
	$row->config_offline_message	= ampReplace( $row->config_offline_message );	
	$row->config_offline_message	= str_replace( '"', '&quot;', $row->config_offline_message );	
	$row->config_offline_message	= str_replace( "'", '&#039;', $row->config_offline_message );	
	
	// handling of quotes (double and single) and amp characters
	// htmlspecialchars not used to preserve ability to insert other html characters
	$row->config_error_message		= ampReplace( $row->config_error_message );	
	$row->config_error_message		= str_replace( '"', '&quot;', $row->config_error_message );	
	$row->config_error_message		= str_replace( "'", '&#039;', $row->config_error_message );	

	$config = "<?php \n";

	$RGEmulation = intval( mosGetParam( $_POST, 'rgemulation', 0 ) );
	$config .= "if(!defined('RG_EMULATION')) { define( 'RG_EMULATION', $RGEmulation ); }\n";


	$config .= $row->getVarText();
	$config .= "setlocale (LC_TIME, \$mosConfig_locale);\n";
	$config .= '?>';

	$fname = $mosConfig_absolute_path . '/configuration.php';

	$enable_write 	= intval( mosGetParam( $_POST, 'enable_write', 0 ) );
	$oldperms 		= fileperms($fname);
	if ( $enable_write ) {
		@chmod( $fname, $oldperms | 0222);
	}

	if ( $fp = fopen($fname, 'w') ) {
		fputs($fp, $config, strlen($config));
		fclose($fp);
		if ($enable_write) {
			@chmod($fname, $oldperms);
		} else {
			if (mosGetParam($_POST,'disable_write',0))
				@chmod($fname, $oldperms & 0777555);
		} // if

		$msg = '������������ ������� ���������';

		// apply file and directory permissions if requested by user
		$applyFilePerms = mosGetParam($_POST,'applyFilePerms',0) && $row->config_fileperms!='';
		$applyDirPerms = mosGetParam($_POST,'applyDirPerms',0) && $row->config_dirperms!='';
		if ($applyFilePerms || $applyDirPerms) {
			$mosrootfiles = array(
				'administrator',
				'cache',
				'components',
				'images',
				'language',
				'mambots',
				'media',
				'modules',
				'templates',
				'configuration.php'
			);
			$filemode = NULL;

			if ( $applyFilePerms ) {
				$filemode = octdec( $row->config_fileperms );
			}

			$dirmode = NULL;

			if ( $applyDirPerms ) {
				$dirmode = octdec( $row->config_dirperms );
			}

			foreach ($mosrootfiles as $file) {
				mosChmodRecursive( $mosConfig_absolute_path.'/'.$file, $filemode, $dirmode );
			}
		} // if

		switch ( $task ) {
			case 'apply':
				mosRedirect( 'index2.php?option=com_config&hidemainmenu=1', $msg );
				break;

			case 'save':
			default:
				mosRedirect( 'index2.php', $msg );
				break;
		}
	} else {
		if ($enable_write) {
			@chmod( $fname, $oldperms );
		}
		mosRedirect( 'index2.php', '������! ���������� ������� ��� ������ ���� ������������!' );
	}
}
?>
