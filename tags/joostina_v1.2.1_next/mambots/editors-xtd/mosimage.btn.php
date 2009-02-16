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

$_MAMBOTS->registerFunction('onCustomEditorButton','botMosImageButton');

/**
* ������ ����������� Joostina
* @return array - ���������� ������ �� ���� ���������: ( imageName, textToInsert )
*/
function botMosImageButton() {
	global $option;

	// button is not active in specific content components
	switch($option) {
		case 'com_sections':
		case 'com_categories':
		case 'com_modules':
			$button = array('','');
			break;

		default:
			$button = array('mosimage.gif','{mosimage}');
			break;
	}

	return $button;
}
?>
