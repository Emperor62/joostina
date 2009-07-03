<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*
* @version		3.1.0
* @package		patTemplate
* @author		Stephan Schmidt <schst@php.net>
* @license		LGPL
* @link		http://www.php-tools.net
*/
// ������ ������� �������
defined('_VALID_MOS') or die();


class patTemplate_Module {
var $_name = null;
var $_params = array();
function getName() {
return $this->_name;
}
function setParams($params,$clear = false) {
if($clear === true)
$this->_params = array();
$this->_params = array_merge($this->_params,$params);
}
function getParam($name) {
if(isset($this->_params[$name]))
return $this->_params[$name];
return false;
}
}
?>