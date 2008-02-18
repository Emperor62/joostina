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

$_MAMBOTS->registerFunction( 'onCustomEditorButton', 'botMosImageButton' );

/**
* ������ ����������� Mambo
* @return array - ���������� ������ �� ���� ���������: ( imageName, textToInsert )
*/
function botMosImageButton() {
	global $option;

	// button is not active in specific content components
	switch ( $option ) {
		case 'com_sections':
		case 'com_categories':
		case 'com_modules':
			$button = array( '', '' );
			break;

		default:
			$button = array( 'mosimage.gif', '{mosimage}' );
			break;
	}

	return $button;
}
?>
