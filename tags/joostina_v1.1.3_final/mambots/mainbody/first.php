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

$_MAMBOTS->registerFunction( 'onMainbody', 'body_clear' );
$_MAMBOTS->registerFunction( 'onTemplate', 'template_clear' );


/* ������� ���������� ������� ����������� �������� ����� ���������� �� ������������ */
function body_clear( ){
	global $_MOS_OPTION;
	$text = $_MOS_OPTION['buffer'];
	$text = str_replace("\n",'',$text);
	$text = str_replace("\r",'',$text);
	$text = str_replace("\t",'',$text);
	$_MOS_OPTION['buffer'] = $text;
	return;
}

/* ������� ����� ���� �������� �� ��������� */
function template_clear( ){
	global $_MOS_OPTION;
	$text = $_MOS_OPTION['mainbody'];
	$text = str_replace(array("\r\n", "\r", "\n", "\t", '  '), ' ', $text);// �������� ���������, ��������� ������, ������� �������� ��� �������� �������
	$text = str_replace('>  <', '><', $text);
	$text = str_replace('> <', '><', $text);
	$text = str_replace(' >', '>', $text);
	$text = str_replace('> ', '>', $text);
	$text = str_replace(' <', '<', $text);
	$text = str_replace('< ', '<', $text);
	$text = str_replace('  ', ' ', $text);
	$_MOS_OPTION['mainbody'] = $text;
	return;
}

?>
