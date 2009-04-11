<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

class jcePlugins extends mosDBTable {
	/**
	@var int*/
	var $id = null;
	/**
	@var varchar*/
	var $name = null;
	/**
	@var varchar*/
	var $plugin = null;
	/**
	@var varchar*/
	var $type = null;
	/**
	@var tinyint unsigned*/
	var $icon = null;
	var $layout_icon = null;
	/**
	@var tinyint unsigned*/
	var $access = null;
	/**
	@var tinyint*/
	var $row = null;
	/**
	@var tinyint*/
	var $ordering = null;
	/**
	@var tinyint*/
	var $published = null;
	/**
	@var tinyint*/
	var $editable = null;
	/**
	@var varchar*/
	var $elements = null;
	/**
	@var tinyint*/
	var $iscore = null;
	/**
	@var tinyint*/
	var $client_id = null;
	/**
	@var int unsigned*/
	var $checked_out = null;
	/**
	@var datetime*/
	var $checked_out_time = null;
	/**
	@var text*/
	var $params = null;

	function jcePlugins(&$db) {
		$this->mosDBTable('#__jce_plugins','id',$db);
	}
}
?>