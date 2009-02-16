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

if( !defined( '_QUICKICON_MODULE' )) {
	define( '_QUICKICON_MODULE', 1 );
	if (file_exists( $mosConfig_absolute_path .'/administrator/templates/'.$cur_template.'/quickicons.php' )) {
		require_once( $mosConfig_absolute_path .'/administrator/templates/'.$cur_template.'/quickicons.php' );
	} else {
		require_once( $mosConfig_absolute_path .'/administrator/components/com_customquickicons/quickicons.php' );
	}
}
?>
