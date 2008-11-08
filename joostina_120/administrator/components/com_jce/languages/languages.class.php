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

class jceLanguages extends mosDBTable {
	/**
	@var int*/
	var $id = null;
	/**
	@var varchar*/
	var $name = null;
	/**
	@var varchar*/
	var $lang = null;
	/**
	@var varchar*/
	var $published = null;

	function jceLanguages(&$db) {
		$this->mosDBTable('#__jce_langs','id',$db);
	}
}
?>
