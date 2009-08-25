<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/LICENSE.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� help/COPYRIGHT.php.
*
* ������ ���� ������� Mitrich http://mitrichlab.ru
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die();

$mainframe = &mosMainFrame::getInstance();
global $my;

if ( $mainframe->getCfg('frontend_login') != NULL && ($mainframe->getCfg('frontend_login') === 0 || $mainframe->getCfg('frontend_login') === '0')) {	
	return; 
}

if ($my->id) {
	$params->set('template', 'logout.php');
} 
else {
	$params->def('template', 'vertical.php');
}

//���������� ��������������� �����
$module->get_helper();

//���������� ������
if($module->set_template($params)){
	require($module->template);
}