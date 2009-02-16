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

class jdebug {
	/* ���� ��������� ���� */
	var $_log = array();
	/* ����� ��������� ���� */
	var $text = null;
	/* ���������� ��������� � ��� */
	function add($text){
		$this->_log[] = $text;
	}
	/* ����� ��������� �� ���� */
	function get($db=1){
		if($db) $this->_db();
		foreach( $this->_log as $key => $value ) {
			$this->text .= $value.'<br />';
		}
		echo '<noindex><div id="jdebug">'.$this->text.'</div></noindex>';
	}
	/* ������� sql �������� ���� ������ */
	function _db(){
		global $database;
		$this->add('<b>SQL ��������:</b> '.count($database->_log).'<pre>');
		foreach ($database->_log as $k=>$sql) {
			$this->add($k+1 .': '.$sql.'<hr />');
		}
		$this->add('</pre>');
		return;
	}

};
/* ���������� ��������� ���������� ��������� � ��� */
function jlog($text){
	global $debug;
	if(!isset($debug)) $debug = new jdebug();
	$debug->add($text);
}

?>
