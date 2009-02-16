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

require_once( $mainframe->getPath( 'toolbar_html' ) );

// handle the task
$act = mosGetParam( $_REQUEST, 'act', '' );
$task = mosGetParam( $_REQUEST, 'task', '' );

switch ($act){
	case "config":
		switch( $task ) {
			case "save":
				break;
			case "apply":
				TOOLBAR_jpack::_CONFIG();
				break;
			case "":
				TOOLBAR_jpack::_CONFIG();
				break;
			default:
				break;
		}
		break;
	case "pack":
			TOOLBAR_jpack::_PACK();	
		break;
	case "ajax":
		break;
	default:
			TOOLBAR_jpack::_PACK();		
		break;
}

?>
