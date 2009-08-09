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
	var $_inc = array();

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
	function inc($key) {
		if(!isset($this->_inc[$key])){
			$this->_inc[$key] = 0;
		}
		$this->_inc[$key] ++;
	}

	
	/* ����� ��������� �� ����*/
	function get($db = 1) {
		echo '<pre>';
		/* �������� */
		foreach($this->_inc as $key => $value) {
			$this->text .= '<small>COUNTER:</small> <b>'.htmlentities($key).'</b>: '.$value.'<br />';
		}
		/* ��� */
		foreach($this->_log as $key => $value) {
			$this->text .= '<small>LOG:</small> '.$value.'<br />';
		}

		echo '<noindex><div id="jdebug">'.$this->text.'</div></noindex>';
		echo '</pre>';
	}
}
;
/* ���������� ��������� ���������� ��������� � ���*/
function jd_log($text) {
	$debug = &jdebug::getInstance();
	$debug->add($text);
}
/* �������� ������� */
function jd_inc($name='counter'){
	$debug = &jdebug::getInstance();
	$debug->inc($name);
}

function jd_get(){
	$debug = &jdebug::getInstance();
	echo $debug->get();
}