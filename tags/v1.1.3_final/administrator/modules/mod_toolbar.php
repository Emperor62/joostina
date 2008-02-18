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

global $cur_template,$mosConfig_absolute_path;

if( !defined( '_TOOLBAR_MODULE' )) {
	define( '_TOOLBAR_MODULE', 1 );
	if (file_exists( $mosConfig_absolute_path .'/administrator/templates/'.$cur_template.'/menubar.php' )) {
		require_once( $mosConfig_absolute_path .'/administrator/templates/'.$cur_template.'/menubar.php' );
	} else {
		require_once( $mosConfig_absolute_path .'/administrator/includes/menubar.html.php' );
	}
}


if ($path = $mainframe->getPath( 'toolbar' )) {
	include_once( $path );
}
?>
