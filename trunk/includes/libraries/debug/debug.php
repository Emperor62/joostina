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
	function add($text,$top=0) {
		$top ? array_unshift($this->_log,$text) : $this->_log[] = $text;
	}

	/* ���������� ��������� � ���*/
	function inc($key) {
		if(!isset($this->_inc[$key])){
			$this->_inc[$key] = 0;
		}
		$this->_inc[$key] ++;
	}

	
	/* ����� ��������� �� ����*/
	function get() {
		echo '<del><![CDATA[<noindex>]]></del><pre>';
		/* �������� */
		foreach($this->_inc as $key => $value) {
			$this->text .= '<small class="debug_counter">COUNTER:</small> <b>'.htmlentities($key).'</b>: '.$value.'<br />';
		}
		$this->text.= '<div class="debug_files"><b>'._INCLUDED_FILES.':</b> '.count(get_included_files()).'</div>';
		
		/* ��� */
		$this->text .= '<ul class="debug_log">';
		foreach($this->_log as $key => $value) {
			$this->text .= '<li><small>LOG:</small> '.$value.'</li>';
		}
		$this->text .= '</ul>';

		/* ������������ ����� */
		$files = get_included_files();
		foreach($files as $key => $value) {
			$this->text .= '<small>FILE:</small> '.$value.'<br />';
		}

		echo '<div id="jdebug">'.$this->text.'</div>';
		echo '</pre><del><![CDATA[</noindex>]]></del>';
	}
}
;
/* ���������� ��������� ���������� ��������� � ��� */
function jd_log($text) {
	$debug = &jdebug::getInstance();
	$debug->add($text);
}
/* ���������� ��������� ���������� ��������� � ������ ���� */
function jd_log_top($text) {
	$debug = &jdebug::getInstance();
	$debug->add($text,1);
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