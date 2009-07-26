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

class jdebug {
	/* ���� ��������� ����*/
	var $_log = array();
	/* ����� ��������� ����*/
	var $text = null;
	/* �������� */
	var $_insc = array();

	function getInstance(){
		static $instance;
		if (!is_object( $instance )) {
			$instance = new jdebug();
		}
		return $instance;
	}

	/* ���������� ��������� � ���*/
	function add($text) {
		$this->_log[] = $text;
	}

	/* ���������� ��������� � ���*/
	function insc($key) {
		if(!isset($this->_insc[$key])){
			$this->_insc[$key] = 0;
		}
		$this->_insc[$key] ++;
	}

	
	/* ����� ��������� �� ����*/
	function get($db = 1) {
		$database = &database::getInstance();

		$this->add('<b>'._INCLUDED_FILES.':</b> '.count(get_included_files()));
		if($db){
			$this->_db();
		}else{
			$this->add(_SQL_QUERIES_COUNT.': '.count($database->_log));
		}

		/* �������� */
		foreach($this->_insc as $key => $value) {
			$this->text .= 'INSC: <b>'.$key.'</b>: '.$value.'<br />';
		}
		/* ��� */
		foreach($this->_log as $key => $value) {
			$this->text .= $value.'<br />';
		}

		echo '<noindex><div id="jdebug">'.$this->text.'</div></noindex>';
	}

	/* ������� sql �������� ���� ������*/
	function _db() {
		$database = &database::getInstance();

		count($database->_log);
		$this->add('<b>SQL:</b> '.count($database->_log).'<pre>');
		foreach($database->_log as $k => $sql) {
			$this->add($k + 1 . ': '.$sql.'<hr />');
		}
		$this->add('</pre>');
		return;
	}
}
;
/* ���������� ��������� ���������� ��������� � ���*/
function jd_log($text) {
	$debug = &jdebug::getInstance();
	$debug->add($text);
}
/* �������� ������� */
function jd_insc($name='counter'){
	$debug = &jdebug::getInstance();
	$debug->insc($name);
}

function jd_get(){
	$debug = &jdebug::getInstance();
	echo $debug->get();
}

?>
